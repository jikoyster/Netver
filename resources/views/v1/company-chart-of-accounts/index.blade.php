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
            <h3><strong>Company Chart of Accounts</strong></h3>
        </div>
    </div>
    @if(session('selected-company'))
        <div class="form-group col-md-2">
            <label for="name" class="col-md-12 control-label text-left text-white" style="padding: 0;">Company: <a href="{{route('companies')}}" style="color:#fff;"><?=$company->legal_name?></a><a href="{{route('clear-company',[$company->id])}}" style="color: #bf5329; margin-left: 7px;"><span class="glyphicon glyphicon-remove"></span></a></label>
        </div>
    @endif
    @can('add')
        <button type="button" class="btn pull-right" onclick="window.location='<?=route('company-chart-of-account.add')?>'">
            <strong>Import</strong>
        </button>
        <button type="button" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right" style="margin-right: 7px;">
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
                    <th data-column-id="group">Group</th>
                    <th data-column-id="class">Class</th>
                    <th data-column-id="locked">Locked</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($company_chart_of_accounts as $chart_of_account) : ?>
                    <tr>
                        <td><?=$chart_of_account->id?></td>
                        <td><?=$chart_of_account->account_no?></td>
                        <td><?=$chart_of_account->name?></td>
                        <td><?=($chart_of_account->account_type) ? $chart_of_account->account_type->name:''?></td>
                        <td><?=($chart_of_account->sign) ? $chart_of_account->sign->name:''?></td>
                        <td>
                            <?php
                                if($chart_of_account->account_map) {
                                    if($chart_of_account->account_map->map_group_id) {
                                        if($chart_of_account->account_map->parent_map)
                                            echo $chart_of_account->account_map->account_map->parent_map->map_no.'.';
                                        echo $chart_of_account->account_map->account_map->map_no;
                                    } else {
                                        echo $chart_of_account->account_map->map_no;
                                    }
                                }
                            ?>
                        </td>
                        <td><?=($chart_of_account->group) ? $chart_of_account->account_group->code.' - '.$chart_of_account->account_group->name : ''?></td>
                        <td><?=($chart_of_account->class) ? $chart_of_account->account_class->code.' - '.$chart_of_account->account_class->name : ''?></td>
                        <td>{{$chart_of_account->locked ? 'Yes':'No'}}</td>
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
        @include('v1.company-chart-of-accounts.add')
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-warning-modal" role="dialog" aria-labelledby="mySmallModalLabel" style="top: 30%;">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Warning!</h4>
        </div>
        <div class="modal-body text-center">
            This selection is not reversable, Continue?
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" id="no-btn">No</button>
            <button class="btn btn-success" data-dismiss="modal" id="yes-btn">Yes</button>
        </div>
    </div>
  </div>
</div>

<?php foreach($company_chart_of_accounts as $chart_of_account) : ?>
    <div class="modal fade bs-example-modal-sm<?=$chart_of_account->id?>" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete
            <strong><?=$chart_of_account->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('company-chart-of-account.delete',[$chart_of_account->id])?>" class="btn btn-danger">Delete</a>
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
                'groups': function(col,row)
                {
                    if(row.group)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Group' data-content='"+row.group+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Group' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/company-chart-of-accounts/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
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
        $('[name=account_group_id]').change(function(){
            if($("[name=account_group_id] option:selected").text().toLowerCase().indexOf('bank') >= 0)
                $('[name=currency]').parent().parent().show();
            else
                $('[name=currency]').parent().parent().hide();
        }).change();
        $('select').select2({dropdownAutoWidth:true});
        var groupWarn = true;
        var currencyWarn = true;
        $('#account_group_id').change(function(){
            $('[name=account_group_id_hidden]').val($(this).val());
            if(groupWarn && ($("[name=account_group_id] option:selected").text().toLowerCase().indexOf('bank') >= 0)) {
                groupWarn = false;
                $('.bs-warning-modal').modal('show');
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#account_group_id').val('').change();
                    groupWarn = true;
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                });
            }
        });
        $('#currency').change(function(){
            $('[name=currency_hidden]').val($(this).val());
            if(currencyWarn) {
                currencyWarn = false;
                $('.bs-warning-modal').modal('show');
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#currency').val('').change();
                    currencyWarn = true;
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                });
            }
        });
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    select + .select2-container { float: inherit; width: 280px !important; }
    .select2-selection { height: 36px !important; }
    #select2-account_type_id-container,
    #select2-sign_id-container,
    #select2-map_no-container,
    #select2-account_group_id-container,
    #select2-account_class_id-container,
    #select2-tax_account-container,
    #select2-currency-container {
        text-align: left;
        padding: 3px 14px;
    }
    th:nth-child(2),th:nth-child(6) {
        width: 7%;
    }
    th:nth-child(7),th:nth-child(8) {
        width: 15%;
    }
    th:nth-child(4),th:nth-child(5) {
        width: 10%;
    }
    th:nth-child(9),th:nth-child(10) {
        width: 5%;
    }
</style>
@stop