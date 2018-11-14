@extends('layouts.app')

@section('content')
<div class="col-md-12" style="margin-bottom: 15px;">
    @if (session('status'))
        <div class="alert spacer text-center">
            @if(is_array(session('status')))
                @foreach(session('status') as $status)
                    <h4><strong class="text-white">{{ $status }}</strong></h4>
                @endforeach
            @else
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            @endif
        </div>
    @endif
    @if ($errors->any())
        <div class="alert spacer text-center">
            @foreach ($errors->all() as $error)
                <h4><strong class="text-red">{{ $error }}</strong></h4>
            @endforeach
        </div>
    @endif
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
            <h3><strong>Map Groups</strong></h3>
            <br>
            <h4><strong><?=$map_group->name?></strong></h4>
        </div>
    </div>
    <button type="button" class="btn pull-left yellow-gradient" onclick="window.location='<?=route('map-groups')?>'">
        <strong>Back</strong>
    </button>
    @can('add')
        <button type="button" class="btn pull-right" onclick="window.location='<?=route('map-group-list.add',[Request::segment(3)])?>'">
            <strong>Add New</strong>
        </button>
    @endcan
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="map_no">Map No</th>
                    <th data-column-id="name">Name</th>
                    <th data-column-id="nca" data-formatter="ncas">NCA<?=($map_group->nca) ? ': '.$map_group->nca->short_name:''?></th>
                    <th data-column-id="title">Title</th>
                    <th data-column-id="unassignable">Unassignable</th>
                    <th data-column-id="flip_type">Flip Type</th>
                    <th data-column-id="flip_to">Flip To</th>
                    <th data-column-id="type">Type</th>
                    <th data-column-id="sign">Normal Sign</th>
                    <th data-column-id="group">Group</th>
                    <th data-column-id="class">Class</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function parent_code($rec)
                {
                    if($rec->parent_map) {
                        parent_code($rec->parent_map);
                        echo $rec->parent_map->map_no.'.';
                    }
                }
                ?>
                <?php foreach($map_group_lists as $list) : ?>
                    <tr>
                        <td><?=$list->id?></td>
                        <td><?=$list->parent_map ? $list->parent_map->map_no.'.'.$list->map_no:$list->account_map->map_no?></td>
                        <td><?=$list->name?></td>
                        <td><?=($list->national_chart_of_account_list) ? $list->national_chart_of_account_list->code.' - '.$list->national_chart_of_account_list->name:''?></td>
                        <td><?=$list->title ? 'Yes':'No'?></td>
                        <td><?=$list->unassignable ? 'Yes':'No'?></td>
                        <td><?=$list->flip_type?></td>
                        <td>
                            <?php
                                if($list->flip_to_map) {
                                    parent_code($list->flip_to_map);
                                    echo $list->flip_to_map->map_no;
                                }
                            ?>
                        </td>
                        <td><?=$list->account_type->name?></td>
                        <td><?=($list->normal_sign) ? $list->normal_sign->name:''?></td>
                        <td><?=($list->account_group) ? $list->account_group->code.' - '.$list->account_group->name : ''?></td>
                        <td><?=($list->account_class) ? $list->account_class->code.' - '.$list->account_class->name : ''?></td>
                        <td>
                            loading...
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php foreach($map_group_lists as $list) : ?>
    <div class="modal fade bs-example-modal-sm<?=$list->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete
            <strong><?=$list->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('map-group-list.delete',[Request::segment(3),$list->id])?>" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.dropdown-toggle').dropdown();
        $('[data-toggle="tooltip"]').tooltip();
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 25,
            formatters: {
                'ncas': function(col,row)
                {
                    /*if(row.nca)
                        return row.nca;
                    else
                        return '';*/
                    if(row.nca)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: <?=($map_group->nca) ? $map_group->nca->short_name:''?>' data-content='"+row.nca+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: <?=($map_group->nca) ? $map_group->nca->short_name:''?>' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'account_group_ids': function(col,row)
                {
                    if(row.account_group_id)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Group' data-content='"+row.account_group_id+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Group' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/map-groups/list/<?=Request::segment(3)?>/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return varEdit+varDelete;
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function(e, rows)
        {
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
            },500);
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    th:nth-child(2),th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(8),th:nth-child(9),th:nth-child(10) {
        width: 7%;
    }
    th:nth-child(13) {
        width: 5%;
    }
</style>
@stop