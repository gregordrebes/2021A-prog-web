@extends('layouts.app')


@section('content')
<div class="col-8 m-auto">
    <h1 style="float: left;">Reports</h1>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col" style="width:24rem; text-align: center;">Report name</th>
              <th scope="col" style="width: 5rem;text-align: center;">Options</th>
            </tr>
          </thead>
          <tbody>
            @foreach (App\Helpers\ReportHelper::getAllowedReports() as $key => $report)
                <tr>
                    <td><h5>{{$report["label"]}}</h5></td>
                    <td>
                      <button type="button" onclick="window.location='{{ url("/reports/form/{$report["name"]}") }}';" class="btn btn-primary input-group-append m-auto" title="Click here to config and generate report" style="cursor: pointer; text-decoration: none !important;">
                        <span class="material-icons m-auto" style="font-size: 18px;">tune</span>
                      </button>
                    </td>
                </tr>
            @endforeach
          </tbody>    
    </table>
</div>
@endsection
