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
            <h3><strong>Journal</strong></h3>
        </div>
    </div>
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
                    <th data-column-id="journalid">Journal ID</th>
                    <th data-column-id="name">Name</th>
                    <th data-column-id="description" data-formatter="descriptions">Description</th>
                    <th data-column-id="journal_index">Index</th>
                    <th data-column-id="show_debit_credit">Show Debit & Credit Columns</th>
                    <th data-column-id="journal_active">Active</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($journals as $journal) : ?>
                    <tr>
                        <td><?=$journal->id?></td>
                        <td><?=$journal->journalid?></td>
                        <td><?=$journal->name?></td>
                        <td><?=$journal->description?></td>
                        <td><?=$journal->journal_index ? 'Yes' : 'No'?></td>
                        <td><?=$journal->show_debit_credit ? 'Yes' : 'No'?></td>
                        <td><?=$journal->journal_active ? 'Yes' : 'No'?></td>
                        <td>
                            loading...
                        </td>
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
        @include('v1.journals.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($journals as $journal) : ?>
    <div class="modal fade bs-example-modal-sm<?=$journal->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete journal
            <strong><?=$journal->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('journal.delete',[$journal->id])?>" class="btn btn-danger">Delete</a>
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
                'descriptions': function(col, row)
                {
                    if(row.description)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Description' data-content='"+row.description+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Description' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"journals/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return varEdit+varDelete;
                }
            }
        }).on("load.rs.jquery.bootgrid", function (e)
        {
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
            },500);
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }
        setTimeout(function(){
            $('[data-toggle="popover"]').popover();
        },500);
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
th:nth-child(2),th:nth-child(5) {
    width: 10%;
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