<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\LinkRequest;
use App\Imports\LinksImport;
use App\Repositories\LinkRepository;
use App\Services\LinkService;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @property LinkService $linkService
 * @property LinkRepository $linkRepository
 */
class LinkController extends Controller
{
    /**
     * @param LinkService $generate_url_service
     */
    public function __construct(LinkService $linkService, LinkRepository $linkRepository)
    {
        $this->linkService = $linkService;
        $this->linkRepository = $linkRepository;
    }

    /**
     * @param LinkRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string|void
     */
    public function store(LinkRequest $request)
    {
        try {
            $res = $this->linkService->create($request->website_url);
            if ($res) {
                return redirect("/dashboard")->with(['success' => 'Your File Imported Successfully']);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param FileRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function uploadLinks(FileRequest $request)
    {
        try {
            Excel::import(new LinksImport, $request->file);

            return redirect('/dashboard')->with(['success' => 'Your File Imported Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $short_link
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string|void
     */
    public function short_link($short_link)
    {
        try {
            $res = $this->linkService->findByShortLink($short_link);
            if ($res) {
                $this->linkService->checkTrackingData($res->id);

                return redirect($res->website_url);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pageLink($data)
    {
        return view('link')->with(['data' => $data]);
    }

    /**
     * @return string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download_file()
    {
        try {
            $table = $this->linkRepository->getall();

            $filename = "test_file.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('website url', 'short link', 'qr code', 'tracking data', 'created at'));

            foreach ($table as $row) {
                fputcsv($handle, array($row['website_url'], $row['short_link'], $row['qr_code'], $row['tracking_data'], $row['created_at']));
            }

            fclose($handle);

            $headers = array(
                'Content-Type' => 'text/csv',
            );

            return Response::download($filename, 'test_file.csv', $headers);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
