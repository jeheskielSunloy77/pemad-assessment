<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display the user's profile.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $this->repository->update($request->user()->id, $request);

            return redirect()->route('profile.edit')->with('message', 'Profile updated!');
        } catch (\Throwable $th) {
            Log::error('Error updating profile', ['error' => $th->getMessage()]);

            return redirect()->back()->with('message', 'Error updating profile');
        }
    }

    /**
     * Delete the user's account.
     * User must confirm their password before deletion.
     *
     * @return \Illuminate\View\View
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $this->repository->delete($request->user()->id);

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } catch (\Throwable $th) {
            Log::error('Error deleting user', ['error' => $th->getMessage()]);

            return redirect()->back()->with('message', 'Error deleting user');
        }
    }
}
