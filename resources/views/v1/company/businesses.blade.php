@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        @if ($errors->has('trade_name'))
            <div class="alert spacer text-center">
                <h4><strong class="text-red">{{ $errors->first('trade_name') }}</strong></h4>
            </div>
        @endif
        <div class="form-group">
            <div class="col-md-12 text-center" style="margin: 0 auto; float: unset;">
                <h3><strong class="text-white">MY Businesses</strong></h3>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12" style="margin-bottom: 30px; min-height: 254px;">
    		<?php foreach($companies as $company) : ?>
    		<div class="col-md-2 text-center">
                <a href="{{route('company.index',[$company->account_no])}}">
                    <img src="/img/my-businesses.jpg">
                    <p><strong class="text-white">{{$company->trade_name}}</strong></p>
                </a>
            </div>
        	<?php endforeach; ?>
    	</div>
    	<div class="col-md-12 form-group">
            <div class="col-md-4 pull-right text-right">
                @can('add')
                    <button type="button" class="btn pull-right" data-toggle="modal" data-target="#addCompanyModal">
                        <strong>Add Company</strong>
                    </button>
                @endcan
                <button type="button" onclick="window.location='{{route('home')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                    <strong>Back</strong>
                </button>
            </div>
        </div>
    </div>
</div>

@can('add')
    <div class="modal fade" tabindex="-1" role="dialog" id="addCompanyModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="POST" action="{{route('company.businesses')}}">
                {{ csrf_field() }}
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			</div>
    			<div class="modal-body">
    				<div class="form-group" style="display: table; width: 100%; margin: 0;">
    					<div style="display: table-cell; width: 20%;">
    						<label>Trade Name</label>
    					</div>
    					<div style="display: table-cell;">
    						<input type="text" name="trade_name" class="form-control">
    					</div>
    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-default"><strong>Add Company</strong></button>
    			</div>
    		</form>
        </div>
      </div>
    </div>
@endcan

@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
@stop