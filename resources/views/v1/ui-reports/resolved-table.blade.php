<table id="grid-basic" class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th data-column-id="id">ID</th>
            <th data-column-id="no">ID No.</th>
            <th data-column-id="date">Date</th>
            <th data-column-id="page">Page</th>
            <th data-column-id="url" data-formatter="urls">URL</th>
            <th data-column-id="reporter">Reporter</th>
            <th data-column-id="report" data-formatter="reports">Report</th>
            <th data-column-id="status">Status</th>
            <th data-column-id="resolved_status">Resolved Status</th>
            <th data-formatter="commands">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ui_reports as $key => $ui_report) : ?>
            <tr>
                <td><?=$ui_report->id?></td>
                <td><?=$ui_report->id?></td>
                <td><?=$ui_report->created_at->format('M d, Y')?></td>
                <td><?=str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($ui_report->url)))?></td>
                <td><?=$ui_report->url?></td>
                <td><?=$ui_report->user->email?></td>
                <td><?=$ui_report->issue?></td>
                <td><?=$ui_report->status ?:''?></td>
                <td><?=$ui_report->resolved_status?></td>
                <td>
                    loading...
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
    $(function(){
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 25,
            formatters: {
                'reports': function(col, row)
                {
                    if(row.report)
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Report' data-content='"+row.report+"'></span>";
                    else
                        varSpan = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Report' data-content='&nbsp;'></span>";
                    return varSpan;
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"ui-reports/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return varEdit+varDelete;
                }
            }
        });
        setTimeout(function(){
            $('[data-toggle="popover"]').popover();
        },500);

        var timeouteTimer = 0;
        $('.search-field').keyup(function(){
            clearTimeout(timeouteTimer);
            timeouteTimer = setTimeout(function(){
              $('[data-toggle="popover"]').popover();
            },500);
        });
    });
</script>