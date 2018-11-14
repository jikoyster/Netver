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
            <h3><strong>Adjusting Journal</strong></h3>
        </div>
    </div>

    <div class="col-xs-12" style="margin-bottom: 15px;">
        <button class="btn yellow-gradient pull-right" data-toggle="modal" data-target=".bs-new-modal"><strong>New</strong></button>
    </div>

    <div class="col-xs-12 form-group{{ $errors->has('group_source') ? ' has-error' : '' }}" style="margin-bottom: 0;">
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
        <table class="table table-striped main-journal-table" style="background: #fff;">
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
                    $split_inc = 0;
                ?>
                @foreach($gjournals as $index => $journal)
                    <tr class="editables" id="gjournal-{{$journal->id}}">
                      <td id="id">{{$journal->id}}</td>
                      <td id="transaction_line_no" align="left">{{($journal->trans_line_no)}}</td>
                      <td id="description" align="left">{{$journal->description}}</td>
                      <td id="date">{{$journal->date->format('Y-m-d')}}</td>
                      <td id="account" align="left">{{$chart_of_accounts->count() ? $journal->account:''}}</td>
                      <td id="debit" align="right">{{$journal->amount >= 0 ? number_format(str_replace(',','',$journal->amount),2):''}}</td>
                      <td>
                        @if($journal->amount >= 0)
                            @if($journal->split_selected == 1)
                                <button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-r.png" class="split-r" style="width: 22px;"></button>
                            @elseif($journal->split_selected == 2)
                                <button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-g.png" style="width: 22px;"></button>
                            @endif
                        @endif
                      </td>
                      <td id="credit" align="right">{{$journal->amount < 0 ? number_format(abs(str_replace(',','',$journal->amount)),2):''}}</td>
                      <td>
                        @if($journal->amount < 0)
                            @if($journal->split_selected == 1)
                                <button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-r.png" class="split-r" style="width: 22px;"></button>
                            @elseif($journal->split_selected == 2)
                                <button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-g.png" style="width: 22px;"></button>
                            @endif
                        @endif
                      </td>
                      <td id="segment">{{$segments->count() ? $journal->segment:''}}</td>
                      <td id="job_project">{{$job_projects->count() ? $journal->job_project:''}}</td>
                      <td data-selected="{{$journal->split_selected}}"></td>
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
                        if($journal->split_selected == 1)
                            $split_inc = true;
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
                    <td style="width: 300px;" id="total_balance" colspan="2" style="text-align: right;">Out of Balance:&nbsp;&nbsp; {{number_format(-1*($tot_dbt + $tot_crt),5)}}</td>
                    <td colspan="4"></td>
                    <td style="width: 278px;"></td>
                </tr>
            </tbody>
            <tbody>
                <tr class="new-entry">
                    <td></td>
                    <td><input type="hidden" name="split_selected"></td>
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
                            <button id="debit-btn" class="btn btn-currency-code pull-left">{{$company->country_currency->currency_code}}</button>
                        @endif
                        <button class="btn pull-left btn-split" style="background-color: transparent; padding: {{$company->multi_currency ? '5px':'0'}} 0 0 2px;"><img src="{{asset('storage/images/split-b.png')}}" style="width: 22px;"></button>
                    </td>
                    <td align="right" style="padding-right: 0;"><input type="" class="form-control text-right" name="credit"></td>
                    <td>
                        @if($company->multi_currency && $company->country_currency)
                            <button id="credit-btn" class="btn btn-currency-code pull-left">{{$company->country_currency->currency_code}}</button>
                        @endif
                        <button class="btn pull-left btn-split" style="background-color: transparent; padding: {{$company->multi_currency ? '5px':'0'}} 0 0 2px;"><img src="{{asset('storage/images/split-b.png')}}" style="width: 22px;"></button>
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
                        @if((number_format(-1*($tot_dbt + $tot_crt),5) == number_format(0,5)) && $gjournals->count() && $split_inc == 0)
                            <a class="btn btn-primary" href="{{route('g-journal.post')}}">POST</a>
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

<div class="modal fade bs-new-modal" role="dialog" aria-labelledby="mySmallModalLabel" style="top: 30%;">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">New Transaction</h4>
        </div>
        <div class="modal-body text-center">
            Would you like to save this transaction?
        </div>
        <div class="modal-footer">
            <form class="form-horizontal" method="POST" action="{{ route('g-journal.update-new') }}">
                {{ csrf_field() }}
                <input type="hidden" name="transaction_no" value="{{$trans_no}}">
                <button class="btn yellow-gradient"><strong>Yes</strong></button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade bs-split-transaction-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      @include('v1.g-journals.split-transaction')
    </div>
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
        <form class="form-horizontal" method="POST" action="{{ route('g-journal.delete') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" id="delete-href">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-delete-split-modal" role="dialog" aria-labelledby="mySmallModalLabel">
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
        <form class="form-horizontal" method="POST" action="{{ route('company-account-split-journal.delete',['x']) }}">
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
        <form class="form-horizontal" method="POST" action="{{ route('g-journal.reset') }}">
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
<div class="modal fade bs-add-note-split-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Note</h4>
      </div>
      <div class="modal-body text-center">
        <textarea class="form-control popup-note-split" style="height: 100px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn yellow-gradient add-note-split" data-dismiss="modal" style="color: #777; font-weight: bold;">OK</button>
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
<div class="modal fade bs-edit-note-split-modal" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Note</h4>
      </div>
      <div class="modal-body text-center">
        <input style="visibility: hidden;" name="theid">
        <textarea class="form-control popup-edit-note-split" style="height: 100px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn yellow-gradient edit-note-split" data-dismiss="modal" style="color: #777; font-weight: bold;">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
    @include('v1.g-journals.js')
@stop
@section('css')
    @include('v1.g-journals.css')
@stop