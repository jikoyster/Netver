@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form class="form-horizontal" method="POST" action="{{ route('accountant.register.confirmed') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-xs-4 control-label text-right text-white">Password</label>

                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input id="password" type="password" class="form-control" name="password" required style="margin: 0 auto; float: unset;">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-xs-4 control-label text-right text-white">Confirm Password</label>
                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required style="margin: 0 auto; float: unset;">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="col-xs-4 control-label text-right text-white">First name</label>

                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input id="first_name" type="first_name" class="form-control" name="first_name" value="{{ $first_name or old('first_name') }}" required autofocus style="margin: 0 auto; float: unset;">

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" class="col-xs-4 control-label text-right text-white">Last name</label>

                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input id="last_name" type="last_name" class="form-control" name="last_name" value="{{ $last_name or old('last_name') }}" required autofocus style="margin: 0 auto; float: unset;">
                    <input id="email" type="" class="form-control hidden" name="email" required style="margin: 0 auto; float: unset;" value="{{ $email or old('email') }}">

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn yellow-gradient" style="margin: 0 auto; float: unset;">
                        <strong>Continue</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<style type="text/css">
    .form-group > div > input,
    .form-group > div > button { width: 304px; }
</style>
@endsection