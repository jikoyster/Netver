@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route(!$company_fiscal_periods->count() ? 'company-fiscal-period.save':'company-fiscal-period.select') }}">
            {{ csrf_field() }}

            <div class="form-group text-center">
                <strong class="text-white">{{App\Company::find(session('selected-company'))->trade_name}}</strong>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    @if(!$company_fiscal_periods->count())
                    <h3><strong>Add Company Fiscal Period</strong></h3>
                    @endif
                </div>
            </div>
@if($company_fiscal_periods->count())
            <div class="form-group{{ $errors->has('fiscal_year') ? ' has-error' : '' }}">
                <label for="fiscal_year" class="col-xs-5 control-label text-right text-white">Fiscal Year</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="fiscal_year" name="fiscal_year" style="width: 60%;">
                        <option value="">-select-</option>
                        <?php $year = [] ?>
                        @foreach($company_fiscal_periods as $period)
                            @if(!isset($year[$period->end_date->format('Y')]))
                                <option>{{$period->end_date->format('Y')}}</option>
                                <?php $year[$period->end_date->format('Y')] = $period->end_date->format('Y'); ?>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('fiscal_year'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fiscal_year') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_period','fiscal_year'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
@else
            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                <label for="end_date" class="col-xs-5 control-label text-right text-white">Year End Date</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="end_date" name="end_date" style="margin: 0 auto; float: unset;" value="{{old('end_date')}}" autocomplete="off">

                    @if ($errors->has('end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_period','end_date'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                <label for="start_date" class="col-xs-5 control-label text-right text-white">Year Begin Date</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="start_date" name="start_date" style="margin: 0 auto; float: unset;" value="{{old('start_date')}}" autocomplete="off">

                    @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_period','start_date'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            @if(false)
            <div class="form-group{{ $errors->has('retained_earning_account') ? ' has-error' : '' }}">
                <label for="retained_earning_account" class="col-xs-5 control-label text-right text-white">Retained Earning Account</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="retained_earning_account" name="retained_earning_account" value="{{old('retained_earning_account')}}" autocomplete="off">
                        <option value="">-select-</option>
                        @foreach($company_chart_of_accounts as $account)
                            <option value="{{$account->id}}">{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('retained_earning_account'))
                        <span class="help-block">
                            <strong>{{ $errors->first('retained_earning_account') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_fiscal_period','retained_earning_account'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            @endif
@endif
            <div class="form-group" style="margin-top: 30px;">
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('clear-company',[session('selected-company')])}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>{{!$company_fiscal_periods->count() ? 'Add':'Select'}}</strong>
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
<script type="text/javascript">
    $(function(){
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
        $('#end_date, #start_date')
            .datepicker({format:'yyyy-mm-dd'})
            .on('changeDate',function(e){
                if(e.viewMode == 'days') {
                    $( this ).datepicker('hide');
                }
            }).on('keyup',function(e){
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
            });
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/datepicker.css')}}">
@stop