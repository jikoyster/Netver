
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('acl.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Access Control</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                <label for="role_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Role</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="">select</option>
                        @foreach($roles as $role)
                            @if(old('role_id') == $role->id)
                                <option selected value="{{$role->id}}">{{$role->name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('role_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('access_control_levels','role_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('feature_id') ? ' has-error' : '' }}">
                <label for="feature_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Feature</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="feature_id" name="feature_id">
                        <option value="">select</option>
                        @foreach($features as $feature)
                            @if(old('feature_id') == $feature->id)
                                <option selected value="{{$feature->id}}">{{$feature->name}}</option>
                            @else
                                <option value="{{$feature->id}}">{{$feature->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('feature_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('feature_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('features','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label for="url" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">URL</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="url" name="url" style="margin: 0 auto; float: unset;" value="{{old('url')}}">

                    @if ($errors->has('url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('access_control_levels','url'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('parameter') ? ' has-error' : '' }}">
                <label for="parameter" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Parameter</label>

                <div class="col-xs-1 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="parameter" name="parameter" style="margin: 0 auto; float: unset;" value="{{old('parameter')}}">

                    @if ($errors->has('parameter'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parameter') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('access_control_levels','parameter'))
                    <div class="col-xs-1" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif

                <div class="col-md-2 col-sm-2 col-xs-2 text-center" style="margin: 0 auto;">
                    <label for="enabled" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Enabled</label>
                    <input type="checkbox" class="form-control pull-right" id="enabled" name="enabled" {{old('enabled') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('enabled'))
                        <span class="help-block">
                            <strong>{{ $errors->first('enabled') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('access_control_levels','enabled'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="col-xs-3 col-xs-offset-2">
                    <hr>
                </div>
                <div class="col-xs-2" style="margin: 5px 0;">
                    <label class="control-label text-white">Permissions</label>
                </div>
                <div class="col-xs-3">
                    <hr>
                </div>
            </div>

            <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                <div class="permissions-container">
                    @foreach($permissions as $key => $permission)
                        <div for="permissions" class="col-md-4 col-sm-4 col-xs-4 text-right text-white">
                            <input type="checkbox" class="form-control pull-right" id="permissions" name="permissions[{{$key}}]" value="{{$permission->id}}" style="margin: 7px auto 0; width: 20px; height: 20px;" {{old('permissions.'.$key) == $permission->id ? 'checked':''}}>
                        </div>
                        <label for="permissions" class="col-md-8 col-sm-8 col-xs-8 text-left text-white" style="margin: 4px 0;">{{$permission->name}}</label>
                    @endforeach
                </div>
                @if ($errors->has('permissions'))
                    <span class="help-block">
                        <strong>{{ $errors->first('permissions') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
