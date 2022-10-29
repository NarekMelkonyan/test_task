<?php

namespace App\Http\Controllers;

use App\Repositories\LinkRepository;

/**
 * @property LinkRepository $linkRepository
 */
class DashboardController extends Controller
{
    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function index()
    {
        $links = $this->linkRepository->getByPaginate();

        return view("dashboard", compact('links'));
    }
}
