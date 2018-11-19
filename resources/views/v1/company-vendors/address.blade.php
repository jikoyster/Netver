@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('company-vendor.address',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>Add Address</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="country" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center">
                    <select class="form-control" id="country" name="country" style="margin: 0 auto; float: unset;">
                        <option value="">Select</option>
                        <?php foreach($countries as $country) : ?>
                            <?php if($country->id == (isset($address->state_province->country->id) ? $address->state_province->country->id : 'x')) : ?>
                                <option value="<?=$country->id?>" selected><?=$country->country_name?></option>
                            <?php else : ?>
                                <option value="<?=$country->id?>" {{(old('country') == $country->id) ? 'selected':''}}><?=$country->country_name?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','country_name'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('state_province') ? ' has-error' : '' }}">
                <label for="state_province" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">State / Province</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                    <select class="form-control" id="state_province" name="state_province" style="margin: 0 auto; float: unset;">
                        <option value="">Select</option>
                    </select>

                    @if ($errors->has('state_province'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state_province') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('addresses','state_province_name'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="city" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">City</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city',isset($address->city) ? $address->city : '') }}" style="margin: 0 auto; float: unset;">

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('addresses','city'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('line1') ? ' has-error' : '' }}">
                <label for="line1" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Line 1</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                    <input id="line1" type="text" class="form-control" name="line1" value="{{ old('line1',isset($address->line1) ? $address->line1 : '') }}" style="margin: 0 auto; float: unset;">

                    @if ($errors->has('line1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('line1') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('addresses','line1'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('line2') ? ' has-error' : '' }}">
                <label for="line2" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Line 2</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                    <input id="line2" type="text" class="form-control" name="line2" value="{{ old('line2',isset($address->line2) ? $address->line2 : '') }}" style="margin: 0 auto; float: unset;">

                    @if ($errors->has('line2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('line2') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('addresses','line2'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                <label for="zipcode" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Postal / Zip code</label>

                <div class="col-md-2 col-sm-2 col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode',isset($address->zip_code) ? $address->zip_code : '') }}" style="margin: 0 auto; float: unset;">

                    @if ($errors->has('zipcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zipcode') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('addresses','zip_code'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('time_zone') ? ' has-error' : '' }}">
                <label for="time_zone" class="col-xs-4 control-label text-right text-white">Time Zone</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" name="time_zone">
                        <option value="">select</option>
                        @foreach($timezone_datas as $timezone_data)
                            @if(old('time_zone'))
                                <option value="{{$timezone_data->id}}" {{($timezone_data->id == old('time_zone')) ? 'selected':''}}>{{$timezone_data->name}}</option>
                            @elseif($address)
                                <option value="{{$timezone_data->id}}" {{($timezone_data->id == $address->time_zone) ? 'selected':''}}>{{$timezone_data->name}}</option>
                            @else
                                <option value="{{$timezone_data->id}}">{{$timezone_data->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('time_zone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('time_zone') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('addresses','time_zone'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add / Update</strong>
                    </button>
                    <button type="button" onclick="window.location='{{route('company-vendor.edit',[Request::segment(3)])}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
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
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[name=country],[name=state_province],[name=time_zone]').select2({dropdownAutoWidth:true});
        $('#country').change(function(){
            if($(this).val()) {
                getStateProvince($(this).val())
            } else {
                $('#state_province').html('<option>select</option>');
            }
        });
        let getStateProvince = function(val) {
            $.get( "<?=route('country.state',[''])?>/"+val, function( data ) {
                let option = "<option value=''>- select -</option>";
                for(var a in data) {
                    if('<?=isset($address->state_province_name) ? $address->state_province_name : 'x'?>' == data[a]['id'] || '<?=old('state_province')?>' == data[a]['id'])
                        option += "<option value='"+data[a]['id']+"' selected>"+data[a]['state_province_name']+"</option>";
                    else
                        option += "<option value='"+data[a]['id']+"'>"+data[a]['state_province_name']+"</option>";
                }
                $('#state_province').html(option);
            });
        }
        getStateProvince($('#country').val());
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop
@section('css')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .select2-container { float: inherit; }
    .select2-selection { height: 36px !important; }
    .select2-selection__rendered {
        text-align: left;
        padding: 3px 14px;
    }
</style>
@stop