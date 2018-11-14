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
            <h3><strong>{{$company->trade_name}} Users</strong></h3>
        </div>
    </div>
    <button type="button" onclick="window.location='{{route('companies')}}'" class="btn yellow-gradient pull-left">
        <strong>Back</strong>
    </button>
    @can('add')
        <button type="button" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right">
            <strong>Add New</strong>
        </button>
    @endcan
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="name">Name</th>
                    <th data-column-id="role">Role</th>
                    <th data-column-id="inactive">Inactive</th>
                    <th data-column-id="updated_at">Updated Date</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($company->users as $user) : ?>
                    <tr>
                        <td><?=$user->id?></td>
                        <td><?=$user->first_name.' '.$user->last_name?></td>
                        <td>
                            <?=$user->roles->first()->name?>
                            {{$company->owner->user_id == $user->id ? '(owner)':''}}
                            {{auth()->user()->id == $user->id ? '(you)':''}}
                        </td>
                        <td><?=$user->pivot->inactive ? 'Yes':'No'?></td>
                        <td><?=$user->pivot->updated_at ? Carbon\Carbon::parse($user->pivot->updated_at)->format('M d, Y g:i:s A'):''?></td>
                        <td>
                            loading...
                        </td>
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
            @include('v1.companies.add-user')
          </div>
        </div>
      </div>
    </div>
@endcan

<?php foreach($company->users as $user) : ?>
    <div class="modal fade bs-example-modal-sm<?=$user->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
                @if(auth()->user()->can('delete') && auth()->user()->hasRole('admin'))
                    Are you sure you want to inactivate?
                @else
                    Cannot Delete.
                @endif
            </h4>
          </div>
          <div class="modal-body text-center">
            @if(auth()->user()->can('delete') && auth()->user()->hasRole('admin'))
                Are you sure you want to inactivate
                <strong><?=$user->first_name.' '.$user->last_name?></strong>
            @else
                You don't have permission to inactivate.
            @endif
          </div>
          <div class="modal-footer">
            @if(auth()->user()->can('delete') && auth()->user()->hasRole('admin'))
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="<?=route('company.user.delete',[Request::segment(3),$user->id])?>" class="btn btn-danger">Delete</a>
            @else
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            @endif
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
                    varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"account-types/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    varInactivate = '';
                    @if(auth()->user()->can('delete') && auth()->user()->hasRole('admin'))
                    if(row.inactive == 'No' && row.id != '<?=auth()->user()->id?>' && '<?=$company->owner->user_id?>' != row.id) {
                        varInactivate = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    }
                    @endcan
                    return varInactivate;
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