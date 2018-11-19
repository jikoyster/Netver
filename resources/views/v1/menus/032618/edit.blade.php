@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('menu.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Menu</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$menu->name)}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('menu_sets','name'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>

            <div class="group_id-container form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                <label for="group_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="group_id" name="group_id">
                        <option value="">System Admin</option>
                        <?php foreach($groups as $group) : ?>
                            @if($menu->groups()->where('id',$group->id)->count())
                                <option {{old('group_id',$menu->groups()->where('id',$group->id)->first()->id) == $group->id ? 'selected':''}} value="<?=$group->id?>"><?=$group->name?></option>
                            @else
                                <option value="<?=$group->id?>" {{old('group_id') == $group->id ? 'selected':''}}><?=$group->name?></option>
                            @endif
                        <?php endforeach; ?>
                    </select>

                    @if ($errors->has('group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('groups','name'))
                <div class="col-xs-1" style="padding: 0;">
                    <span class="glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                </div>
                @endif
            </div>
            
            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Update</strong>
                    </button>
                    <button type="button" onclick="window.location='{{route('menus')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
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