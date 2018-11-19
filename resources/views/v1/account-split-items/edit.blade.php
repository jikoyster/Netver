@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('account-split-item.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Account Split Item</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Account No</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_no" name="account_no">
                        <option value="">- select -</option>
                        @foreach($chart_of_accounts as $account)
                            <option value="{{$account->id}}" {{old('account_no',$account_split_item->account_no) == $account->id ? 'selected':''}}>{{$account->account_no.' - '.$account->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_split_items','account_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('sub_account_no') ? ' has-error' : '' }}">
                <label for="sub_account_no" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Sub-Account No</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="sub_account_no" name="sub_account_no" style="margin: 0 auto; float: unset;" value="{{old('sub_account_no',$account_split_item->sub_account_no)}}">

                    @if ($errors->has('sub_account_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sub_account_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_split_items','sub_account_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('sub_account_name') ? ' has-error' : '' }}">
                <label for="sub_account_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Sub-Account Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="sub_account_name" name="sub_account_name" style="margin: 0 auto; float: unset;" value="{{old('sub_account_name',$account_split_item->sub_account_name)}}">

                    @if ($errors->has('sub_account_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sub_account_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_split_items','sub_account_name'))
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
                    <button type="button" onclick="window.location='{{route('account-split-items')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
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
    });
</script>
@stop