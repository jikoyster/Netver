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
            <h3><strong>Menus</strong></h3>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="name" class="col-md-3 control-label text-left text-white">Group: </label>
        <div class="col-md-9 pull-left text-center" style="margin: 0 auto; float: unset;">
            <select class="form-control" name="group">
                <option value="0">all</option>
                <?php foreach($groups as $role) : ?>
                    <option value="<?=$role->id?>"><?=$role->name?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit" data-toggle="modal" data-target=".bs-add-modal" class="btn pull-right">
        <strong>Add New</strong>
    </button>
    <div class="col-md-12 menus-table-container" style="background-color: #fff; margin-top: 15px;">
        
    </div>
</div>

<div class="modal fade bs-add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        @include('v1.menus.add')
      </div>
    </div>
  </div>
</div>


<?php foreach($menus as $menu) : ?>
    <div class="modal fade bs-example-modal-sm<?=$menu->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to delete Menu
            <strong><?=$menu->name?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="<?=route('menu.delete',[$menu->id])?>" class="btn btn-danger">Delete</a>
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
        $('[name="group"]').change(function(){
            $.ajax({
              url: '/menus/data/'+$(this).val(),
            }).done(function(data){
                $('.menus-table-container').html(data);
            });
        });

        $('[name="parent_id"]').change(function(){
            if($(this).val())
                $('.group_id-container').toggle('hide');
            else
                $('.group_id-container').toggle('show');
        });

        $('[name="has_children"]').change(function(){
            if($(this).is(':checked'))
                $('.link-container').toggle('hide');
            else
                $('.link-container').toggle('show');
        });

        $('[name="has_parent"]').change(function(){
            if($(this).is(':checked'))
                $('.parent_id-container').toggle('show');
            else
                $('.parent_id-container').toggle('hide');
        });
        
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
@stop