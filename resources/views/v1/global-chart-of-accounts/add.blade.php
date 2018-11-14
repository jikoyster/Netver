
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('global-chart-of-account.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Global Chart of Account</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-xs-4 control-label text-right text-white">Account No.</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="account_no" name="account_no" style="margin: 0 auto; float: unset;" value="{{old('account_no')}}">
                </div>
                @if ($errors->has('account_no'))
                    <span class="help-block pull-left">
                        <strong>{{ $errors->first('account_no') }}</strong>
                    </span>
                @endif
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_no'))
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
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_type_id') ? ' has-error' : '' }}">
                <label for="account_type_id" class="col-xs-4 control-label text-right text-white">Type</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_type_id" name="account_type_id">
                        <option value="">-select-</option>
                        @foreach($account_types as $type)
                            @if(old('account_type_id') == $type->id)
                                <option selected value="{{$type->id}}">{{$type->name}}</option>
                            @else
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('account_type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_type_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_type_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('sign_id') ? ' has-error' : '' }}">
                <label for="sign_id" class="col-xs-4 control-label text-right text-white">Normal Sign</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="sign_id" name="sign_id">
                        <option value="">-select-</option>
                        @foreach($signs as $sign)
                            @if(old('sign_id') == $sign->id)
                                <option selected value="{{$sign->id}}">{{$sign->name}}</option>
                            @else
                                <option value="{{$sign->id}}">{{$sign->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('sign_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sign_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','sign_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_group_id') ? ' has-error' : '' }}">
                <label for="account_group_id" class="col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_group_id" name="account_group_id">
                        <option value="">-select-</option>
                        @foreach($account_groups as $group)
                            @if(old('account_group_id') == $group->id)
                                <option selected value="{{$group->id}}">{{$group->code.' - '.$group->name}}</option>
                            @else
                                <option value="{{$group->id}}">{{$group->code.' - '.$group->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('account_group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_group_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_group_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_class_id') ? ' has-error' : '' }}">
                <label for="account_class_id" class="col-xs-4 control-label text-right text-white">Class</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_class_id" name="account_class_id">
                        <option value="">-select-</option>
                        @foreach($account_classes as $class)
                            @if(old('account_class_id') == $class->id)
                                <option selected value="{{$class->id}}">{{$class->code.' - '.$class->name}}</option>
                            @else
                                <option value="{{$class->id}}">{{$class->code.' - '.$class->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('account_class_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_class_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_class_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-xs-4"></div>
                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
