@extends('layouts.app')

@section('content')
<div class="col-8 m-auto">
    <h1 style="float: left;">Categories</h1>
    <a style="float: right;" class="btn btn-primary" href="{{ route("categories.add") }}" role="button">New</a>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col" style="text-align: center;">Id</th>
              <th scope="col" style="text-align: center;">Name</th>
              <th scope="col" style="text-align: center;">Description</th>
              <th scope="col" style="text-align: center;">Icon</th>
              <th scope="col" style="text-align: center;">Color</th>
              <th scope="col" style="text-align: center;">Options</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ substr($desc = $c->description, 0, $maxLength = 50) . (strlen($desc) > $maxLength ? "..." : "") }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                      @if (!empty($c->icon))
                        <span class="material-icons" style="font-size: 18px;">{{ $c->icon }}</span>
                      @endif
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                      <span class="material-icons" style="font-size: 18px; color: {{ $c->color }};">circle</span>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/categories/edit/".$c->id) }}'" title="Edit"><span class="material-icons align-middle">edit</span></button>
                        <button type="submit" form="form-{{$c->id}}" class="btn btn-{{ $c->deleted == 't' ? "success" : "danger" }} align-middle" title="{{ $c->deleted == 't' ? "Restore" : "Delete" }}"><span class="material-icons align-middle">{{ $c->deleted == 't' ? "restore_from_trash" : "delete" }}</span></button>
                        <form id="form-{{$c->id}}" action="{{ url("/categories/".($c->deleted == 't' ? "restore" : "delete")."/".$c->id) }}" onsubmit="return confirm('Are you sure?');"></form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No registers</td>
                </tr>
            @endforelse
          </tbody>
    </table>
</div>
@endsection