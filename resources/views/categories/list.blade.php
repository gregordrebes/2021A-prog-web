@extends('layouts.app')

@section('content')
<div class="col-8 m-auto">
    <h1 style="float: left;">Categories</h1>
    <a style="float: right;" class="btn btn-primary" href="{{ route("categories.add") }}" role="button">New</a>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col" colspan="2">Options</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->description }}</td>
                    <td>
                        <a class="col btn btn-primary" href="{{ url("/categories/edit/".$c->id) }}" role="button">Edit</a>
                    </td>
                    <td>
                        <a class="col btn btn-danger" href="{{ url("/categories/delete/".$c->id) }}" role="button">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No registers</td>
                </tr>
            @endforelse
            {{-- 
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
            </tr> 
            --}}
          </tbody>
    </table>
</div>
@endsection