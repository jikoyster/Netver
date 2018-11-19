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
            <h3><strong>Global Chart of Accounts</strong></h3>
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
                    <th data-column-id="code">Account No.</th>
                    <th data-column-id="name">Name</th>
                    <th data-formatter="types" data-column-id="type">Type</th>
                    <th data-formatter="normal_signs" data-column-id="normal_sign">Normal Sign</th>
                    <th data-formatter="groups" data-column-id="group">Group</th>
                    <th data-formatter="classes" data-column-id="class">Class</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($gcoas as $gcoa) : ?>
                    <tr>
                        <td><?=$gcoa->id?></td>
                        <td><?=$gcoa->account_no?></td>
                        <td><?=$gcoa->name?></td>
                        <td><?=$gcoa->account_type->name?></td>
                        <td><?=$gcoa->normal_sign->name?></td>
                        <td><?=($gcoa->account_group_id) ? $gcoa->account_group->code.' - '.$gcoa->account_group->name : ''?></td>
                        <td><?=($gcoa->account_class_id) ? $gcoa->account_class->code.' - '.$gcoa->account_class->name : ''?></td>
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
        @include('v1.global-chart-of-accounts.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($gcoas as $gcoa) : ?>
    <div class="modal fade bs-example-modal-sm<?=$gcoa->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete
            <strong><?=$gcoa->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('global-chart-of-account.delete',[$gcoa->id])?>" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
@if($gcoas->count())
<div id="type_container" style="display: none;">
    <select class="form-control pull-left" name="sel_type">
        <option value="">- select -</option>
        @foreach($account_types as $rec)
            <option value="{{$rec->id}}" {{$gcoa->account_type_id == $rec->id ? '':''}}>{{$rec->name}}</option>
        @endforeach
    </select>
</div>
<div id="normal_sign_container" style="display: none;">
    <select class="form-control pull-left" name="sel_normal_sign">
        <option value="">- select -</option>
        @foreach($signs as $rec)
            <option value="{{$rec->id}}" {{$gcoa->sign_id == $rec->id ? '':''}}>{{$rec->name}}</option>
        @endforeach
    </select>
</div>
<div id="group_container" style="display: none;">
    <select class="form-control pull-left" name="sel_group">
        <option value="">- select -</option>
        @foreach($account_groups as $rec)
            <option value="{{$rec->id}}" {{$gcoa->account_group_id == $rec->id ? '':''}}>{{$rec->code.' - '.$rec->name}}</option>
        @endforeach
    </select>
</div>
<div id="class_container" style="display: none;">
    <select class="form-control pull-left" name="sel_class">
        <option value="">- select -</option>
        @foreach($account_classes as $rec)
            <option value="{{$rec->id}}" {{$gcoa->account_class_id == $rec->id ? '':''}}>{{$rec->code.' - '.$rec->name}}</option>
        @endforeach
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
        var keep_account_map = [];
        var keep_type = [];
        var keep_normal_sign = [];
        var keep_group = [];
        var keep_class = [];
        $('.dropdown-toggle').dropdown();
        $('[data-toggle="tooltip"]').tooltip();
        $("#grid-basic").bootgrid({
            rowCount: 10,
            formatters: {
                'types': function(col, row)
                {
                    label = row.type;
                    if(keep_type[row.id])
                        label = keep_type[row.id];
                    varBtn = '<span tabindex="0" class="type-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="gcoa_id">';
                    return "<span id='type_span'>"+label+"</span>"+varBtn;
                },
                'normal_signs': function(col, row)
                {
                    label = row.normal_sign;
                    if(keep_normal_sign[row.id])
                        label = keep_normal_sign[row.id];
                    varBtn = '<span tabindex="0" class="normal_sign-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="gcoa_id">';
                    return "<span id='sign_span'>"+label+"</span>"+varBtn;
                },
                'groups': function(col, row)
                {
                    label = row.group;
                    if(keep_group[row.id])
                        label = keep_group[row.id];
                    if(label.length > 18) {
                        wrapped = label.slice(0,18)+'. . .';
                        label = '<span style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="Group" data-content="'+label+'">'+wrapped+'</span>';
                    }
                    varBtn = '<span tabindex="0" class="group-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="gcoa_id">';
                    return "<span id='group_span'>"+label+"</span>"+varBtn;
                },
                'classes': function(col, row)
                {
                    label = row.class;
                    if(keep_class[row.id])
                        label = keep_class[row.id];
                    if(label.length > 18) {
                        wrapped = label.slice(0,18)+'. . .';
                        label = '<span style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="Class" data-content="'+label+'">'+wrapped+'</span>';
                    }
                    varBtn = '<span tabindex="0" class="class-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="gcoa_id">';
                    return "<span id='class_span'>"+label+"</span>"+varBtn;
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"global-chart-of-accounts/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return varEdit+varDelete;
                }
            }
        }).on('load.rs.jquery.bootgrid',function(){
            popoverExtention();
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        var selected_account_map_no = [];
        var selected_type = [];
        var selected_normal_sign = [];
        var selected_group = [];
        var selected_class = [];

        popoverExtention = function(){
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
                $('[data-toggle="tooltip"]').tooltip();
                $('.map_no-btn').attr('data-content',$('#map_no_container').html());
                $('.type-btn').attr('data-content',$('#type_container').html());
                $('.normal_sign-btn').attr('data-content',$('#normal_sign_container').html());
                $('.group-btn').attr('data-content',$('#group_container').html());
                $('.class-btn').attr('data-content',$('#class_container').html());
                $('.map_no-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_map_no]').select2({
                            dropdownAutoWidth:true
                        }).select2('open');
                        if(selected_account_map_no[$(this).parent().find('#map_no_span').html().trim()])
                            $('[name=sel_map_no]').val(selected_account_map_no[$(this).parent().find('#map_no_span').html().trim()]);
                        $(this).next().find('[name=sel_map_no]').on('select2:close', function(){
                            if($(this).val())
                                updateMapNo(this);
                            else
                                $(this).parent().parent().parent().find('.map_no-btn').popover('hide');
                        });
                        $('[name=sel_map_no]').off('focus').on('focus',function(){
                            $(this).on('change',function(e){
                                updateMapNo(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.type-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_type]').select2({
                            dropdownAutoWidth:true
                        }).select2('open');
                        if(selected_type[$(this).parent().find('#type_span').html().trim()])
                            $('[name=sel_type]').val(selected_type[$(this).parent().find('#type_span').html().trim()]);
                        $(this).next().find('[name=sel_type]').on('select2:close', function(){
                            if($(this).val())
                                updateType(this);
                            else
                                $(this).parent().parent().parent().find('.type-btn').popover('hide');
                        });
                        $('[name=sel_type]').off('focus').on('focus',function(){
                           $(this).on('change',function(e){
                                updateType(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.normal_sign-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_normal_sign]').select2({
                            dropdownAutoWidth:true
                        }).select2('open');
                        if(selected_normal_sign[$(this).parent().find('#sign_span').html().trim()])
                            $('[name=sel_normal_sign]').val(selected_normal_sign[$(this).parent().find('#sign_span').html().trim()]);
                        $(this).next().find('[name=sel_normal_sign]').on('select2:close', function(){
                            if($(this).val())
                                updateSign(this);
                            else
                                $(this).parent().parent().parent().find('.normal_sign-btn').popover('hide');
                        });
                        $('[name=sel_normal_sign]').off('focus').on('focus',function(){
                            $(this).on('change',function(e){
                                updateSign(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.group-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_group]').select2({
                            dropdownAutoWidth:true
                        }).select2('open');
                        if(selected_group[$(this).parent().find('#group_span').html().trim()])
                            $('[name=sel_group]').val(selected_group[$(this).parent().find('#group_span').html().trim()]);
                        $(this).next().find('[name=sel_group]').on('select2:close', function(){
                            if($(this).val())
                                updateGroup(this);
                            else
                                $(this).parent().parent().parent().find('.group-btn').popover('hide');
                        });
                        $('[name=sel_group]').off('focus').on('focus',function(){
                            $(this).on('change',function(e){
                                updateGroup(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.class-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_class]').select2({
                            dropdownAutoWidth:true
                        }).select2('open');
                        if(selected_class[$(this).parent().find('#class_span').html().trim()])
                            $('[name=sel_class]').val(selected_class[$(this).parent().find('#class_span').html().trim()]);
                        $(this).next().find('[name=sel_class]').on('select2:close', function(){
                            if($(this).val())
                                updateClass(this);
                            else
                                $(this).parent().parent().parent().find('.class-btn').popover('hide');
                        });
                        $('[name=sel_class]').off('focus').on('focus',function(){
                            $(this).on('change',function(e){
                                updateClass(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
            },500);
        }

        popoverExtention();
        updateMapNo = function(el) {
            $(el).parent().parent().parent().find('#map_no_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('global-chart-of-account.update')?>',{
                gcoa_id: $(el).parent().parent().parent().find('[name=gcoa_id]').val(),
                id: $(el).val(),
                type: 'map_no_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#map_no_span').html(data.val);
                    selected_account_map_no[data.val] = $(el).val();
                    keep_account_map[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.map_no-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateType = function(el) {
            $(el).parent().parent().parent().find('#type_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('global-chart-of-account.update')?>',{
                gcoa_id: $(el).parent().parent().parent().find('[name=gcoa_id]').val(),
                id: $(el).val(),
                type: 'type_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#type_span').html(data.val);
                    selected_type[data.val] = $(el).val();
                    keep_type[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.type-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateSign = function(el) {
            $(el).parent().parent().parent().find('#sign_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('global-chart-of-account.update')?>',{
                gcoa_id: $(el).parent().parent().parent().find('[name=gcoa_id]').val(),
                id: $(el).val(),
                type: 'sign_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#sign_span').html(data.val);
                    selected_normal_sign[data.val] = $(el).val();
                    keep_normal_sign[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.normal_sign-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateGroup = function(el) {
            $(el).parent().parent().parent().find('#group_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('global-chart-of-account.update')?>',{
                gcoa_id: $(el).parent().parent().parent().find('[name=gcoa_id]').val(),
                id: $(el).val(),
                type: 'group_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    if(data.val.length > 18) {
                        wrapped = data.val.slice(0,18)+'. . .';
                        label = '<span style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="Group" data-content="'+data.val+'">'+wrapped+'</span>';
                    } else {
                        label = data.val;
                    }
                    $(el).parent().parent().parent().find('#group_span').html(label);
                    $('[data-toggle="popover"]').popover();
                    selected_group[data.val] = $(el).val();
                    keep_group[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.group-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateClass = function(el) {
            $(el).parent().parent().parent().find('#class_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('global-chart-of-account.update')?>',{
                gcoa_id: $(el).parent().parent().parent().find('[name=gcoa_id]').val(),
                id: $(el).val(),
                type: 'class_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    if(data.val.length > 18) {
                        wrapped = data.val.slice(0,18)+'. . .';
                        label = '<span style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="Class" data-content="'+data.val+'">'+wrapped+'</span>';
                    } else {
                        label = data.val;
                    }
                    $(el).parent().parent().parent().find('#class_span').html(label);
                    $('[data-toggle="popover"]').popover();
                    selected_class[data.val] = $(el).val();
                    keep_class[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.class-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    th:nth-child(2),th:nth-child(5),th:nth-child(8) {
        width: 8%;
    }
    th:nth-child(6),th:nth-child(7) {
        width: 15%;
    }
    th:nth-child(4) {
        width: 12%;
    }
    .table-condensed>tbody>tr>td {
        vertical-align: middle;
    }
    td > span {
        display: inline-block;
        padding: 7px 0;
    }
    .glyphicon-collapse-down {
        padding-top: 0;
        padding-bottom: 0;
        font-size: 23px;
        float: right;
    }
    .select2-container {
        z-index: 9999;
    }
</style>
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
@stop