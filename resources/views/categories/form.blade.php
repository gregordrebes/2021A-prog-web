@extends('layouts.app')

@section('content')
<div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
    {{-- <form class="form-horizontal col" method="post" action="{{ url("/categories/save/".($category->id ?? "")) }}" enctype="multipart/form-data"> --}}
    <form class="form-horizontal col" method="post" action="{{ url("/categories/save/".request()->id) }}" enctype="multipart/form-data">
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
                <label class="col-md-4 control-label" for="icon">Category icon</label>
                <div class="col input-group mb-2">
                    <input id="icon" name="icon" type="text" class="form-control input-md" value="{{ $category->icon ?? "" }}">
                    <a class="input-group-append" title="Click here to see which icons you can use" style="cursor: pointer; text-decoration: none !important;" href="https://fonts.google.com/icons" target="_blank">
                        <div class="input-group-text">
                            <span class="material-icons" style="font-size: 15px;">help</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="color">Category color</label><br>
                <div class="col">
                    <input type="color" name="color" value="{{ $category->color ?? "" }}">
                </div>
            </div>


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