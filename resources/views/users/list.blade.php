@extends('layouts.app')

@section('content')
<div class="col-8 m-auto">
    <h1>Users</h1>
    {{--
    <div class="row">
        <div class="col-sm-10 col-12">
            <h1>Users</h1>
        </div>
        <div class="col-sm-2 col-12">
            <input class="btn btn-primary" type="button" value="Input">
        </div>
     </div> 
    --}}
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              {{-- <th scope="col">Options</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>
                    @if ($u->id == Auth::user()->id)
                      <p class="font-weight-bold">
                      {{ $u->name . " (YOU)" }}
                      </p>
                    @else
                        {{ $u->name }}
                    @endif
                    </td>
                    <td>{{ $u->email }}</td>
                    <td>{{ App\Helpers\RoleHelper::getRoleName($u->role_id) }}</td>
                </tr>
            @endforeach
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