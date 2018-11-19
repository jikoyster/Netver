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
            <h3><strong>Tax Rates</strong></h3>
        </div>
    </div>
    @can('add')
        <button type="button" onclick="window.location='{{route('tax-rate.add-grouped')}}'" class="btn pull-right">
            <strong>Add New Tax Group</strong>
        </button>
        <button type="button" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right" style="margin-right: 7px;">
            <strong>Add New Tax</strong>
        </button>
    @endcan
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="tax_code">Tax Code</th>
                    <th data-column-id="name">Name</th>
                    <th data-column-id="country">Country</th>
                    <th data-column-id="province_state">Province / State</th>
                    <th data-column-id="city">City</th>
                    <th data-column-id="tax_rate" data-align="right" data-header-align="right">Tax Rate</th>
                    <th data-column-id="grouped_tax_rates">Grouped</th>
                    <th data-formatter="commands">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tax_rates as $tax_rate) : ?>
                    <tr>
                        <td><?=$tax_rate->id?></td>
                        <td><?=$tax_rate->tax_code?></td>
                        <td><?=$tax_rate->name?></td>
                        <td><?=$tax_rate->state_province->country->country_name?></td>
                        <td><?=$tax_rate->state_province->state_province_name?></td>
                        <td><?=$tax_rate->city?></td>
                        <td><?=number_format(str_replace(',','',$tax_rate->tax_rate),5)?></td>
                        <td><?=$tax_rate->grouped_tax_rates->count()?></td>
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
        @include('v1.tax-rates.add')
      </div>
    </div>
  </div>
</div>

<?php foreach($tax_rates as $tax_rate) : ?>
    <div class="modal fade bs-example-modal-sm<?=$tax_rate->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete tax rate
            <strong><?=$tax_rate->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('tax-rate.delete',[$tax_rate->id])?>" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>
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
                    varGrouped = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"tax-rates/edit/" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    if(row.grouped_tax_rates > 0) {
                        varGrouped = " <a class=\"btn btn-xs command-edit\" href=\"tax-rates/edit-grouped/" + row.id + "\"><span class=\"glyphicon glyphicon-compressed\"></span></a> ";
                    }
                    return varEdit+varDelete+varGrouped;
                }
            }
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        let getStateProvince = function(val) {
            $.get( "<?=route('country.state',[''])?>/"+val, function( data ) {
                let option = "<option value=''>- select -</option>";
                for(var a = 0;  a < data.length; a++) {
                    if('<?=old('province_state')?>' == data[a]['id'])
                        option += "<option value='"+data[a]['id']+"' selected>"+data[a]['state_province_name']+"</option>";
                    else
                        option += "<option value='"+data[a]['id']+"'>"+data[a]['state_province_name']+"</option>";
                }
                $('#_province_state').html(option);
            });
        }
        $('#_country').change(function(){
            if($(this).val()) {
                getStateProvince($(this).val())
            } else {
                $('#province_state').html('<option>- select -</option>');
            }
        }).change();

        $('[name=_tax_rate]').off('blur').on('blur',function(){
            if(isNaN($(this).val()))
                $(this).val(0);
            else
                $(this).val(parseFloat($(this).val()).toFixed(5));
        });
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<link rel="stylesheet" href="{{asset('assets/datepicker/datepicker.css')}}">
<style type="text/css">
    .datepicker {
        z-index: 9999;
    }
    th:nth-child(7) {
        width: 10%;
    }
    th:nth-child(8),td:nth-child(8) {
        width: 0px;
        visibility: hidden;
    }
    .help-block {
        margin: 0;
    }
    .glyphicon-compressed {
        font-size: 17px;
    }
</style>
@stop