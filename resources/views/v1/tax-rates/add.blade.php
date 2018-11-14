
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('tax-rate.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Tax Rate</strong></h3>
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('_tax_code') ? ' has-error' : '' }}">
                <label for="_tax_code" class="col-xs-4 control-label text-right text-white">Tax Code</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_tax_code" name="_tax_code" style="margin: 0 auto; float: unset; text-transform: uppercase;" value="{{old('_tax_code')}}">
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','tax_code'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
                @if ($errors->has('_tax_code'))
                    <span class="help-block pull-left" style="margin-left: 7px;">
                        <strong>{{ $errors->first('_tax_code') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_name') ? ' has-error' : '' }}">
                <label for="_name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_name" name="_name" style="margin: 0 auto; float: unset;" value="{{old('_name')}}">

                    @if ($errors->has('_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','name'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_country') ? ' has-error' : '' }}">
                <label for="_country" class="col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="_country" name="_country">
                        <option value="">- select -</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{old('_country') == $country->id ? 'selected':''}}>{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('_country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_country') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','country_name'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_province_state') ? ' has-error' : '' }}">
                <label for="_province_state" class="col-xs-4 control-label text-right text-white">Province / State</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="_province_state" name="_province_state">
                    </select>

                    @if ($errors->has('_province_state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_province_state') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','province_state'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_city') ? ' has-error' : '' }}">
                <label for="_city" class="col-xs-4 control-label text-right text-white">City</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_city" name="_city" style="margin: 0 auto; float: unset;" value="{{old('_city')}}">

                    @if ($errors->has('_city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_city') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','city'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_tax_rate') ? ' has-error' : '' }}">
                <label for="_tax_rate" class="col-xs-4 control-label text-right text-white">Tax Rate</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_tax_rate" name="_tax_rate" style="margin: 0 auto; float: unset; text-align: right;" value="{{old('_tax_rate')}}">
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','tax_rate'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
                @if ($errors->has('_tax_rate'))
                    <span class="help-block pull-left" style="margin-left: 7px;">
                        <strong>{{ $errors->first('_tax_rate') }}</strong>
                    </span>
                @endif
            </div>
            @if(1 == 2)
            <div class="form-group{{ $errors->has('_start_date') ? ' has-error' : '' }}">
                <label for="_start_date" class="col-xs-4 control-label text-right text-white">Start Date</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_start_date" name="_start_date" style="margin: 0 auto; float: unset;" value="{{old('_start_date')}}" autocomplete="off">

                    @if ($errors->has('_start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_start_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','start_date'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_end_date') ? ' has-error' : '' }}">
                <label for="_end_date" class="col-xs-4 control-label text-right text-white">End Date</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_end_date" name="_end_date" style="margin: 0 auto; float: unset;" value="{{old('_end_date')}}" autocomplete="off">

                    @if ($errors->has('_end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_end_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','end_date'))
                    <div style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            @endif
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
