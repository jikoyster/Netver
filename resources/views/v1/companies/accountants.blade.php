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
            <h3><strong>Accountants</strong></h3>
        </div>
    </div>
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="system_user_id">Account No.</th>
                    <th data-column-id="company_name">Company Name</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="contact">Contact</th>
                    <th data-column-id="designation" data-formatter="designations">Designation</th>
                    <th data-column-id="country">Country</th>
                    <th data-column-id="city">City</th>
                    <th data-column-id="phone">Phone</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($companies as $company) : ?>
                    
                    <tr>
                        <td><?=$company->id?></td>
                        <td><?=$company->account_no?></td>
                        <td><?=$company->display_name?></td>
                        <td><?=$company->owner->user->email?></td>
                        <td><?=$company->contact_person?></td>
                        <td><?=$company->owner->user->designation->name?></td>
                        <td><?=$company->country_currency ? $company->country_currency->country_name:''?></td>
                        <td><?=$company->owner->user->address()->count() ? $company->owner->user->address()->first()->city:''?></td>
                        <td><?=$company->phone?></td>
                        <td>loading...</td>
                    </tr>
                    
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


<?php foreach($companies as $company) : ?>
    <div class="modal fade bs-example-modal-sm<?=$company->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete User
            <strong><?=$company->first_name?></strong>
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
            <a href="<?=route('user.delete',[$company->id])?>" class="btn btn-danger">Delete</a>
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
        
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 25,
            formatters: {
                'designations': function(col,row)
                {
                    return "<span data-toggle=\"tooltip\" data-placement=\"top\" title=\""+row.designation+"\">"+row.designation+"</span>";
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @if(auth()->user()->can('edit') && auth()->user()->hasRole('super admin'))
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"></span></button>";
                    @endif
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/companies/accounting-profile/" + row.system_user_id + "\"><span class=\"glyphicon glyphicon-edit\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"></span></a> ";
                    @endcan
                    return varEdit;//+varDelete;
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
    th:nth-child(10),th:nth-child(2),th:nth-child(9) {
        width: 7%;
    }

    th:nth-child(3),th:nth-child(6) {
        width: 15%;
    }
</style>
@stop