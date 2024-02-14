<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceRepository extends AppRepository
{
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    protected function setDataPayload(Request $request): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
        ];
    }
}
