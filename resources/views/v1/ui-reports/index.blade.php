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
            <h3><strong>Errors and Bugs Report</strong></h3>
        </div>
    </div>
    @if(1 == 1)
    <div class="form-group col-md-2">
        <label for="name" class="col-md-3 control-label text-left text-white">Status: </label>
        <div class="col-md-9 pull-left text-center" style="margin: 0 auto; float: unset;">
            <select class="form-control" name="status_search">
                <option value="0">all</option>
                <option>Resolved</option>
                <option selected>Outstanding</option>
            </select>
        </div>
    </div>
    @endif
    @can('add')
        <button type="button" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right">
            <strong>Add New</strong>
        </button>
    @endcan
    <div class="col-md-12 ui-reports-table-container" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="no" data-formatter="nos">ID No.</th>
                    <th data-column-id="created_at" data-formatter="created_ats">Date</th>
                    <th data-column-id="page">Page</th>
                    <th data-column-id="url" data-formatter="urls">URL</th>
                    <th data-column-id="user_id" data-formatter="user_ids">Reporter</th>
                    <th data-column-id="report" data-formatter="reports">Report</th>
                    <th data-column-id="status" data-formatter="statuses">Status</th>
                    <th data-column-id="priority" data-formatter="priorities">Priority</th>
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
                        <td>
                            <?=str_replace_last('http://sysacc.netver.niel/', '', str_replace_last('http://sysacc.netver.com/', '', strtolower($ui_report->url)))?>
                        </td>
                        <td><?=$ui_report->url?></td>
                        <td><?=$ui_report->user->email?></td>
                        <td><?=$ui_report->issue?></td>
                        <td><?=$ui_report->status ?:''?></td>
                        <td><?=$ui_report->priority?></td>
                        <td><?=$ui_report->resolved_status?></td>
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
        @include('v1.ui-reports.add')
      </div>
    </div>
  </div>
</div>
<?php foreach($ui_reports as $key => $ui_report) : ?>
    <div class="modal fade bs-example-modal-sm<?=$ui_report->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete ui report #
            <strong><?=$ui_report->id?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a data-report-id='<?=$ui_report->id?>' data-row-id='<?=$key?>' data-dismiss="modal" nohref="<?=route('ui-report.delete',[$ui_report->id])?>" class="btn btn-danger delete-report">Delete</a>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade modal-report bs-report-modal-sm<?=$ui_report->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close text-white" style="font-weight: bold;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Report</h4>
          </div>
          <div class="modal-body text-center">
            <textarea class="form-control report-container" readonly>{{$ui_report->issue}}</textarea>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
@if($ui_reports->count())
<div id="priority_container" style="display: none;">
    <select class="form-control pull-left" name="sel_priority">
        <option value="">- select -</option>
        <option value="1">High</option>
        <option value="2">Medium</option>
        <option value="3">Low</option>
    </select>
</div>
<div id="status_container" style="display: none;">
    <select class="form-control pull-left" name="sel_status">
        <option value="">- select -</option>
        <option>Resolved</option>
        <option>Outstanding</option>
    </select>
