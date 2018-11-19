@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-journal.import') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Import Journals</strong></h3>
                </div>
            </div>

            <div class="col-md-12" style="background-color: #fff; margin-bottom: 15px;">
                <table id="grid-keep-selection" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                            <th data-column-id="journalid">Journal ID</th>
                            <th data-column-id="name">Name</th>
                            <th data-column-id="description" data-formatter="descriptions">Description</th>
                            <th data-column-id="journal_index" data-formatter="journal_indexs">Index</th>
                            <th data-column-id="show_debit_credit" data-formatter="show_debit_credits">Show Debit & Credit Columns</th>
                            <th data-column-id="journal_active" data-formatter="journal_actives">Active</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto;">
                    <button type="button" onclick="window.location='{{route('company-journals')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $("#grid-keep-selection").bootgrid({
            ajax: true,
            caseSensitive: false,
            rowCount: 10,
            post: ()=>
            {
                /* To accumulate custom parameter with the request object */
                return {
                    _token:$('[name=_token').val()
                };
            },
            url: "<?=route('company-journal.group-source')?>",
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                'descriptions': function(col, row)
                {
                    if(row.description)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Description' data-content='"+row.description+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Description' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'journal_indexs': function(col, row)
                {
                    if(row.journal_index)
                        return 'Yes';
                    else
                        return 'No';
                },
                'show_debit_credits': function(col, row)
                {
                    if(row.show_debit_credit)
                        return 'Yes';
                    else
                        return 'No';
                },
                'journal_actives': function(col, row)
                {
                    if(row.journal_active)
                        return 'Yes';
                    else
                        return 'No';
                },
            }
        }).on("loaded.rs.jquery.bootgrid", function(e, rows)
        {
            $('[name=select]').attr('name','journal_ids[]');
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
            },500);
        }).on("selected.rs.jquery.bootgrid", function(e, rows)
        {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++)
            {
                rowIds.push(rows[i].id);
            }
        }).on("deselected.rs.jquery.bootgrid", function(e, rows)
        {
            var rowIds = [];
            for (var i = 0; i < rows.length; i++)
            {
                rowIds.push(rows[i].id);
            }
        });
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    th:nth-child(2),td:nth-child(2) {
        visibility: hidden;
        width: 0;
    }
    .container {
        width: 90%;
    }
</style>
@stop