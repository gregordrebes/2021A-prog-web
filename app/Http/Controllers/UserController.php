<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("users.list", compact("users"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $user = Auth::user();
        return view("users.form", compact("user"));
    }


    public function save(Request $request)
    {
        $user_id = Auth::user()->id;

        $changePassword = isset($request->change_password) and $request->change_password == 't';

        $data = [
            "name" => ["required", "max:255"],
            "email" => ["required", Rule::unique('users')->ignore($user_id), "max:255"],
        ];

        if ($changePassword) {
            $data["password"] = ["required", "min:8", "confirmed"];
        }

        $validatedData = $request->validate($data);

        User::find($user_id)->update($validatedData);

        return redirect()->route("users.edit")->with('message', 'Chages saved successfully!');
    }

    public function deactivate(Request $request)
    {
        if ($id = $request->id){
            
            $user = User::findOrFail($id);

            $current = $user->active == 't' ? 'f' : $user->active;
            
            if ($user->fill(['active'=> $current])->save()) {
                // User was deactivated successfully, redirect to login
                return redirect()->route("users")->with("message", "User ".($current == 't' ? "re" : "de")."activated!");
            } else {
                return back()->with('error', 'Failed to '.($current == 't' ? "re" : "de").'activate the user!');
            }
        } else if (Auth::user()){
            // Get the user
            $user = User::findOrFail(Auth::id());

            $current = $user->active == 't' ? 'f' : $user->active;

            // Log the user out
            Auth::logout();

            if ($user->fill(["active"=>$current])->save()) {
                // User was deactivated successfully, redirect to login
                return redirect()->route("/")->with("message", "User ".($current == 't' ? "re" : "de")."activated!");
            } else {
                // User was NOT deactivated successfully, so log them back into your application! Could also use: Auth::loginUsingId($user->id);
                $user->fill(["active"=>$user->active])->save();
                
                Auth::login($user);

                // Redirect them back with some data letting them know it failed (or handle however you need depending on your setup)
                return back()->with('error', "Failed to ".($current == 't' ? "re" : "de")."activate your user!");
            }
        } else {
            return back()->with('error', 'No user selected!');
        }
        
        
    }
}
