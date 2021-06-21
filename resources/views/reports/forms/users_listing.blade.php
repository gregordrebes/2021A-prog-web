@extends('layouts.app')

@section('content')
<div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
    <form target="_blank" class="form-horizontal col" method="get" action="{{ url("/reports/generate/users_listing") }}">
        <legend>Users listing</legend>
        <fieldset>
            <div class="form-group">
                <label class="col control-label" for="date1">Created/Updated at</label>
                <div class="col">
                    <input id="date1" name="date1" type="date" class="form-control input-md" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col">
                    <input id="date2" name="date2" type="date" class="form-control input-md" value="{{ date('Y-m-d') }}">
                </div> 
            </div>
        </fieldset>
        <button type="submit"  class="btn btn-primary">Search</button>
    </form>
</div>
@endsection
