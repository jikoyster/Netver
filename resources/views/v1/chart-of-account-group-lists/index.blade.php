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
            <h3><strong>Chart of Account Groups</strong></h3>
            <br>
            <h4><strong><?=$chart_of_account_group->name?></strong></h4>
        </div>
    </div>
    <button type="button" class="btn pull-left yellow-gradient" onclick="window.location='<?=route('chart-of-account-groups')?>'">
        <strong>Back</strong>
    </button>
    @can('add')
        <button type="button" class="btn pull-right" onclick="window.location='<?=route('chart-of-account-group-list.add',[Request::segment(3)])?>'">
            <strong>Add New</strong>
        </button>
    @endcan
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="account_no">Account No</th>
                    <th data-column-id="name">Name</th>
                    <th data-column-id="account_type_id">Type</th>
                    <th data-column-id="normal_sign">Normal Sign</th>
                    <th data-column-id="account_map_no_id">Map No</th>
                    <th data-column-id="account_group_id">Group</th>
                    <th data-column-id="account_class_id">Class</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($chart_of_account_group_lists as $list) : ?>
                    <tr>
                        <td><?=$list->id?></td>
                        <td><?=$list->account_no?></td>
                        <td><?=$list->name?></td>
                        <td><?=$list->account_type->name?></td>
                        <td><?=($list->sign) ? $list->sign->name:''?></td>
                        <td>
                            <?php
                                if($list->account_map) {
                                    if($list->account_map) {
                                        if($list->account_map->parent_map)
                                            echo $list->account_map->parent_map->map_no.'.';
                                        echo $list->account_map->map_no;
                                    } else {
                                        echo $list->account_map->map_no;
                                    }
                                }
                            ?>
                        </td>
                        <td><?=($list->account_group_id) ? $list->account_group->code.' - '.$list->account_group->name : ''?></td>
                        <td><?=($list->account_class_id) ? $list->account_class->code.' - '.$list->account_class->name : ''?></td>
                        <td>
                            loading...
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php foreach($chart_of_account_group_lists as $list) : ?>
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
            <a href="<?=route('chart-of-account-group-list.delete',[Request::segment(3),$list->id])?>" class="btn btn-danger">Delete</a>
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
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: <?=($chart_of_account_group->nca) ? $chart_of_account_group->nca->short_name:''?>' data-content='"+row.nca+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: <?=($chart_of_account_group->nca) ? $chart_of_account_group->nca->short_name:''?>' data-content='&nbsp;'></span>";
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
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/chart-of-account-groups/list/<?=Request::segment(3)?>/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
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
    th:nth-child(2),th:nth-child(6),th:nth-child(10) {
        width: 7%;
    }
    th:nth-child(7),th:nth-child(8) {
        width: 15%;
    }
    th:nth-child(4),th:nth-child(5) {
        width: 10%;
    }
    th:nth-child(9) {
        width: 5%;
    }
</style>
@stop