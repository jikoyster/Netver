
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company.users',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                        <h3><strong>User</strong></h3>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                <label for="user_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="user_id" name="user_id" style="margin: 0 auto; float: unset;">
                        <option value="">select</option>
                        @foreach($invited_users as $user)
                            @if(old('user_id') == $user->user_id)
                                <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name.' ('.$user->roles->first()->name.')'}}</option>
                            @else
                                <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name.' ('.$user->roles->first()->name.')'}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('user_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('ui_reports','user_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
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
