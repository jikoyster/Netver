@extends('layouts.app')

@section('content')
<div class="col-md-12" style="margin-bottom: 15px;">
    @if (session('status'))
        <div class="alert spacer text-center">
            <h4><strong class="text-white">{{ session('status') }}</strong></h4>
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
            <h3><strong>Menu Elements</strong></h3>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="name" class="col-md-12 control-label text-left text-white" style="padding: 0;">Menu Name: <?=$menu_set->name?></label>
    </div>
    @can('add')
        <button type="submit" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right" style="margin-left: 5px;">
            <strong>Add New</strong>
        </button>
    @endcan
    <button type="button" onclick="window.location='{{route('menus')}}'" class="btn yellow-gradient pull-right">
        <strong>Back</strong>
    </button>
    <div class="col-md-12 menus-table-container" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="parent_id">Parent ID</th>
                    <th data-column-id="name">Name</th>
                    <th data-column-id="parent">Parent</th>
                    <th data-column-id="link">Link</th>
                    <th data-column-id="roles">Roles</th>
                    <th data-column-id="company_related" data-formatter="company_relateds">Company Related</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $parent_ids = 'nielito';
                    function spacer_($id, $parent_id){
                        global $parent_ids;
                        
                        if($parent_id) {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            $parent_ids[$id] = $parent_id;
                            spacer_($parent_id,$parent_ids[$parent_id]);
                        } else {
                            $parent_ids[$id] = 0;
                        }
                    }
                ?>
                <?php foreach($menus as $menu) : ?>
                    <tr>
                        <td><?=$menu->id?></td>
                        <td><?=Request::segment(3)?></td>
                        <td>
                            <?php
                                spacer_($menu->id,$menu->parent_id);
                            ?>
                            <?=$menu->name?>
                        </td>
                        <td><?=$menu->parent_menu ? $menu->parent_menu->name:''?></td>
                        <td><?=$menu->link?></td>
                        <td>
                            <?php
                                $menu_roles = $menu->roles()->get();
                                $ctr = $menu->roles()->count();
                                for($a = 0; $a < $ctr; ++$a) :
                            ?>
                                @if($a > 0)
                                    <span> / </span>
                                @endif
                                <span><?=ucwords($menu_roles[$a]->name)?></span>
                            <?php endfor; ?>
                        </td>
                        <td><?=$menu->company_related?></td>
                        <td>loading...</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

@can('add')
    <div class="modal fade bs-add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            @include('v1.menus.032618.add-menu-element')
          </div>
        </div>
      </div>
    </div>
@endcan


<?php foreach($menus as $menu) : ?>
    <div class="modal fade bs-example-modal-sm<?=$menu->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete Menu
            <strong><?=$menu->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('menu.delete-element',[$menu->id,Request::segment(3)])?>" class="btn btn-danger">Delete</a>
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
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 50,
            formatters: {
                'company_relateds': function(col,row)
                {
                    if(row.company_related == 1)
                        return "<strong>Yes</strong>";
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/menus/edit-element/"+ row.parent_id +"/" + row.id + "\" data-toggle=\"tooltip\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\" data-toggle=\"tooltip\" title=\"Delete\" data-placement=\"right\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return varEdit+"<a class=\"btn btn-xs btn-success command-edit\" href=\"/menus/roles/"+ row.parent_id +"/" + row.id + "\" data-toggle=\"tooltip\" title=\"Menu Roles\">Menu Roles</a> "+varDelete;
                }
            }
        });
        
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
<style type="text/css">
    #grid-basic > thead > tr > th:nth-child(2),
    #grid-basic > tbody tr > td:nth-child(2) {
        width: 0px;
        visibility: hidden;
    }
    .modal-dialog.modal-lg {
        width: 1028px;
    }
    .control-label {
        font-size: 13px;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #fff;
    }
    .container-check {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }.container-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* On mouse-over, add a grey background color */
    .container-check:hover input ~ .checkmark {
        background-color: #fff;
    }

    /* When the checkbox is checked, add a blue background */
    .container-check input:checked ~ .checkmark {
        background-color: #fff;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container-check input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container-check .checkmark:after {
        left: 7px;
        top: 2px;
        width: 10px;
        height: 17px;
        border: solid #000;
        border-width: 0 5px 5px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
@stop