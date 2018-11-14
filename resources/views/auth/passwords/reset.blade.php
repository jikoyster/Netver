@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
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
                    <input id="email" type="" class="form-control hidden" name="email" required style="margin: 0 auto; float: unset;" value="{{ $email or old('email') }}">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
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
                <div class="col-xs-12 text-center" style="margin: 0 auto 7px; float: unset;">
                    <button type="submit" class="btn yellow-gradient" style="margin: 0 auto; float: unset;">
                        <strong>Continue</strong>
                    </button>
                </div>
                @if (Auth::check())
                <div class="col-xs-12 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('user.profile')}}'" class="btn yellow-gradient" style="margin: 0 auto; float: unset;">
                        <strong>Back</strong>
                    </button>
                </div>
                @endif
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