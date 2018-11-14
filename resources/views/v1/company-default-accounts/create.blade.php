@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('company-default-account.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Company Default Accounts</strong></h3>
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('retained_earnings') ? ' has-error' : '' }}">
                <label for="retained_earnings" class="col-xs-5 control-label text-right text-white">Retained Earning Account</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="retained_earnings" name="retained_earnings" {{$company_default_accounts->count() ? 'disabled':''}}>
                        <option value="">-select-</option>
                        @foreach($company_chart_of_accounts as $account)
                            <option value="{{$account->id}}" {{old('retained_earnings',$company_default_accounts->count() ? $company_default_accounts[0]->retained_earnings:'') == $account->id ? 'selected':''}}>{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('retained_earnings'))
                        <span class="help-block">
                            <strong>{{ $errors->first('retained_earnings') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_default_accounts','retained_earnings'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('accounts_payable') ? ' has-error' : '' }}">
                <label for="accounts_payable" class="col-xs-5 control-label text-right text-white">Accounts Payable</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="accounts_payable" name="accounts_payable">
                        <option value="">-select-</option>
                        @foreach($company_chart_of_accounts as $account)
                            <option value="{{$account->id}}" {{old('accounts_payable',$company_default_accounts->count() ? $company_default_accounts[0]->accounts_payable:'') == $account->id ? 'selected':''}}>{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('accounts_payable'))
                        <span class="help-block">
                            <strong>{{ $errors->first('accounts_payable') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_default_accounts','accounts_payable'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('accounts_receivable') ? ' has-error' : '' }}">
                <label for="accounts_receivable" class="col-xs-5 control-label text-right text-white">Accounts Receivable</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="accounts_receivable" name="accounts_receivable">
                        <option value="">-select-</option>
                        @foreach($company_chart_of_accounts as $account)
                            <option value="{{$account->id}}" {{old('accounts_receivable',$company_default_accounts->count() ? $company_default_accounts[0]->accounts_receivable:'') == $account->id ? 'selected':''}}>{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('accounts_receivable'))
                        <span class="help-block">
                            <strong>{{ $errors->first('accounts_receivable') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_default_accounts','accounts_receivable'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('purchase_discounts') ? ' has-error' : '' }}">
                <label for="purchase_discounts" class="col-xs-5 control-label text-right text-white">Purchase Discounts</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="purchase_discounts" name="purchase_discounts">
                        <option value="">-select-</option>
                        @foreach($company_chart_of_accounts as $account)
                            <option value="{{$account->id}}" {{old('purchase_discounts',$company_default_accounts->count() ? $company_default_accounts[0]->purchase_discounts:'') == $account->id ? 'selected':''}}>{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('purchase_discounts'))
                        <span class="help-block">
                            <strong>{{ $errors->first('purchase_discounts') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_default_accounts','purchase_discounts'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group{{ $errors->has('sales_discounts') ? ' has-error' : '' }}">
                <label for="sales_discounts" class="col-xs-5 control-label text-right text-white">Sales Discounts</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="sales_discounts" name="sales_discounts">
                        <option value="">-select-</option>
                        @foreach($company_chart_of_accounts as $account)
                            <option value="{{$account->id}}" {{old('sales_discounts',$company_default_accounts->count() ? $company_default_accounts[0]->sales_discounts:'') == $account->id ? 'selected':''}}>{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('sales_discounts'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sales_discounts') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_default_accounts','sales_discounts'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
            
            <div class="form-group" style="margin-top: 30px;">
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('companies')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>{{!$company_default_accounts->count() ? 'Add':'Update'}}</strong>
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
        $('select').select2().change();
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
        /*.blur(function(){
            setTimeout(()=>{
                $(this).datepicker('hide');
            },500);
        })*/.on('keyup',function(e){
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
        });;
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
</style>
@stop