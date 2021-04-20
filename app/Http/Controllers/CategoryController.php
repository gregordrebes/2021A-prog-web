<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
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

        // $c = new stdClass();
        // $c->id = 1;
        // $c->name = "Programming";
        // $c->description = "About programming tricks, technologies and etc.";
        // $categories = [$c];

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
        dd($request->all());
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;
        $icon_path = null;
        
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('icon_path') && $request->file('icon_path')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
            
            // Recupera a extensão do arquivo
            $extension = $request->icon_path->extension();
            
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            
            // Path
            $path =  'public/img/categories/';

            // Faz o upload:
            $upload = $request->icon_path->storeAs($path, $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            
            $icon_path = $path . $nameFile;

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload) {
                return redirect()
                ->back()
                ->with('error', 'Failed to upload file!')
                ->withInput();
            }
        }

        // $data = [
        //     "name" => ["required", "max:255"],
        //     "email" => ["required", Rule::unique('users')->ignore($user_id), "max:255"],
        // ];
        
        // if (!is_null($icon_path)){
        //     $data["icon_path"] = ["required", "min:8", "confirmed"];
        // }
        
        // $validatedData = $request->validate($data);

        // Category::find($user_id)->update($validatedData);


        return redirect()->back()->with('message', 'Chages saved successfully!');

        /// TODO CONTINUA INSERT/UPDATE
    }
    
    /**
     * Show the form for add/edit the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($id = null)
    {
        $category = Category::find($id);
        // dd($category);
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
        //
        dd("delete");
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
