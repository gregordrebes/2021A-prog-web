<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            $is_moderator = Auth::user()->role_id == RoleHelper::MODERATOR;
        } else {
            $is_moderator = false;
        }
        
        $posts = $is_moderator ? DB::table('posts')->select("*") : DB::table('posts')->select("*")->whereRaw("deleted = 'f'"); 

        if(!empty($_GET["text"])){
            $posts->whereRaw("(title like '%{$_GET["text"]}%' or subtitle like '%{$_GET['text']}%' or body like '%{$_GET['text']}%')");
        }
        
        if(!empty($_GET["date1"])){
            $posts->whereRaw("created_at > '{$_GET["date1"]}'");
        }
        
        if(!empty($_GET["date2"])){
            // tive que utilizar o where raw ao inves do where
            $posts->whereRaw("created_at < '{$_GET["date2"]}'");
            // dd($posts->toSql());
        }

        // debug

        $posts = $posts->get();

        return view('home', compact("posts"));
    }
}
