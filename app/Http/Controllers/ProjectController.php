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

class ProjectController extends Controller
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
        $projects = $this->repository->query($request, ['paginate' => true, 'searchColumns' => ['price', 'status']]);

        return view('pages.projects.index', [
            'projects' => $projects, 'pageTitle' => 'Services | Pemad App'
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

            return redirect()->route('projects.show', $project->id)->with('message', 'Project created!');
        } catch (\Throwable $th) {
            Log::error('Error creating project', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error creating project!');
        }
    }

    /**
     * Update the specified project in storage.
     *
     * @param string $id
     * @param UpsertProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $id, UpsertProjectRequest $request): RedirectResponse
    {
        try {
            $this->repository->update($id, $request);

            return redirect()->back()->with('message', 'Project updated!');
        } catch (\Throwable $th) {
            LOG::error('Error updating project', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error updating project!');
        }
    }

    /**
     * Display the specified project.
     * If id is 'new', show the project creation form.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        $project = $id === 'new' ? null : $this->repository->show($id);

        $users = User::select('id', 'name')->where('role', 'user')->orWhere('role', 'admin')->pluck('name', 'id');

        $clients =  DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->pluck('users.name', 'clients.id');
        $services = Service::select('id', 'name')->pluck('name', 'id');

        return view('pages.projects.show', [
            'project' => $project, 'users' => $users,
            'clients' => $clients,
            'services' => $services,
            'backRoute' => route('projects.index'),
        ]);
    }

    /**
     * Remove the specified project from storage.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->repository->delete($id);

            return redirect()->back();
        } catch (\Throwable $th) {
            LOG::error('Error deleting project', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error deleting project!');
        }
    }
}
