<div class="row" style="margin-bottom: 30px;">
    <form class="form-horizontal" method="POST" action="{{ route('menu.role.save',[Request::segment(3),Request::segment(4)]) }}">
        {{ csrf_field() }}

        <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Role</strong></h3>
                </div>
            </div>

        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
            <label for="role_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

            <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                <select class="form-control" name="role_id">
                    <option value="">select</option>
                    @foreach($roles as $role)
                        <option value="<?=$role->id?>"><?=$role->name?></option>
                    @endforeach
                </select>

                @if ($errors->has('role_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('role_id') }}</strong>
                    </span>
                @endif
            </div>
            @if($title = auth()->user()->table_column_description('roles','name'))
                <div class="col-xs-2" style="padding: 0;">
                    <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
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