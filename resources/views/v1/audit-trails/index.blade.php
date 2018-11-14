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
            <h3><strong>Audit Trails</strong></h3>
        </div>
    </div>
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="user" data-align="center">User</th>
                    <th data-column-id="activity" data-align="center">Activity</th>
                    <th data-column-id="created_at" data-align="center" data-order="desc">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($audit_trails as $audit_trail) : ?>
                    <tr>
                        <td><?=$audit_trail->id?></td>
                        <td><?=$audit_trail->user['first_name'].' '.$audit_trail->user['last_name']?></td>
                        <td><?=$audit_trail->activity?></td>
                        <td><?=$audit_trail->created_at.' - '.$audit_trail->created_at->diffForHumans()?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.dropdown-toggle').dropdown();
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 25
        });
        confirmModal = function(test){
            $($(test).data('target')).modal('show');
        }
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
<style type="text/css">
    thead tr th{
        text-align: center !important;
    }
</style>

@stop