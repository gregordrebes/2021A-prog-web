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
              <th scope="col" style="width: 15rem;text-align: center;">Options</th>
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
                    <td>
                      <div class="btn-toolbar text-center" style="width:100%">
                        <a class="col btn btn-block btn-primary" href="{{ url("/categories/edit/".$c->id) }}" role="button">Edit</a>
                        <form class="col" action="{{ url("/categories/delete/".$c->id) }}" onsubmit="return confirm('Are you sure?');">
                          @csrf
                          <input type="submit" class="btn btn-block btn-danger" role="button" value="Delete"/>
                        </form>
                      </div>
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