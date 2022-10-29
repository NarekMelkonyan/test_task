<?php

namespace App\Repositories;

use App\Models\UserLink;
use Illuminate\Support\Facades\Auth;

/**
 * @property UserLink $model
 */
class TrackingRepository
{
    public function __construct()
    {
        $this->model = new UserLink();
    }

    /**
     * @param $link_id
     * @return false
     */
    public function checkTrackingData($link_id)
    {
        $res = $this->model::query()
            ->where('link_id', $link_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$res) {
            $data['user_id'] = Auth::id();
            $data['link_id'] = $link_id;

            return $this->model::create($data);
        }
        return false;
    }
}
