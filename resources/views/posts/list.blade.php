@extends('layouts.app')

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
              <form id="formModal" class="form-horizontal col" method="get" action="{{ url("/posts") }}">
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
              <button type="button" onclick="window.location='{{ url("/posts") }}';" class="btn btn-secondary" data-dismiss="modal">Clean search</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="formModal" class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </div>
</div>
@endpush

@section('content')
<div class="col-8 m-auto">
    <h1 style="float: left;">Posts</h1>
    <a style="float: right;" class="btn btn-primary" href="{{ route("posts.add") }}" role="button">New</a>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col" style="text-align: center;">Id</th>
              <th scope="col" style="text-align: center;">Title</th>
              <th scope="col" style="text-align: center;">Subtitle</th>
              <th scope="col" style="text-align: center;">Created by</th>
              <th scope="col" style="text-align: center;">Category</th>
              <th scope="col" style="text-align: center;">Created at</th>
              <th scope="col" style="text-align: center;">Updated at</th>
              <th scope="col" style="width: 15rem;text-align: center;">Options</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->subtitle }}</td>
                    <td>{{ App\User::find($p->user_id)->name }}</td>
                    <td>{{ App\Category::find($p->category_id)->name }}</td>
                    <td>{{ $p->created_at }}</td>
                    <td>{{ $p->updated_at }}</td>
                    {{-- <td>{{ substr($desc = $c->description, 0, $maxLength = 50) . (strlen($desc) > $maxLength ? "..." : "") }}</td> --}}
                    <td>
                      <div class="btn-toolbar text-center" style="width:100%">
                        <a class="col btn btn-block btn-primary" href="{{ url("/posts/edit/".$p->id) }}" role="button">Edit</a>
                        <form class="col" action="{{ url("/posts/".($p->deleted == 't' ? "restore" : "delete")."/".$p->id) }}" onsubmit="return confirm('Are you sure?');">
                          @csrf
                          <input type="submit" class="btn btn-block btn-{{ $p->deleted == 't' ? "success" : "danger"}}" role="button" value="{{ $p->deleted == 't' ? "Restore" : "Delete" }}"/>
                        </form>
                      </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No registers</td>
                </tr>
            @endforelse
          </tbody>
    </table>
</div>
@endsection