@extends('layouts.app')

@section('content')
<div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
    {{-- <form class="form-horizontal col" method="post" action="{{ url("/categories/save/".($category->id ?? "")) }}" enctype="multipart/form-data"> --}}
    <form class="form-horizontal col" method="post" action="{{ url("/categories/save/1") }}" enctype="multipart/form-data">
        @csrf
        <fieldset>

            <!-- Form Name -->
            <legend>Edit</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Name</label>
                <div class="col">
                    <input id="name" name="name" type="text" required class="form-control input-md" value="{{ $category->name ?? "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Description</label>
                <div class="col">
                    <textarea id="description" name="description" class="form-control input-md" value="">{{ $category->description ?? "" }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="theme_color">Category color</label><br>
                <div class="col">
                    <input type="color" name="theme_color" value="{{ $category->theme_color ?? "" }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="icon_path">Category icon</label>
                <div class="col">
                    <input type="file" class="form-control-file" id="icon_path" accept="image/*" name="icon_path">
                </div>
            </div>
            

            {{-- 
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">E-mail</label>
                <div class="col">
                    <input id="email" name="email" type="email" required class="form-control input-md" value="{{ $user->email }}">

                </div>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkbox">Change password?</label>
                <div class="col">
                    <div class="checkbox">
                        <label for="checkbox-0">
                            <input type="checkbox" name="change_password" id="change_password" value="t">
                            Yes
                        </label>
                    </div>
                </div>
            </div>

            <!-- Password input-->
            <div id="password-form-group" class="form-group d-none">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col">
                    <input id="password" name="password" type="password" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- Password input-->
            <div id="confirm-password-form-group" class="form-group d-none">
                <label class="col-md-4 control-label" for="password_confirm">Confirm password</label>
                <div class="col">
                    <input id="confirm-password" name="password_confirm" type="password" placeholder=""
                        class="form-control input-md">

                </div>
            </div> 
            --}}

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                <button id="submit" type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
@endsection