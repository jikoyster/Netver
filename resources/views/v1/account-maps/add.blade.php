
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('account-map.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Map</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('map_no') ? ' has-error' : '' }}">
                <label for="map_no" class="col-xs-2 control-label text-right text-white">Map No.</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="map_no" name="map_no" style="margin: 0 auto; float: unset;" value="{{old('map_no')}}">
                    @if ($errors->has('map_no'))
                        <span class="help-block pull-left">
                            <strong>{{ $errors->first('map_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','map_no'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
                
                <div class="col-xs-2 text-center">
                    <label for="title" class="col-xs-10 control-label text-right text-white">Title</label>
                    <input type="checkbox" class="form-control pull-right" id="title" name="title" {{old('title') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','title'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
                
                <div class="col-xs-3 text-center" style="margin-left: 17px;">
                    <label for="unassignable" class="col-xs-10 control-label text-right text-white">Unassignable</label>
                    <input type="checkbox" class="form-control pull-right" id="unassignable" name="unassignable" {{old('unassignable') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('unassignable'))
                        <span class="help-block">
                            <strong>{{ $errors->first('unassignable') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','unassignable'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-2 control-label text-right text-white">Name</label>

                <div class="col-xs-8 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','name'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('map_no') ? ' has-error' : '' }}">
                <label for="parent_id" class="col-xs-2 control-label text-right text-white">Parent</label>

                <div class="col-xs-8 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">- select -</option>
                        @foreach($parent_maps as $map)
                            <option value="{{$map->id}}" {{$map->id == old('parent_id') ? 'selected':''}}>{{$map->map_no.' - '.$map->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('map_no'))
                        <span class="help-block">
                            <strong>Map No. and Parent Combination already existed!</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','parent_id'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_type_id') ? ' has-error' : '' }}">
                <label for="account_type_id" class="col-xs-2 control-label text-right text-white">Type</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_type_id" name="account_type_id">
                        <option value="">- select -</option>
                        @foreach($account_types as $type)
                            <option value="{{$type->id}}" {{old('account_type_id') == $type->id ? 'selected':''}}>{{$type->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_type_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','account_type_id'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif

                <label style="width: 124px;" for="sign_id" class="col-xs-2 control-label text-right text-white">Normal Sign</label>

                <div class="col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="sign_id" name="sign_id">
                        <option value="">- select -</option>
                        @foreach($signs as $sign)
                            <option value="{{$sign->id}}" {{old('sign_id') == $sign->id ? 'selected':''}}>{{$sign->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('sign_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sign_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','sign_id'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_group_id') ? ' has-error' : '' }}">
                <label for="account_group_id" class="col-xs-2 control-label text-right text-white">Group</label>

                <div class="col-xs-8 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_group_id" name="account_group_id">
                        <option value="">- select -</option>
                        @foreach($account_groups as $group)
                            <option value="{{$group->id}}" {{old('account_group_id') == $group->id ? 'selected':''}}>{{$group->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_group_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','account_group_id'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_class_id') ? ' has-error' : '' }}">
                <label for="account_class_id" class="col-xs-2 control-label text-right text-white">Class</label>

                <div class="col-xs-8 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_class_id" name="account_class_id">
                        <option value="">- select -</option>
                        @foreach($account_classes as $class)
                            <option value="{{$class->id}}" {{old('account_class_id') == $class->id ? 'selected':''}}>{{$class->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_class_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_class_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','account_class_id'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="flip_type" class="col-xs-2 control-label text-right text-white">Flip Type</label>

                <div class="col-xs-3 pull-left text-center{{ $errors->has('flip_type') ? ' has-error' : '' }}" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="flip_type" name="flip_type">
                        <option value="">- select -</option>
                        <option value="Individual" {{old('flip_type') == 'Individual' ? 'selected':''}}>Individual</option>
                        <option value="Total is Debit" {{old('flip_type') == 'Total is Debit' ? 'selected':''}}>Total is Debit</option>
                        <option value="Total is Credit" {{old('flip_type') == 'Total is Credit' ? 'selected':''}}>Total is Credit</option>
                    </select>

                    @if ($errors->has('flip_type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('flip_type') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','flip_type'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif

                <label style="width: 124px;" for="flip_to" class="col-xs-2 control-label text-right text-white">Flip To</label>

                <div class="col-xs-3 pull-left text-center{{ $errors->has('flip_to') ? ' has-error' : '' }}" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="flip_to" name="flip_to">
                        <option value="">- select -</option>
                        @foreach($flip_tos as $map)
                            <option value="{{$map->id}}" {{old('flip_to') == $map->id ? 'selected':''}}>
                                <?php
                                    if($map->parent_map)
                                        echo $map->parent_map->map_no.'.';
                                    echo $map->map_no.' - '.$map->name
                                ?>
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('flip_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('flip_to') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','flip_to'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('has_a_child') ? ' has-error' : '' }}">
                <div class="col-xs-offset-7 col-xs-3 text-center">
                    <label for="has_a_child" class="col-xs-10 control-label text-right text-white">Has a child</label>
                    <input type="checkbox" class="form-control pull-right" id="has_a_child" name="has_a_child" {{old('has_a_child') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('has_a_child'))
                        <span class="help-block">
                            <strong>{{ $errors->first('has_a_child') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_maps','has_a_child'))
                    <div class="" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
