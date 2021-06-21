<?php

namespace App\Http\Controllers;

use App\Helpers\ReportHelper;
use App\Helpers\RoleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Symfony\Component\Console\Input\Input;

class ReportController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(Auth::check()){
        //     $is_moderator = Auth::user()->role_id == RoleHelper::MODERATOR;
        // } else {
        //     $is_moderator = false;
        // }
        
        // $posts = $is_moderator ? DB::table('posts')->select("*") : DB::table('posts')->select("*")->whereRaw("deleted = 'f'"); 

        // if(!empty($_GET["text"])){
        //     $posts->whereRaw("(title like '%{$_GET["text"]}%' or subtitle like '%{$_GET['text']}%' or body like '%{$_GET['text']}%')");
        // }
        
        // if(!empty($_GET["date1"])){
        //     $posts->whereRaw("created_at > '{$_GET["date1"]}'");
        // }
        
        // if(!empty($_GET["date2"])){
        //     // tive que utilizar o where raw ao inves do where
        //     $posts->whereRaw("created_at < '{$_GET["date2"]}'");
        //     // dd($posts->toSql());
        // }

        // // debug

        // $posts = $posts->get();

        return view('reports.list');
    }

    public function form($type)
    {   
        if (!in_array($type, ReportHelper::getAllowedReports("name"))){
            return back()->with('error', "Report type not exists!");
        }

        return view("reports.forms.{$type}");
    }

    public function generate($type)
    {   

        if (!in_array($type, ReportHelper::getAllowedReports("name"))){
            return back()->with('error', "Report type not exists!");
        }

        return $this->$type();
    }

    public function posts_by_date()
    {
        $posts = DB::table("posts")->select("*");

        if(!empty($date1 = $_GET["date1"]) and !empty($date2 = $_GET["date2"])){
            $posts->whereRaw("(created_at BETWEEN '{$date1}' AND '{$date2}') OR (updated_at BETWEEN '{$date1}' AND '{$date2}')");
        }

        $pdf = PDF::loadView('reports.pdfs.'. __FUNCTION__, ["posts" => $posts->get(), "inputs" => request()->all()]);
        return $pdf->setPaper('a4', 'landscape')->stream(__FUNCTION__. date('YmdHis') . ".pdf");
    }

    public function posts_by_category()
    {
        $result = DB::table("posts as P")->join("categories as C",  DB::raw( 'P.category_id' ), '=', DB::raw( 'C.id' ))->select("C.id", "C.name", DB::raw("COUNT(P.id) AS nof_posts"));

        if(!empty($date1 = $_GET["date1"]) and !empty($date2 = $_GET["date2"])){
            $result->whereRaw("((P.created_at BETWEEN '{$date1}' AND '{$date2}') OR (P.updated_at BETWEEN '{$date1}' AND '{$date2}'))");
        }

        if (!empty($category = $_GET["category_id"])){
            $result->whereRaw("P.category_id = '{$category}'");
        }

        $result->groupBy("C.id");
        
        $pdf = PDF::loadView('reports.pdfs.'. __FUNCTION__, ["result" => $result->get(), "inputs" => request()->all()]);
        return $pdf->setPaper('a4', 'landscape')->stream(__FUNCTION__. date('YmdHis') . ".pdf");
    }

    public function posts_by_user()
    {
        $result = DB::table("posts as P")->join("users as U",  DB::raw( 'P.user_id' ), '=', DB::raw( 'U.id' ))->select("U.id", "U.name", DB::raw("COUNT(P.id) AS nof_posts"));

        if(!empty($date1 = $_GET["date1"]) and !empty($date2 = $_GET["date2"])){
            $result->whereRaw("((P.created_at BETWEEN '{$date1}' AND '{$date2}') OR (P.updated_at BETWEEN '{$date1}' AND '{$date2}'))");
        }

        if (!empty($user = $_GET["user_id"])){
            $result->whereRaw("P.user_id = '{$user}'");
        }

        $result->groupBy("U.id");
        
        $pdf = PDF::loadView('reports.pdfs.'. __FUNCTION__, ["result" => $result->get(), "inputs" => request()->all()]);
        return $pdf->setPaper('a4', 'landscape')->stream(__FUNCTION__. date('YmdHis') . ".pdf");
    }

    public function users_listing()
    {
        $users = DB::table("users")->select("*");

        if(!empty($date1 = $_GET["date1"]) and !empty($date2 = $_GET["date2"])){
            $users->whereRaw("(created_at BETWEEN '{$date1}' AND '{$date2}') OR (updated_at BETWEEN '{$date1}' AND '{$date2}')");
        }

        $pdf = PDF::loadView('reports.pdfs.'. __FUNCTION__, ["users" => $users->get(), "inputs" => request()->all()]);
        return $pdf->setPaper('a4', 'landscape')->stream(__FUNCTION__. date('YmdHis') . ".pdf");
    }

    public function category_listing()
    {
        $categories = DB::table("categories")->select("*");

        if(!empty($date1 = $_GET["date1"]) and !empty($date2 = $_GET["date2"])){
            $categories->whereRaw("(created_at BETWEEN '{$date1}' AND '{$date2}') OR (updated_at BETWEEN '{$date1}' AND '{$date2}')");
        }

        $pdf = PDF::loadView('reports.pdfs.'. __FUNCTION__, ["categories" => $categories->get(), "inputs" => request()->all()]);
        return $pdf->setPaper('a4', 'landscape')->stream(__FUNCTION__. date('YmdHis') . ".pdf");
    }

    public function category_graph()
    {
        $result = DB::table("posts as P")->join("categories as C",  DB::raw( 'P.category_id' ), '=', DB::raw( 'C.id' ))->select("C.id", "C.name", DB::raw("COUNT(P.id) AS nof_posts"));

        if(!empty($date1 = $_GET["date1"]) and !empty($date2 = $_GET["date2"])){
            $result->whereRaw("((P.created_at BETWEEN '{$date1}' AND '{$date2}') OR (P.updated_at BETWEEN '{$date1}' AND '{$date2}'))");
        }

        $result->groupBy("C.id");


        return json_encode($result->get());
    }

}
