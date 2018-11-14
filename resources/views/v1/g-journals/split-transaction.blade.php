<div class="modal-body text-center">
    <div class="row" style="margin-bottom: 30px;">
        
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Split Transaction</strong></h3>
                    <div class="ajax-alert-split"></div>
                </div>
            </div>

            <div class="form-group col-xs-12{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-3 control-label text-right text-white">Account No:</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-left" style="margin: 0 auto; float: unset;">
                    <label class="control-label" id="account-no-label">53000</label>
                </div>
                @if($title = auth()->user()->table_column_description('company_account_split_journals','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group col-xs-12{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-3 control-label text-right text-white">Amount to Split:</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-left" style="margin: 0 auto; float: unset;">
                    <input type="text" name="amount_to_split" id="amount-to-split-label" style="color: #fff; background: transparent; border: none; font-weight: bold;" readonly>
                </div>
                @if($title = auth()->user()->table_column_description('company_account_split_journals','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group col-xs-12{{ $errors->has('split_by') ? ' has-error' : '' }}">
                <label for="split_by" class="col-xs-3 control-label text-right text-white">Split By:</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="split_by" name="split_by">
                        <option value="">select</option>
                        <option value="1">Sub-Account</option>
                        <option value="2">Segment</option>
                        <option value="3">Job/Project</option>
                    </select>

                    @if ($errors->has('split_by'))
                        <span class="help-block">
                            <strong>{{ $errors->first('split_by') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_account_split_journals','split_by'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
@if(1==2)
            <div class="form-group col-xs-12{{ $errors->has('split_amount_by') ? ' has-error' : '' }}">
                <label for="split_amount_by" class="col-xs-3 control-label text-right text-white">Split Amount By:</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="split_amount_by" name="split_amount_by">
                        <option value="">select</option>
                        <option value="1">Amount</option>
                        <option value="2">Percentage</option>
                    </select>

                    @if ($errors->has('split_amount_by'))
                        <span class="help-block">
                            <strong>{{ $errors->first('split_amount_by') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('company_account_split_journals','split_amount_by'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>
@endif
            <div class="text-center col-md-12" style="margin-top: 17px;">
                <label class="pull-left text-white split-transaction-no-label" style="margin: 0 0 14px;">
                    {{$gjournals->count() && $gjournals[0]->company_account_split->count() ? 'Split Transaction No:  '.$gjournals[0]->company_account_split->first()->split_t_no : ''}}
                </label>
                <table class="table table-striped split-table" style="background: #fff;">
                    <thead style="font-weight: bold;">
                        <tr style="font-weight: bold; background-color: #000; color: #fff;">
                            <td>ID</td>
                            <td align="left" colspan="2">Line</td>
                            <td id="sub-account" style="text-align: left;">Sub-Account</td>
                            <td id="percentage">%</td>
                            <td id="debit" style="text-align: right;">Debit</td>
                            <td id="credit" style="text-align: right;">Credit</td>
                            <td></td>
                            <td><span class="glyphicon glyphicon-file"></span></td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody class="from-database-split">
                    </tbody>
                    <tbody>
                        <tr style="font-weight: bold; background-color: #000; color: #fff;">
                            <td></td>
                            <td style="width: 868px;" id="total_balance" colspan="9" style="text-align: right;">
                                <div style="float: left; text-align: right; width: 468px;" id="_total_split1"></div>
                                <div style="float: left; text-align: right; width: 167px;" id="_total_split"></div>
                                <div style="float: left; text-align: right; width: 25%;">Out of Balance:&nbsp;&nbsp; <span id="total_balance_split">{{number_format(-1*($tot_dbt + $tot_crt),5)}}</span></div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="new-entry-split">
                            <td></td>
                            <td colspan="5" style="padding-right: 0; padding-left: 0; width: 57%;">
                                <div class="col-xs-7">
                                    <select class="form-control" name="split_item">
                                        <option>select</option>
                                    </select>
                                </div>
                                <div class="col-xs-2" style="padding-left: 0; padding-right: 0;">
                                    <input class="form-control" name="split_percent"></input>
                                </div>
                                <div class="col-xs-3">
                                    <input class="form-control" name="split_amount">
                                </div>
                            </td>

                            <td></td>
                            <td>
                                <a class="glyphicon glyphicon-plus add-split-transaction" style="cursor: pointer; color: #555; padding: 2px 2px 3px 3px; border: solid 2px; border-radius: 5px; background-color: transparent;"></a>
                            </td>
                            <td>
                                <textarea name="note_split" class="form-control hidden"></textarea>
                                <a style='font-weight:bold; cursor:pointer; color: #555; background-color: transparent; border: unset;' class='glyphicon glyphicon-minus add-note-split-symbol' data-toggle="modal" data-target=".bs-add-note-split-modal"></a>
                            </td>
                            <td id="total_action">
                                @if(1 == 2)
                                    <a class="btn btn-primary">POST</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        
    </div>
</div>