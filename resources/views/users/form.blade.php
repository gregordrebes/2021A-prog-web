@extends('layouts.app')

@push('head')
    <!-- Styles -->
    {{-- <link href="{{ asset('css/pizza.css') }}" rel="stylesheet"> --}}
    <!-- Scripts -->
    <script src="{{ asset('js/users.js') }}"></script>
@endpush

@section('content')
    
    <div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
        <form class="form-horizontal col" method="post" action="{{ route("users.save") }}">
            @csrf
            <fieldset>

                <!-- Form Name -->
                <legend class="col-md-4">Edit</legend>
                    
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">Name</label>
                    <div class="col">
                        <input id="name" name="name" type="text" required class="form-control input-md" value="{{ $user->name }}">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">E-mail</label>
                    <div class="col">
                        <input id="email" name="email" type="email" required class="form-control input-md" value="{{ $user->email }}">

                    </div>
                </div>

                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkbox">Change password?</label>
                    <div class="col">
                        <div class="checkbox">
                            <label for="checkbox-0">
                                <input type="checkbox" name="change_password" id="change_password" value="t">
                                Yes
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Password input-->
                <div id="password-form-group" class="form-group d-none">
                    <label class="col-md-4 control-label" for="password">Password</label>
                    <div class="col">
                        <input id="password" name="password" type="password" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Password input-->
                <div id="confirm-password-form-group" class="form-group d-none">
                    <label class="col-md-4 control-label" for="password_confirm">Confirm password</label>
                    <div class="col">
                        <input id="confirm-password" name="password_confirm" type="password" placeholder=""
                            class="form-control input-md">

                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <div class="col-md-4">
                        <button id="submit" type="submit" class="col btn btn-success">Submit</button>
                    </div>
                  </div>

            </fieldset>
        </form>
    </div>
    <div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
        <form class="form-horizontal col" method="post" action="{{ route("users.delete") }}">
            @csrf
            <div class="form-group">
                <div class="col-md-4">
                    <button class="col btn btn-danger" type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete this account</button>
                </div>
              </div>
        </form>
    </div>
@endsection
