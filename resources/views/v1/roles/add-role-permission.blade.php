<div class="row" style="margin-bottom: 30px;">
    <form class="form-horizontal" method="POST" action="{{ route('role.permission.save',[Request::segment(3)]) }}">
        {{ csrf_field() }}

        <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Permission</strong></h3>
                </div>
            </div>

        <div class="form-group{{ $errors->has('permission_id') ? ' has-error' : '' }}">
            <label for="permission_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

            <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                <select class="form-control" name="permission_id">
                    <option value="">select</option>
                    @foreach($permissions as $permission)
                        <option value="<?=$permission->id?>"><?=$permission->name?></option>
                    @endforeach
                </select>

                @if ($errors->has('permission_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('permission_id') }}</strong>
                    </span>
                @endif
            </div>
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