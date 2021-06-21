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
          <th scope="col" colspan="3" style="font-size: 1.25rem; text-align: center;">Posts by category</th>
        </tr>
        <tr>
          <th scope="col" colspan="3">
            <span style="float: left;">
              <b>Date:</b> From {{ $inputs["date1"] }} to {{ $inputs["date2"] }}
            </span>
            <span style="float: right">
                <b>Category:</b> {{ !empty($cat_id = $inputs["category_id"]) ? App\Category::find($cat_id)->name : "All" }}
            </span>
            <span style="clear: both"></span>
          </th>
        </tr>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Category</th>
          <th scope="col">Nº of posts</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($result as $key => $r)
            <tr>
              <td scope="col">{{ $r->id }}</td>
              <td scope="col">{{ $r->name }}</td>
              <td scope="col">{{ $r->nof_posts }}</td>
            </tr>
        @empty
            <tr>
              <td colspan="6" class="text-center"> Nothing here</td>
            </tr>
        @endforelse
      </tbody>
    </table>
</div>
@endsection