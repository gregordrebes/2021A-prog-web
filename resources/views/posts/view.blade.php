@extends('layouts.app')

@section('content')
<div class="row m-auto d-flex flex-row justify-content-center">
    <div class="card col-lg-8 pl-0 pr-0">
        <img class="card-img-top" style="height: 20rem; object-fit: cover;" src="{{ $post->thumbnail }}" alt="Thumbnail">
        <div class="card-body">
            <h1 class="card-title">{{ $post->title }}</h1>
            <p class="card-text">
                <h4>{{ $post->subtitle }}</h4>
                <h4>Likes: {{ App\Reactions::where("post_id", $post->id)->where("type", "l")->count() }}  |  Dislikes: {{ App\Reactions::where("post_id", $post->id)->where("type", "d")->count() }} </h4>
                <h4>By: {{ App\User::find($post->user_id)->name }}</h4>
                <h4>Category: {{ App\Category::find($post->category_id)->name }}</h4>
                <h4>Created at: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | Updated at: {{ \Carbon\Carbon::parse($post->updated_at)->format('d/m/Y') }}</h4>
                <br>
                <h5> {{$post->body}} </h5>
                @if (Auth::check())
                    <div class="row m-auto mb-3 d-flex flex-row justify-content-center" style="">
                        <button type="submit" form="form-like" class="btn btn-success align-middle" title="Like"><span class="material-icons align-middle">thumb_up</span></button>
                        <form id="form-like" action="{{ url("/posts/like/{$post->id}") }}" ></form>
                        &nbsp;
                        <button type="submit" form="form-dislike" class="btn btn-danger align-middle" title="Dislike"><span class="material-icons align-middle">thumb_down</span></button>
                        <form id="form-dislike" action="{{ url("/posts/dislike/{$post->id}") }}" ></form>
                    </div>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection