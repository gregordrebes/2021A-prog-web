@extends('templates.report')

@section('report-body')
<div class="col">
  <style>
    tr {
      line-height: 1.26rem !important;
    }
  </style>
  <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col" colspan="5" style="font-size: 1.25rem; text-align: center;">Users listing</th>
        </tr>
        <tr>
          <th scope="col" colspan="5">
            <span>
              <b>Date:</b> From {{ $inputs["date1"] }} to {{ $inputs["date2"] }}
            </span>
          </th>
        </tr>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">E-mail</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $key => $u)
            <tr>
              <td scope="col">{{ $u->id }}</td>
              <td scope="col">{{ $u->name }}</td>
              <td scope="col">{{ $u->email }}</td>
              <td scope="col">{{ $u->created_at }}</td>
              <td scope="col">{{ $u->updated_at }}</td>
            </tr>
        @empty
            <tr>
              <td colspan="5" class="text-center"> Nothing here</td>
            </tr>
        @endforelse
      </tbody>
    </table>
</div>
@endsection