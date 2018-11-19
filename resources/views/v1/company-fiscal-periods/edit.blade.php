@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-fiscal-period.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Company Fiscal Period</strong></h3>
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('fiscal_year') ? ' has-error' : '' }}">
                <label for="fiscal_year" class="col-xs-4 control-label text-right text-white">Fiscal Year</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="fiscal_year" name="fiscal_year">
                        <option>-select-</option>
                        <option {{old('fiscal_year',$company_fiscal_period->fiscal_year) == '2018' ? 'selected':''}}>2018</option>
                        <option {{old('fiscal_year',$company_fiscal_period->fiscal_year) == '2019' ? 'selected':''}}>2019</option>
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

            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                <label for="end_date" class="col-xs-4 control-label text-right text-white">Year End Date</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="end_date" name="end_date" style="margin: 0 auto; float: unset;" value="{{old('end_date',$company_fiscal_period->end_date->format('Y-m-d'))}}">

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
                <label for="start_date" class="col-xs-4 control-label text-right text-white">Year Begin Date</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="start_date" name="start_date" style="margin: 0 auto; float: unset;" value="{{old('start_date',$company_fiscal_period->start_date->format('Y-m-d'))}}">

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

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('company-fiscal-periods')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop