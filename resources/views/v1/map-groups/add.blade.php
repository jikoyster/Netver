
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('map-group.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Map Group</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Group Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_classes','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                <label for="country_id" class="col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="country_id" name="country_id">
                        <option value="">-select-</option>
                        @foreach($countries as $country)
                            <option {{old('country_id') == $country->id ? 'selected':''}} value="{{$country->id}}">{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('country_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_classes','country_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('nca_id') ? ' has-error' : '' }}">
                <label for="nca_id" class="col-xs-4 control-label text-right text-white">NCA</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="nca_id" name="nca_id">
                        <option value="">-select-</option>
                        @foreach($ncas as $nca)
                            <option {{old('nca_id') == $nca->id ? 'selected':''}} value="{{$nca->id}}">{{$nca->short_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('nca_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nca_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_classes','nca_id'))
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
