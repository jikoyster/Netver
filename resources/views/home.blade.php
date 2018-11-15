@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="row text-center text-white">
            <h3 class="text-white"><strong>{{$name}}</strong></h3>
            <div class="alert spacer">
                <h4 class="text-white"><strong>{{ session('status') }}</strong></h4>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn col-md-12 col-sm-12 col-xs-12 yellow-gradient">
                            <strong>Logout</strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        @if(session('error_message'))
            <div class="row text-center text-white">
                <div class="alert spacer">
                    <h4 class="text-white"><strong>{{ session('error_message') }}</strong></h4>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection