@extends('layouts.app')

@section('content')
<div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
    {{-- <form class="form-horizontal col" method="post" action="{{ url("/categories/save/".($category->id ?? "")) }}" enctype="multipart/form-data"> --}}
    <form class="form-horizontal col" method="post" action="{{ url("/posts/save/".request()->id) }}" enctype="multipart/form-data">
        @csrf
        <fieldset>

            <!-- Form Name -->
            <legend>Edit</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Title</label>
                <div class="col">
                    <input id="title" name="title" type="text" required class="form-control input-md" value="{{ $post->title ?? "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="slug">Slug</label>
                <div class="col">
                    <input id="slug" name="slug" type="text" required class="form-control input-md" value="{{ $post->slug ?? "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="subtitle">Subtitle</label>
                <div class="col">
                    <input id="subtitle" name="subtitle" type="text" required class="form-control input-md" value="{{ $post->subtitle ?? "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="thumbnail">Thumbnail</label>
                <div class="col">
                    <input id="thumbnail" name="thumbnail" type="text" required class="form-control input-md" value="{{ $post->thumbnail ?? "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="body">Body</label>
                <div class="col">
                    <textarea id="body" name="body" class="form-control input-md" value="">{{ $post->body ?? "" }}</textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4 control-label" for="category_id">Category</label>
                <div class="col-md-5">
                  <select id="category_id" name="category_id" class="form-control">
                    <option value="">Select</option>
                    @foreach (App\Category::all() as $c)
                        <option value="{{ $c->id }}" {{ (isset($post->category_id) and ($post->category_id == $c->id)) ? "selected" : "" }}>{{ $c->name }}</option>
                    @endforeach
                  </select>
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