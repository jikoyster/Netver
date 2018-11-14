@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 15px;">
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
    @if(Request::segment(1) == 'testing')
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                <h3><strong>Testing</strong></h3>
            </div>
        </div>
    @endif
    <div class="col-md-12" style="margin-top: 15px;">
        <div class="form-group col-xs-12">
            <label for="name" class="col-xs-5 control-label text-right text-white">Calculator 1</label>

            <div class="col-xs-2 pull-left text-center" style="margin: 0 auto;">
                <input type="text" class="form-control" id="calculator1" name="calculator1" style="text-align: right; font-weight: bold;">
            </div>
        </div>
        <div class="form-group col-xs-12">
            <label for="name" class="col-xs-5 control-label text-right text-white">Calendar</label>

            <div class="col-xs-2 pull-left text-center" style="margin: 0 auto;">
                <input type="text" class="form-control" id="nieldate" name="nieldate" style="text-align: center; font-weight: bold; font-size: 17px;" placeholder="YYYY-MM-DD">
            </div>
        </div>
    </div>
    <div class="text-center col-md-12" style="margin-top: 17px;">
        <label class="control-label text-white">below is still under construction...</label>
        <table class="table table-striped" style="background: #fff;">
            <thead style="font-weight: bold;">
                <tr>
                    <td align="left">No</td>
                    <td align="left">Description</td>
                    <td>Date</td>
                    <td align="right">Debit</td>
                    <td align="right">Credit</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody class="from-database">
                <?php
                    $tot_dbt = 0;
                    $tot_crt = 0;
                ?>
                @foreach($test_accts as $acct)
                    <tr class="editables">
                      <td id="id" align="left">{{$acct->id}}</td>
                      <td id="description" align="left">{{$acct->description}}</td>
                      <td id="date">{{$acct->date->format('Y-m-d')}}</td>
                      <td id="debit" align="right">{{$acct->amount >= 0 ? number_format(str_replace(',','',$acct->amount),2):''}}</td>
                      <td id="credit" align="right">{{$acct->amount < 0 ? number_format(abs(str_replace(',','',$acct->amount)),2):''}}</td>
                      <td id="action">
                        <span class="glyphicon glyphicon-edit"></span>
                        <span class="glyphicon glyphicon-trash delete-niel"></span>
                      </td>
                    </tr>
                    <?php
                        if($acct->amount >= 0)
                            $tot_dbt += str_replace(',','',$acct->amount);
                        else
                            $tot_crt += str_replace(',','',$acct->amount);
                    ?>
                @endforeach
            </tbody>
            <tbody>
                <tr style="font-weight: bold;">
                    <td colspan="3" align="right">Total</td>
                    <td id="total_debit" align="right">{{$tot1 = number_format($tot_dbt,2)}}</td>
                    <td id="total_credit" align="right">{{$tot2 = number_format(abs($tot_crt),2)}}</td>
                    <td id="total_action">
                        @if($tot1 == $tot2 && $test_accts->count())
                            <a class="btn btn-primary" href="{{route('test-post')}}">POST</a>
                        @endif
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr class="new-entry">
                    <td></td>
                    <td><input type="" name="description"></td>
                    <td><input type="" name="date"></td>
                    <td align="right"><input type="" class="text-right" name="debit"></td>
                    <td align="right"><input type="" class="text-right" name="credit"></td>
                    <td>
                        <span class="glyphicon glyphicon-plus add-niel" style="cursor: pointer;"></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{ asset('assets/calculator/jquery.plugin.js') }}"></script> 
