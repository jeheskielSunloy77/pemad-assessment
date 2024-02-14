<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertServiceRequest;
use App\Repositories\ServiceRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ServiceController extends Controller
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
        $services = $this->repository->query(
            $request,
            [
                'searchColumns' => ['name',  'type', 'language'],
                'paginate' => true
            ]
        );

        return view('pages.services.index', [
            'services' => $services,
            'columns' => ['service name', 'created by', 'type', 'language', 'Created At', 'actions'], 'pageTitle' => 'Services | Pemad App'
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

            return redirect()->route('services.show', $service->id)->with('message', 'Service created!');
        } catch (\Throwable $th) {
            Log::error('Error creating service', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error creating service!');
        }
    }

    /**
     * Update the specified service in storage.
     *
     * @param string $id
     * @param UpsertServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $id, UpsertServiceRequest $request): RedirectResponse
    {
        try {
            $this->repository->update($id, $request);

            return redirect()->back()->with('message', 'Service updated!');
        } catch (\Throwable $th) {
            LOG::error('Error updating service', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error updating service!');
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

        return view('pages.services.show', ['service' => $service, 'backRoute' => route('services.index')]);
    }

    /**
     * Remove the specified service from storage.
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
            Log::error('Error deleting service', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error deleting service!');
        }
    }
}
