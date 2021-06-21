<?php

namespace App\Helpers;

use App\Roport;

class ReportHelper
{
    const COL_NAME = "name";
    const COL_LABEL = "label";

    public static function getAllowedReports($column = null)
    {
        $array = [
            ["name"=>"posts_by_date", "label"=>"Posts by date (created or updated)"],
            ["name"=>"posts_by_category", "label"=>"Posts by category"],
            ["name"=>"posts_by_user", "label"=>"Posts by user"],
            ["name"=>"users_listing", "label"=>"Users listing"],
            ["name"=>"category_listing", "label"=>"Category listing"],
            ["name"=>"category_graph", "label"=>"Category graph"],
        ];
        return !is_null($column) ? array_column($array, $column) : $array;
    }

}