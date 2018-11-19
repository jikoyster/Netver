
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-segment.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Company Segment</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('cs_id') ? ' has-error' : '' }}">
                <label for="cs_id" class="col-xs-4 control-label text-right text-white">ID</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="cs_id" name="cs_id" style="margin: 0 auto; float: unset;" value="{{old('cs_id')}}">

                    @if ($errors->has('cs_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cs_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_segments','cs_id'))
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
                @if($title = auth()->user()->table_column_description('company_segments','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                <label for="parent_id" class="col-xs-4 control-label text-right text-white">Parent</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="parent_id" name="parent_id" style="margin: 0 auto; float: unset;" value="{{old('parent_id')}}">
                        <option value="">- select -</option>
                        @foreach($company->segments->where('has_children',1) as $parent)
                            <option value="{{$parent->id}}">{{$parent->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('parent_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_segments','parent_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                <label for="location" class="col-xs-4 control-label text-right text-white">Location</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="location" name="location" style="margin: 0 auto; float: unset;" value="{{old('location')}}">
                        <option value="">- select -</option>
                        @foreach($company_locations as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_segments','location'))
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
                @if($title = auth()->user()->table_column_description('company_segments','description'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('index') ? ' has-error' : '' }}">
                <div class="col-xs-offset-5 col-xs-3 text-center">
                    <label for="index" class="col-xs-9 control-label text-right text-white">Index</label>
                    <label class="container-check pull-right">
                      <input type="checkbox" class="form-control pull-right" id="index" name="index" {{old('index') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if ($errors->has('index'))
                        <span class="help-block">
                            <strong>{{ $errors->first('index') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_segments','index'))
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
                @if($title = auth()->user()->table_column_description('company_segments','active'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('has_children') ? ' has-error' : '' }}">
                <div class="col-xs-offset-5 col-xs-3 text-center">
                    <label for="has_children" class="col-xs-9 control-label text-right text-white">Has Children</label>
                    <label class="container-check pull-right">
                      <input type="checkbox" class="form-control pull-right" id="has_children" name="has_children" {{old('has_children') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if ($errors->has('has_children'))
                        <span class="help-block">
                            <strong>{{ $errors->first('has_children') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_segments','has_children'))
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
