<?php

namespace App\Repositories;

use App\Models\Link;

/**
 * @property Link $model
 */
class LinkRepository
{
    public function __construct()
    {
        $this->model = new Link();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model::create($data);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByPaginate()
    {
        return $this->model::query()
            ->orderBy('id', 'desc')
            ->paginate(env('PAGINATION_COUNT', 50));
    }

    /**
     * @param $short_url
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findByShortURL($short_url)
    {
        return $this->model::query()
            ->select(['id', 'website_url', 'short_link'])
            ->where('short_link', $short_url)
            ->first();
    }

    /**
     * @return Link[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model::all();
    }

    /**
     * @param $id
     * @return false
     */
    public function update($id)
    {
        $link = $this->model::find($id);
        if ($link) {
            return $link->update(['tracking_data' => $link->tracking_data + 1]);
        }
        return false;
    }
}
