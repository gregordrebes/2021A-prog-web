<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $is_moderator = Auth::user()->role_id == RoleHelper::MODERATOR;
        
        $posts = $is_moderator ? DB::table('posts')->select("*") : DB::table('posts')->select("*")->where('deleted', '=', 'f'); 

        if(!empty($_GET["text"])){
            $posts->whereRaw("(title like '%{$_GET["text"]}%' or subtitle like '%{$_GET['text']}%' or body like '%{$_GET['text']}%')");
        }

        if(!empty($_GET["date1"])){
            $posts->whereRaw("created_at > '{$_GET["date1"]}'");
        }

        if(!empty($_GET["date2"])){
            $posts->whereRaw("created_at < '{$_GET["date2"]}'");
        }

        $posts = $posts->get();

        return view("posts.list", compact("posts"));
    }

    /**
     * Save a (created or updated) resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // https://blog.especializati.com.br/upload-de-arquivos-no-laravel-com-request/
        $post_id = $request->id;

        $data = [
             "title" => ["required", "max:255"],
             "subtitle" => ["required", "max:255"],
             // problema no unique ao update | caracteres permitidos letras, numeros e menos
             "slug" => ["required", "unique:posts,slug,{$post_id},id", "max:255"],
             "body" => ["required"],
             // "user_id" => ["required"],
             "category_id" => ["required"],
        ];
        
        $request->validate($data);
        
        $data = array_merge($request->all(), ["user_id"=>Auth::user()->id]);

        if (!empty($post_id)){
            Post::find($post_id)->update($data);
        } else {
            Post::create($data);
        }

        return redirect()->route("posts")->with('message', 'Chages saved successfully!');
    }
    
    /**
     * Show the form for add/edit the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($id = null)
    {
        $post = Post::find($id);
        return view("posts.form", compact("post"));
    }

    /**
     * Delete register
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null)
    {
        $post = Post::find($id);
        $post->deleted = 't';
        $post->save();
        return redirect()->route("posts")->with('message', 'Post deleted successfully!');
    }

    /**
     * Restore register
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id = null)
    {
        $post = Post::find($id);
        $post->deleted = 'f';
        $post->save();
        return redirect()->route("posts")->with('message', 'Post restored successfully!');
    }

    /**
     * Show the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($slug)
    {
        $post = Post::where("slug", "=", $slug)->first();
        return view("posts.view", compact("post"));
    }
}
