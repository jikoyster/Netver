
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('ui-registrations') }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>UI Registration</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="UI-{{($uis->count() ? $uis->last()->id:0) + 1}}" readonly>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('ui_url') ? ' has-error' : '' }}">
                <label for="ui_url" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">URL</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="ui_url" name="ui_url" style="margin: 0 auto; float: unset;" value="{{old('ui_url')}}">

                    @if ($errors->has('ui_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ui_url') }}</strong>
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
