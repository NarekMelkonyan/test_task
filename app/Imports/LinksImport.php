<?php

namespace App\Imports;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LinksImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Link([
            "user_id" => Auth::id(),
            "website_url" => $row['website_url'],
            "short_link" => $row['short_link'],
            "tracking_data" => $row['tracking_data'],
            "created_at" => $row['created_at'],
        ]);
    }


}
