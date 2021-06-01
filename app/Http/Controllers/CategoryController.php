<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\RoleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $is_moderator = Auth::user()->role_id == RoleHelper::MODERATOR;
        
        $categories = $is_moderator ? Category::all() : Category::where('deleted', '=', 'f')->get(); 

        return view("categories.list", compact("categories"));
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
        $category_id = $request->id;

        $data = [
             "name" => ["required", "max:255"],
        ];
        
        $request->validate($data);
        
        if (!empty($category_id)){
            Category::find($category_id)->update($request->all());
        } else {
            Category::create($request->all());
        }

        return redirect()->route("categories")->with('message', 'Chages saved successfully!');
    }
    
    /**
     * Show the form for add/edit the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($id = null)
    {
        $category = Category::find($id);
        return view("categories.form", compact("category"));
    }

    /**
     * Delete register
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null)
    {
        $category = Category::find($id);
        $category->deleted = 't';
        $category->save();
        return redirect()->route("categories")->with('message', 'Category deleted successfully!');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Category $category)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Category $category)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Category $category)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Category $category)
    // {
    //     //
    // }
}
