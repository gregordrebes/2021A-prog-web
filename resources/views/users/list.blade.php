@extends('layouts.app')

@section('content')
<div class="col-8 m-auto">
    <h1>Users</h1>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              @moderator
              <th scope="col" style="width: 5rem;">Options</th>
              @endmoderator
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
                    @moderator
                    <td>
                      @if ($u->id == Auth::user()->id)
                      <button type="button" class="col btn btn-danger" disabled title="You can {{ ($u->active == 't') ? 'deactivate' : 'activate' }} your user in 'Edit user'"><span class="material-icons align-middle">toggle_off</span></button>
                      @else
                      <form method="post" action="{{ url("/users/deactivate/".$u->id) }}" onsubmit="return confirm('Do you really want to {{ ($u->active == 't') ? 'deactivate' : 'activate' }} the user {{ $u->name}}?');">
                        @csrf
                        <button type="submit" class="col btn btn-{{ ($u->active == 't') ? "danger" : "success" }}" title="{{ ($u->active == 't') ? "Deactivate" : "Activate" }}"><span class="material-icons align-middle">toggle_{{ ($u->active == 't') ? "off" : "on" }}</span></button>
                      </form>
                      @endif
                    </td>
                    @endmoderator
                </tr>
            @endforeach
          </tbody>
    </table>
</div>
@endsection