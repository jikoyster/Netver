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
            <h3><strong>Map List</strong></h3>
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
                    <th data-column-id="map_no" data-order="asc">Map No.</th>
                    <th data-column-id="name" data-formatter="names">Name</th>
                    <th data-column-id="title" data-formatter="titles">Title</th>
                    <th data-column-id="unassignable" data-formatter="unassignables">Unassignable</th>
                    <th data-column-id="flip_type" data-formatter="flip_types">Flip Type</th>
                    <th data-column-id="flip_to" data-formatter="flip_tos">Flip To</th>
                    <th data-column-id="account_type_id" data-formatter="account_type_ids">Type</th>
                    <th data-column-id="sign_id" data-formatter="sign_ids">Sign</th>
                    <th data-column-id="account_group_id" data-formatter="account_group_ids">Group</th>
                    <th data-column-id="account_class_id" data-formatter="account_class_ids">Class</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function parent_code($rec)
                {
                    if($rec->parent_map) {
                        parent_code($rec->parent_map);
                        echo $rec->parent_map->map_no.'.';
                    }
                }
                ?>
                <?php foreach($account_maps as $map) : ?>
                    <tr>
                        <td><?=$map->id?></td>
                        <td>
                            <?php
                                parent_code($map);
                                echo $map->map_no;
                            ?>
                        </td>
                        <td><?=$map->name?></td>
                        <td><?=$map->title ? 'Yes':'No'?></td>
                        <td><?=$map->unassignable ? 'Yes':'No'?></td>
                        <td><?=$map->flip_type?></td>
                        <td>
                            <?php
                            if($map->flip_to_map) {
                                parent_code($map->flip_to_map);
                                echo $map->flip_to_map->map_no;
                            }
                            ?>
                        </td>
                        <td><?=$map->account_type->name?></td>
                        <td><?=$map->normal_sign ? $map->normal_sign->name:''?></td>
                        <td><?=$map->account_group ? $map->account_group->name:''?></td>
                        <td><?=$map->account_class ? $map->account_class->name:''?></td>
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
        @include('v1.account-maps.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($account_maps as $map) : ?>
    <div class="modal fade bs-example-modal-sm<?=$map->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete account map
            <strong><?=$map->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('account-map.delete',[$map->id])?>" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
@if($account_maps->count())
<div id="title_container" style="display: none;">
    <select class="form-control pull-left" name="sel_title">
        <option value="">- select -</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
    </select>
</div>
<div id="unassignable_container" style="display: none;">
    <select class="form-control pull-left" name="sel_unassignable">
        <option value="">- select -</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
    </select>
</div>
<div id="flip_type_container" style="display: none;">
    <select class="form-control pull-left" name="sel_flip_type">
        <option value="xxx">- select -</option>
        <option value="">- unselect -</option>
        <option value="Individual" {{old('flip_type') == 'Individual' ? 'selected':''}}>Individual</option>
        <option value="Total is Debit" {{old('flip_type') == 'Total is Debit' ? 'selected':''}}>Total is Debit</option>
        <option value="Total is Credit" {{old('flip_type') == 'Total is Credit' ? 'selected':''}}>Total is Credit</option>
    </select>
</div>
<div id="flip_to_container" style="display: none;">
    <select class="form-control pull-left" name="sel_flip_to">
        <option value="">- select -</option>
        <option value="">- unselect -</option>
        @foreach($flip_tos as $map)
            <option value="{{$map->id}}">
                <?php
                    if($map->parent_map)
                        echo $map->parent_map->map_no.'.';
                    echo $map->map_no.' - '.$map->name
                ?>
            </option>
        @endforeach
    </select>
</div>
<div id="account_type_id_container" style="display: none;">
    <select class="form-control pull-left" name="sel_account_type_id">
        <option value="">- select -</option>
        @foreach($account_types as $rec)
            <option value="{{$rec->id}}">{{$rec->name}}</option>
        @endforeach
    </select>
</div>
<div id="sign_id_container" style="display: none;">
    <select class="form-control pull-left" name="sel_sign_id">
        <option value="">- select -</option>
        @foreach($signs as $rec)
            <option value="{{$rec->id}}">{{$rec->name}}</option>
        @endforeach
    </select>
</div>
<div id="account_class_id_container" style="display: none;">
    <select class="form-control pull-left" name="sel_account_class_id">
        <option value="">- select -</option>
        @foreach($account_classes as $rec)
            <option value="{{$rec->id}}">{{$rec->code.' - '.$rec->name}}</option>
        @endforeach
    </select>
</div>
<div id="account_group_id_container" style="display: none;">
    <select class="form-control pull-left" name="sel_account_group_id">
        <option value="">- select -</option>
        @foreach($account_groups as $rec)
            <option value="{{$rec->id}}">{{$rec->code.' - '.$rec->name}}</option>
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
        var keep_flip_to = [];
        var keep_title = [];
        var keep_unassignable = [];
        var keep_sign = [];
        var keep_flip_type = [];
        var keep_account_type = [];
        var keep_account_class = [];
        var keep_account_group = [];
        $('.dropdown-toggle').dropdown();
        $('[data-toggle="tooltip"]').tooltip();
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 10,
            formatters: {
                'names': function(col,row)
                {
                    if(row.name.length > 59)
                        return "<span style='font-weight:bold; cursor:pointer;' tabindex='0' data-trigger='focus' data-toggle='popover' title='Name' data-content='"+row.name+"'>"+row.name.slice(0,59)+"...</span>";
                    else
                        return row.name;
                },
                'titles': function(col, row)
                {
                    label = row.title;
                    if(keep_title[row.id]) {
                        label = keep_title[row.id];
                    }
                    varBtn = '<span tabindex="0" class="title-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='title_span'>"+label+"</span>"+varBtn;
                },
                'unassignables': function(col, row)
                {
                    label = row.unassignable;
                    if(keep_unassignable[row.id]) {
                        label = keep_unassignable[row.id];
                    }
                    varBtn = '<span tabindex="0" class="unassignable-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='unassignable_span'>"+label+"</span>"+varBtn;
                },
                'flip_types': function(col, row)
                {
                    label = row.flip_type;
                    if(keep_flip_type[row.id]) {
                        label = keep_flip_type[row.id];
                    }
                    varBtn = '<span tabindex="0" class="flip_type-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='flip_type_span'>"+label+"</span>"+varBtn;
                },
                'flip_tos': function(col, row)
                {
                    label = row.flip_to;
                    visibility = 'hidden';
                    if(keep_flip_to[row.id]) {
                        label = keep_flip_to[row.id];
                        visibility = 'visible';
                    }
                    if(row.flip_type)
                        visibility = 'visible';
                    varBtn = '<span style="visibility:'+visibility+'" tabindex="0" class="flip_to-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span style='visibility:"+visibility+"' id='flip_to_span'>"+label+"</span>"+varBtn;
                },
                'account_type_ids': function(col, row)
                {
                    label = row.account_type_id;
                    if(keep_account_type[row.id]) {
                        label = keep_account_type[row.id];
                    }
                    varBtn = '<span tabindex="0" class="account_type_id-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='account_type_id_span'>"+label+"</span>"+varBtn;
                },
                'sign_ids': function(col, row)
                {
                    label = row.sign_id;
                    if(keep_sign[row.id]) {
                        label = keep_sign[row.id];
                    }
                    varBtn = '<span tabindex="0" class="sign_id-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='sign_id_span'>"+label+"</span>"+varBtn;
                },
                'account_group_ids': function(col, row)
                {
                    label = row.account_group_id;
                    if(keep_account_group[row.id]) {
                        label = keep_account_group[row.id];
                    }
                    if(label.length > 14) {
                        wrapped = label.slice(0,14)+'...';
                        label = "<span style='font-weight:bold; cursor:pointer;' tabindex='0' data-trigger='focus' data-toggle='popover' title='Name' data-content='"+label+"'>"+wrapped+"</span>";
                    }
                    varBtn = '<span tabindex="0" class="account_group_id-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='account_group_id_span'>"+label+"</span>"+varBtn;
                },
                'account_class_ids': function(col, row)
                {
                    label = row.account_class_id;
                    if(keep_account_class[row.id]) {
                        label = keep_account_class[row.id];
                    }
                    if(label.length > 14) {
                        wrapped = label.slice(0,14)+'...';
                        label = "<span style='font-weight:bold; cursor:pointer;' tabindex='0' data-trigger='focus' data-toggle='popover' title='Name' data-content='"+label+"'>"+wrapped+"</span>";
                    }
                    varBtn = '<span tabindex="0" class="account_class_id-btn glyphicon glyphicon-collapse-down btn btn-sm" role="button" data-html="true" data-toggle="popover" data-placement="top"></span><input type="hidden" value="'+row.id+'" name="account_map_id">';
                    return "<span id='account_class_id_span'>"+label+"</span>"+varBtn;
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"account-maps/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
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

        var selected_title = [];
        var selected_unassignable = [];
        var selected_flip_type = [];
        var selected_flip_to = [];
        var selected_account_type_id = [];
        var selected_sign_id = [];
        var selected_account_class_id = [];
        var selected_account_group_id = [];

        popoverExtention = function(){
            setTimeout(function(){
                $('[data-toggle="popover"]').popover();
                $('.title-btn').attr('data-content',$('#title_container').html());
                $('.unassignable-btn').attr('data-content',$('#unassignable_container').html());
                $('.flip_type-btn').attr('data-content',$('#flip_type_container').html());
                $('.flip_to-btn').attr('data-content',$('#flip_to_container').html());
                $('.account_type_id-btn').attr('data-content',$('#account_type_id_container').html());
                $('.sign_id-btn').attr('data-content',$('#sign_id_container').html());
                $('.account_class_id-btn').attr('data-content',$('#account_class_id_container').html());
                $('.account_group_id-btn').attr('data-content',$('#account_group_id_container').html());

                $('.title-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_title]').select2().select2('open');
                        if(selected_title[$(this).parent().find('#title_span').html().trim()])
                            $('[name=sel_title]').val(selected_title[$(this).parent().find('#title_span').html().trim()]);
                        $(this).next().find('[name=sel_title]').on('select2:close', function(){
                            if($(this).val())
                                updateTitle(this);
                            else
                                $(this).parent().parent().parent().find('.title-btn').popover('hide');
                        });
                        $('[name=sel_title]').off('focus').on('focus',function(){
                            $('[name=sel_title]').change(function(e){
                                updateTitle(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.unassignable-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_unassignable]').select2().select2('open');
                        if(selected_unassignable[$(this).parent().find('#unassignable_span').html().trim()])
                            $('[name=sel_unassignable]').val(selected_unassignable[$(this).parent().find('#unassignable_span').html().trim()]);
                        $(this).next().find('[name=sel_unassignable]').on('select2:close', function(){
                            if($(this).val())
                                updateUnassignable(this);
                            else
                                $(this).parent().parent().parent().find('.unassignable-btn').popover('hide');
                        });
                        $('[name=sel_unassignable]').off('focus').on('focus',function(){
                            $('[name=sel_unassignable]').change(function(e){
                                updateUnassignable(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.flip_type-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_flip_type]').select2().select2('open');
                        if(selected_flip_type[$(this).parent().find('#flip_type_span').html().trim()])
                            $('[name=sel_flip_type]').val(selected_flip_type[$(this).parent().find('#flip_type_span').html().trim()]);
                        $(this).next().find('[name=sel_flip_type]').on('select2:close', function(){
                            if($(this).val() != 'xxx')
                                updateFlipType(this);
                            else
                                $(this).parent().parent().parent().find('.flip_type-btn').popover('hide');
                        });
                        $('[name=sel_flip_type]').off('focus').on('focus',function(){
                            $('[name=sel_flip_type]').change(function(e){
                                updateFlipType(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.flip_to-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_flip_to]').select2().select2('open');
                        if(selected_flip_to[$(this).parent().find('#flip_to_span').html().trim()])
                            $('[name=sel_flip_to]').val(selected_flip_to[$(this).parent().find('#flip_to_span').html().trim()]);
                        /*$(this).next().find('[name=sel_flip_to]').on('select2:close', function(){
                            if($(this).val())
                                updateFlipTo(this);
                            else
                                $(this).parent().parent().parent().find('.flip_to-btn').popover('hide');
                        });*/
                        $('[name=sel_flip_to]').off('focus').on('focus',function(){
                            $('[name=sel_flip_to]').change(function(e){
                                updateFlipTo(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.account_type_id-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_account_type_id]').select2().select2('open');
                        if(selected_account_type_id[$(this).parent().find('#account_type_id_span').html().trim()])
                            $('[name=sel_account_type_id]').val(selected_account_type_id[$(this).parent().find('#account_type_id_span').html().trim()]);
                        $(this).next().find('[name=sel_account_type_id]').on('select2:close', function(){
                            if($(this).val())
                                updateAccountType(this);
                            else
                                $(this).parent().parent().parent().find('.account_type_id-btn').popover('hide');
                        });
                        $('[name=sel_account_type_id]').off('focus').on('focus',function(){
                            $('[name=sel_account_type_id]').change(function(e){
                                updateAccountType(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.sign_id-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_sign_id]').select2().select2('open');
                        if(selected_sign_id[$(this).parent().find('#sign_id_span').html().trim()])
                            $('[name=sel_sign_id]').val(selected_sign_id[$(this).parent().find('#sign_id_span').html().trim()]);
                        $(this).next().find('[name=sel_sign_id]').on('select2:close', function(){
                            if($(this).val())
                                updateSign(this);
                            else
                                $(this).parent().parent().parent().find('.sign_id-btn').popover('hide');
                        });
                        $('[name=sel_sign_id]').off('focus').on('focus',function(){
                            $('[name=sel_sign_id]').change(function(e){
                                updateSign(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.account_class_id-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_account_class_id]').select2().select2('open');
                        if(selected_account_class_id[$(this).parent().find('#account_class_id_span').html().trim()])
                            $('[name=sel_account_class_id]').val(selected_account_class_id[$(this).parent().find('#account_class_id_span').html().trim()]);
                        $(this).next().find('[name=sel_account_class_id]').on('select2:close', function(){
                            if($(this).val())
                                updateClass(this);
                            else
                                $(this).parent().parent().parent().find('.account_class_id-btn').popover('hide');
                        });
                        $('[name=sel_account_class_id]').off('focus').on('focus',function(){
                            $('[name=sel_account_class_id]').change(function(e){
                                updateClass(this);
                                e.stopImmediatePropagation();
                                $(this).off("blur");
                                $(this).blur();
                            });
                        }).focus();
                    },500);
                });
                $('.account_group_id-btn').click(function(){
                    $('span.btn').popover('hide');
                    setTimeout(() => {
                        $(this).popover('show');
                        $(this).next().find('[name=sel_account_group_id]').select2().select2('open');
                        if(selected_account_group_id[$(this).parent().find('#account_group_id_span').html().trim()])
                            $('[name=sel_account_group_id]').val(selected_account_group_id[$(this).parent().find('#account_group_id_span').html().trim()]);
                        $(this).next().find('[name=sel_account_group_id]').on('select2:close', function(){
                            if($(this).val())
                                updateGroup(this);
                            else
                                $(this).parent().parent().parent().find('.account_group_id-btn').popover('hide');
                        });
                        $('[name=sel_account_group_id]').off('focus').on('focus',function(){
                            $('[name=sel_account_group_id]').change(function(e){
                                updateGroup(this);
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

        updateTitle = function(el) {
            $(el).parent().parent().parent().find('#title_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'title',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#title_span').html(data.val);
                    selected_title[data.val] = $(el).val();
                    keep_title[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.title-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateUnassignable = function(el) {
            $(el).parent().parent().parent().find('#unassignable_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'unassignable',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#unassignable_span').html(data.val);
                    selected_unassignable[data.val] = $(el).val();
                    keep_unassignable[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.unassignable-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateFlipType = function(el) {
            $(el).parent().parent().parent().find('#flip_type_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'flip_type',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    if(data.val.length > 1) {
                        $(el).parent().parent().parent().parent().find('#flip_to_span').css('visibility','visible');
                        $(el).parent().parent().parent().parent().find('.flip_to-btn').css('visibility','visible').click();
                    } else {
                        $(el).parent().parent().parent().parent().find('#flip_to_span').css('visibility','hidden').html('');
                        $(el).parent().parent().parent().parent().find('.flip_to-btn').css('visibility','hidden');
                    }
                    $(el).parent().parent().parent().find('#flip_type_span').html(data.val);
                    selected_flip_type[data.val] = $(el).val();
                    keep_flip_type[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.flip_type-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateFlipTo = function(el) {
            $(el).parent().parent().parent().find('#flip_to_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'flip_to',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#flip_to_span').html(data.val);
                    selected_flip_to[data.val] = $(el).val();
                    keep_flip_to[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.flip_to-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateAccountType = function(el) {
            $(el).parent().parent().parent().find('#account_type_id_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'account_type_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#account_type_id_span').html(data.val);
                    selected_account_type_id[data.val] = $(el).val();
                    keep_account_type[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.account_type_id-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateSign = function(el) {
            $(el).parent().parent().parent().find('#sign_id_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'sign_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    $(el).parent().parent().parent().find('#sign_id_span').html(data.val);
                    selected_sign_id[data.val] = $(el).val();
                    keep_sign[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.sign_id-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateClass = function(el) {
            $(el).parent().parent().parent().find('#account_class_id_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'account_class_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    label = data.val;
                    if(data.val.length > 14) {
                        wrapped = label.slice(0,14)+'...';
                        label = "<span style='font-weight:bold; cursor:pointer;' tabindex='0' data-trigger='focus' data-toggle='popover' title='Name' data-content='"+data.val+"'>"+wrapped+"</span>";
                    }
                    $(el).parent().parent().parent().find('#account_class_id_span').html(label);
                    setTimeout(function(){
                        $('[data-toggle="popover"]').popover();
                    },500);
                    selected_account_class_id[data.val] = $(el).val();
                    keep_account_class[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.account_class_id-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        updateGroup = function(el) {
            $(el).parent().parent().parent().find('#account_group_id_span').html("<img src='img/loading.gif' style='width:30px'>");
            $.post('<?=route('account-map.update')?>',{
                account_map_id: $(el).parent().parent().parent().find('[name=account_map_id]').val(),
                id: $(el).val(),
                type: 'account_group_id',
                _token: $('[name=_token]').val()
            }).success(function(data){
                if(data) {
                    label = data.val;
                    if(data.val.length > 14) {
                        wrapped = label.slice(0,14)+'...';
                        label = "<span style='font-weight:bold; cursor:pointer;' tabindex='0' data-trigger='focus' data-toggle='popover' title='Name' data-content='"+data.val+"'>"+wrapped+"</span>";
                    }
                    $(el).parent().parent().parent().find('#account_group_id_span').html(label);
                    setTimeout(function(){
                        $('[data-toggle="popover"]').popover();
                    },500);
                    selected_account_group_id[data.val] = $(el).val();
                    keep_account_group[data.id] = data.val;
                }
                $(el).parent().parent().parent().find('.account_group_id-btn').popover('hide');
            }).error(function(er){
                console.log(er.responseJSON);
            });
        }

        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        $('[name=flip_type]').change(function(){
            if($(this).val() == '') 
                $('[name=flip_to]').attr('disabled',true).val('');
            else
                $('[name=flip_to]').attr('disabled',false);
        });
        $('[name=flip_type]').change();
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    th:nth-child(6),th:nth-child(8),th:nth-child(10),th:nth-child(11) {
        width: 10%;
    }
    th:nth-child(4),th:nth-child(12) {
        width: 5%;
    }
    th:nth-child(9) {
        width: 6%;
    }
    th:nth-child(2),th:nth-child(5),th:nth-child(7) {
        width: 7%;
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