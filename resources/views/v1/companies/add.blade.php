
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Company</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Account No</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="account_no" name="account_no" style="margin: 0 auto; float: unset;" value="{{old('account_no',str_limit(strtoupper(md5(microtime())),6,''))}}">

                    @if ($errors->has('account_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_no') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                <label for="display_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Display Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="display_name" name="display_name" style="margin: 0 auto; float: unset;" value="{{old('display_name')}}">

                    @if ($errors->has('display_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('display_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('trade_name') ? ' has-error' : '' }}">
                <label for="trade_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Trade Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="trade_name" name="trade_name" style="margin: 0 auto; float: unset;" value="{{old('trade_name','Netver')}}">

                    @if ($errors->has('trade_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('trade_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('legal_name') ? ' has-error' : '' }}">
                <label for="legal_name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Legal Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="legal_name" name="legal_name" style="margin: 0 auto; float: unset;" value="{{old('legal_name','Netver')}}">

                    @if ($errors->has('legal_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('legal_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
