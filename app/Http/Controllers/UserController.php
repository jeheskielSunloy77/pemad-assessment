<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Client;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of users, with search, sort and pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $users = $this->repository->query($request, [
            'columns' => ['id', 'name', 'email', 'role', 'avatar_url', 'created_at'],
            'searchColumns' => ['name', 'email', 'role'],
            'paginate' => true
        ]);

        return view('pages.users.index', [
            'users' => $users,
            'pageTitle' => 'Users | Pemad App'
        ]);
    }

    /**
     * Store a newly created user in storage.
     * If the user is a client, create a client record.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $user = $this->repository->store($request);

            if ($user->role === 'client') {
                Client::create([
                    'user_id' => $user->id,
                    'company_name' => $request->company_name,
                    'bank_account_number' => $request->bank_account_number,
                    'bank_account_name' => $request->bank_account_name,
                ]);
            }

            return redirect()->route('users.show', $user->id)->with('message', 'User created!');
        } catch (\Throwable $th) {
            Log::error('Error creating user', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error creating user');
        }
    }

    /**
     * Update the specified user in storage.
     * If previously a client, and now not a client, delete the client record.
     * If previously not a client, and now a client, create a client record.
     *
     * @param string $id
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $id, UpdateUserRequest $request): RedirectResponse
    {
        try {
            $user = $this->repository->update($id, $request);

            $isClient = $user->role === 'client';
            $isInitClient = $request->init_role === 'client';

            if (!$isClient && $isInitClient) {
                Client::where('user_id', $user->id)->first()->delete();
            }

            if ($isClient) {
                if (!$isInitClient) {
                    Client::create([
                        'user_id' => $user->id,
                        'company_name' => $request->company_name,
                        'bank_account_number' => $request->bank_account_number,
                        'bank_account_name' => $request->bank_account_name,
                    ]);
                } else {
                    Client::where('user_id', $user->id)->first()->update([
                        'company_name' => $request->company_name,
                        'bank_account_number' => $request->bank_account_number,
                        'bank_account_name' => $request->bank_account_name,
                    ]);
                }
            }

            return redirect()->back()->with('message', 'User updated!');
        } catch (\Throwable $th) {
            Log::error('Error updating user', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error updating user');
        }
    }

    /**
     * Display the specified user.
     * If id is 'new', show the user creation form.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        $user = $id === 'new' ? null : $this->repository->show($id);

        return view('pages.users.show', ['user' => $user]);
    }

    /**
     * Remove the specified user from storage.
     * If the user is a client, delete the client record.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $data = $this->repository->delete($id);

            if ($data->role === 'client') {
                Client::where('user_id', $data->id)->first()->delete();
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error('Error deleting user', ['error' => $th->getMessage()]);

            return redirect()->back()->withInput()->with('message', 'Error deleting user');
        }
    }
}
