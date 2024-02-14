<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class ProjectRepository extends AppRepository
{
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    protected function setDataPayload(Request $request): array
    {
        return [
            'user_id' => $request->input('user_id') ?? auth()->id(),
            'client_id' => $request->input('client_id') ?? auth()->user()->client->id,
            'service_id' => $request->input('service_id'),
            'status' => $request->input('status'),
            'payment_due_date' => $request->input('payment_due_date'),
            'paid_at' => $request->input('paid_at'),
            'price' => $request->input('price')
        ];
    }
}
