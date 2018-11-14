@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('map-group-list.edit',[Request::segment(3),Request::segment(5)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Map Group List</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('group_name') ? ' has-error' : '' }}">
                <label for="group_name" class="col-xs-4 control-label text-right text-white">Group Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="group_name" name="group_name" style="margin: 0 auto; float: unset;" value="{{old('group_name',$map_group->name)}}" readonly>

                    @if ($errors->has('group_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group_name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','name'))
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
                            <option value="{{$country->id}}" {{old('country_id',$map_group->country_id) == $country->id ? 'selected':''}}>{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('country_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','country_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('map_no') ? ' has-error' : '' }}">
                <label for="map_no" class="col-xs-4 control-label text-right text-white">Map No</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="map_no" name="map_no">
                        <option value="">- select -</option>
                        @foreach($maps as $map)
                            <option value="{{$map->id}}" {{old('map_no',$map_group_list->map_no) == $map->id ? 'selected':''}}>
                                <?php
                                    if($map->parent_map)
                                        echo $map->parent_map->map_no.'.';
                                    echo $map->map_no.' - '.$map->name;
                                ?>
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('map_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('map_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','map_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$map_group_list->name)}}" readonly>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('nca') ? ' has-error' : '' }}">
                <label for="nca" class="col-xs-4 control-label text-right text-white">NCA<?=($map_group->nca) ? ': '.$map_group->nca->short_name : ''?></label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="nca" name="nca">
                        <option value="">- select -</option>
                        @if($map_group->nca)
                            @foreach($map_group->nca->lists as $list)
                                <option value="{{$list->id}}" {{old('nca',$map_group_list->nca) == $list->id ? 'selected':''}}>{{$list->code.' - '.$list->name}}</option>
                            @endforeach
                        @endif
                    </select>

                    @if ($errors->has('nca'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nca') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','nca'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-xs-4 control-label text-right text-white">Title</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="title" name="title">
                        <option value="">- select -</option>
                        <option value="1" {{old('title',$map_group_list->title) == 1 ? 'selected':''}}>Yes</option>
                        <option value="0" {{old('title',$map_group_list->title) == 0 ? 'selected':''}}>No</option>
                    </select>

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','title'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('unassignable') ? ' has-error' : '' }}">
                <label for="unassignable" class="col-xs-4 control-label text-right text-white">Unassignable</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="unassignable" name="unassignable">
                        <option value="">- select -</option>
                        <option value="1" {{old('unassignable',$map_group_list->unassignable) == 1 ? 'selected':''}}>Yes</option>
                        <option value="0" {{old('unassignable',$map_group_list->unassignable) == 0 ? 'selected':''}}>No</option>
                    </select>

                    @if ($errors->has('unassignable'))
                        <span class="help-block">
                            <strong>{{ $errors->first('unassignable') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','unassignable'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('flip_type') ? ' has-error' : '' }}">
                <label for="flip_type" class="col-xs-4 control-label text-right text-white">Flip Type</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="flip_type" name="flip_type">
                        <option value="">- select -</option>
                        <option value="Individual" {{(old('flip_type',$map_group_list->flip_type) == 'Individual') ? 'selected':''}}>Individual</option>
                        <option value="Total is Debit" {{(old('flip_type',$map_group_list->flip_type) == 'Total is Debit') ? 'selected':''}}>Total is Debit</option>
                        <option value="Total is Credit" {{(old('flip_type',$map_group_list->flip_type) == 'Total is Credit') ? 'selected':''}}>Total is Credit</option>
                    </select>

                    @if ($errors->has('flip_type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('flip_type') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','flip_type'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('flip_to') ? ' has-error' : '' }}">
                <label for="flip_to" class="col-xs-4 control-label text-right text-white">Flip To</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="flip_to" name="flip_to">
                        <option value="">- select -</option>
                        @foreach($flip_tos as $map)
                            <option value="{{$map->id}}" {{(old('flip_to',$map_group_list->flip_to) == $map->id) ? 'selected':''}}>
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
                @if($title = auth()->user()->table_column_description('map_group_lists','flip_to'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="type" class="col-xs-4 control-label text-right text-white">Type</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="type" name="type">
                        <option value="">- select -</option>
                        @foreach($account_types as $type)
                            <option value="{{$type->id}}" {{old('type',$map_group_list->type) == $type->id ? 'selected':''}}>{{$type->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','type'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('sign') ? ' has-error' : '' }}">
                <label for="sign" class="col-xs-4 control-label text-right text-white">Normal Sign</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="sign" name="sign">
                        <option value="">- select -</option>
                        @foreach($signs as $sign)
                            <option value="{{$sign->id}}" {{old('sign',$map_group_list->sign) == $sign->id ? 'selected':''}}>{{$sign->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('sign'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sign') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','sign'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                <label for="group" class="col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="group" name="group">
                        <option value="">- select -</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{old('group',$map_group_list->group) == $group->id ? 'selected':''}}>{{$group->code.' - '.$group->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('group'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','group'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                <label for="class" class="col-xs-4 control-label text-right text-white">Class</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="class" name="class">
                        <option value="">- select -</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" {{old('class',$map_group_list->class) == $class->id ? 'selected':''}}>{{$class->code.' - '.$class->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('class'))
                        <span class="help-block">
                            <strong>{{ $errors->first('class') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_group_lists','class'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('map-group-lists',[Request::segment(3)])}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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