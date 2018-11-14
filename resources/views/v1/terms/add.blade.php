
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('term.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Term</strong></h3>
                </div>
            </div><div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-3 control-label text-right text-white">Term Name</label>

                <div class="col-xs-7 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('standard_data_driven'))
                        <span class="help-block">
                            <strong>{{ $errors->first('standard_data_driven') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('terms','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('standard_data_driven') ? ' has-error' : '' }}">
                <label for="standard_data_driven" class="col-xs-3 control-label text-right text-white">Standard</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <label class="container-check pull-left">
                      <input type="radio" class="form-control pull-left" id="standard_data_driven" name="standard_data_driven" value="0" style="margin: 7px 7px 0 auto; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if($title = auth()->user()->table_column_description('terms','standard'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>

                <label for="standard_data_driven" class="col-xs-2 control-label text-right text-white">Data Driven</label>

                <div class="col-xs-1 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <label class="container-check pull-right">
                      <input type="radio" class="form-control pull-right" id="standard_data_driven" name="standard_data_driven" value="1" style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                </div>
                @if($title = auth()->user()->table_column_description('terms','data_driven'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('net_due1') ? ' has-error' : '' }}">
                <label for="net_due1" class="col-xs-3 control-label text-right text-white">Net due in</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control pull-left" id="net_due1" name="net_due1">

                    @if ($errors->has('net_due1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('net_due1') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-1" style="padding: 0;">
                    <label for="" class="control-label pull-left text-white">days</label>
                </div>

                <div class="col-xs-2">
                    @if($title = auth()->user()->table_column_description('terms','net_due'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                    <label for="net_due2" class="control-label pull-right text-white">Net due before the</label>
                </div>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control pull-left" id="net_due2" name="net_due2">

                    @if ($errors->has('net_due2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('net_due2') }}</strong>
                        </span>
                    @endif
                </div>
                <label style="font-size: 12px;" for="" class="control-label pull-left text-white">th day of the next month</label>
            </div>

            <div class="form-group{{ $errors->has('discount1') ? ' has-error' : '' }}">
                <label for="discount1" class="col-xs-3 control-label text-right text-white">Discout %</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control pull-left" id="discount1" name="discount1">

                    @if ($errors->has('discount1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount1') }}</strong>
                        </span>
                    @endif
                </div>

                <label for="discount2" class="col-xs-3 control-label text-right text-white">Discount %</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control pull-left" id="discount2" name="discount2">

                    @if ($errors->has('discount2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount2') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('terms','discount'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('discount_if_paid1') ? ' has-error' : '' }}">
                <label for="discount_if_paid1" class="col-xs-3 control-label text-right text-white">Discount if paid in</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control pull-left" id="discount_if_paid1" name="discount_if_paid1">

                    @if ($errors->has('discount_if_paid1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount_if_paid1') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-1" style="padding: 0;">
                    <label for="" class="control-label pull-left text-white">days</label>
                </div>

                <div class="col-xs-2">
                    @if($title = auth()->user()->table_column_description('terms','discount_if_paid'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                    <label for="discount_if_paid2" class="control-label pull-right text-white">Discount if paid before the</label>
                </div>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control pull-left" id="discount_if_paid2" name="discount_if_paid2">

                    @if ($errors->has('discount_if_paid2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount_if_paid2') }}</strong>
                        </span>
                    @endif
                </div>
                <label style="font-size: 12px;" for="" class="control-label pull-left text-white">th day of the next month</label>
            </div>

            <div class="form-group{{ $errors->has('inactive') ? ' has-error' : '' }}">
                <div class="col-xs-offset-7 col-xs-3 text-center">
                    <label for="inactive" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Inactive</label>
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="inactive" name="inactive" {{old('inactive') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if ($errors->has('inactive'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inactive') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('terms','inactive'))
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