</div>
@endif
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var keep_priority = [];
        var keep_status = [];
        var selected_priority = [];
        var selected_status = [];
        $('.dropdown-toggle').dropdown();
        $('[data-toggle="tooltip"]').tooltip();
        $("#grid-basic").bootgrid({
            ajax: true,
            caseSensitive: false,
            rowCount: 25,
            post: ()=>
            {
                /* To accumulate custom parameter with the request object */
                return {
                    _token:$('[name=_token').val()
                };
            },
            url: "<?=route('ui-report.ajax-data')?>",
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                'nos': function(col,row)
                {
                    return row.id;
                },
                'created_ats': function(col,row)
                {
                    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    var d = new Date(row.created_at);
                    return months[d.getMonth()]+' '+d.getDate()+', '+d.getFullYear();
                },
                'statuses': function(col, row)
                {
                    label = row.status;
                    if(keep_status[row.id])
                        label = keep_status[row.id];
                    varBtn = '<span tabindex="0" class="status-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="ui_report_id">';
                    return "<span id='status_span'>"+label+"</span>"+varBtn;
                },
                'priorities': function(col, row)
                {
                    label = row.priority;
                    if(keep_priority[row.id]) {
                        label = keep_priority[row.id];
                    } else {
                        if(label == 1) {
                            label = 'High';
                            style = 'color:red;font-weight:bold;';
                        } else if(label == 2) {
                            label = 'Medium';
                            style = 'font-weight:bold;';
                        } else {
                            label = 'Low';
                            style = '';
                        }
                    }
                    varBtn = '<span tabindex="0" class="priority-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="ui_report_id">';
                    return "<span id='priority_span' style='"+style+"'>"+label+"</span>"+varBtn;
                },
                'urls': function(col, row)
                {
                    return "<a href='"+row.url.replace('sysacc.netver.com','{{request()->server('SERVER_NAME')}}')+"' target='_blank'>"+row.url+"</a>";
                },
                'user_ids': function(col, row)
                {
                    return row.user.email;
                },
                'reports': function(col, row)
                {
                    varSpanOld1 = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' onclick=\"showReport(this)\" data-target=\".bs-report-modal-sm"+row.id+"\"></span>";
                    varSpanOld2 = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' onclick=\"showReport(this)\" data-target=\".bs-report-modal-sm"+row.id+"\"></span>";
                    if(row.issue)
                        varSpan = `<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' title='Report' data-content='`+row.issue+`'></span>`;
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
        }).on("load.rs.jquery.bootgrid",function(){
            popoverExtention();
        });
        
        popoverExtention = function(){
            setTimeout(function(){
                $('.delete-report').off().on('click',function(){
                    $.get("<?=route('ui-report.delete',[''])?>/"+$(this).data('report-id'));
                    $('[data-target=".bs-example-modal-sm'+$(this).data('report-id')+'"]').parent().parent().hide();
                    //$('tr[data-row-id="'+$(this).data('row-id')+'"]').hide();
                });
                $('[data-toggle="popover"]').popover();
                $('.priority-btn').attr('data-content',$('#priority_container').html());
                $('.status-btn').attr('data-content',$('#status_container').html());
                $('.priority-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_priority]').select2().select2('open');
                        if(selected_priority[$(this).parent().find('#priority_span').html().trim()])
                            $('[name=sel_priority]').val(selected_priority[$(this).parent().find('#priority_span').html().trim()]);
                        $(this).next().find('[name=sel_priority]').on('select2:close', function(){
                            if($(this).val())
                                updatePriority(this);
                            else
                                $(this).parent().parent().parent().find('.priority-btn').popover('hide');
                        });
                    },1000);
                });
                $('.status-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_status]').select2().select2('open');
                        if(selected_status[$(this).parent().find('#status_span').html().trim()])
                            $('[name=sel_status]').val(selected_status[$(this).parent().find('#status_span').html().trim()]);
                        $(this).next().find('[name=sel_status]').on('select2:close', function(){
                            if($(this).val())
                                updateStatus(this);
                            else
                                $(this).parent().parent().parent().find('.status-btn').popover('hide');
                        });
                    },1000);
                });
            },1000);
        }

        updatePriority = function(el) {
            $(el).parent().parent().parent().find('#priority_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('ui-report.update')?>',{
                ui_report_id: $(el).parent().parent().parent().find('[name=ui_report_id]').val(),
                id: $(el).val(),
                type: 'priority',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    if(data.val == 'High') {
                        style = 'color:red;font-weight:bold;';
                    } else if(data.val == 'Medium') {
                        style = 'font-weight:bold;';
                    } else {
                        style = '';
                    }
                    $(el).parent().parent().parent().find('#priority_span').html(data.val).attr('style',style);
                    selected_priority[data.val] = $(el).val();
                    keep_priority[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.priority-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateStatus = function(el) {
            $(el).parent().parent().parent().find('#status_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('ui-report.update')?>',{
                ui_report_id: $(el).parent().parent().parent().find('[name=ui_report_id]').val(),
                id: $(el).val(),
                type: 'status',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#status_span').html(data.val);
                    selected_status[data.val] = $(el).val();
                    keep_status[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.status-btn').popover('hide');
                location.reload();
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }
        showReport = function(desc) {
            $($(desc).data('target')).modal('show');
        }
        hideReport = function(desc) {
            $(desc).parent().find('.glyphicon').show();
            $(desc).css('visibility','hidden').height(0);
        }
        $('.modal-report').on('shown.bs.modal', function () {
            var iScrollHeight = $(this).find('.report-container').prop("scrollHeight");
            $(this).find('.report-container').css('visibility','visible').css('resize','none').height(iScrollHeight);
        });
        $('.modal-report').on('hidden.bs.modal', function () {
            $(this).find('.report-container').css('visibility','visible').css('resize','none').height(0);
        });
        $('.report-container').css('height',0).css('transition','all 0.3s');

        var timeouteTimer = 0;
        $('.search-field').keyup(function(){
            clearTimeout(timeouteTimer);
            timeouteTimer = setTimeout(function(){
                if($('.search-field').val() == '')
                    $('[name="status_search"]').val(0);
            },1000);
        });

        $('[name="status_search"]').off('change').on('change',function(){
            if($(this).val() == 'Outstanding')
                $('.search-field').val('-status-not-resolved-');
            else if($(this).val() == 'Resolved')
                $('.search-field').val('-status-resolved-');
            else
                $('.search-field').val('');
            $('.search-field').css('color','transparent').keyup();
        });
        $('.search-field').click(function(){
            $(this).css('color','black').val('');
        });
        $('[name="status_search"]').change();
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    th:nth-child(2),th:nth-child(3),th:nth-child(7),th:nth-child(9) {
        width: 7%;
    }
    th:nth-child(10),td:nth-child(10) {
        width: 0px;
        visibility: hidden;
    }
    th:nth-child(8) {
        width: 10%;
    }
    th:nth-child(11),td:nth-child(11) {
        width:  10%;
        text-align: center;
    }
    .glyphicon-collapse-down {
        padding-top: 0;
        padding-bottom: 0;
        font-size: 23px;
        float: right;
    }
</style>
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
@stop