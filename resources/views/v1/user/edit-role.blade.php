@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('user.edit-role',[Request::segment(3),$user_group]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>User Profile</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('system_user_id') ? ' has-error' : '' }}">
                <label for="system_user_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">System User ID</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="system_user_id" name="system_user_id" style="margin: 0 auto; float: unset;" value="{{old('system_user_id',$user->system_user_id)}}" readonly>

                    @if ($errors->has('system_user_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('system_user_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('users','system_user_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">First Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="first_name" name="first_name" style="margin: 0 auto; float: unset;" value="{{old('first_name',$user->first_name)}}" readonly>
                        
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('users','first_name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                <label for="group" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" name="group">
                        @foreach($groups as $group)
                            @if(auth()->user()->groups->first()->id == 7 || auth()->user()->groups->first()->id == $group->id)
                                @if($user->groups->count())
                                    <option value="<?=$group->id?>" {{(old('group',$user->groups->first()->id) == $group->id ? 'selected':'')}}><?=$group->name?></option>
                                @else
                                    <option {{(strtolower($group->name) == 'guest' ? 'selected':'')}} value="<?=$group->id?>"><?=$group->name?></option>
                                @endif
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('group'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('groups','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

@if(1 == 1)
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
                    @if(($role->is_system_role && auth()->user()->hasRole('super admin')) || !$role->is_system_role)
                        @if($role->id != 6 || (auth()->user()->hasRole('system admin') || auth()->user()->hasRole('super admin')))
                            <div for="roles" class="col-md-4 col-sm-4 col-xs-4 text-right text-white">
                                <input type="checkbox" class="form-control pull-right" id="roles" name="roles[{{$key}}]" value="{{$role->id}}" style="margin: 7px auto 0; width: 20px; height: 20px;" {{count(old('roles')) ? (old('roles.'.$key) == $role->id) ? 'checked':'':($user->roles->where('id',$role->id)->count()) ? 'checked':''}}>
                            </div>
                            <label for="roles" class="col-md-8 col-sm-8 col-xs-8 text-left text-white" style="margin: 4px 0;">{{$role->name}}</label>
                        @endif
                    @endif
                @endforeach
                @if ($errors->has('roles'))
                    <span class="help-block text-center">
                        <strong>{{ $errors->first('roles') }}</strong>
                    </span>
                @endif
            </div>
@endif

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Update</strong>
                    </button>
                    <button type="button" onclick="window.location='{{route($user_group ? 'client-users':'users')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
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