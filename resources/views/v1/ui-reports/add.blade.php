
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('ui-reports') }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>Errors and Bugs Report</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('issue') ? ' has-error' : '' }}">
                <label for="issue" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Issue</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <textarea type="text" class="form-control" id="issue" name="issue" style="height: 100px;">{{old('issue')}}</textarea>

                    @if ($errors->has('issue'))
                        <span class="help-block">
                            <strong>{{ $errors->first('issue') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('ui_reports','issue'))
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
                @if($title = auth()->user()->table_column_description('ui_reports','url'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                <label for="priority" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Piority</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="priority" name="priority">
                        <option value="">- select -</option>
                        <option value="1" {{old('priority') == '1' ? 'selected':''}}>High</option>
                        <option value="2" {{old('priority') == '2' ? 'selected':''}}>Medium</option>
                        <option value="3" {{old('priority') == '3' ? 'selected':''}}>Low</option>
                    </select>

                    @if ($errors->has('priority'))
                        <span class="help-block">
                            <strong>{{ $errors->first('priority') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('ui_reports','priority'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <label for="status" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Status</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="status" name="status">
                        <option {{old('status') == 'Outstanding' ? 'selected':''}}>Outstanding</option>
                        <option {{old('status') == 'Resolved' ? 'selected':''}}>Resolved</option>
                    </select>

                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('ui_reports','status'))
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
