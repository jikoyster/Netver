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
            <h3><strong>Companies</strong></h3>
        </div>
    </div>
    @if(session('selected-company') && false)
        <div class="form-group col-md-2">
            <label for="name" class="col-md-12 control-label text-left text-white" style="padding: 0;">Company: <a href="{{route('companies')}}" style="color:#fff;"><?=$selected_company->legal_name?></a><a href="{{route('clear-company',[$selected_company->id])}}" style="color: #bf5329; margin-left: 7px;"><span class="glyphicon glyphicon-remove"></span></a></label>
        </div>
    @endif
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
                    <th data-column-id="account_no">Account No</th>
                    <th data-column-id="legal_name">Legal Name</th>
                    <th data-column-id="country">Country</th>
                    <th data-column-id="registration_type_id">Registration Type</th>
                    <th data-column-id="phone">Phone</th>
                    <th data-column-id="company_email">Company Email</th>
                    <th data-column-id="trade_name">Trade Name</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($companies as $company) : ?>
                    @if($company->owner->user->groups[0]->id == 1 || auth()->user()->hasRole('super admin'))
                    <tr>
                        <td><?=$company->id?></td>
                        <td><?=$company->account_no?></td>
                        <td><?=$company->legal_name?></td>
                        <td><?=$company->country_currency ? $company->country_currency->country_name : ''?></td>
                        <td><?=$company->registration_type ? $company->registration_type->name : ''?></td>
                        <td><?=$company->phone?></td>
                        <td><?=$company->company_email?></td>
                        <td><?=$company->trade_name?></td>
                        <td>
                            loading...
                        </td>
                    </tr>
                    @endif
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
            @include('v1.companies.add')
          </div>
        </div>
      </div>
    </div>
@endcan

<?php foreach($companies as $company) : ?>
    <div class="modal fade bs-example-modal-sm<?=$company->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete
            <strong><?=$company->trade_name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('company.delete',[$company->id])?>" class="btn btn-danger">Delete</a>
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
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    varSelect = " <a class=\"btn btn-xs btn-primary command-users\" href=\"/companies/select-company/"+row.id+"\">Select</a> ";
                    varLocation = '';
                    varSegment = '';
                    varJobProject = '';
                    varDocument = '';
                    varChartOfAccount = '';
                    varAccountMap = '';
                    varJournal = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/companies/profile/" + row.account_no + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    varUsers = "<a class=\"btn btn-xs btn-primary command-users\" href=\"/companies/users/"+row.id+"\">Users</a> ";
                    if('<?=session('selected-company')?>' == row.id) {
                        varSelect = "";
                        /*varLocation = " <a class=\"btn btn-xs btn-success command-users\" href=\"/company-locations\">Locations</a> ";
                        varSegment = " <a class=\"btn btn-xs btn-success command-users\" href=\"/company-segments\">Segments</a> ";
                        varJobProject = " <a class=\"btn btn-xs btn-success command-users\" href=\"/job-projects\">Jobs / Projects</a> ";
                        varDocument = " <a class=\"btn btn-xs btn-success command-users\" href=\"/company-documents\">Documents</a> ";
                        varChartOfAccount = " <a class=\"btn btn-xs btn-success command-users\" href=\"/company-chart-of-accounts\">Chart of Accounts</a> ";
                        varAccountMap = " <a class=\"btn btn-xs btn-success command-users\" href=\"/company-account-maps\">Account Maps</a> ";
                        varJournal = " <a class=\"btn btn-xs btn-success command-users\" href=\"/company-journals\">Journals</a> ";*/
                    }
                    return varEdit+varSelect+varLocation+varSegment+varJobProject+varDocument+varChartOfAccount+varAccountMap+varJournal;
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