
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('account-group.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Account Group</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <label for="code" class="col-xs-4 control-label text-right text-white">Code</label>

                <div class="col-xs-1 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="code" name="code" style="margin: 0 auto; float: unset;" value="{{old('code')}}">
                </div>
                @if ($errors->has('code'))
                    <span class="help-block pull-left">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
                @if($title = auth()->user()->table_column_description('account_groups','code'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_groups','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                <label for="parent_id" class="col-xs-4 control-label text-right text-white">Parent</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">-select-</option>
                        @foreach($parent_groups as $group)
                            @if(old('parent_id') == $group->id)
                                <option selected value="{{$group->id}}">{{$group->name}}</option>
                            @else
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('parent_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_groups','parent_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('has_children') ? ' has-error' : '' }}">
                <div class="col-xs-offset-5 col-xs-3 text-center">
                    <label for="has_children" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Has Children</label>
                    <input type="checkbox" class="form-control pull-right" id="has_children" name="has_children" {{old('has_children') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('has_children'))
                        <span class="help-block">
                            <strong>{{ $errors->first('has_children') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_groups','has_children'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-xs-4"></div>
                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
