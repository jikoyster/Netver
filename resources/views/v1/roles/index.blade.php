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
            <h3><strong>Roles</strong></h3>
        </div>
    </div>
    @can('add')
        <button type="submit" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right">
            <strong>Add New</strong>
        </button>
    @endcan
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="name">Name</th>
                    <!-- <th data-column-id="permissions">Permissions</th> -->
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($roles as $role) : ?>
                    <tr>
                        <td><?=$role->id?></td>
                        <td><?=ucwords($role->name)?></td>
                        <!-- <td>
                            @foreach($role->permissions as $key => $val)
                                {{($key != 0 ? ' / ' : '')}}
                                {{$val->name}}
                            @endforeach
                        </td> -->
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
            @include('v1.roles.add')
          </div>
        </div>
      </div>
    </div>
@endcan


<?php foreach($roles as $role) : ?>
    <div class="modal fade bs-example-modal-sm<?=$role->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete Role
            <strong><?=$role->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('role.delete',[$role->id])?>" class="btn btn-danger">Delete</a>
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
                'commands': function(column, row)
                {
                    editVar = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"roles/edit/" + row.id + "\" data-toggle=\"tooltip\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    deleteVar ="<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\" data-toggle=\"tooltip\" title=\"Delete\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    permissionVar = "<a class=\"btn btn-xs btn-success command-edit\" href=\"roles/permissions/" + row.id + "\" data-toggle=\"tooltip\" title=\"Role Permissions\">Role Permissions</a> ";
                    return editVar/*+permissionVar*/+deleteVar;
                }
            }
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
@stop