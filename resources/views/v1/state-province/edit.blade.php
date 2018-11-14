@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('state-province.edit',[Request::segment(3)]) }}">
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
                            <?php if($country->id == $state_province->country_currency_id) : ?>
                                <option selected value="<?=$country->id?>"><?=$country->country_name?></option>
                            <?php else : ?>
                                <option value="<?=$country->id?>"><?=$country->country_name?></option>
                            <?php endif; ?>
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
                    <input type="text" class="form-control" id="state_province_name" name="state_province_name" style="margin: 0 auto; float: unset;" value="{{old('state_province_name',$state_province->state_province_name)}}">

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
                        <input type="text" class="form-control" readonly="" value="{{$state_province->flag}}">
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
                    <input type="checkbox" class="form-control pull-left" id="inactive" name="inactive" style="margin: 7px 7px 0 auto; width: 20px; height: 20px;" {{old('inactive',$state_province->inactive) ? 'checked':''}}>

                    @if ($errors->has('inactive'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inactive') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('state_provinces','country_currency_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Update</strong>
                    </button>
                    <button type="button" onclick="window.location='{{route('state-province')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });
        $('.btn-file :file').on('fileselect', function(event, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        
        });
    });
</script>
@stop
@section('css')
<style type="text/css">
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        max-width: 100px;
        max-height: 37px;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>
@stop