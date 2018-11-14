@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="row text-center text-white">
            <h3 class="text-white"><strong>{{$name}}</strong></h3>
            <div class="alert spacer">
                <h4 class="text-white"><strong>{{ session('status') }}</strong></h4>
            </div>
        </div>
    @endif

    @if(session('error_message'))
        <div class="row text-center text-white">
            <div class="alert spacer">
                <h4 class="text-white"><strong>{{ session('error_message') }}</strong></h4>
            </div>
        </div>
    @endif
        
    <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">
        <form class="form-horizontal" method="POST" action="{{ route('select-company.save') }}">
            {{ csrf_field() }}
            <label for="company_id" class="col-xs-5 control-label text-right text-white">Select a Company</label>

            <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                <select class="form-control" id="company_id" name="company_id">
                    <option value="">-select-</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->display_name}}</option>
                    @endforeach
                </select>

                @if ($errors->has('company_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('company_id') }}</strong>
                    </span>
                @endif
            </div>
                <button type="submit" class="btn col-xs-1" style="margin: 0 auto; float: unset;">
                    <strong>Select</strong>
                </button>
            @if($title = auth()->user()->table_column_description('companies','legal_name'))
                <div class="col-xs-2" style="padding: 0;">
                    <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
            @endif
        </form>
    </div>
        
</div>
@endsection