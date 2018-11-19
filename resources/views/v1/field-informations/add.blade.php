
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('field-informations') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Field Information</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label for="link" class="col-xs-4 control-label text-right text-white">URL</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="link" name="link" style="margin: 0 auto; float: unset;" value="{{old('link')}}">

                    @if ($errors->has('link'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('table_column_descriptions','link'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('table_name') ? ' has-error' : '' }}">
                <label for="table_name" class="col-xs-4 control-label text-right text-white">Table Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="table_name" name="table_name">
                        <option value="">- select -</option>
                        @foreach($tables as $table)
                            <option {{old('table_name') == $table->Tables_in_netver_dev ? 'selected':''}}><?=$table->Tables_in_netver_dev?></option>
                        @endforeach
                    </select>

                    @if ($errors->has('table_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('table_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('table_column_descriptions','table_name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('table_column') ? ' has-error' : '' }}">
                <label for="table_column" class="col-xs-4 control-label text-right text-white">Field / Column Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="table_column" name="table_column">
                        <option>- select -</option>
                    </select>

                    @if ($errors->has('table_column'))
                        <span class="help-block">
                            <strong>{{ $errors->first('table_column') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('table_column_descriptions','table_column'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('column_description') ? ' has-error' : '' }}">
                <label for="column_description" class="col-xs-4 control-label text-right text-white">Field Description</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <textarea class="form-control" id="column_description" name="column_description" style="margin: 0 auto; float: unset;">{{old('column_description')}}</textarea>

                    @if ($errors->has('column_description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('column_description') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('table_column_descriptions','table_column_description'))
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
