@extends('templates.report')

@section('report-body')
{{--  
<div class="col">
  <style>
    tr {
      line-height: 1.26rem !important;
    }
  </style>
  <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col" colspan="6" style="font-size: 1.25rem; text-align: center;">Posts by date</th>
        </tr>
        <tr>
          <th scope="col" colspan="6">
            <span>
              <b>Date:</b> From {{ $inputs["date1"] }} to {{ $inputs["date2"] }}
            </span>
          </th>
        </tr>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Title</th>
          <th scope="col">Created by</th>
          <th scope="col">Category</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($posts as $key => $p)
            <tr>
              <td scope="col">{{ $p->id }}</td>
              <td scope="col">{{ $p->title }}</td>
              <td scope="col">{{ App\User::find($p->user_id)->name }}</td>
              <td scope="col">{{ App\Category::find($p->category_id)->name }}</td>
              <td scope="col">{{ $p->created_at }}</td>
              <td scope="col">{{ $p->updated_at }}</td>
            </tr>
        @empty
            <tr>
              <td colspan="6" class="text-center"> Nothing here</td>
            </tr>
        @endforelse
      </tbody>
    </table>
</div>
  --}}
@endsection