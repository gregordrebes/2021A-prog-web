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

    public function delete(Request $request)
    {
        // Get the user
        $user = Auth::user();

        // Log the user out
        Auth::logout();

        // Delete the user (note that softDeleteUser() should return a boolean for below)
        $deleted = User::destroy($user->id);

        if ($deleted) {
            // User was deleted successfully, redirect to login
            return redirect()->route("/")->with("message", "User deleted!");
        } else {
            // User was NOT deleted successfully, so log them back into your application! Could also use: Auth::loginUsingId($user->id);
            Auth::login($user);

            // Redirect them back with some data letting them know it failed (or handle however you need depending on your setup)
            return back()->with('error', 'Failed to delete your user!');
        }
    }
}
