<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AppRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    protected function setDataPayload(Request $request): array
    {
        $password = $request->input('password');

        return [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role') ?? auth()->user()->role,
            'password' => $password ? Hash::make($password) : auth()->user()->password,
            'avatar_url' => $request->input('avatar_url') ?? 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $request->input('email'),
        ];
    }
}
