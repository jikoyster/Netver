@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('accountant.password.email') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="text-center text-white">
                    <h3><strong>Password Assistance</strong></h3>
                    <label>We'll send you a link to a page where you can easily reset your password</label>
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label text-right text-white">Email address</label>

                <div class="col-md-4 text-center" style="margin: 0 auto; float: unset;">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required  style="margin: 0 auto; float: unset;">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center" style="margin: 0 auto; float: unset;">
                    <script src='https://www.google.com/recaptcha/api.js'></script>
                    <div class="g-recaptcha" data-sitekey="6LeYdTMUAAAAAKxVZrwXCIdoLn5SRa5uoCGdR_UH"></div>

                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn col-12 yellow-gradient" style="margin: 0 auto; float: unset;">
                        <strong>Continue</strong>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-4 col-xs-offset-4 text-center">
                    <a class="btn btn-link text-white" href="{{ route('accountant.login') }}">
                        Sign in to an existing account
                    </a>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="col-xs-4">
                        <hr>
                    </div>
                    <div class="col-xs-4 text-center">
                        <div style="margin: 12px 0;" class="text-white">New?</div>
                    </div>
                    <div class="col-xs-4">
                        <hr>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <button type="button" class="btn" onclick="window.location='{{route('accountant.register')}}'">
                        <strong>Create a new account</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<style type="text/css">
    .g-recaptcha > div { margin: 0 auto; }
    .form-group > div > input,
    .form-group > div > button { width: 304px; }
</style>
@endsection