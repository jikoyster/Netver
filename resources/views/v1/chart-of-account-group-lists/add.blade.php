@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('chart-of-account-group-list.save',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Chart of Account Group List</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-5 control-label text-right text-white">Group Name</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$chart_of_account_group->name)}}" readonly>

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

            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                <label for="country_id" class="col-xs-5 control-label text-right text-white">Country</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
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
                <label for="map_group_id" class="col-xs-5 control-label text-right text-white">Map Group</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
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

            <div class="form-group{{ $errors->has('group_source') ? ' has-error' : '' }}">
                <label for="group_source" class="col-xs-5 control-label text-right text-white">Group Source</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="group_source" name="group_source">
                        <option value="">-select-</option>
                        <option value="global_chart_of_accounts">Global Chart of Account</option>
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
                            <th data-column-id="account_no">Account No</th>
                            <th data-column-id="name">Name</th>
                            <th data-column-id="account_type_id" data-formatter="account_type_ids">Type</th>
                            <th data-column-id="sign_id" data-formatter="sign_ids">Normal Sign</th>
                            <th data-column-id="account_map_no" data-formatter="map_nos">Map No</th>
                            <th data-column-id="account_group_id" data-formatter="account_group_ids">Group</th>
                            <th data-column-id="account_class_id" data-formatter="account_class_ids">Class</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto;">
                    <button type="button" onclick="window.location='{{route('chart-of-account-group-lists',[Request::segment(3)])}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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
            url: "<?=route('chart-of-account-group-list.group-source',[Request::segment(3)])?>",
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                'account_type_ids': function(col,row) {
                    if(row.account_type)
                        return row.account_type.name;
                },
                'sign_ids': function(col, row) {
                    if(row.normal_sign)
                        return row.normal_sign.name;
                },
                'ncas': function(col,row) {
                    /*if(row.national_chart_of_account_list)
                        return row.national_chart_of_account_list.code+' - '+row.national_chart_of_account_list.name;
                    else
                        return '';*/
                    if(row.national_chart_of_account_list)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: "+row.national_chart_of_account_list.nca.short_name+"' data-content='"+row.national_chart_of_account_list.code+' - '+row.national_chart_of_account_list.name+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'map_nos': function(col, row) {
                    if(row.account_map) {
                        if(row.account_map.parent_map)
                            return row.account_map.parent_map.map_no+'.'+row.account_map.map_no;
                        return row.account_map.map_no;
                    }
                },
                'account_class_ids': function(col, row) {
                    if(row.account_class)
                        return row.account_class.code+'-'+row.account_class.name;
                },
                'account_group_ids': function(col, row) {
                    if(row.account_group)
                        return row.account_group.code+'-'+row.account_class.name;
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function(e, rows)
        {
            $('[name=select]').attr('name','gcoa_ids[]');
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