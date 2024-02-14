<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertServiceRequest;
use App\Repositories\ServiceRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserServiceController extends Controller
{
    protected $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of services, with search, sort and pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $isMyServices = $request->has('mine');

        $queryOpts = [
            'paginate' => true,
            'searchColumns' => ['name', 'type'],
        ];

        if ($isMyServices) {

            $services = $this->repository->queryByUser($request, auth()->id(), $queryOpts);
        } elseif ($request->has('from')) {

            $services = $this->repository->query($request, array_merge(
                $queryOpts,
                [
                    'whereHas' => [
                        'table' => 'user',
                        'column' => 'role',
                        'value' => $request->from,
                    ],
                ]
            ));
        } else {
            $services = $this->repository->query($request, $queryOpts);
        }


        $columns = ['service name', 'created by', 'type', 'language', 'Created At', 'actions'];
        $pageTitle = 'Browse';

        if ($isMyServices) {
            $columns = ['service name',  'type', 'language', 'Created At', 'actions'];
            $pageTitle = 'My';
        }

        if ($request->has('from')) {
            $columns = ['service name', 'offered by', 'type', 'language', 'Created At', 'actions'];
            $pageTitle = $request->from === 'user' ? 'Offered' : 'Requested';
        }

        return view('pages.services.index', [
            'services' => $services,
            'isUserRoute' => true,
            'columns' => $columns,
            'pageTitle' => $pageTitle . ' Services | Pmad App',
        ]);
    }

    /**
     * Store a newly created service in storage.
     *
     * @param UpsertServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UpsertServiceRequest $request): RedirectResponse
    {
        try {
            $service = $this->repository->store($request);

            return redirect()->route('browse-services.show', $service->id)->with('message', 'Service created!');
        } catch (\Throwable $th) {
            Log::error('Error creating service', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error creating service!');
        }
    }

    /**
     * Display the specified service.
     * If id is 'new', show the service creation form.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        $service = $id === 'new' ? null : $this->repository->show($id);

        return view('pages.services.show', [
            'service' => $service,
            'backRoute' => route('browse-services.index'), 'isUserRoute' => true,
            'formAction' => $service ? route('services.update', $service->id) : route('browse-services.store'),
            'isUserRoute' => true,
        ]);
    }
}
