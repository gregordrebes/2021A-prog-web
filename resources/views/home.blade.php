@extends('layouts.app')

@push('styles')
    <style>
        .posts{
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        }
        .posts:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>
@endpush

@push('search-bar')
<div class="col m-2">
    <button type="button" class="btn btn-primary input-group-append" title="Click here to search" style="cursor: pointer; text-decoration: none !important;" data-toggle="modal" data-target="#searchModal">
        <span class="pr-2">Search</span>
        <span class="material-icons m-auto" style="font-size: 18px;">search</span>
    </button>
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="searchModalLabel">Search filters</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formModal" class="form-horizontal col" method="get" action="{{ url("/") }}">
                    @csrf
                    <fieldset>
                      <div class="form-group">
                        <label class="col" for="text">Title, subtitle or body contains</label>
                        <div class="col">
                            <input id="text" name="text" type="search"  class="form-control input-md" value="{{ $_GET["text"] ?? "" }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col control-label" for="date1">Created at</label>
                        <div class="col">
                            <input id="date1" name="date1" type="date"  class="form-control input-md" value="{{ $_GET["date1"] ?? "" }}">
                        </div>
                        <div class="col">
                          <input id="date2" name="date2" type="date"  class="form-control input-md" value="{{ $_GET["date2"] ?? "" }}">
                      </div>
                      </div>
                    </fieldset>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="window.location='{{ url("/") }}';" class="btn btn-secondary" data-dismiss="modal">Clean search</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="formModal" class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </div>
</div>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center py-2">
        @forelse($posts as $p)
                <div class="col d-flex flex-row justify-content-center mb-3">
                    <div class="card posts" style="width: 18rem;">
                        <img class="card-img-top" style="height: 8rem; object-fit: cover;" src="{{ $p->thumbnail }}" alt="Thumbnail">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->title }}</h5>
                            <p class="text-muted">
                              Posted at {{ date("d/m/Y", strtotime($p->created_at)) }}
                              <br>
                              Updated at {{ date("d/m/Y", strtotime($p->updated_at)) }}
                            </p>
                            <p class="card-text">{{ $p->subtitle }}</p>
                            <a href="/posts/view/{{$p->slug}}" style="float: left;" class="btn btn-primary btn-red">See post</a>
                            <p class="text-muted" style="float: right;">
                              {{ App\Reactions::where("post_id", $p->id)->where("type", "l")->count() }} like(s)
                              &nbsp;
                              {{ App\Reactions::where("post_id", $p->id)->where("type", "d")->count() }} dislike(s)
                            </p>
                        </div>
                    </div>
                    
                </div>
        @empty
          <div class="col d-flex flex-row justify-content-center">
            <h3>Nothing here</h3>
          </div>
        @endforelse
        </div>
    </div>
@endsection
