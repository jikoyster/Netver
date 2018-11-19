
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('global-currency-code.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Global Currency Codes</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('entity') ? ' has-error' : '' }}">
                <label for="entity" class="col-xs-4 control-label text-right text-white">Entity</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="entity" name="entity" style="margin: 0 auto; float: unset;" value="{{old('entity')}}">
                </div>
                @if ($errors->has('entity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('entity') }}</strong>
                    </span>
                @endif
                @if($title = auth()->user()->table_column_description('global_currency_codes','entity'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                <label for="currency" class="col-xs-4 control-label text-right text-white">Currency</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="currency" name="currency" style="margin: 0 auto; float: unset;" value="{{old('currency')}}">

                    @if ($errors->has('currency'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_currency_codes','currency'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('alphabetic_code') ? ' has-error' : '' }}">
                <label for="alphabetic_code" class="col-xs-4 control-label text-right text-white">Alphabetic Code</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input class="form-control" id="alphabetic_code" name="alphabetic_code" value="{{old('alphabetic_code')}}">

                    @if ($errors->has('alphabetic_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alphabetic_code') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_currency_codes','alphabetic_code'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('numeric_code') ? ' has-error' : '' }}">
                <label for="numeric_code" class="col-xs-4 control-label text-right text-white">Numeric Code</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input class="form-control" id="numeric_code" name="numeric_code" value="{{old('numeric_code')}}">

                    @if ($errors->has('numeric_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('numeric_code') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_currency_codes','numeric_code'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <div class="col-xs-offset-5 col-xs-3 text-center">
                    <label for="active" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Active</label>
                    <label class="container-check pull-right">
                      <input type="checkbox" class="form-control pull-right" id="active" name="active" {{old('active') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if ($errors->has('active'))
                        <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_currency_codes','active'))
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
