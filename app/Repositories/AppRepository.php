<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AppRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Used to query data from the database and cache the result for future use, 
     * it also accepts an array of options to customize the query.
     * 
     * @param Request $request
     * @param array $opts
     * @return mixed
     */

    private function queryData(Request $request, array $opts = [])
    {
        $queryId = md5(json_encode($request->all()) . json_encode($opts));

        $cache = Cache::tags($this->model->getTable())->get($queryId);
        if ($cache) {
            return $cache;
        }

        $result = $this->model;

        if (isset($opts['columns'])) {
            $result = $result->select($opts['columns']);
        }
        if (isset($opts['searchColumns']) && $request->has('q')) {
            $search = $request->input('q');
            $result = $result->where(function ($query) use ($opts, $search) {
                foreach ($opts['searchColumns'] as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        if (isset($opts['whereHas'])) {
            $result = $result->whereHas($opts['whereHas']['table'], function ($query) use ($opts) {
                $query->where($opts['whereHas']['column'], $opts['whereHas']['value']);
            });
        }

        if (isset($opts['where'])) {
            $result = $result->where($opts['where']);
        }

        $orderBy = $request->input('order_by', 'created_at');
        $order = $request->input('order', 'desc');

        $result = $result->orderBy($orderBy, $order);

        if (isset($opts['paginate'])) {
            return $result->paginate($request->input('limit', 20));
        }

        $result = $result->get();

        Cache::tags($this->model->getTable())->put($queryId, $result);

        return $result;
    }

    public function query(Request $request, array $opts = [])
    {
        Gate::authorize('viewAny', $this->model);

        return $this->queryData($request, $opts);
    }

    public function queryByUser(Request $request, $userId, array $opts = [])
    {
        $opts['where'] = array_merge($opts['where'] ?? [], ['user_id' => $userId]);
        return $this->queryData($request, $opts);
    }

    /**
     * Used to store data to the database and cache the result for future use.
     * 
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        Gate::authorize('create', $this->model);

        $data = $this->setDataPayload($request);
        $item = $this->model;
        $item->fill($data);
        $item->id = $data['id'] ?? Str::uuid();
        $item->save();

        Cache::tags($this->model->getTable())->flush();
        Cache::tags($this->model->getTable())->put($item->id, $item);

        return $item;
    }

    /**
     * Used to update data to the database, invalidate the cache and cache the new data future use.
     * If the id is not found it will return 404.
     * 
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update(string $id, Request $request): mixed
    {
        $data = $this->setDataPayload($request);
        $item = $this->model->find($id);
        if (!$item) abort(404, 'Data not found');

        $item->fill($data);

        Gate::authorize('update', $item);

        $item->save();

        Cache::tags($this->model->getTable())->flush();
        Cache::tags($this->model->getTable())->put($item->id, $item);

        return $item;
    }

    /**
     * Used to show a single data from the database by using table primary key.
     * If the id is not found it will return 404.
     * 
     * @param $id
     * @return mixed
     */
    public function show(string $id): mixed
    {
        $cache = Cache::tags($this->model->getTable())->get($id);
        if ($cache) {
            return $cache;
        }

        $item = $this->model->find($id);
        if (!$item) abort(404, 'Data not found');

        Gate::authorize('view', $item);

        return $item;
    }

    /**
     * Used to delete a single data from the database and invalidate the cache.
     * If the id is not found it will return 404.
     * 
     * @param $id
     * @return mixed
     */
    public function delete(string $id): mixed
    {
        $item = $this->model->find($id);
        if (!$item) abort(404, 'Data not found');

        Gate::authorize('delete', $item);
        $item = $item->delete();

        Cache::tags($this->model->getTable())->flush();

        return $item;
    }

    /**
     * Used to set the data payload for store and update method.
     * 
     * @param Request $request
     * @return array
     */
    protected function setDataPayload(Request $request): array
    {
        return $request->all();
    }
}
