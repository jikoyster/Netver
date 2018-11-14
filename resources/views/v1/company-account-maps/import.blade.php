@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-account-map.import') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Import Account Maps</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('group_source') ? ' has-error' : '' }}">
                <label for="group_source" class="col-xs-5 control-label text-right text-white">Map Group</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="group_source" name="group_source">
                        <option value="">-select-</option>
                        @foreach($group_sources as $source)
                            <option value="{{$source->id}}">{{$source->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('group_source'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group_source') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('account_classes','group_source'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="col-md-12" style="background-color: #fff; margin-bottom: 15px;">
                <table id="grid-keep-selection" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                            <th data-column-id="map_no" data-formatter="map_nos">Map No</th>
                            <th data-column-id="name">Name</th>
                            <th data-column-id="nca" data-formatter="ncas">NCA</th>
                            <th data-column-id="title" data-formatter="titles">Title</th>
                            <th data-column-id="unassignable" data-formatter="unassignables">Unassignable</th>
                            <th data-column-id="flip_type" data-formatter="flip_types">Flip Type</th>
                            <th data-column-id="flip_to" data-formatter="flip_tos">Flip To</th>
                            <th data-column-id="type" data-formatter="types">Type</th>
                            <th data-column-id="group" data-formatter="groups">Group</th>
                            <th data-column-id="sign" data-formatter="signs">Sign</th>
                            <th data-column-id="class" data-formatter="classes">Class</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto;">
                    <button type="button" onclick="window.location='{{route('company-account-maps')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $("#grid-keep-selection").bootgrid({
            ajax: true,
            caseSensitive: false,
            rowCount: 10,
            post: ()=>
            {
                /* To accumulate custom parameter with the request object */
                return {
                    coag_id: '<?=Request::segment(3)?>',
                    group_source_id: $('[name=group_source]').val(),
                    _token:$('[name=_token').val()
                };
            },
            url: "<?=route('company-account-map.group-source')?>",
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                'map_nos': function(col, row) {
                    if(row.parent_map) {
                        if(row.parent_map.parent_map)
                            return row.parent_map.parent_map.map_no+'.'+row.parent_map.map_no;
                        return row.parent_map.map_no+'.'+row.map_no;
                    } else {
                        if(row.account_map)
                            return row.account_map.map_no;
                        else
                            return row.map_no;
                    }
                },
                'ncas': function(col,row) {
                    if(row.national_chart_of_account_list)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: "+row.national_chart_of_account_list.nca.short_name+"' data-content='"+row.national_chart_of_account_list.code+' - '+row.national_chart_of_account_list.name+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'titles': function(col,row) {
                    if(row.title)
                        return 'Yes';
                    else
                        return 'No';
                },
                'unassignables': function(col,row) {
                    if(row.unassignable)
                        return 'Yes';
                    else
                        return 'No';
                },
                'flip_types': function(col,row) {
                    return row.flip_type;
                },
                'flip_tos': function(col,row) {
                    if(row.flip_to_map) {
                        if(row.flip_to_map.parent_map)
                            return row.flip_to_map.parent_map.map_no+'.'+row.flip_to_map.map_no;
                        return row.flip_to_map.map_no;
                    }
                    return row.flip_to;
                },
                'types': function(col,row) {
                    if(row.account_type)
                        return row.account_type.name;
                },
                'signs': function(col, row) {
                    if(row.normal_sign)
                        return row.normal_sign.name;
                },
                'groups': function(col, row) {
                    if(row.account_group)
                        return row.account_group.code+'-'+row.account_group.name;
                },
                'classes': function(col, row) {
                    if(row.account_class)
                        return row.account_class.code+'-'+row.account_class.name;
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function(e, rows)
        {
            $('[name=select]').attr('name','account_map_ids[]');
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
            },500);
        }).on("selected.rs.jquery.bootgrid", function(e, rows)
        {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++)
            {
                rowIds.push(rows[i].id);
            }
        }).on("deselected.rs.jquery.bootgrid", function(e, rows)
        {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++)
            {
                rowIds.push(rows[i].id);
            }
        });

        $('[name=group_source]').change(function(){
            $("#grid-keep-selection").bootgrid('reload');
        });
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    th:nth-child(2),td:nth-child(2) {
        visibility: hidden;
        width: 0;
    }
    .container {
        width: 90%;
    }
</style>
@stop