@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('map-group.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Map Group</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Group Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$map_group->name)}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_groups','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                <label for="country_id" class="col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="country_id" name="country_id" {{$map_group->lists->count() ? 'disabled':''}}>
                        <option value="">-select-</option>
                        @foreach($countries as $country)
                            <option {{$country->id == $map_group->country_id ? 'selected':''}} value="{{$country->id}}">{{$country->country_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('country_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('map_groups','country_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('nca_id') ? ' has-error' : '' }}">
                <label for="nca_id" class="col-xs-4 control-label text-right text-white">NCA</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="nca_id" name="nca_id" {{$nca_linked ? 'disabled':''}}>
                        <option value="">-select-</option>
                        @foreach($ncas as $nca)
                            <option {{old('nca_id',$map_group->nca_id) == $nca->id ? 'selected':''}} value="{{$nca->id}}">{{$nca->short_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('nca_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nca_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_classes','nca_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('map-groups')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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
        $('[data-toggle="tooltip"]').tooltip();
        $('#country_id').change(function(){
            if($(this).val()) {
                getNCA($(this).val())
            } else {
                $('#nca_id').html('<option>select</option>');
            }
        });
        let getNCA = function(val) {
            $.get( "<?=route('country.nca',[''])?>/"+val, function( data ) {
                let option = "<option value=''>- select -</option>";
                for(var a = 0; a < data.length; a++) {
                    if('<?=old('nca_id',$map_group->nca_id)?>' == data[a]['id'])
                        option += "<option value='"+data[a]['id']+"' selected>"+data[a]['short_name']+"</option>";
                    else
                        option += "<option value='"+data[a]['id']+"'>"+data[a]['short_name']+"</option>";
                }
                $('#nca_id').html(option);
            });
        }
        getNCA($('#country_id').val());
    });
</script>
@stop