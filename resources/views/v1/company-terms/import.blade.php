@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-term.import') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Import Terms</strong></h3>
                </div>
            </div>

            <div class="col-md-12" style="background-color: #fff; margin-bottom: 15px;">
                <table id="grid-keep-selection" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                            <th data-column-id="name">Name</th>
                            <th data-column-id="standart_data_driven" data-formatter="standart_data_drivens">Standard / Data driven</th>
                            <th data-column-id="net_due" data-formatter="net_dues">Net Due</th>
                            <th data-column-id="discount">Discount</th>
                            <th data-column-id="discount_if_paid" data-formatter="discount_if_paids">Discount if paid</th>
                            <th data-column-id="inactive" data-formatter="inactives">Inactive</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto;">
                    <button type="button" onclick="window.location='{{route('company-terms')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
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
            url: "<?=route('company-term.group-source')?>",
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                'standart_data_drivens': function(col, row)
                {
                    if(row.data_driven == 0)
                        return 'Standard';
                    else
                        return 'Data Driven';
                },
                'net_dues': function(col, row)
                {
                    if(row.data_driven == 1)
                        return 'before the '+row.net_due+'th day of the month';
                    else
                        return 'in '+row.net_due+' day(s)';
                },
                'discount_if_paids': function(col, row)
                {
                    if(row.data_driven == 1)
                        return 'before the '+row.discount_if_paid+'th day of the month';
                    else
                        return 'in '+row.discount_if_paid+' day(s)';
                },
                'inactives': function(col, row)
                {
                    if(row.inactive)
                        return 'Yes';
                    else
                        return 'No';
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function(e, rows)
        {
            $('[name=select]').attr('name','term_ids[]');
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