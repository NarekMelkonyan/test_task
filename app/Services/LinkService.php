<?php

namespace App\Services;

use App\Repositories\LinkRepository;
use App\Repositories\TrackingRepository;
use Illuminate\Support\Str;

/**
 * @property TrackingRepository $trackingRepository
 * @property LinkRepository $linkRepository
 */
class LinkService
{
    /**
     * @param LinkRepository $linkRepository
     */
    public function __construct(LinkRepository $linkRepository, TrackingRepository $trackingRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->trackingRepository = $trackingRepository;
    }

    /**
     * @param $req
     * @return mixed
     */
    public function create($req)
    {
        $data['website_url'] = $req;
        $data['short_link'] = Str::random(8);
        $data['user_id'] = Auth()->id();

        return $this->linkRepository->create($data);
    }

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findByShortLink($data)
    {
        return $this->linkRepository->findByShortURL($data);
    }

    /**
     * @param $link_id
     * @return false
     */
    public function checkTrackingData($link_id)
    {
        $res = $this->trackingRepository->checkTrackingData($link_id);
        if ($res) {
            return $this->linkRepository->update($link_id);
        }
        return false;
    }
}
