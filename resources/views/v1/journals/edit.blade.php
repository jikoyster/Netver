@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('journal.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Journal</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('journalid') ? ' has-error' : '' }}">
                <label for="journalid" class="col-xs-4 control-label text-right text-white">Journal ID</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="journalid" name="journalid" style="margin: 0 auto; float: unset; text-transform: uppercase;" value="{{old('journalid',$journal->journalid)}}">
                </div>
                @if ($errors->has('journalid'))
                    <span class="help-block">
                        <strong>{{ $errors->first('journalid') }}</strong>
                    </span>
                @endif
                @if($title = auth()->user()->table_column_description('journals','journalid'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$journal->name)}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('journals','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-xs-4 control-label text-right text-white">Description</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <textarea class="form-control" id="description" name="description">{{old('description',$journal->description)}}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('journals','description'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('journal_index') ? ' has-error' : '' }}">
                <label for="journal_index" class="col-xs-4 control-label text-right text-white">Index</label>

                <div class="col-xs-1 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="journal_index" name="journal_index" {{old('journal_index',$journal->journal_index) ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                    @if($title = auth()->user()->table_column_description('journals','journal_index'))
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>

                <label for="show_debit_credit" class="col-xs-3 control-label text-right text-white">
                    Show Debit and Credit Columns
                    <label class="container-check pull-right" style="margin-left: 15px;">
                      <input type="checkbox" class="form-control pull-right" id="show_debit_credit" name="show_debit_credit" {{old('show_debit_credit',$journal->show_debit_credit) ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                </label>
                @if($title = auth()->user()->table_column_description('journals','show_debit_credit'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('journal_active') ? ' has-error' : '' }}">
                <label for="journal_active" class="col-xs-4 control-label text-right text-white">Active</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="journal_active" name="journal_active" {{old('journal_active',$journal->journal_active) ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                    @if($title = auth()->user()->table_column_description('journals','journal_active'))
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    @endif
                </div>
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('journals')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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
<script type="text/javascript">
    $(function(){
        var iScrollHeight = $('textarea').prop("scrollHeight");
        $('textarea').height(iScrollHeight);
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop
@section('css')
<style type="text/css">
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #fff;
}
.container-check {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}.container-check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* On mouse-over, add a grey background color */
.container-check:hover input ~ .checkmark {
    background-color: #fff;
}

/* When the checkbox is checked, add a blue background */
.container-check input:checked ~ .checkmark {
    background-color: #fff;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container-check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container-check .checkmark:after {
    left: 7px;
    top: 2px;
    width: 10px;
    height: 17px;
    border: solid #000;
    border-width: 0 5px 5px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
@stop