
	<div class="row">
        <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('state-province') }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>State / Province</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('country_currency_id') ? ' has-error' : '' }}">
                <label for="country_currency_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="country_currency_id" name="country_currency_id" style="margin: 0 auto; float: unset;">
                        <option value="">Select</option>
                        <?php foreach($countries as $country) : ?>
                            <option value="<?=$country->id?>" {{old('country_currency_id') == $country->id ? 'selected':''}}><?=$country->country_name?></option>
                        <?php endforeach; ?>
                    </select>

                    @if ($errors->has('country_currency_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country_currency_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('state_provinces','country_currency_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('state_province_name') ? ' has-error' : '' }}">
                <label for="state_province_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">State / Province</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="state_province_name" name="state_province_name" style="margin: 0 auto; float: unset;" value="{{old('state_province_name')}}">

                    @if ($errors->has('state_province_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state_province_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('state_provinces','state_province_name'))
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
                @if($title = auth()->user()->table_column_description('state_provinces','inactive'))
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
