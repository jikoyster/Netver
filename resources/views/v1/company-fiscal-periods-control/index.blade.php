@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('company-fiscal-periods-control.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Fiscal Periods Control</strong></h3>
                </div>
            </div>

            <div class="col-xs-12 form-group">
                <label for="fiscal_year" class="col-xs-2 pull-left control-label text-white">Fiscal Year</label>

                <div class="pull-left text-center" style="margin: 0 auto; float: unset; padding-left: 15px; padding-right: 15px;">
                    <select class="form-control" id="fiscal_year" name="fiscal_year" style="width: 163px;">
                        <option value="">-select-</option>
                        @foreach($fiscal_periods as $period)
                            <option value="{{$period->id}}" {{session('selected-company-fiscal-period') && session('selected-company-fiscal-period')->end_date->format('Y') == $period->fiscal_year ? 'selected':''}}>{{$period->fiscal_year}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('fiscal_year'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fiscal_year') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_periods','fiscal_year'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            <div class="col-xs-12 form-group">
                <label for="end_date" class="col-xs-2 pull-left control-label text-white">Year End Date</label>

                <div class="pull-left text-center" style="margin: 0 auto; float: unset; padding-left: 15px; padding-right: 15px;">
                    <select class="form-control" id="end_date" name="end_date" style="width: 163px;" disabled>
                        <option value="">-select-</option>
                        @foreach($fiscal_periods as $period)
                            <option value="{{$period->id}}">{{$period->end_date->format('Y-m-d')}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_periods','end_date'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            
                <label for="start_date" class="pull-left control-label text-white">Year Begin Date</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="start_date" name="start_date" disabled>
                        <option value="">-select-</option>
                        @foreach($fiscal_periods as $period)
                            <option value="{{$period->id}}">{{$period->start_date->format('Y-m-d')}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_periods','start_date'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
                
                <label for="period_date_sequence" class="pull-left control-label text-white">Period Date Sequences</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="period_date_sequence" name="period_date_sequence">
                        <option value="">-select-</option>
                        <option value="1" {{$period->period_date_sequence == 1 ? 'selected':''}}>Yearly</option>
                        <option value="2" {{$period->period_date_sequence == 2 ? 'selected':''}}>Monthly</option>
                    </select>

                    @if ($errors->has('period_date_sequence'))
                        <span class="help-block">
                            <strong>{{ $errors->first('period_date_sequence') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_periods','period_date_sequence'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="text-center col-md-12" style="margin-top: 17px;">
                <table class="table table-striped main-journal-table" style="background: #fff;">
                    <thead style="font-weight: bold;">
                        <tr style="font-weight: bold; background-color: #000; color: #fff;">
                            <td></td>
                            <td>Beginning</td>
                            <td>End</td>
                            <td>Locked</td>
                            <td></td>
                            <td>Beginning</td>
                            <td>End</td>
                            <td>Locked</td>
                        </tr>
                    </thead>
                    <tbody class="fiscal-periods-container">
                    </tbody>
                    <tbody class="adjusting-period-tbody" style="border-top: none;">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 160px;" class="control-label">Adjusting Period&nbsp;&nbsp;&nbsp;&nbsp;<span class="adjusting_period_ctr"></span></td>
                            <td class="adjusting-period-beginning-date"></td>
                            <td class="adjusting-period-end-date"></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="form-group" style="margin-top: 30px;">
                <div class="col-xs-4 pull-right text-center">
                    <button type="button" onclick="window.location='{{route('companies')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Save</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        $('[name=period_date_sequence]').change(function(){
            if($('[name=fiscal_year]').val() && $(this).val()) {
                $.get('{{route('company-fiscal-periods-control.list',[])}}/'+$('[name=fiscal_year]').val(),(data)=>{
                    if(data.length > 1) {
                        html = '';
                        for(var a = 0; a < data.length; a++) {
                            start_date = new Date(data[a].beginning);
                            if($(this).val() == 1)
                                end_date = new Date(data[data.length - 1].end);
                            else
                                end_date = new Date(data[a].end);
                            html += '<tr>';
                                html += '<td class="control-label">'+data[a].sequence+'</td>';
                                if(start_date.getDate() < 10)
                                    day = '0'+start_date.getDate();
                                else
                                    day = start_date.getDate();
                                html += '<td>'+start_date.getFullYear()+'-'+months[start_date.getMonth()]+'-'+day+'</td>';
                                html += '<td>'+end_date.getFullYear()+'-'+months[end_date.getMonth()]+'-'+end_date.getDate()+'</td>';
                                if(data[a].locked) {
                                    locked = 'checked';
                                    color = 'red';
                                } else {
                                    locked = '';
                                    color = '';
                                }
                                console.log('color:'+color);
                                html += '<td><span class="glyphicon glyphicon-lock '+color+'"></span><input type="checkbox" class="checkbox-input" name="locked[]" value="'+data[a].id+'" '+locked+'></td>';

                                a++;
                                if($(this).val() == 2 && data[a]) {
                                    if(data[a]) {
                                        start_date = new Date(data[a].beginning);
                                        end_date = new Date(data[a].end);
                                        sequence = data[a].sequence;
                                        id = data[a].id;
                                        lock = data[a].locked;
                                        if(start_date.getDate() < 10)
                                            day = '0'+start_date.getDate();
                                        else
                                            day = start_date.getDate();
                                        date_start = start_date.getFullYear()+'-'+months[start_date.getMonth()]+'-'+day
                                        date_end = end_date.getFullYear()+'-'+months[end_date.getMonth()]+'-'+end_date.getDate()
                                    }
                                    else {
                                        sequence = '';
                                        id = '';
                                        lock = '';
                                        date_start = '';
                                        date_end = '';
                                    }
                                    html += '<td class="control-label">'+sequence+'</td>';
                                    html += '<td>'+date_start+'</td>';
                                    html += '<td>'+date_end+'</td>';
                                    if(lock) {
                                        locked = 'checked';
                                        color = 'red';
                                    } else {
                                        locked = '';
                                        color = '';
                                    }
                                    html += '<td>';
                                    if(data[a])
                                        html += '<span class="glyphicon glyphicon-lock '+color+'"></span><input type="checkbox" class="checkbox-input" name="locked[]" value="'+id+'" '+locked+'>';
                                    html += '</td>';
                                } else {
                                    sequence = '';
                                    html += '<td class="control-label"></td>';
                                    html += '<td></td>';
                                    html += '<td></td>';
                                    html += '<td></td>';
                                }
                            html += '</tr>';
                            ctr = parseInt(sequence);
                            if($(this).val() == 1)
                                a = data.length;
                        }
                        a_start_date = new Date(data[0].beginning);
                        a_end_date = new Date(data[(data.length - 1)].end);
                        if(a_start_date.getDate() < 10)
                            day = '0'+a_start_date.getDate();
                        else
                            day = a_start_date.getDate();
                        $('.adjusting-period-beginning-date').html(a_start_date.getFullYear()+'-'+months[a_start_date.getMonth()]+'-'+day);
                        $('.adjusting-period-end-date').html(a_end_date.getFullYear()+'-'+months[a_end_date.getMonth()]+'-'+a_end_date.getDate());
                    } else {
                        var start_date = new Date($('[name=start_date] option:selected').text());
                        var end_date = new Date($('[name=end_date] option:selected').text());
                        html = '';
                        ctr = 0;
                        for(var a = start_date.getMonth(); a <= end_date.getMonth(); a++) {
                            html += '<tr>';
                                html += '<td class="control-label">'+(++ctr)+'</td>';
                                if(a == start_date.getMonth())
                                    html += '<td>'+start_date.getFullYear()+'-'+months[start_date.getMonth()]+'-'+start_date.getDate()+'</td>';
                                else
                                    html += '<td>'+start_date.getFullYear()+'-'+months[a]+'-01</td>';
                                last_day = new Date(start_date.getFullYear(), (a + 1), 0).getDate();
                                if($(this).val() == 1 || a != start_date.getMonth()) {
                                    if(a == end_date.getMonth())
                                        html += '<td>'+end_date.getFullYear()+'-'+months[end_date.getMonth()]+'-'+end_date.getDate()+'</td>';
                                    else {
                                        html += '<td>'+end_date.getFullYear()+'-'+months[a]+'-'+last_day+'</td>';
                                    }
                                }
                                else
                                    html += '<td><input name="first_period_end_date" value="'+end_date.getFullYear()+'-'+months[a]+'-'+last_day+'" class="form-control" style="width:150px; margin:0 auto;"></td>';
                                if($(this).val() == 1 && data.length == 1 && data[0].locked) {
                                    locked = 'checked';
                                    color = 'red';
                                    value = data[0].id;
                                } else {
                                    locked = '';
                                    color = '';
                                    value = a + 1;
                                }
                                html += '<td><span class="glyphicon glyphicon-lock '+color+'"></span><input type="checkbox" class="checkbox-input" name="locked[]" value="'+value+'" '+locked+'></td>';

                                a++;
                                if($(this).val() == 2 && a <= end_date.getMonth()) {
                                    html += '<td class="control-label">'+(++ctr)+'</td>';
                                    if(a == start_date.getMonth())
                                        html += '<td>'+start_date.getFullYear()+'-'+months[start_date.getMonth()]+'-'+start_date.getDate()+'</td>';
                                    else
                                        html += '<td>'+start_date.getFullYear()+'-'+months[a]+'-01</td>';
                                    last_day = new Date(start_date.getFullYear(), (a + 1), 0).getDate();
                                    if($(this).val() == 1 || a != start_date.getMonth()) {
                                        if(a == end_date.getMonth())
                                            html += '<td>'+end_date.getFullYear()+'-'+months[end_date.getMonth()]+'-'+end_date.getDate()+'</td>';
                                        else {
                                            html += '<td>'+end_date.getFullYear()+'-'+months[a]+'-'+last_day+'</td>';
                                        }
                                    }
                                    html += '<td><span class="glyphicon glyphicon-lock"></span><input type="checkbox" class="checkbox-input" name="locked[]" value="'+(a + 1)+'"></td>';
                                } else {
                                    html += '<td class="control-label"></td>';
                                    html += '<td></td>';
                                    html += '<td></td>';
                                    html += '<td></td>';
                                }
                            html += '</tr>';
                            if($(this).val() == 1)
                                a = end_date.getMonth() + 1;
                        }
                        if(start_date.getDate() < 10)
                            day = '0'+start_date.getDate();
                        else
                            day = start_date.getDate();
                        $('.adjusting-period-beginning-date').html(start_date.getFullYear()+'-'+months[start_date.getMonth()]+'-'+day);
                        $('.adjusting-period-end-date').html(end_date.getFullYear()+'-'+months[end_date.getMonth()]+'-'+end_date.getDate());
                    }
                    $('.adjusting_period_ctr').html(ctr + 1);
                    $('.fiscal-periods-container').html(html);
                    $('[name=first_period_end_date]')
                        .datepicker({format:'yyyy-mm-dd'})
                        .on('keyup',function(e){
                            if(!$(this).val()) {
                                var d = new Date();
                                var m = d.getMonth() + 1;
                                if(m < 10)
                                    m = '0'+m;
                                $(this).val(d.getFullYear()+'-'+m+'-'+d.getDate());
                            }
                            if(e.keyCode == 13) {
                                $(this).datepicker('hide');
                            }
                            if(e.keyCode > 36 && e.keyCode < 41){
                                theKeyup(e,this);
                            }
                        }).on('changeDate',function(e){
                            if(e.viewMode == 'days') {
                                $( this ).datepicker('hide');
                            }
                        });
                    $('.glyphicon-lock').click(function(){
                        if($(this).hasClass('red')) {
                            $(this).next().prop('checked',false);
                            $(this).removeClass('red');
                        } else {
                            $(this).next().prop('checked',true);
                            $(this).addClass('red');
                        }
                    });
                });
            }
        });
        $('select').select2();
        $('[name=fiscal_year]').change(function(){
            $('[name=end_date],[name=start_date]').val($(this).val()).change();
            $('[name=period_date_sequence]').change();
        }).change();
        var theKeyup = function(e,this_is) {
            var someDate = new Date($(this_is).val());
            if(e.keyCode == 37)
                var addNumberOfDaysToAdd = -1;
            if(e.keyCode == 38)
                var addNumberOfDaysToAdd = -7;
            if(e.keyCode == 39)
                var addNumberOfDaysToAdd = 1;
            if(e.keyCode == 40)
                var addNumberOfDaysToAdd = 7;
            //someDate.setDate(someDate.getDate() + addNumberOfDaysToAdd);
            var dd = someDate.getDate() + addNumberOfDaysToAdd;
            var mm = someDate.getMonth() + 1;
            if(mm < 10)
                mm = '0'+mm;
            var y = someDate.getFullYear();
            var someFormattedDate = y + '-'+ mm + '-'+ dd;
            $(this_is).val(someFormattedDate).datepicker('setValue',someFormattedDate);
        }
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/datepicker.css')}}">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .select2-selection {
        height: 36px !important;
        padding: 3px 0;
        text-align: left;
    }
    .control-label {
        font-weight: bold;
    }
    .glyphicon-lock {
        cursor: pointer;
    }
    .glyphicon-lock.red {
        color: red;
    }
    .checkbox-input {
        visibility: hidden;
    }
</style>
@stop