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
            <h3><strong>Company Account Maps</strong></h3>
        </div>
    </div>
    @if(session('selected-company'))
        <div class="form-group col-md-2">
            <label for="name" class="col-md-12 control-label text-left text-white" style="padding: 0;">Company: <a href="{{route('companies')}}" style="color:#fff;"><?=$company->legal_name?></a><a href="{{route('clear-company',[$company->id])}}" style="color: #bf5329; margin-left: 7px;"><span class="glyphicon glyphicon-remove"></span></a></label>
        </div>
    @endif
    @can('add')
        <button type="button" class="btn pull-right" onclick="window.location='<?=route('company-account-map.add')?>'">
            <strong>Import</strong>
        </button><button type="button" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right" style="margin-right: 7px;">
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
                    <th data-column-id="nca" data-formatter="ncas-xxx">NCA</th>
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
                <?php foreach($company_account_maps as $account_map) : ?>
                    <tr>
                        <td><?=$account_map->id?></td>
                        <td>
                            <?php
                                if($account_map->map_group_id) {
                                    echo $account_map->parent_map ? $account_map->account_map->parent_map->map_no.'.'.$account_map->account_map->map_no:$account_map->account_map->map_no;
                                } else {
                                    echo $account_map->map_no;
                                }
                            ?>        
                        </td>
                        <td><?=$account_map->name?></td>
                        <td><?=($account_map->national_chart_of_account_list) ? $account_map->national_chart_of_account_list->code/*.' - '.$account_map->national_chart_of_account_list->name*/:''?></td>
                        <td><?=$account_map->title ? 'Yes':'No'?></td>
                        <td><?=$account_map->unassignable ? 'Yes':'No'?></td>
                        <td><?=$account_map->flip_type?></td>
                        <td>
                            <?php
                                if($account_map->flip_to_map) {
                                    parent_code($account_map->flip_to_map);
                                    echo $account_map->flip_to_map->map_no;
                                }
                            ?>
                        </td>
                        <td><?=$account_map->account_type->name?></td>
                        <td><?=($account_map->normal_sign) ? $account_map->normal_sign->name:''?></td>
                        <td><?=($account_map->account_group) ? $account_map->account_group->code.' - '.$account_map->account_group->name : ''?></td>
                        <td><?=($account_map->account_class) ? $account_map->account_class->code.' - '.$account_map->account_class->name : ''?></td>
                        <td>
                            loading...
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade bs-add-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        @include('v1.company-account-maps.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($company_account_maps as $account_map) : ?>
    <div class="modal fade bs-example-modal-sm<?=$account_map->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete
            <strong><?=$account_map->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('company-account-map.delete',[$account_map->id])?>" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
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
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: ' data-content='"+row.nca+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='NCA: ' data-content='&nbsp;'></span>";
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
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/company-account-maps/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
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

        $('[name=flip_type]').change(function(){
            if($(this).val() == '') 
                $('[name=flip_to]').attr('disabled',true).val('');
            else
                $('[name=flip_to]').attr('disabled',false);
        });
        $('[name=flip_type]').change();
        $('#nca').select2();
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    th:nth-child(2),th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(8),th:nth-child(9),th:nth-child(10) {
        width: 7%;
    }
    th:nth-child(13) {
        width: 5%;
    }
    #select2-nca-container { text-align: left; }
    .select2-container { width: 100% !important; }
</style>
@stop