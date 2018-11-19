@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('role.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>Role</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{ucwords(old('name',$role->name))}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('roles','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('enabled') ? ' has-error' : '' }}">
                <div class="col-xs-3 col-xs-offset-5 text-center">
                    <label for="enabled" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Enabled</label>
                    <input type="checkbox" class="form-control pull-right" id="enabled" name="enabled" {{old('enabled',$role->enabled) ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('enabled'))
                        <span class="help-block">
                            <strong>{{ $errors->first('enabled') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('roles','enabled'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
@role('super admin')
            <div class="form-group{{ $errors->has('is_system_role') ? ' has-error' : '' }}">
                <div class="col-xs-3 col-xs-offset-5 text-center">
                    <label for="is_system_role" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Not a System Role</label>
                    <input type="checkbox" class="form-control pull-right" id="is_system_role" name="is_system_role" {{old('is_system_role',$role->is_system_role) ? '':'checked'}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('is_system_role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('is_system_role') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('roles','is_system_role'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
@endrole
            <div class="form-group">
                <div class="col-xs-3 col-xs-offset-2">
                    <hr>
                </div>
                <div class="col-xs-2 text-center" style="margin: 5px 0;">
                    <label class="control-label text-white">Permissions</label>
                </div>
                <div class="col-xs-3">
                    <hr>
                </div>
            </div>

            <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                @foreach($permissions as $permission)
                    <div for="permissions" class="col-md-4 col-sm-4 col-xs-4 text-right text-white">
                        <input type="checkbox" class="form-control pull-right" id="permissions" name="permissions[]" value="{{$permission->id}}" style="margin: 7px auto 0; width: 20px; height: 20px;" {{$role->hasPermissionTo($permission->name) ? 'checked':''}}>
                    </div>
                    <label for="permissions" class="col-md-8 col-sm-8 col-xs-8 text-left text-white" style="margin: 4px 0;">{{$permission->name}}</label>
                @endforeach
                @if ($errors->has('permissions'))
                    <span class="help-block text-center">
                        <strong>{{ $errors->first('permissions') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Update</strong>
                    </button>
                    <button type="button" onclick="window.location='{{route('roles')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
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