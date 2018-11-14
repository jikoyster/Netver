
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-location.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Company Location</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('cl_id') ? ' has-error' : '' }}">
                <label for="cl_id" class="col-xs-4 control-label text-right text-white">Location No.</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="cl_id" name="cl_id" style="margin: 0 auto; float: unset;" value="{{old('cl_id')}}">

                    @if ($errors->has('cl_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cl_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_locations','cl_id'))
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
                @if($title = auth()->user()->table_column_description('company_locations','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-xs-4 control-label text-right text-white">Description</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <textarea class="form-control" id="description" name="description" style="margin: 0 auto; float: unset; min-height: 100px;">{{old('description')}}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_locations','description'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('tax_jurisdiction') ? ' has-error' : '' }}">
                <label for="tax_jurisdiction" class="col-xs-4 control-label text-right text-white">Tax Jurisdiction</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="tax_jurisdiction" name="tax_jurisdiction">
                        <option value="">select</option>
                        @foreach($tax_jurisdiction as $jurisdiction)
                            <option value="{{$jurisdiction->id}}" {{old('tax_jurisdiction') == $jurisdiction->id ? 'selected':''}}>{{$jurisdiction->state_province_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tax_jurisdiction'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tax_jurisdiction') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_locations','tax_jurisdiction'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <div class="col-xs-offset-5 col-xs-3 text-center">
                    <label for="active" class="col-xs-9 control-label text-right text-white">Active</label>
                    <label class="container-check pull-right">
                      <input type="checkbox" class="form-control pull-right" id="active" name="active" {{old('active') ? 'checked':'checked'}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if ($errors->has('active'))
                        <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_locations','active'))
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
