@extends('layouts.app')

@section('content')
<div class="row m-auto d-flex flex-row justify-content-center">
    <div class="col-lg-8">
        <img class="card-img-top" src="{{ $post->thumbnail }}" alt="Thumbnail">
        <h1>{{ $post->title }}</h1>
        <h4>{{ $post->subtitle }}</h4>
        <h4>By: {{ App\User::find($post->user_id)->name }}</h4>
        <h4>Category: {{ App\Category::find($post->category_id)->name }}</h4>
        <h4>Created at: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | Updated at: {{ \Carbon\Carbon::parse($post->updated_at)->format('d/m/Y') }}</h4>
        <br>
        <h5 class="">
            {{$post->body}}
        </h5>
    </div>
</div>
@endsection