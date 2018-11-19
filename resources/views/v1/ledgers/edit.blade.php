@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('ledger.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Ledger</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$ledger->name)}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('standard_data_driven'))
                        <span class="help-block">
                            <strong>{{ $errors->first('standard_data_driven') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('ledgers','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('ledgers')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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