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
            <h3><strong>Field Informations</strong></h3>
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
                    <th data-column-id="table_name">Table Name</th>
                    <th data-column-id="table_column">Field / Column Name</th>
                    <th data-column-id="link" data-formatter="links">URL</th>
                    <th data-column-id="column_description">Description</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($field_infos as $field_info) : ?>
                    <tr>
                        <td><?=$field_info->id?></td>
                        <td><?=$field_info->table_name?></td>
                        <td><?=$field_info->table_column?></td>
                        <td><?=$field_info->link?></td>
                        <td><?=$field_info->table_column_description?></td>
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
        @include('v1.field-informations.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($field_infos as $field_info) : ?>
    <div class="modal fade bs-example-modal-sm<?=$field_info->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete information on
            <strong><?=$field_info->table_column.' of '.$field_info->table_name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('field-information.delete',[$field_info->id])?>" class="btn btn-danger">Delete</a>
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
                'links': function(col, row)
                {
                    return "<a href='"+row.link+"' target='_blank'>"+row.link+"</a>";
                },
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"field-informations/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return varEdit+varDelete;
                }
            }
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        $('#table_name').change(function(){
            if($(this).val()) {
                getTableColumn($(this).val())
            } else {
                $('#table_column').html('<option>- select -</option>');
            }
        });
        let getTableColumn = function(val) {
            $.get( "<?=route('field-information.table-columns',[''])?>/"+val, function( data ) {
                let option = "<option value=''>- select -</option>";
                for(var a = 0; a < data.length; a++) {
                    if('<?=isset($address->state_province_name) ? $address->state_province_name : 'x'?>' == data[a]['Field'] || '<?=old('table_column')?>' == data[a]['Field'])
                        option += "<option selected>"+data[a]['Field']+"</option>";
                    else
                        option += "<option>"+data[a]['Field']+"</option>";
                }
                $('#table_column').html(option);
            });
        }
        getTableColumn($('#table_name').val());
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
@stop