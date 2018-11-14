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
            <form class="form-horizontal" method="POST" action="{{ route('invite') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-md-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>Invite A New User</strong></h3>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label text-white">New User Email</label>

                    <div class="col-md-4 text-center">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required style="margin: 0 auto; float: unset;">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if(auth()->user()->table_column_description('users','email'))
                    <div class="col-md-1" style="padding: 0;">
                        <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=auth()->user()->table_column_description('users','email')?>"></span>
                    </div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                    <label for="role" class="col-md-4 control-label text-white">Role</label>

                    <div class="col-md-4 text-center">
                        <select name="role" class="form-control" style="margin: 0 auto; float: unset;">
                            <option value="">select</option>
                            <?php foreach($roles as $role) : ?>
                                @if(($role->is_system_role && auth()->user()->hasRole('super admin')) || !$role->is_system_role)
                                    @if($role->id != 6 || (auth()->user()->hasRole('system admin') || auth()->user()->hasRole('super admin')))
                                        <option value="<?=$role->id?>"><?=$role->name?></option>
                                    @endif
                                @endif
                            <?php endforeach; ?>
                        </select>

                        @if ($errors->has('role'))
                            <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if(auth()->user()->table_column_description($roles[0]->getTable(),'name'))
                    <div class="col-md-1" style="padding: 0;">
                        <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=auth()->user()->table_column_description($roles[0]->getTable(),'name')?>"></span>
                    </div>
                    @endif
                </div>
@if(1 == 2)
                <div class="form-group">
                    <div class="col-xs-3 col-xs-offset-2">
                        <hr>
                    </div>
                    <div class="col-xs-2 text-center" style="margin: 5px 0;">
                        <label class="control-label text-white">Roles</label>
                    </div>
                    <div class="col-xs-3">
                        <hr>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                    @foreach($roles as $key => $role)
                        @if($role->id != 6)
                            <div for="roles" class="col-md-4 col-sm-4 col-xs-4 text-right text-white">
                                <input type="checkbox" class="form-control pull-right" id="roles" name="roles[{{$key}}]" value="{{$role->id}}" style="margin: 7px auto 0; width: 20px; height: 20px;" {{old('roles.'.$key) == $role->id ? 'checked':''}}>
                            </div>
                            <label for="roles" class="col-md-8 col-sm-8 col-xs-8 text-left text-white" style="margin: 4px 0;">{{$role->name}}</label>
                        @endif
                    @endforeach
                    @if ($errors->has('roles'))
                        <span class="help-block">
                            <strong>{{ $errors->first('roles') }}</strong>
                        </span>
                    @endif
                </div>
@endif
                <div class="form-group">
                    <div class="col-md-12 text-center" style="margin: 0 auto; float: unset;">
                        <button type="submit" class="btn col-12" style="margin: 0 auto; float: unset;">
                            <strong>Continue</strong>
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
    .form-group > div > input,
    .form-group > div > select,
    .form-group > div > button { width: 304px; }
    .g-recaptcha > div { margin: 0 auto; }
</style>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop