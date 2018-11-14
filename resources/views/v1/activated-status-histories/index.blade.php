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
            <h3><strong>Status History</strong></h3>
        </div>
    </div>
    <button type="button" onclick="history.back()" class="btn yellow-gradient pull-left">
        <strong>Back</strong>
    </button>
    <div class="col-md-12" style="background-color: #fff; margin-top: 15px;">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id">ID</th>
                    <th data-column-id="code">Activity</th>
                    <th data-column-id="name">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($activities as $activity) : ?>
                    <tr>
                        <td><?=$activity->id?></td>
                        <td><?=$activity->activated ? 'Activated':'Deactivated'?></td>
                        <td><?=$activity->created_at.' - '.$activity->created_at->diffForHumans()?></td>
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
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/assets/jquery.bootgrid-1.3.1/jquery.bootgrid.css">
@stop