@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="row text-center text-white">
            <div class="alert spacer">
                <h4><strong>{{ session('status') }}</strong></h4>
            </div>
            <div class="form-group">
                <div class="col-xs-4 col-xs-offset-4">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="button" class="btn col-xs-12 yellow-gradient" onclick="window.location='{{route('login')}}'">
                            <strong>Login</strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-xs-4 col-xs-offset-4">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Your email">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-4 col-xs-offset-4">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Your password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4 col-xs-offset-4">
                        <button type="submit" class="btn col-xs-12 yellow-gradient">
                            <strong>Login</strong>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4 col-xs-offset-4 text-center">
                        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                            Forgot Your Password?
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
                    <div class="col-xs-4 col-xs-offset-4">
                        <button type="button" class="btn col-xs-12" onclick="window.location='{{route('register')}}'">
                            <strong>Create a new account</strong>
                        </button>
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
</style>
@stop