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
            <h3><strong>Chart of Account Groups</strong></h3>
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
                    <th data-column-id="name">Group Name</th>
                    <th data-column-id="country_id">Country</th>
                    <th data-column-id="map_group_id">Map Group</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($chart_of_account_groups as $group) : ?>
                    <tr>
                        <td><?=$group->id?></td>
                        <td><?=$group->name?></td>
                        <td><?=$group->country->country_name?></td>
                        <td><?=$group->map_group ? $group->map_group->name:''?></td>
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
        @include('v1.chart-of-account-groups.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($chart_of_account_groups as $group) : ?>
    <div class="modal fade bs-example-modal-sm<?=$group->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete
            <strong><?=$group->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('chart-of-account-group.delete',[$group->id])?>" class="btn btn-danger">Delete</a>
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
                'commands': function(column, row)
                {
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"chart-of-account-groups/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return "<a class=\"btn btn-xs command-view\" href=\"/chart-of-account-groups/list/" + row.id + "\" data-toggle=\"tooltip\" title=\"Chart of Account Group\"><span class=\"glyphicon glyphicon-eye-open\"></span></a> "+varEdit+varDelete;
                }
            }
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        $('#country_id').change(function(){
            if($(this).val()) {
                getMapGroups($(this).val())
            } else {
                $('#map_group_id').html('<option>select</option>');
            }
        });
        let getMapGroups = function(val) {
            $.get( "<?=route('country.map-groups',[''])?>/"+val, function( data ) {
                let option = "<option value=''>- select -</option>";
                for(var a = 0; a < data.length; a++) {
                    if('<?=isset($chart_of_account_group->map_group_id) ? $chart_of_account_group->map_group_id : 'x'?>' == data[a]['id'] || '<?=old('map_group_id')?>' == data[a]['id'])
                        option += "<option value='"+data[a]['id']+"' selected>"+data[a]['name']+"</option>";
                    else
                        option += "<option value='"+data[a]['id']+"'>"+data[a]['name']+"</option>";
                }
                $('#map_group_id').html(option);
            });
        }
        getMapGroups($('#country_id').val());
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
@stop