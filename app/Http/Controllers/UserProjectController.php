<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProjectRequest;
use App\Models\Service;
use App\Models\User;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserProjectController extends Controller
{
    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of projects, with search, sort and pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        if ($user->role === 'user') {

            $projects = $this->repository->queryByUser($request, $user->id, ['paginate' => true, 'searchColumns' => ['price', 'status']]);
        } else {
            $projects = $this->repository->query($request, [
                'paginate' => true, 'searchColumns' => ['price', 'status'],
                'whereHas' => [
                    'table' => 'client',
                    'column' => 'user_id',
                    'value' => $user->id
                ]
            ]);
        }

        return view('pages.projects.index', [
            'projects' => $projects,
            'isUserRoute' => true,
            'pageTitle' => 'My Projects | Pmad App',
        ]);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param UpsertProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UpsertProjectRequest $request): RedirectResponse
    {
        try {
            $project = $this->repository->store($request);

            return redirect()->route('my-projects.show', $project->id)->with('message', 'Project created!');
        } catch (\Throwable $th) {
            Log::error('Error creating project', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error creating project!');
        }
    }

    /**
     * Display the specified project.
     * If id is 'new', show the project creation form.
     * If the user role is 'user', dont show the client select input.
     * If the user role is 'client', dont show the user select input.
     * If is owner and a user, show only the services created by the user.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        $user = auth()->user();
        $project = $id === 'new' ? null : $this->repository->show($id);
        $isUpsert = !$project || $user->id === $project->user_id;

        $clients = $user->role === 'user' ? DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->pluck('users.name', 'clients.id') : null;
        $users = $user->role === 'client' ? User::select('id', 'name')->where('role', 'user')->orWhere('role', 'admin')->pluck('name', 'id') : null;
        $services = Service::select('id', 'name');


        if ($isUpsert && $user->role === 'user') {
            $services = $services->where('user_id', $user->id);
        }

        $services = $services->pluck('name', 'id');

        return view('pages.projects.show', [
            'project' => $project,
            'clients' => $clients,
            'users' => $users,
            'services' => $services,
            'backRoute' => route('my-projects.index'),
            'formAction' => $project ? route('projects.update', $project->id) : route('my-projects.store'),
        ]);
    }
}
