@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('user.update') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>USER Profile</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('system_user_id') ? ' has-error' : '' }}">
                <label for="system_user_id" class="col-xs-4 control-label text-right text-white">ID</label>

                <div class="col-md-2 col-sm-2 col-xs-2 pull-left" style="margin: 0 auto; float: unset;">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input id="system_user_id" type="hidden" class="form-control" name="system_user_id" value="{{ ($user->system_user_id) ? $user->system_user_id : $user->new_system_user_id }}" required autofocus style="margin: 0 auto; float: unset;">
                    <h3 class="text-white" style="margin: 0;"><strong>{{ ($user->system_user_id) ? $user->system_user_id : $user->new_system_user_id }}</strong></h3>

                    @if ($errors->has('system_user_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('system_user_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-xs-4 control-label text-right text-white">Email</label>

                <div class="col-xs-3 text-center">
                    <input
                        id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        value="{{ old('email',$user->email) }}"
                        required
                        {{($user->system_user_id) ? 'readonly':''}}
                        {{($user->new_system_user_id) ? 'readonly':''}}
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="col-xs-1" style="padding: 0;">
                    @if($title = auth()->user()->table_column_description('users','email'))
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>
                
                <div class="col-xs-4 text-center">
                    <button type="button" class="btn col-xs-5 yellow-gradient" onclick="window.location='{{route('user.password.request')}}'"><strong>Change Password</strong></button>
                </div>
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="col-xs-4 control-label text-right text-white">First Name</label>

                <div class="col-xs-3 text-center">
                    <input
                        id="first_name"
                        type="first_name"
                        class="form-control"
                        name="first_name"
                        value="{{ old('first_name',$user->first_name) }}"
                        required
                        
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-xs-1" style="padding: 0;">
                    @if($title = auth()->user()->table_column_description('users','first_name'))
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>

                <div class="col-xs-4 text-center">
                    <button type="button" onclick="window.location='{{route('user.address')}}'" class="btn col-xs-5 yellow-gradient"><strong>Address</strong></button>
                </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" class="col-xs-4 control-label text-right text-white">Last Name</label>

                <div class="col-xs-3 text-center">
                    <input
                        id="last_name"
                        type="last_name"
                        class="form-control"
                        name="last_name"
                        value="{{ old('last_name',$user->last_name) }}"
                        required
                        
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-1" style="padding: 0;">
                    @if($title = auth()->user()->table_column_description('users','last_name'))
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('home_phone') ? ' has-error' : '' }}">
                <label for="home_phone" class="col-xs-4 control-label text-right text-white">Home Phone</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input
                        id="home_phone"
                        type="home_phone"
                        class="form-control"
                        name="home_phone"
                        value="{{ old('home_phone',$user->home_phone) }}"
                        
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('home_phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('home_phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-1" style="padding: 0;">
                    @if($title = auth()->user()->table_column_description('users','home_phone'))
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
                <label for="mobile_phone" class="col-xs-4 control-label text-right text-white">Mobile Phone</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input
                        id="mobile_phone"
                        type="mobile_phone"
                        class="form-control"
                        name="mobile_phone"
                        value="{{ old('mobile_phone',$user->mobile_phone) }}"
                        
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('mobile_phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile_phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-1" style="padding: 0;">
                    @if($title = auth()->user()->table_column_description('users','mobile_phone'))
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-3 col-xs-offset-4">
                    <button type="button" onclick="window.location='{{route('home')}}'" class="btn yellow-gradient pull-left" style="margin: 0; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-5 pull-right" ><strong>Update</strong></button>
                </div>
            </div>

        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop