@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="row text-center text-white">
            <h3><strong>Thank you for regsitering</strong></h3>
            <div class="alert spacer">
                <h4><strong>{{ session('status') }}</strong></h4>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="button" class="btn col-md-12 yellow-gradient" onclick="window.location='{{route('login')}}'">
                            <strong>Login</strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-md-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>Create a new account</strong></h3>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label text-white">Email address</label>

                    <div class="col-md-4 text-center" style="margin: 0 auto; float: unset;">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required style="margin: 0 auto; float: unset;">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
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
                    <div class="col-md-12 text-center" style="margin: 0 auto; float: unset;">
                        <a class="btn btn-link text-white" href="{{ route('login') }}">
                            Sign in to an existing account
                        </a>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection
@section('css')
<style type="text/css">
    a:hover { color: #fff !important; }
    .form-group > div > input,
    .form-group > div > button { width: 304px; }
    .g-recaptcha > div { margin: 0 auto; }
</style>
@endsection