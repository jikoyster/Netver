@extends('layouts.app')

@section('content')
<div class="col-md-12" style="margin-bottom: 15px;">
    @if (session('status'))
        <div class="alert spacer text-center">
            <h4><strong class="text-white">
                @if(is_array(session('status')))
                    @foreach(session('status') as $message)
                        <p>{{$message}}</p>
                    @endforeach
                @else
                    {{ session('status') }}
                @endif
            </strong></h4>
        </div>
    @endif
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
            <h3><strong>Clients</strong></h3>
        </div>
    </div>
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="system_user_id">Account No.</th>
                    <th data-column-id="first_name">{{$users->name}} Name</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="activated">Active</th>
                    <th data-column-id="activated_date" data-formatter="activated_dates">Activated Date</th>
                    <th data-column-id="deactivated">Deactivated</th>
                    <th data-column-id="deactivated_date" data-formatter="deactivated_dates">Deactivated Date</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users->users as $user) : ?>
                    @if($user->hasRole('admin'))
                    <tr>
                        <td><?=$user->id?></td>
                        <td><?=$user->system_user_id?></td>
                        <td><?=$user->first_name.' '.$user->last_name?></td>
                        <td><?=$user->email?></td>
                        <td><?=($user->user_status_histories->count()) ? $user->user_status_histories->last()->activated ? 'Yes':'No':'No'?></td>
                        <td>
                            <?php
                                if($user->user_status_histories->count())
                                    echo $user->user_status_histories->last()->activated ? $user->user_status_histories->last()->created_at->format('M d, Y'):'';
                                else
                                    echo '';
                            ?>
                        </td>
                        <td><?=$deac = ($user->user_status_histories->count()) ? $user->user_status_histories->last()->activated ? 'No':'Yes':'Yes'?></td>
                        <td>
                            <?php
                                if($deac == 'Yes' && $user->user_status_histories->count())
                                    echo $user->user_status_histories->last()->activated ? '':$user->user_status_histories->last()->created_at->format('M d, Y');
                                else
                                    echo '';
                            ?>
                        </td>
                        <td>loading...</td>
                    </tr>
                    @endif
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade bs-add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        
      </div>
    </div>
  </div>
</div>


<?php foreach($users->users as $user) : ?>
    @if($user->hasRole('admin'))
    <div class="modal fade bs-example-modal-sm<?=$user->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete User
            <strong><?=$user->first_name?></strong>
            <p><strong>Note: </strong>This will also delete related data:</p>
            <ul class="deleteul">
                <li>Address</li>
                <li>Company</li>
                <li>Role</li>
                <li>Group</li>
                <li>ACL: Access Control Level</li>
                <li>Errors and Bugs Report</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('user.delete',[$user->id,'client'])?>" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
    @endif
<?php endforeach; ?>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.dropdown-toggle').dropdown();
        
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 25,
            formatters: {
                'activated_dates': function(col,row)
                {
                    return "<a href=\"/users/activity/"+row.id+"\">"+row.activated_date+"</a>";
                },
                'deactivated_dates': function(col,row)
                {
                    return "<a href=\"/users/activity/"+row.id+"\">"+row.deactivated_date+"</a>";
                },
                'commands': function(column, row)
                {
                    varActivate = '';
                    varDeactivate = '';
                    if(row.activated == 'No') {
                        varActivate = "<a class=\"btn btn-xs btn-success\" href=\"/users/user-activate/"+row.id+"/client\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Activate\"><span class=\"glyphicon glyphicon-ok\"></span></a> ";
                    } else {
                        varDeactivate = "<a class=\"btn btn-xs btn-danger\" href=\"/users/user-deactivate/"+row.id+"/client\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Deactivate\"><span class=\"glyphicon glyphicon-remove\"></span></a> ";
                    }
                    varEdit = '';
                    varDelete = '';
                    @if(auth()->user()->can('edit') && auth()->user()->hasRole('super admin'))
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"></span></button>";
                    @endif
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/users/edit-role/" + row.id + "/client\"><span class=\"glyphicon glyphicon-edit\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"></span></a> ";
                    @endcan
                    return varActivate+varDeactivate+varEdit+varDelete;
                }
            }
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        setTimeout(function(){
            $('[data-toggle="tooltip"]').tooltip();
        },500);
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    ul.deleteul {
        width: 50%;
        margin: 0 auto;
    }
    ul.deleteul li {
        text-align: left;
    }
    th:nth-child(2),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(9) {
        width: 7%;
    }
</style>
@stop