@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('chart-of-account-group-list.edit',[Request::segment(3),Request::segment(5)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Chart of Account Group List</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('group_name') ? ' has-error' : '' }}">
                <label for="group_name" class="col-xs-4 control-label text-right text-white">Group Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="group_name" name="group_name" style="margin: 0 auto; float: unset;" value="{{old('group_name',$chart_of_account_group->name)}}" readonly>

                    @if ($errors->has('group_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                <label for="country_id" class="col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="country_id" name="country_id" disabled>
                        <option value="">-select-</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{old('country_id',$chart_of_account_group->country_id) == $country->id ? 'selected':''}}>{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('country_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','country_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('map_group_id') ? ' has-error' : '' }}">
                <label for="map_group_id" class="col-xs-4 control-label text-right text-white">Map Group</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="map_group_id" name="map_group_id" disabled>
                        <option value="">-select-</option>
                        @foreach($map_groups as $group)
                            <option value="{{$group->id}}" {{old('map_group_id',$chart_of_account_group->map_group_id) == $group->id ? 'selected':''}}>{{$group->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('map_group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('map_group_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','map_group_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-xs-4 control-label text-right text-white">Account No</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="account_no" name="account_no" style="margin: 0 auto; float: unset;" value="{{old('account_no',$chart_of_account_group_list->account_no)}}" readonly>

                    @if ($errors->has('account_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','account_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$chart_of_account_group_list->name)}}" readonly>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_type_id') ? ' has-error' : '' }}">
                <label for="account_type_id" class="col-xs-4 control-label text-right text-white">Type</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="account_type_id" name="account_type_id">
                        <option value="">- select -</option>
                        @foreach($account_types as $type)
                            <option value="{{$type->id}}" {{old('account_type_id',$chart_of_account_group_list->account_type_id) == $type->id ? 'selected':''}}>{{$type->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_type_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('normal_sign') ? ' has-error' : '' }}">
                <label for="normal_sign" class="col-xs-4 control-label text-right text-white">Normal Sign</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="normal_sign" name="normal_sign">
                        <option value="">- select -</option>
                        @foreach($signs as $sign)
                            <option value="{{$sign->id}}" {{old('normal_sign',$chart_of_account_group_list->normal_sign) == $sign->id ? 'selected':''}}>{{$sign->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('normal_sign'))
                        <span class="help-block">
                            <strong>{{ $errors->first('normal_sign') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_map_no_id') ? ' has-error' : '' }}">
                <label for="account_map_no_id" class="col-xs-4 control-label text-right text-white">Map No</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="account_map_no_id" name="account_map_no_id">
                        <option value="">- select -</option>
                        @foreach($maps as $map)
                            <option value="{{$map->id}}" {{old('account_map_no_id',$chart_of_account_group_list->account_map_no_id) == $map->id ? 'selected':''}}>
                                <?php
                                    if($map->parent_map)
                                        echo $map->parent_map->map_no.'.';
                                    echo $map->map_no.' - '.$map->name;
                                ?>
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_map_no_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_map_no_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_group_id') ? ' has-error' : '' }}">
                <label for="account_group_id" class="col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="account_group_id" name="account_group_id">
                        <option value="">- select -</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{old('account_group_id',$chart_of_account_group_list->account_group_id) == $group->id ? 'selected':''}}>{{$group->code.' - '.$group->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_group_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_class_id') ? ' has-error' : '' }}">
                <label for="account_class_id" class="col-xs-4 control-label text-right text-white">Class</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="account_class_id" name="account_class_id">
                        <option value="">- select -</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" {{old('account_class_id',$chart_of_account_group_list->account_class_id) == $class->id ? 'selected':''}}>{{$class->code.' - '.$class->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('account_class_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_class_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('chart-of-account-group-lists',[Request::segment(3)])}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('[name=nca]').select2();
    });
</script>
@stop
@section('css')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    #select2-nca-container { text-align: left; }
</style>
@stop