<script type="text/javascript" src="{{ asset('assets/calculator/jquery.calculator.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">
    $(function(){
        addCommas = function(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        $('[name=calculator1]').blur(function(){
            calc1 = 0;
            setTimeout(()=>{
                if($(this).val() > 0) {
                    if($(this).val())
                        calc1 = Number($(this).val());
                    $(this).val(addCommas(calc1.toFixed(2)));
                } else {
                    $(this).val('');
                }
            },500);
        }).calculator({
            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
            useThemeRoller: true
        });
        $( "#nieldate" ).css('text-align','center').change(function(){
            if($(this).val()=='')
                $(this).css('text-align','center');
        });
        $( "#nieldate" ).datepicker({
            format:'yyyy-mm-dd'
        }).on('changeDate',function(e){
            if(e.viewMode == 'days') {
                $( "#nieldate" ).datepicker('hide');
                $(this).css('text-align','right');
            }
        });

        /* custom new */
        var theEditables = function() {
            $('.editables').off().on('click',function(){
                if($(this).attr('class') == 'editables') {
                    $(this).attr('class','locked');
                    var description = $(this).find('#description');
                    var date = $(this).find('#date');
                    var debit = $(this).find('#debit');
                    var credit = $(this).find('#credit');
                    var action = $(this).find('#action');

                    var descriptionElem = $('<input>')
                        .css('text-align','left')
                        .val(description.html());
                    description.attr('id',description.attr('id')+'-edit').html(descriptionElem);
                    var dateElem = $('<input>')
                        .attr('placeholder','YYYY-MM-DD')
                        .css('font-weight','bold')
                        .css('text-align','center')
                        .datepicker({format:'yyyy-mm-dd'})
                        .on('changeDate',function(e){
                            if(e.viewMode == 'days') {
                                $( this ).datepicker('hide');
                                $(this).css('text-align','right');
                            }
                        })
                        .val(date.html());
                    date.attr('id',date.attr('id')+'-edit').html(dateElem);
                    var debitElem = $('<input>')
                        .css('text-align','right')
                        .focus(function(){
                            val = $(this).val();
                            $(this).val(val.replace(/,/g,''));
                        }).blur(function(){
                            calc1 = 0;
                            setTimeout(()=>{
                                if($(this).val() > 0) {
                                    if($(this).val())
                                        calc1 = Number($(this).val());
                                    $(this).val(addCommas(calc1.toFixed(2)));
                                } else {
                                    $(this).val('');
                                }
                                dbt = parseFloat($(this).val().replace(/,/g, ''));
                                cdt = parseFloat($(this).parent().parent().find('#credit-edit > input').val().replace(/,/g, ''));
                                if(isNaN(dbt)) {
                                    $(this).val(Number(0).toFixed(2));
                                    dbt = 0;
                                }
                                if(isNaN(cdt)) {
                                    $(this).parent().parent().find('#credit-edit > input').val(Number(0).toFixed(2));
                                    cdt = 0;
                                }
                            },500);
                        }).calculator({
                            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                            useThemeRoller: true
                        }).val(debit.html());
                    debit.attr('id',debit.attr('id')+'-edit').html(debitElem);
                    var creditElem = $('<input>')
                        .css('text-align','right')
                        .focus(function(){
                            val = $(this).val();
                            $(this).val(val.replace(/,/g,''));
                        }).val(credit.html())
                        .blur(function(){
                            calc1 = 0;
                            setTimeout(()=>{
                                if($(this).val() > 0) {
                                    if($(this).val())
                                        calc1 = Number($(this).val());
                                    $(this).val(addCommas(calc1.toFixed(2)));
                                } else {
                                    $(this).val('');
                                }
                                dbt = parseFloat($(this).parent().parent().find('#debit-edit > input').val().replace(/,/g, ''));
                                cdt = parseFloat($(this).val().replace(/,/g, ''));
                                if(isNaN(dbt)) {
                                    $(this).parent().parent().find('#debit-edit > input').val(Number(0).toFixed(2));
                                    dbt = 0;
                                }
                                if(isNaN(cdt)) {
                                    $(this).val(Number(0).toFixed(2));
                                    cdt = 0;
                                }
                            },500);
                        }).calculator({
                            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                            useThemeRoller: true
                        });
                    credit.attr('id',credit.attr('id')+'-edit').html(creditElem);
                    var actionElem = $('<span class="glyphicon glyphicon-floppy-saved update-niel"></span>')
                        .click(function(){
                            $.post('<?=route('test-update')?>', {
                                _token: '{{csrf_token()}}',
                                id: $(this).parent().parent().find('#id').html(),
                                description: $(this).parent().parent().find('#description-edit > input').val(),
                                date: $(this).parent().parent().find('#date-edit > input').val(),
                                debit: $(this).parent().parent().find('#debit-edit > input').val(),
                                credit: $(this).parent().parent().find('#credit-edit > input').val()
                            }).success((data)=>{
                                var d = new Date(data.date);
                                var month = (d.getMonth() + 1);
                                var debit = '';
                                var credit = '';
                                var amount = data.amount.replace(/,/g, "");
                                if(month < 10)
                                    month = '0'+month;
                                if(amount < 0) {
                                    credit = Math.abs(amount);
                                    if( credit > 0)
                                        credit = parseFloat(Number(credit).toFixed(2)).toLocaleString('en');
                                    else
                                        credit = '';
                                } else {
                                    debit = amount;
                                    if(debit > 0)
                                        debit = parseFloat(Number(debit).toFixed(2)).toLocaleString('en');
                                    else
                                        debit = '';
                                }
                                $(this).parent().parent().attr('class','editables');
                                $(this).parent().parent().find('#description-edit').attr('id','description').html(data.description);
                                $(this).parent().parent().find('#date-edit').attr('id','date').html(d.getFullYear()+'-'+month+'-'+d.getDate());
                                $(this).parent().parent().find('#debit-edit').attr('id','debit').html(debit);
                                $(this).parent().parent().find('#credit-edit').attr('id','credit').html(credit);
                                $(this).parent().parent().find('#action-edit').attr('id','action').html('<span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-trash delete-niel"></span>');

                                var total_debit = $('#total_debit');
                                total_debit.html(parseFloat(Number(data.total_debit).toFixed(2)).toLocaleString('en'));
                                var total_credit = $('#total_credit');
                                total_credit.html(parseFloat(Number(data.total_credit).toFixed(2)).toLocaleString('en'));
                                if(total_debit.html() == total_credit.html())
                                    $('#total_action').html('<a class="btn btn-primary" href="{{route('test-post')}}">POST</a>');
                                else
                                    $('#total_action').html('');

                                theEditables();
                            }).error(function(error){
                                if(error.responseJSON.message != 'Unauthenticated.')
                                    console.log(error.responseJSON.errors.issue[0]);
                            });
                        });
                    action.attr('id',action.attr('id')+'-edit').html(actionElem);
                }
            });
            $('.delete-niel').off().on('click',function(e){
                if(!confirm('Are you sure you want to delete #'+$(this).parent().parent().find('#id').html()+'?')) {
                    var parent = $(this).parent();
                    setTimeout(()=>{
                        parent.parent().attr('class','editables');
                        var description = parent.parent().find('#description-edit');
                        description.attr('id','description').html(description.find('input').val());
                        var date = parent.parent().find('#date-edit');
                        date.attr('id','date').html(date.find('input').val());
                        var debit = parent.parent().find('#debit-edit');
                        debit.attr('id','debit').html(debit.find('input').val());
                        var credit = parent.parent().find('#credit-edit');
                        credit.attr('id','credit').html(credit.find('input').val());
                        var action = parent.parent().find('#action-edit');
                        action.attr('id','action').html('<span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-trash delete-niel"></span>');
                    },10);
                } else {
                    $.post('<?=route('test-delete')?>',{
                        _token: '{{csrf_token()}}',
                        id: $(this).parent().parent().find('#id').html()
                    });
                    var minus_debit = Number($(this).parent().parent().find('#debit').html().replace(/,/g, ""));
                    var total_debit = $('#total_debit');
                    total_debit.html(parseFloat((Number(total_debit.html().replace(/,/g, "")) - minus_debit).toFixed(2)).toLocaleString('en'));
                    var minus_credit = Number($(this).parent().parent().find('#credit').html().replace(/,/g, ""));
                    var total_credit = $('#total_credit');
                    total_credit.html(parseFloat((Number(total_credit.html().replace(/,/g, "")) - minus_credit).toFixed(2)).toLocaleString('en'));
                    if(total_debit.html() == total_credit.html())
                        $('#total_action').html('<a class="btn btn-primary" href="{{route('test-post')}}">POST</a>');
                    else
                        $('#total_action').html('');
                    $(this).parent().parent().remove();
                }
            });
        }
        theEditables();
        $('[name=date]').attr('placeholder','YYYY-MM-DD')
        .css('font-weight','bold')
        .css('text-align','center')
        .datepicker({format:'yyyy-mm-dd'})
        .on('changeDate',function(e){
            if(e.viewMode == 'days') {
                $( this ).datepicker('hide');
                $(this).css('text-align','right');
            }
        });
        $('[name=debit],[name=credit]')
            .blur(function(){
                calc1 = 0;
                setTimeout(()=>{
                    if($(this).val() > 0) {
                        if($(this).val())
                            calc1 = Number($(this).val());
                        $(this).val(addCommas(calc1.toFixed(2)));
                    } else {
                        $(this).val('');
                    }
                    dbt = parseFloat($(this).parent().parent().find('[name=debit]').val().replace(/,/g, ''));
                    cdt = parseFloat($(this).parent().parent().find('[name=credit]').val().replace(/,/g, ''));
                    if(isNaN(cdt)) {
                        $(this).parent().parent().find('[name=credit]').val(Number(0).toFixed(2));
                        cdt = 0;
                    }
                    if(isNaN(dbt)) {
                        $(this).parent().parent().find('[name=debit]').val(Number(0).toFixed(2));
                        dbt = 0;
                    }
                },500);
            }).calculator({
                layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                useThemeRoller: true
            });
            $('.add-niel').click(function(){
                $.post('<?=route('test-store')?>', {
                    _token: '{{csrf_token()}}',
                    description: $('[name=description]').val(),
                    date: $('[name=date]').val(),
                    debit: $('[name=debit]').val(),
                    credit: $('[name=credit]').val()
                }).success((data)=>{
                    if(data) {
                        var d = new Date(data.date);
                        var month = (d.getMonth() + 1);
                        var debit = '';
                        var debit_num = 0;
                        var credit = '';
                        var credit_num = 0;
                        var amount = data.amount.replace(/,/g, "");
                        if(month < 10)
                            month = '0'+month;
                        if(amount < 0) {
                            credit = Math.abs(amount);
                            if( credit > 0) {
                                credit_num = Number(credit).toFixed(2);
                                credit = parseFloat(credit_num).toLocaleString('en');
                            } else {
                                credit = '';
                            }
                        } else {
                            debit = amount;
                            if(debit > 0) {
                                debit_num = Number(debit).toFixed(2);
                                debit = parseFloat(debit_num).toLocaleString('en');
                            } else {
                                debit = '';
                            }
                        }
                        html = '<tr class="editables">';
                            html += '<td id="id" align="left">'+data.id+'</td>';
                            html += '<td id="description" align="left">'+data.description+'</td>';
                            html += '<td id="date">'+d.getFullYear()+'-'+month+'-'+d.getDate()+'</td>';
                            html += '<td id="debit" align="right">'+debit+'</td>';
                            html += '<td id="credit" align="right">'+credit+'</td>';
                            html += '<td id="action">';
                                html += '<span class="glyphicon glyphicon-edit"></span>';
                                html += '<span class="glyphicon glyphicon-trash delete-niel"></span>';
                            html += '</td>';
                        html += '</tr>';
                        $('.from-database').append(html);
                        var total_debit = $('#total_debit');
                        var total_credit = $('#total_credit');
                        var total_debit_val = Number(total_debit.html().replace(/,/g, ""));
                        var total_credit_val = Number(total_credit.html().replace(/,/g, ""));
                        total_debit.html(parseFloat((total_debit_val + Number(debit_num)).toFixed(2)).toLocaleString('en'));
                        total_credit.html(parseFloat((total_credit_val + Number(credit_num)).toFixed(2)).toLocaleString('en'));
                        if(total_debit.html() == total_credit.html())
                            $('#total_action').html('<a class="btn btn-primary" href="{{route('test-post')}}">POST</a>');
                        else
                            $('#total_action').html('');

                        $(this).parent().parent().find('[name=debit],[name=credit]').val('');
                        theEditables();
                    }
                }).error(function(error){
                    if(error.responseJSON.message != 'Unauthenticated.')
                        console.log(error.responseJSON.errors.issue[0]);
                });
            });
        /* end custom new */
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/calculator/jquery.calculator.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/calculator/black-tie-jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/datepicker.css')}}">

<style type="text/css">
    .spacer { padding: 50px 0; }
    .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
        background: #111;
        color: #fff;
    }

    .glyphicon {
        cursor: pointer;
    }
    .glyphicon-edit {
        color: #3097D1;
    }
    .glyphicon-trash {
        color: red;
    }
    .glyphicon-floppy-saved,
    .glyphicon-plus {
        color: #2ab27b;
    }
</style>
@stop