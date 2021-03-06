@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('tax-rate.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Tax Rate</strong></h3>
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('_tax_code') ? ' has-error' : '' }}">
                <label for="_tax_code" class="col-xs-4 control-label text-right text-white">Tax Code</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_tax_code" name="_tax_code" style="margin: 0 auto; float: unset; text-transform: uppercase;" value="{{old('_tax_code',$tax_rate->tax_code)}}">

                    @if ($errors->has('_tax_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_tax_code') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','tax_code'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_name') ? ' has-error' : '' }}">
                <label for="_name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_name" name="_name" style="margin: 0 auto; float: unset;" value="{{old('_name',$tax_rate->name)}}">

                    @if ($errors->has('_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','name'))
                    <div class="col-xs-2" style="padding: 0;">
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
                            <option value="{{$country->id}}" {{old('_country',$tax_rate->state_province->country->id) == $country->id ? 'selected':''}}>{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('_country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_country') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('country_currencies','country_name'))
                    <div class="col-xs-2" style="padding: 0;">
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
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_city') ? ' has-error' : '' }}">
                <label for="_city" class="col-xs-4 control-label text-right text-white">City</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_city" name="_city" style="margin: 0 auto; float: unset;" value="{{old('_city',$tax_rate->city)}}">

                    @if ($errors->has('_city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_city') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','city'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_tax_rate') ? ' has-error' : '' }}">
                <label for="_tax_rate" class="col-xs-4 control-label text-right text-white">Tax Rate</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_tax_rate" name="_tax_rate" style="margin: 0 auto; float: unset; text-align: right;" value="{{old('_tax_rate',$tax_rate->tax_rate)}}" {{$tax_rate->grouped_tax_rates->count() ? 'readonly':''}}>

                    @if ($errors->has('_tax_rate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_tax_rate') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','tax_rate'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            @if(1 == 2)
            <div class="form-group{{ $errors->has('_start_date') ? ' has-error' : '' }}">
                <label for="_start_date" class="col-xs-4 control-label text-right text-white">Start Date</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_start_date" name="_start_date" style="margin: 0 auto; float: unset;" value="{{old('_start_date',($tax_rate->start_date) ? $tax_rate->start_date->format('Y-m-d'):'')}}" autocomplete="off">

                    @if ($errors->has('_start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_start_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','start_date'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('_end_date') ? ' has-error' : '' }}">
                <label for="_end_date" class="col-xs-4 control-label text-right text-white">End Date</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="_end_date" name="_end_date" style="margin: 0 auto; float: unset;" value="{{old('_end_date',($tax_rate->end_date) ? $tax_rate->end_date->format('Y-m-d'):'')}}" autocomplete="off">

                    @if ($errors->has('_end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_end_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('tax_rates','end_date'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            @endif
            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('tax-rates')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Update</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        let getStateProvince = function(val) {
            $.get( "<?=route('country.state',[''])?>/"+val, function( data ) {
                let option = "<option value=''>- select -</option>";
                for(var a = 0;  a < data.length; a++) {
                    if('<?=old('province_state',$tax_rate->state_province->id)?>' == data[a]['id'])
                        option += "<option value='"+data[a]['id']+"' selected>"+data[a]['state_province_name']+"</option>";
                    else
                        option += "<option value='"+data[a]['id']+"'>"+data[a]['state_province_name']+"</option>";
                }
                $('#_province_state').html(option);
            });
        }
        $('#_country').change(function(){
            if($(this).val()) {
                getStateProvince($(this).val())
            } else {
                $('#_province_state').html('<option>- select -</option>');
            }
        }).change();

        $( "#_start_date,#_end_date" ).datepicker({
            format:'yyyy-mm-dd'
        }).on('changeDate',function(){
            $(this).datepicker('hide');
        });

        addCommas = function(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        @if($tax_rate->grouped_tax_rates->count() < 1)
            $('[name=_tax_rate]').off('blur').on('blur',function(){
                if($(this).val().trim() == '')
                    $(this).val('');
                else
                    $(this).val(addCommas(parseFloat($(this).val()).toFixed(5)));
            });
        @endif
    });
</script>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('assets/datepicker/datepicker.css')}}">
@stop