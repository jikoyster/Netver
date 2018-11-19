
	<div class="row" style="margin-bottom: 30px;">
        <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('country.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>Country and Currency</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('country_name') ? ' has-error' : '' }}">
                <label for="country_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Country Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="country_name" name="country_name" style="margin: 0 auto; float: unset;" value="{{old('country_name')}}">

                    @if ($errors->has('country_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','country_name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('currency_name') ? ' has-error' : '' }}">
                <label for="currency_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Currency Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="currency_name" name="currency_name" style="margin: 0 auto; float: unset;" value="{{old('currency_name')}}">
                        
                    @if ($errors->has('currency_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','currency_name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('iso_code') ? ' has-error' : '' }}">
                <label for="iso_code" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">ISO Code</label>

                <div class="col-md-2 col-sm-2 col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input id="iso_code" type="text" class="form-control" name="iso_code" value="{{ old('iso_code') }}" required style="margin: 0 auto; float: unset;">

                    @if ($errors->has('iso_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('iso_code') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','iso_code'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                <label for="currency_code" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Currency Code</label>

                <div class="col-md-2 col-sm-2 col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select id="currency_code" type="text" class="form-control" name="currency_code" required style="margin: 0 auto; float: unset;">
                        <option value="">select</option>
                        @foreach($global_currency_codes as $code)
                            <option {{old('currency_code') == $code->alphabetic_code ? 'selected':''}}>{{$code->alphabetic_code}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('currency_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency_code') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','currency_code'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('currency_symbol') ? ' has-error' : '' }}">
                <label for="currency_symbol" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Currency Symbol</label>

                <div class="col-md-2 col-sm-2 col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input id="currency_symbol" type="text" class="form-control" name="currency_symbol" value="{{ old('currency_symbol') }}" required style="margin: 0 auto; float: unset;">

                    @if ($errors->has('currency_symbol'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency_symbol') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','currency_symbol'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('flag') ? ' has-error' : '' }}">
                <label for="flag" class="col-xs-4 control-label text-right text-white">Flag</label>

                <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset; overflow: hidden;">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly="" value="">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="flag" name="flag">
                            </span>
                        </span>
                    </div>

                    <span class="help-block flag">
                        <strong>{{ $errors->first('flag') }}</strong>
                    </span>
                </div>
                @if($title = auth()->user()->table_column_description('state_provinces','flag'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('inactive') ? ' has-error' : '' }}">
                <label for="inactive" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Inactive</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input type="checkbox" class="form-control pull-left" id="inactive" name="inactive" style="margin: 7px 7px 0 auto; width: 20px; height: 20px;">

                    @if ($errors->has('inactive'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inactive') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','inactive'))
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
