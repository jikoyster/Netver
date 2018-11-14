@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 15px; width: 1728px; margin-top: 0;">
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
    <div class="ajax-alert"></div>
    <div class="form-group" style="margin-bottom: 30px;">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
            <h3><strong>Company Account Split Journal</strong></h3>
        </div>
    </div>

    <div class="col-xs-12 hidden form-group{{ $errors->has('group_source') ? ' has-error' : '' }}" style="margin-bottom: 0;">
        <div>
        <label for="group_source" class="pull-left control-label text-white">Journal</label>

        <div class="pull-left text-center" style="margin: 0 auto; float: unset; padding-left: 15px; padding-right: 15px;">
            <select class="form-control" id="group_source" name="group_source" disabled style="width: 163px;">
                <option value="">-select-</option>
                @foreach($all_journals as $journal)
                    <option value="{{$journal->id}}" {{$journal->id == 5 ? 'selected':''}}>{{$journal->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('group_source'))
                <span class="help-block">
                    <strong>{{ $errors->first('group_source') }}</strong>
                </span>
            @endif
        </div>
        @if($title = auth()->user()->table_column_description('g_journals','group_source'))
            <div class="col-xs-2" style="padding: 0;">
                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
            </div>
        @endif
    
    @if($locations->where('active',1)->count() > 0)        
        <label for="location" class="pull-left control-label text-white">Location</label>

        <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
            <select class="form-control" id="location" name="location">
                <option value="">-select-</option>
                @foreach($locations->where('active',1) as $location)
                    <option value="{{$location->name}}" {{($gjournals->count() && $gjournals->last()->location == $location->name) ? 'selected':''}}>{{$location->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('location'))
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>
        @if($title = auth()->user()->table_column_description('g_journals','location'))
            <div class="col-xs-2" style="padding: 0;">
                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
            </div>
        @endif
    @endif
    @if($segments->where('active',1)->count() > 0)
        <label for="segment1" class="pull-left control-label text-white">Segment</label>

        <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
            <select class="form-control" id="segment1" name="segment1">
                <option value="">-select-</option>
                @foreach($segments->where('active',1) as $segment)
                    <option value="{{$segment->name}}" {{($gjournals->count() && $gjournals->last()->segment == $segment->name) ? 'selected':''}}>{{$segment->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('segment1'))
                <span class="help-block">
                    <strong>{{ $errors->first('segment1') }}</strong>
                </span>
            @endif
        </div>
        @if($title = auth()->user()->table_column_description('g_journals','segment'))
            <div class="col-xs-2" style="padding: 0;">
                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
            </div>
        @endif
    @endif
    @if($job_projects->where('active',1)->count() > 0)
        <label for="job_project1" class="pull-left control-label text-white">Job / Project</label>

        <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset; width: 16%;">
            <select class="form-control" id="job_project1" name="job_project1">
                <option value="">-select-</option>
                @foreach($job_projects->where('active',1) as $job_project)
                    <option value="{{$job_project->name}}" {{($gjournals->count() && $gjournals->last()->job_project == $job_project->name) ? 'selected':''}}>{{$job_project->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('job_project1'))
                <span class="help-block">
                    <strong>{{ $errors->first('job_project1') }}</strong>
                </span>
            @endif
        </div>
        @if($title = auth()->user()->table_column_description('g_journals','job_project'))
            <div class="col-xs-2" style="padding: 0;">
                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
            </div>
        @endif
    @endif
    <label class="pull-right text-white" style="margin: 14px 0 0;">Transaction No:  {{$trans_no = $gjournals->count() ? $gjournals[0]->transaction_no : sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0x0fff ) | 0x4000, mt_rand( 0, 0x3fff ) | 0x8000, mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ))}}</label>
    </div>
    </div>
    <div class="text-center col-md-12" style="margin-top: 17px;">
        <table class="table table-striped" style="background: #fff;">
            <thead style="font-weight: bold;">
                <tr style="font-weight: bold; background-color: #000; color: #fff;">
                    <td>ID</td>
                    <td align="left">Line</td>
                    <td align="left">Description</td>
                    <td>Date</td>
                    <td align="left">{{$chart_of_accounts->count() ? 'Account':''}}</td>
                    <td align="right">Debit</td>
                    <td></td>
                    <td align="right">Credit</td>
                    <td></td>
                    <td>{{$segments->count() ? 'Segment':''}}</td>
                    <td>{{$job_projects->count() ? 'Job / Project':''}}</td>
                    <td></td>
                    <td align="left"><span class="glyphicon glyphicon-flag"></span></td>
                    <td><span class="glyphicon glyphicon-file"></span></td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody class="from-database">
                <?php
                    $tot_dbt = 0;
                    $tot_crt = 0;
                ?>
                @foreach($gjournals as $index => $journal)
                    <tr class="editables" id="gjournal-{{$journal->id}}">
                      <td id="id">{{$journal->id}}</td>
                      <td id="transaction_line_no" align="left">{{($journal->trans_line_no)}}</td>
                      <td id="description" align="left">{{$journal->description}}</td>
                      <td id="date">{{$journal->date->format('Y-m-d')}}</td>
                      <td id="account" align="left">{{$chart_of_accounts->count() ? $journal->account:''}}</td>
                      <td id="debit" align="right">{{$journal->amount >= 0 ? number_format(str_replace(',','',$journal->amount),2):''}}</td>
                      <td></td>
                      <td id="credit" align="right">{{$journal->amount < 0 ? number_format(abs(str_replace(',','',$journal->amount)),2):''}}</td>
                      <td></td>
                      <td id="segment">{{$segments->count() ? $journal->segment:''}}</td>
                      <td id="job_project">{{$job_projects->count() ? $journal->job_project:''}}</td>
                      <td></td>
                      <td id="flag">
                        <label class="container-check pull-left">
                          <input type="checkbox" class="form-control pull-right" {{$journal->flag ? 'checked':''}}>
                          <span class="checkmark"></span>
                        </label>
                      </td>
                      <td id="note">
                        @if($journal->note)
                            <span style='font-weight:bold; cursor:pointer; color: inherit;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' data-placement="top" title='Note' data-content="{{$journal->note}}"></span>
                        @else
                            <span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus' tabindex='0'></span>
                        @endif
                      </td>
                      <td id="action">
                        <input type="hidden" value="{{$journal->amount}}">
                        <span class="glyphicon glyphicon-edit" style="margin-right: 12px;"></span>
                        <span class="glyphicon glyphicon-trash delete-niel"></span>
                      </td>
                    </tr>
                    <?php
                        if($journal->amount >= 0)
                            $tot_dbt += str_replace(',','',$journal->amount);
                        else
                            $tot_crt += str_replace(',','',$journal->amount);
                    ?>
                @endforeach
            </tbody>
            <tbody>
                <tr style="font-weight: bold; background-color: #000; color: #fff;">
                    <td></td>
                    <td style="width: 550px;" colspan="6" align="right"></td>
                    <td style="width: 150px;" id="total_debit" align="right">{{$tot1 = number_format($tot_dbt,2)}}</td>
                    <td style="width: 240px;" id="total_credit" align="right">{{$tot2 = number_format(abs($tot_crt),2)}}</td>
                    <td style="width: 300px;" id="total_balance" colspan="2" style="text-align: right;">Out of Balance:&nbsp;&nbsp; {{number_format(-1*($tot_dbt + $tot_crt),2)}}</td>
                    <td colspan="4"></td>
                    <td style="width: 278px;"></td>
                </tr>
            </tbody>
            <tbody>
                <tr class="new-entry">
                    <td></td>
                    <td></td>
                    <td><input class="form-control" name="description" value="{{($gjournals->count()) ? $gjournals->last()->description:''}}"></td>
                    <td><input class="form-control date-input" name="date" value={{$gjournals->count() ? $gjournals->last()->date->format('Y-m-d'):''}}></td>
                    <td>
                        @if($chart_of_accounts->count())
                        <select class="form-control" type="" name="account" id="sel_account">
                            <option value="">select</option>
                            @foreach($chart_of_accounts as $account)
                                <option value="{{$account->account_no}}">{{$account->account_no.' - '.$account->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </td>
                    <td align="right" style="padding-right: 0;"><input type="" class="form-control text-right" name="debit"></td>
                    <td>
                        @if($company->multi_currency && $company->country_currency)
                            <button class="btn btn-currency-code pull-left">{{$company->country_currency->currency_code}}</button>
                        @endif
                        <button class="btn pull-left" style="background-color: transparent; padding: {{$company->multi_currency ? '5px':'0'}} 0 0 2px;"><img src="{{asset('storage/images/split-b.png')}}" style="width: 22px;"></button>
                    </td>
                    <td align="right" style="padding-right: 0;"><input type="" class="form-control text-right" name="credit"></td>
                    <td>
                        @if($company->multi_currency && $company->country_currency)
                            <button class="btn btn-currency-code pull-left">{{$company->country_currency->currency_code}}</button>
                        @endif
                        <button class="btn pull-left" style="background-color: transparent; padding: {{$company->multi_currency ? '5px':'0'}} 0 0 2px;"><img src="{{asset('storage/images/split-b.png')}}" style="width: 22px;"></button>
                    </td>
                    <td>
                        @if($segments->count())
                        <select name="segment" class="form-control" id="sel_segment">
                            <option value="">select</option>
                            @foreach($segments as $segment)
                                <option>{{$segment->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </td>
                    <td>
                        @if($job_projects->count())
                        <select name="job_project" class="form-control" id="sel_job_project">
                            <option value="">select</option>
                            @foreach($job_projects as $job_project)
                                <option>{{$job_project->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </td>
                    <td>
                        <button class="glyphicon glyphicon-plus add-niel" style="cursor: pointer; color: inherit; padding: 2px 2px 3px 3px; border: solid 2px; border-radius: 5px; background-color: transparent;"></button>
                    </td>
                    <td style="padding-top: 0;">
                        <label class="container-check pull-left">
                          <input type="checkbox" class="form-control pull-right" name="flag" style="width:0;">
                          <span class="checkmark"></span>
                        </label>
                        <!-- <input type="checkbox" name="flag"> -->
                    </td>
                    <td>
                        <textarea name="note" class="form-control hidden"></textarea>
                        <button style='font-weight:bold; cursor:pointer; color: inherit; background-color: transparent; border: unset;' class='glyphicon glyphicon-minus add-note-symbol' data-toggle="modal" data-target=".bs-add-modal"></button>
                    </td>
                    <td id="total_action">
                        @if((number_format(-1*($tot_dbt + $tot_crt),2) == number_format(0,2)) && $gjournals->count())
                            <a class="btn btn-primary" href="{{route('company-account-split-journal.post')}}">POST</a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <button type="button" class="btn pull-left" data-toggle="modal" data-target=".bs-reset-modal">
            <strong>Reset</strong>
        </button>
    </div>
</div>

<div class="modal fade bs-delete-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete?</h4>
      </div>
      <div class="modal-body text-center">
        Are you sure you want to delete
        <strong id="delete-name"></strong>
      </div>
      <div class="modal-footer">
        <form class="form-horizontal" method="POST" action="{{ route('company-account-split-journal.delete') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="delete-href">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-reset-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure you want to reset?</h4>
      </div>
      <div class="modal-body text-center">
        Are you sure you want to reset Transaction No:
        <div><strong>{{$trans_no}}</strong></div>
      </div>
      <div class="modal-footer">
        <form class="form-horizontal" method="POST" action="{{ route('company-account-split-journal.reset') }}">
            {{ csrf_field() }}
            <input type="hidden" name="transaction_no" value="{{$trans_no}}">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="delete-href">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-add-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Note</h4>
      </div>
      <div class="modal-body text-center">
        <textarea class="form-control popup-note" style="height: 100px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn yellow-gradient add-note" data-dismiss="modal" style="color: #777; font-weight: bold;">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-edit-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Note</h4>
      </div>
      <div class="modal-body text-center">
        <input style="visibility: hidden;" name="theid">
        <textarea class="form-control popup-edit-note" style="height: 100px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn yellow-gradient edit-note" data-dismiss="modal" style="color: #777; font-weight: bold;">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/calculator/jquery.plugin.js') }}"></script> 
<script type="text/javascript" src="{{ asset('assets/calculator/jquery.calculator.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
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
        var updateError = true;
        $('.add-note').click(function(){
            $('[name=note]').val($('.popup-note').val());
            if($('[name=note]').val())
                $('.add-note-symbol').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            else
                $('.add-note-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        });
        $('.edit-note').click(function(){
            $('#gjournal-'+$('[name=theid]').val()).find('#note-edit textarea').val($('.popup-edit-note').val());
            if($('#gjournal-'+$('[name=theid]').val()).find('#note-edit textarea').val())
                $('#gjournal-'+$('[name=theid]').val()).find('.edit-note-symbol').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            else
                $('#gjournal-'+$('[name=theid]').val()).find('.edit-note-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        });
        $('[name=account],[name=segment],[name=job_project]').next().css('width','150px');
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
        $('[name=account').change(function(){
            setTimeout(()=>{
                if($(this).val())
                    $(this).next().find('#select2-sel_account-container').html($(this).val()).css('text-align','left');
            },200);
        }).change();
        $('[name=segment1').change(function(){
            $('[name=segment]').val($(this).val()).change();
        }).change();
        $('[name=job_project1').change(function(){
            $('[name=job_project]').val($(this).val()).change();
        }).change();

        /* custom new */
        var theEditables = function() {
            $('[name=account],[name=segment],[name=job_project],[name=location],[name=segment1],[name=job_project1]').select2({dropdownAutoWidth:true});
            $('.from-database').scrollTop($('.from-database').height());
            $(document).scrollTop($(document).height());
            $('[name=description]').focus();
            $('.editables').off().on('click',function(){
                if($(this).attr('class') == 'editables') {
                    if($('.locked').html()) {
                        $('.locked').find('.update-niel').click();
                        setTimeout(()=>{
                            if(updateError == false) {
                                updateError = true;
                                $(this).click();
                            }
                        },1000);
                    } else {
                        $(this).attr('class','locked');
                        $('.new-entry').addClass('entry-locked').find('input, select, a').attr('disabled',true);
                        $('.add-note-symbol').attr('data-target','');
                        var description = $(this).find('#description');
                        var date = $(this).find('#date');
                        var account = $(this).find('#account');
                        var debit = $(this).find('#debit');
                        var debCur = debit.next();
                        var credit = $(this).find('#credit');
                        var creCur = credit.next();
                        var segment = $(this).find('#segment');
                        var job_project = $(this).find('#job_project');
                        var flag = $(this).find('#flag');
                        var note = $(this).find('#note');
                        var action = $(this).find('#action');

                        var descriptionElem = $('<input class="form-control">')
                            .css('text-align','left')
                            .val(description.html());
                        description.attr('id',description.attr('id')+'-edit').html(descriptionElem);
                        var dateElem = $('<input class="form-control date-input">')
                            .attr('placeholder','YYYY-MM-DD')
                            .css('text-align','center')
                            .datepicker({format:'yyyy-mm-dd'})
                            .on('changeDate',function(e){
                                if(e.viewMode == 'days') {
                                    $( this ).datepicker('hide');
                                    $(this).css('text-align','right');
                                }
                            })
                            .blur(function(){
                                setTimeout(()=>{
                                    $(this).datepicker('hide');
                                },500);
                            })
                            .val(date.html());
                        date.attr('id',date.attr('id')+'-edit').html(dateElem);

                        var accountElem = $('<select class="form-control" id="sel_account">').html($('[name=account]').html()).change(function(){
                            setTimeout(()=>{
                                if($(this).val())
                                    $(this).next().find('#select2-sel_account-container').html($(this).val()).css('text-align','left');
                            },200);
                        });
                        if(account.html())
                            accountElem.val(account.html());
                        else
                            accountElem.val($('[name=account]').val());
                        account.attr('id',account.attr('id')+'-edit').html(accountElem);
                        accountElem.select2({dropdownAutoWidth:true}).change();

                        var segmentElem = $('<select class="form-control" id="sel_segment">').html($('[name=segment]').html());
                        if(segment.html())
                            segmentElem.val(segment.html());
                        else
                            segmentElem.val($('[name=segment1]').val());
                        segment.attr('id',segment.attr('id')+'-edit').html(segmentElem);
                        segmentElem.select2({dropdownAutoWidth:true});

                        var job_projectElem = $('<select class="form-control" id="sel_job_project">').html($('[name=job_project]').html());
                        if(job_project.html())
                            job_projectElem.val(job_project.html());
                        else
                            job_projectElem.val($('[name=job_project1]').val());
                        job_project.attr('id',job_project.attr('id')+'-edit').html(job_projectElem);
                        job_projectElem.select2({dropdownAutoWidth:true});

                        var flagElem = $('<input type="checkbox" class="form-control pull-right">').prop('checked',flag.find('input').prop('checked'));
                        var containerElem = '<label class="container-check pull-left">';
                        if(flag.find('input').prop('checked'))
                            containerElem += '<input type="checkbox" class="form-control pull-right" checked>';
                        else
                            containerElem += '<input type="checkbox" class="form-control pull-right">';
                        containerElem += '<span class="checkmark"></span>';
                        containerElem += '</label>';
                        flag.attr('id',flag.attr('id')+'-edit').html(containerElem);

                        var noteElem = $('<textarea class="form-control">')
                            .css('visibility','hidden')
                            .css('width','0')
                            .css('position','absolute')
                            .val(note.find('span').data('content'));
                        var noteGlyph = $('<button class="glyphicon edit-note-symbol" data-toggle="modal" data-target=".bs-edit-modal" style="border:unset; background-color:transparent;">')
                            .css('color','inherit')
                            .css('font-weight','bold')
                            .click(function(){
                                $('[name=theid]').css('color','#000').val($(this).parent().parent().find('#id').html());
                                $('.popup-edit-note').val($(this).parent().find('textarea').val());
                            });
                        if(noteElem.val())
                            noteGlyph.addClass('glyphicon-plus');
                        else
                            noteGlyph.addClass('glyphicon-minus');
                        note.attr('id',note.attr('id')+'-edit').html(noteElem).append(noteGlyph);

                        var debitElem = $('<input class="form-control">')
                            .css('text-align','right')
                            .focus(function(){
                                val = $(this).val();
                                $(this).val(val.replace(/,/g,'')).select();
                            }).blur(function(){
                                /*calc1 = 0;
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
                                        $(this).parent().parent().find('#credit-edit > input').val(Number(0).toFixed(2)).select();
                                        cdt = 0;
                                    }
                                });*/
                            }).val(debit.html() ? action.find('input').val():'').keyup(function(e){
                                if(e.keyCode == 17)
                                    $(this).calculator('hide');
                            }).mousedown(function(e){
                                if(e.which == 3)
                                    $(this).calculator('hide');
                            });
                        debit.attr('id',debit.attr('id')+'-edit').html(debitElem);
                        debit.find('input').calculator({
                            showOn:'button',
                            //buttonImageOnly:true,
                            buttonImage:'/storage/images/calculator-icon-1.png',
                            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                            useThemeRoller: true
                        });

                        debCur.html($('[name=debit]').parent().next().html());
                        creCur.html($('[name=credit]').parent().next().html());

                        var creditElem = $('<input class="form-control">')
                            .css('text-align','right')
                            .focus(function(){
                                val = $(this).val();
                                $(this).val(val.replace(/,/g,'')).select();
                            }).val(credit.html() ? addCommas(Number(-1*action.find('input').val().replace(/,/g, '')).toFixed(5)):'')
                            .blur(function(){
                                /*calc1 = 0;
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
                                });*/
                            }).keyup(function(e){
                                if(e.keyCode == 17)
                                    $(this).calculator('hide');
                            }).mousedown(function(e){
                                if(e.which == 3)
                                    $(this).calculator('hide');
                            });
                        credit.attr('id',credit.attr('id')+'-edit').html(creditElem);
                        credit.find('input').calculator({
                            showOn:'button',
                            //buttonImageOnly:true,
                            buttonImage:'/storage/images/calculator-icon-1.png',
                            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                            useThemeRoller: true
                        });
                        var actionElem = $('<button class="glyphicon glyphicon-floppy-saved update-niel" style="border:unset;"></button>')
                            .click(function(){
                                $.post('<?=route('company-account-split-journal.edit')?>', {
                                    _token: '{{csrf_token()}}',
                                    id: $(this).parent().parent().find('#id').html(),
                                    description: $(this).parent().parent().find('#description-edit > input').val(),
                                    date: $(this).parent().parent().find('#date-edit > input').val(),
                                    account: $(this).parent().parent().find('#account-edit > select').val(),
                                    debit: $(this).parent().parent().find('#debit-edit > input').val().replace(/,/g,''),
                                    credit: $(this).parent().parent().find('#credit-edit > input').val().replace(/,/g,''),
                                    segment: $(this).parent().parent().find('#segment-edit > select').val(),
                                    job_project: $(this).parent().parent().find('#job_project-edit > select').val(),
                                    flag: $(this).parent().parent().find('#flag-edit input').prop('checked'),
                                    note: $(this).parent().parent().find('#note-edit > textarea').val()
                                }).success((data)=>{
                                    $('.new-entry').removeClass('entry-locked').find('input, select, a').attr('disabled',false);
                                    $('.add-note-symbol').attr('data-target','.bs-add-modal');
                                    var d = new Date(data.date);
                                    var month = (d.getMonth() + 1);
                                    var day = d.getDate();
                                    var debit = '';
                                    var credit = '';
                                    var amount = data.amount.replace(/,/g, "");
                                    if(month < 10)
                                        month = '0'+month;
                                    if(day < 10)
                                        day = '0'+day;
                                    if(amount < 0) {
                                        credit = Math.abs(amount);
                                        if( credit > 0)
                                            credit = parseFloat(Number(credit)).toFixed(2).toLocaleString('en');
                                        else
                                            credit = '';
                                    } else {
                                        debit = amount;
                                        if(debit > 0)
                                            debit = parseFloat(Number(debit)).toFixed(2).toLocaleString('en');
                                        else
                                            debit = '';
                                    }
                                    $(this).parent().parent().attr('class','editables');
                                    $(this).parent().parent().find('#description-edit').attr('id','description').html(data.description);
                                    $(this).parent().parent().find('#date-edit').attr('id','date').html(d.getFullYear()+'-'+month+'-'+day);
                                    
                                    $(this).parent().parent().find('#account-edit').attr('id','account').html(data.account);
                                    
                                    $(this).parent().parent().find('#debit-edit').attr('id','debit').html(addCommas(debit)).next().html('');
                                    $(this).parent().parent().find('#credit-edit').attr('id','credit').html(addCommas(credit)).next().html('');
                                    
                                    $(this).parent().parent().find('#segment-edit').attr('id','segment').html(data.segment);
                                    
                                    
                                    $(this).parent().parent().find('#job_project-edit').attr('id','job_project').html(data.job_project);
                                    
                                    if(data.flag)
                                        flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right" checked><span class="checkmark"></span></label>';
                                    else
                                        flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right"><span class="checkmark"></span></label>';
                                    $(this).parent().parent().find('#flag-edit').attr('id','flag').html(flag);
                                    if(data.note)
                                        note = "<span style='font-weight:bold; cursor:pointer; color:inherit;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' data-placement='top' title='Note' data-content=\""+data.note+"\"></span>";
                                    else
                                        note = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus'></span>";
                                    $(this).parent().parent().find('#note-edit').attr('id','note').html(note);
                                    $(this).parent().parent().find('#action-edit').attr('id','action').html('<input type="hidden" value="'+data.amount+'"><span class="glyphicon glyphicon-edit" style="margin-right: 12px;"></span> <span class="glyphicon glyphicon-trash delete-niel"></span>');

                                    var total_debit = $('#total_debit');
                                    total_debit.html(addCommas(parseFloat(Number(data.total_debit)).toFixed(2).toLocaleString('en')));
                                    var total_credit = $('#total_credit');
                                    total_credit.html(addCommas(parseFloat(Number(data.total_credit)).toFixed(2).toLocaleString('en')));
                                    if(parseFloat(-1*(Number(data.total_debit) - Number(data.total_credit))).toFixed(2) == Number(0).toFixed(2))
                                        $('#total_action').html('<a class="btn btn-primary" href="{{route('company-account-split-journal.post')}}">POST</a>');
                                    else
                                        $('#total_action').html('');
                                    $('#total_balance').html('Out of Balance:&nbsp;&nbsp; '+(addCommas(parseFloat(-1*(Number(data.total_debit) - Number(data.total_credit))).toFixed(2).toLocaleString('en'))));
                                    if($('select').length < 10)
                                        $('[name=account],[name=segment],[name=job_project],[name=location],[name=segment1],[name=job_project1]').select2({dropdownAutoWidth:true});
                                    theEditables();
                                    updateError = false;
                                }).error((error)=>{
                                    updateError = true;
                                    $('.select2-selection__rendered').css('background-color','inherit');
                                    $('input').css('background-color','#fff');
                                    window.scrollTo(0, 0);
                                    var hold = '<div class="alert spacer text-center">';
                                    $(this).parent().parent().find('#description-edit > input').css('background-color','#fff');
                                    $(this).parent().parent().find('#date-edit > input').css('background-color','#fff');
                                    $(this).parent().parent().find('#segment-edit #select2-sel_segment-container').css('background-color','#fff');
                                    jQuery.each(error.responseJSON.errors, (i,val)=> {
                                        hold += '<h4><strong class="text-red">'+val+'</strong></h4>';
                                        if(i == 'segment') 
                                            $(this).parent().parent().find('#segment-edit #select2-sel_segment-container').css('background-color','#f1b9b8');
                                        else if(i == 'date')
                                            $(this).parent().parent().find('#date-edit > input').css('background-color','#f1b9b8');
                                        else if(i == 'description')
                                            $(this).parent().parent().find('#description-edit > input').css('background-color','#f1b9b8');
                                        else if(i == 'account')
                                            $('#select2-sel_account-container').css('background-color','#f1b9b8');
                                        else if(i == 'debit')
                                            $('#debit-edit > input,#credit-edit > input').css('background-color','#f1b9b8');
                                            
                                    });
                                    hold += '</div>';
                                    $('.ajax-alert').html(hold).fadeTo(7000, 500).slideUp(1000, function(){
                                        $(".alert").slideUp();
                                    });
                                });
                            });
                        action.attr('id',action.attr('id')+'-edit').html(actionElem);
                    }
                }
            });
            $('.delete-niel').off().on('click',function(e){
                e.stopImmediatePropagation();
                $('.bs-delete-modal').modal();
                $('#delete-name').html('line #'+$(this).parent().parent().find('#transaction_line_no').html());
                $('[name=id]').val($(this).parent().parent().find('#id').html());
            });
            $('[data-toggle="popover"]').popover({trigger:'hover'});
        }
        var updateTransLineNo = function(elem) {
            var own_tr = $(elem).parent().parent();
            var next_tr = own_tr.next();
            var hold_tans_line_no = own_tr.find('#transaction_line_no').html();
            var next_tras_line_no = next_tr.find('#transaction_line_no').html();
            if(next_tras_line_no) {
                next_tr.find('#transaction_line_no').html(hold_tans_line_no);
                updateNextTransLineNo(next_tr,next_tras_line_no);
            }
        }
        var updateNextTransLineNo = function(own_tr, hold_tans_line_no) {
            var next_tr = own_tr.next();
            var next_tras_line_no = next_tr.find('#transaction_line_no').html();
            if(next_tras_line_no) {
                next_tr.find('#transaction_line_no').html(hold_tans_line_no);
                updateNextTransLineNo(next_tr,next_tras_line_no);
            }
        }
        theEditables();
        $('[name=date]').attr('placeholder','YYYY-MM-DD')
        .css('text-align','left')
        .datepicker({format:'yyyy-mm-dd',defaultDate: new Date()})
        .on('changeDate',function(e){
            if(e.viewMode == 'days') {
                $( this ).datepicker('hide');
                $(this).css('text-align','left');
            }
        }).blur(function(){
            setTimeout(()=>{
                $(this).datepicker('hide');
            },500);
        });
        var theKeyup = function(e,this_is) {
            var someDate = new Date($(this_is).val());
            if(e.keyCode == 37)
                var addNumberOfDaysToAdd = -1;
            if(e.keyCode == 38)
                var addNumberOfDaysToAdd = -7;
            if(e.keyCode == 39)
                var addNumberOfDaysToAdd = 1;
            if(e.keyCode == 40)
                var addNumberOfDaysToAdd = 7;
            //someDate.setDate(someDate.getDate() + addNumberOfDaysToAdd);
            var dd = someDate.getDate() + addNumberOfDaysToAdd;
            var mm = someDate.getMonth() + 1;
            if(mm < 10)
                mm = '0'+mm;
            var y = someDate.getFullYear();
            var someFormattedDate = y + '-'+ mm + '-'+ dd;
            $(this_is).val(someFormattedDate).datepicker('setValue',someFormattedDate);
        }
        $('[name=date]').on('keyup',function(e){
            if(!$(this).val()) {
                var d = new Date();
                var m = d.getMonth() + 1;
                if(m < 10)
                    m = '0'+m;
                $(this).val(d.getFullYear()+'-'+m+'-'+d.getDate());
            }
            if(e.keyCode == 13) {
                $(this).datepicker('hide');
                $('[name=account]').focus();
            }
            if(e.keyCode > 36 && e.keyCode < 41){
                theKeyup(e,this);
            }
        });
        $('[name=debit],[name=credit]')
            .focus(function(){
                val = $(this).val();
                $(this).val(val.replace(/,/g,'')).select();
            })
            .blur(function(){
                /*calc1 = 0;
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
                },500);*/
            }).calculator({
                showOn:'button',
                //buttonImageOnly:true,
                buttonImage:'/storage/images/calculator-icon-1.png',
                layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                useThemeRoller: true
            }).keyup(function(e){
                if(e.keyCode == 17)
                    $(this).calculator('hide');
            }).mousedown(function(e){
                if(e.which == 3)
                    $(this).calculator('hide');
            });
            $('.add-niel').click(function(){
                if($('.locked').html()) {
                    // no action
                } else {
                    var debit_val = $('[name=debit]').val().replace(/,/g,'');
                    if(!debit_val)
                        debit_val = 0;
                    var credit_val = $('[name=credit]').val().replace(/,/g,'');
                    if(!credit_val)
                        credit_val = 0;
                    $('.select2-selection__rendered').css('background-color','inherit');
                    $('input').css('background-color','inherit');
                    $.post('<?=route('company-account-split-journal.save')?>', {
                        _token: '{{csrf_token()}}',
                        description: $('[name=description]').val(),
                        date: $('[name=date]').val(),
                        account: $('[name=account]').val(),
                        debit: debit_val,
                        credit: credit_val,
                        segment: $('[name=segment]').val(),
                        job_project: $('[name=job_project]').val(),
                        flag: $('[name=flag]').prop('checked'),
                        note: $('[name=note]').val(),
                        location: $('[name=location]').val(),
                        trans_no: '{{$trans_no}}'
                    }).success((data)=>{
                        if(data) {
                            var d = new Date(data.date);
                            var month = (d.getMonth() + 1);
                            var day = d.getDate();
                            var debit = '';
                            var debit_num = 0;
                            var credit = '';
                            var credit_num = 0;
                            var amount = data.amount.replace(/,/g, "");
                            if(month < 10)
                                month = '0'+month;
                            if(day < 10)
                                day = '0'+day;
                            if(amount < 0) {
                                credit = Math.abs(amount);
                                if( credit > 0) {
                                    credit_num = Number(credit).toFixed(2);
                                    credit = parseFloat(credit_num).toFixed(2).toLocaleString('en');
                                } else {
                                    credit = '';
                                }
                            } else {
                                debit = amount;
                                if(debit > 0) {
                                    debit_num = Number(debit).toFixed(2);
                                    debit = parseFloat(debit_num).toFixed(2).toLocaleString('en');
                                } else {
                                    debit = '';
                                }
                            }
                            if(data.account)
                                accountVal = data.account;
                            else
                                accountVal = '';
                            if(data.segment)
                                segmentVal = data.segment;
                            else
                                segmentVal = '';
                            if(data.job_project)
                                job_projectVal = data.job_project;
                            else
                                job_projectVal = '';
                            html = '<tr id="gjournal-'+data.id+'" class="editables">';
                                html += '<td id="id" align="left">'+data.id+'</td>';
                                html += '<td id="transaction_line_no" align="left">'+data.total+'</td>';
                                html += '<td id="description" align="left">'+data.description+'</td>';
                                html += '<td id="date">'+d.getFullYear()+'-'+month+'-'+day+'</td>';
                                html += '<td id="account" align="left">'+accountVal+'</td>';
                                html += '<td id="debit" align="right">'+addCommas(debit)+'</td>';
                                html += '<td></td>';
                                html += '<td id="credit" align="right">'+addCommas(credit)+'</td>';
                                html += '<td></td>';
                                html += '<td id="segment">'+segmentVal+'</td>';
                                html += '<td id="job_project">'+job_projectVal+'</td>';
                                html += '<td></td>';
                                if(data.flag)
                                    flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right" checked><span class="checkmark"></span></label>';
                                else
                                    flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right"><span class="checkmark"></span></label>';
                                html += '<td id="flag">'+flag+'</td>';
                                if(data.note)
                                    note = "<span style='font-weight:bold; cursor:pointer; color:inherit;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' data-placement='top' title='Note' data-content=\""+data.note+"\"></span>";
                                else
                                    note = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus'></span>";
                                html += '<td id="note">'+note+'</td>';
                                html += '<td id="action">';
                                    html += '<input type="hidden" value="'+amount+'">';
                                    html += '<span class="glyphicon glyphicon-edit" style="margin-right: 12px;"></span>';
                                    html += '<span class="glyphicon glyphicon-trash delete-niel"></span>';
                                html += '</td>';
                            html += '</tr>';
                            $('.from-database').append(html);
                            var total_debit = $('#total_debit');
                            var total_credit = $('#total_credit');
                            var total_debit_val = Number(total_debit.html().replace(/,/g, ""));
                            var total_credit_val = Number(total_credit.html().replace(/,/g, ""));
                            total_debit.html(addCommas(parseFloat((total_debit_val + Number(debit_num))).toFixed(2).toLocaleString('en')));
                            total_credit.html(addCommas(parseFloat((total_credit_val + Number(credit_num))).toFixed(2).toLocaleString('en')));
                            if(parseFloat(-1*(Number(total_debit_val + Number(debit_num)) - Number(total_credit_val + Number(credit_num)))).toFixed(2) == Number(0).toFixed(2))
                                $('#total_action').html('<a class="btn btn-primary" href="{{route('company-account-split-journal.post')}}">POST</a>');
                            else
                                $('#total_action').html('');
                            $('#total_balance').html('Out of Balance:&nbsp;&nbsp; '+(addCommas(parseFloat(-1*(Number(total_debit_val + Number(debit_num)) - Number(total_credit_val + Number(credit_num)))).toFixed(2).toLocaleString('en'))));
                            $('.add-note-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                            $('.popup-note').val('');
                            $('[name=note]').val('');
                            $('[name=account]').val('').change();
                            $('[name=flag]').prop('checked',false);
                            $(this).parent().parent().find('[name=debit],[name=credit]').val('');
                            theEditables();
                        }
                    }).error(function(error){
                        window.scrollTo(0, 0);
                        var hold = '<div class="alert spacer text-center">';
                        jQuery.each(error.responseJSON.errors, function(i,val) {
                            hold += '<h4><strong class="text-red">'+val+'</strong></h4>';
                            if(i == 'segment') {
                                i += '1';
                                if(!$('[name='+i+']').val()) {
                                    $('#select2-'+i+'-container').css('background-color','#f1b9b8');
                                    $('#select2-sel_segment-container').css('background-color','#f1b9b8');
                                }
                                else
                                    $('#select2-sel_segment-container').css('background-color','#f1b9b8');
                            }
                            else if(i == 'account')
                                $('#select2-sel_account-container').css('background-color','#f1b9b8');
                            else if(i == 'debit')
                                $('[name=debit],[name=credit]').css('background-color','#f1b9b8');
                            else
                                $('#select2-'+i+'-container').css('background-color','#f1b9b8');
                            $('[name='+i+']').css('background-color','#f1b9b8');
                        });
                        hold += '</div>';
                        $('.ajax-alert').html(hold).fadeTo(7000, 500).slideUp(1000, function(){
                            $(".alert").slideUp();
                        });
                    });
                }
            });
        /* end custom new */
        $('[name=location],[name=segment1],[name=segment],[name=account]').change(function(){
            $(this).next().find('.select2-selection__rendered').css('background-color','inherit');
        });
        $('[name=description],[name=date]').blur(function(){
            $(this).css('background-color','inherit');
        });
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/calculator/jquery.calculator.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/calculator/black-tie-jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/datepicker.css')}}">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .date-input { padding: 7px; }
    .select2-container { float: inherit; }
    .select2-selection { height: 36px !important; }
    #select2-sel_account-container,
    #select2-sel_segment-container,
    #select2-sel_job_project-container,
    #select2-location-container,
    #select2-segment1-container,
    #select2-job_project1-container {
        text-align: left;
        padding: 3px 14px;
    }
    table.table td:nth-child(1) {
        max-width: 0 !important;
        padding: 0 !important;
        visibility: hidden;
    }
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
    .clearfix {
        margin: 17px 0;
    }
    .new-entry td {
        vertical-align: middle !important;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        background-color: #fff;
        border: solid 1px #ccc;
    }
    .container-check {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }.container-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
    }

    /* On mouse-over, add a grey background color */
    .container-check:hover input ~ .checkmark {
        background-color: #fff;
    }

    /* When the checkbox is checked, add a blue background */
    .container-check input:checked ~ .checkmark {
        background-color: #fff;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container-check input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container-check .checkmark:after {
        left: 6px;
        top: 2px;
        width: 8px;
        height: 14px;
        border: solid #000;
        border-width: 0 5px 5px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .locked {
        background-color: #62beff !important;
        transition: 1s;
        color: #fff;
    }
    .locked .glyphicon-floppy-saved {
        padding: 4px 4px 4px 5px;
        background: #fff;
        border-radius: 7px;
        color: #2ab27b;
    }
    .entry-locked {
        display: none !important;
    }
    .table tbody.from-database{
      display:block;
      overflow-y:scroll;
      max-height:595px;
      width:100%;
    }
    .table thead tr, .new-entry, .from-database + tbody tr{
      display:block;
    }
    /* line */
    .table td:nth-child(2) {
        width: 50px;
    }
    /* description */
    .table td:nth-child(3) {
        width: 281px;
    }
    /* date */
    .table td:nth-child(4) {
        width: 120px;
    }
    /* account */
    .table td:nth-child(5) {
        width: 100px;
    }
    /* debit */
    .table td:nth-child(6) {
        width: 150px;
    }
    /* deb-cad */
    .table td:nth-child(7) {
        width: 90px;
        padding-left: 0;
        text-align: left;
    }
    /* credit */
    .table td:nth-child(8) {
        width: 150px;
    }
    /* cred-cad */
    .table td:nth-child(9) {
        width: 90px;
        padding-left: 0;
        text-align: left;
    }
    /* segment */
    .table td:nth-child(10) {
        width: 200px;
    }
    /* job / project */
    .table td:nth-child(11) {
        width: 200px;
    }
    /* add-new button */
    .table td:nth-child(12) {
        width: 50px;
    }
    /* flag */
    .table td:nth-child(13) {
        width: 50px;
    }
    /* note */
    .table td:nth-child(14) {
        width: 50px;
    }
    /* action */
    .table td:nth-child(15) {
        width: 65px;
    }
    nav.navbar { margin-bottom: 0; }
    .footer .container { margin-top: 0; }
    .btn-currency-code {
        background-color: #333;
        color: #fff;
        font-weight: bold;
        margin-left: 1px;
    }
    .locked .btn-currency-code,
    .locked .btn-currency-code + button {
        margin-top: 0;
        height: 35px;
    }
    tbody { border: none !important; }
    button.calculator-trigger {
        width: 36px;
        float: right;
        border: none;
        background-color: transparent;
    }
    button.calculator-trigger img { width: 100%; }
    .locked button.calculator-trigger {
        width: 35px;
    }
    .is-calculator {
        width: 74%;
        float: left;
    }
    #debit-edit,#credit-edit {
        padding-right: 0;
    }
</style>
@stop