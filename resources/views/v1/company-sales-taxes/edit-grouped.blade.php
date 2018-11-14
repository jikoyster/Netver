@extends('layouts.app')

@section('content')
<div class="col-md-12" style="margin-bottom: 15px;">
    <div class="col-md-12" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-sales-tax.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Grouped Company Sales Tax</strong></h3>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-6 form-group{{ $errors->has('_location') ? ' has-error' : '' }}">
                    <label for="_location" class="col-xs-2 control-label text-right text-white">Location</label>

                    <div class="col-xs-5 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <select class="form-control" id="_location" name="_location">
                            <option value="">- select -</option>
                            @foreach($company_locations as $location)
                                <option value="{{$location->id}}" {{old('_location',$tax_rate->location) == $location->id ? 'selected':''}}>{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('_location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_location') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','location'))
                        <div style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 form-group{{ $errors->has('_tax_code') ? ' has-error' : '' }}">
                    <label for="_tax_code" class="col-xs-2 control-label text-right text-white">Tax Code</label>

                    <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <input type="text" class="form-control" id="_tax_code" name="_tax_code" style="margin: 0 auto; float: unset; text-transform: uppercase;" value="{{old('_tax_code',$tax_rate->tax_code)}}">
                    </div>
                    @if ($errors->has('_tax_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_tax_code') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','tax_code'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
                
                <div class="col-md-6 form-group{{ $errors->has('_country') ? ' has-error' : '' }}">
                    <label for="_country" class="col-xs-2 control-label text-right text-white">Country</label>

                    <div class="col-xs-5 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <select class="form-control" id="_country" name="_country">
                            <option value="">- select -</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{old('_country',$tax_rate->state_province->country->id) == $country->id ? 'selected':''}}>{{$country->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($title = auth()->user()->table_column_description('country_currencies','country_name'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                    @if ($errors->has('_country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_country') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="col-md-6 form-group{{ $errors->has('_name') ? ' has-error' : '' }}">
                    <label for="_name" class="col-xs-2 control-label text-right text-white">Name</label>

                    <div class="col-xs-5 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <input type="text" class="form-control" id="_name" name="_name" style="margin: 0 auto; float: unset;" value="{{old('_name',$tax_rate->name)}}">
                    </div>
                    @if ($errors->has('_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_name') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','name'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
                
                <div class="col-md-6 form-group{{ $errors->has('_province_state') ? ' has-error' : '' }}">
                    <label for="_province_state" class="col-xs-2 control-label text-right text-white">Province / State</label>

                    <div class="col-xs-5 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <select class="form-control" id="_province_state" name="_province_state">
                        </select>
                    </div>
                    @if ($errors->has('_province_state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_province_state') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','province_state'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
            
                <div class="col-md-6 form-group{{ $errors->has('_start_date') ? ' has-error' : '' }}">
                    <label for="_start_date" class="col-xs-2 control-label text-right text-white">Start Date</label>

                    <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <input type="text" class="form-control" id="_start_date" name="_start_date" style="margin: 0 auto; float: unset;" value="{{old('_start_date',($tax_rate->start_date) ? $tax_rate->start_date->format('Y-m-d'):'')}}" autocomplete="off">
                    </div>
                    @if ($errors->has('_start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_start_date') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','start_date'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
            
                <div class="col-md-6 form-group{{ $errors->has('_city') ? ' has-error' : '' }}">
                    <label for="_city" class="col-xs-2 control-label text-right text-white">City</label>

                    <div class="col-xs-5 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <input type="text" class="form-control" id="_city" name="_city" style="margin: 0 auto; float: unset;" value="{{old('_city',$tax_rate->city)}}">
                    </div>
                    @if ($errors->has('_city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_city') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','city'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
            
                <div class="col-md-6 form-group{{ $errors->has('_end_date') ? ' has-error' : '' }}">
                    <label for="_end_date" class="col-xs-2 control-label text-right text-white">End Date</label>

                    <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <input type="text" class="form-control" id="_end_date" name="_end_date" style="margin: 0 auto; float: unset;" value="{{old('_end_date',($tax_rate->end_date) ? $tax_rate->end_date->format('Y-m-d'):'')}}" autocomplete="off">
                    </div>
                    @if ($errors->has('_end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_end_date') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','end_date'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
            
                <div class="col-md-6 form-group{{ $errors->has('_tax_rate') ? ' has-error' : '' }}">
                    <label for="_tax_rate" class="col-xs-2 control-label text-right text-white">Tax Rate</label>

                    <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <input type="text" class="form-control" id="_tax_rate" name="_tax_rate" style="margin: 0 auto; float: unset; text-align: right;" value="{{old('_tax_rate',$tax_rate->tax_rate)}}" {{$tax_rate->grouped_tax_rates->count() ? 'readonly':''}}>
                    </div>
                    @if ($errors->has('_tax_rate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('_tax_rate') }}</strong>
                        </span>
                    @endif
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','tax_rate'))
                        <div class="" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
            
                <div class="col-md-6 form-group{{ $errors->has('_tax_agency') ? ' has-error' : '' }}">
                    <label for="_tax_agency" class="col-xs-2 control-label text-right text-white">Tax Agency</label>

                    <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                        <select class="form-control" id="_tax_agency" name="_tax_agency">
                            <option value="">- select -</option>
                            @foreach($company_vendors as $vendor)
                                <option value="{{$vendor->id}}" {{old('_tax_agency',$tax_rate->tax_agency) == $vendor->id ? 'selected':''}}>{{$vendor->display_name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('_tax_agency'))
                            <span class="help-block">
                                <strong>{{ $errors->first('_tax_agency') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if($title = auth()->user()->table_column_description('company_sales_taxes','tax_agency'))
                        <div class="col-xs-2" style="padding: 0;">
                            <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12" style="background-color: #fff; margin-bottom: 15px;">
                <table id="grid-keep-selection" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                            <th data-column-id="tax_code">Tax Code</th>
                            <th data-column-id="name">Name</th>
                            <th data-column-id="country" data-formatter="countries">Country</th>
                            <th data-column-id="province_state" data-formatter="province_states">Province / State</th>
                            <th data-column-id="city">City</th>
                            <th data-column-id="tax_rate" data-align="right" data-header-align="right">Tax Rate</th>
                            <th data-column-id="start_date" data-align="center" data-header-align="center">Start Date</th>
                            <th data-column-id="end_date" data-align="center" data-header-align="center">End Date</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto;">
                    <button type="button" onclick="window.location='{{route('company-sales-taxes')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
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
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $("#grid-keep-selection").bootgrid({
            ajax: true,
            caseSensitive: false,
            rowCount: 10,
            post: ()=>
            {
                /* To accumulate custom parameter with the request object */
                return {
                    _id:'{{Request::segment(3)}}',
                    _token:$('[name=_token').val()
                };
            },
            url: "<?=route('company-sales-tax.group-source')?>",
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                'countries': function(col, row)
                {
                    return row.state_province.country.country_name;
                },
                'province_states': function(col, row)
                {
                    return row.state_province.state_province_name;
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function(e, rows)
        {
            $('[name=select]').attr('name','tax_rate_ids[]');
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
            },500);
            @foreach($tax_rate->grouped_tax_rates as $rate)
                $('[type=checkbox][value={{$rate->tax_rate_id}}]').prop('checked',true);
            @endforeach
        }).on("selected.rs.jquery.bootgrid", function(e, rows)
        {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++)
            {
                rowIds.push(rows[i].id);
            }
        }).on("deselected.rs.jquery.bootgrid", function(e, rows)
        {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++)
            {
                rowIds.push(rows[i].id);
            }
        });

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
                $('#province_state').html('<option>- select -</option>');
            }
        }).change();
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<link rel="stylesheet" href="{{asset('assets/datepicker/datepicker.css')}}">
<style type="text/css">
    .datepicker {
        z-index: 9999;
    }
    #grid-keep-selection th:nth-child(2),
    #grid-keep-selection td:nth-child(2) {
        visibility: hidden;
        width: 0;
    }
    .container {
        width: 90%;
    }
    .help-block {
        margin: 0;
    }
</style>
@stop