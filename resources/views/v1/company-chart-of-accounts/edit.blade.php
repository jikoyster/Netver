@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-bottom: 30px;">
        @if (session('status'))
            <div class="alert spacer text-center">
                @if(is_array(session('status')))
                    @foreach(session('status') as $status)
                        <h4><strong class="text-white">{{ $status }}</strong></h4>
                    @endforeach
                @else
                    <h4><strong class="text-white">{{ session('status') }}</strong></h4>
                @endif
            </div>
        @endif
        @if ($errors->any())
            <div class="alert spacer text-center">
                @foreach ($errors->all() as $error)
                    <h4><strong class="text-red">{{ $error }}</strong></h4>
                @endforeach
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('company-chart-of-account.edit',[Request::segment(3)]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Edit Company Chart of Account</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-xs-4 control-label text-right text-white">Account No</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="account_no" name="account_no" style="margin: 0 auto; float: unset;" value="{{old('account_no',$company_chart_of_account->account_no)}}" readonly>

                    @if ($errors->has('account_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','account_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name',$company_chart_of_account->name)}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="type" class="col-xs-4 control-label text-right text-white">Type</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="type" name="type">
                        <option value="">- select -</option>
                        @foreach($account_types as $type)
                            <option value="{{$type->id}}" {{old('type',$company_chart_of_account->type) == $type->id ? 'selected':''}}>{{$type->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('normal_sign') ? ' has-error' : '' }}">
                <label for="normal_sign" class="col-xs-4 control-label text-right text-white">Normal Sign</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="normal_sign" name="normal_sign">
                        <option value="">- select -</option>
                        @foreach($signs as $sign)
                            <option value="{{$sign->id}}" {{old('normal_sign',$company_chart_of_account->normal_sign) == $sign->id ? 'selected':''}}>{{$sign->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('normal_sign'))
                        <span class="help-block">
                            <strong>{{ $errors->first('normal_sign') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('map_no') ? ' has-error' : '' }}">
                <label for="map_no" class="col-xs-4 control-label text-right text-white">Map No</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="map_no" name="map_no">
                        <option value="">- select -</option>
                        @foreach($maps as $map)
                            <option value="{{$map->id}}" {{old('map_no',$company_chart_of_account->map_no) == $map->id ? 'selected':''}}>
                                <?php
                                    if($map->map_group_id) {
                                        if($map->parent_map)
                                            echo $map->parent_map->map_no.'.';
                                        echo $map->account_map->map_no.' - '.$map->name;
                                    } else {
                                        if($map->parent_map)
                                            echo $map->parent_map->map_no.'.';
                                        echo $map->map_no.' - '.$map->name;
                                    }
                                ?>
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('map_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('map_no') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                <label for="group" class="col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="hidden" name="group_hidden" value="{{old('group',$company_chart_of_account->group)}}">
                    <select type="text" class="form-control" id="group" name="group">
                        <option value="">- select -</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{old('group',$company_chart_of_account->group) == $group->id ? 'selected':''}}>{{$group->code.' - '.$group->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('group'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                <label for="class" class="col-xs-4 control-label text-right text-white">Class</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="class" name="class">
                        <option value="">- select -</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" {{old('class',$company_chart_of_account->class) == $class->id ? 'selected':''}}>{{$class->code.' - '.$class->name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('class'))
                        <span class="help-block">
                            <strong>{{ $errors->first('class') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                <label for="currency" class="col-xs-4 control-label text-right text-white">Currency</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="hidden" name="currency_hidden">
                    <select type="text" class="form-control" id="currency" name="currency">
                        <option value="">- select -</option>
                        @foreach($global_currency_codes->unique('alphabetic_code')->sortBy('alphabetic_code') as $global_currency_code)
                            @if($company_chart_of_account->parent_company->multi_currency)
                                <option value="{{$global_currency_code->id}}" {{old('currency',$company_chart_of_account->currency) == $global_currency_code->id ? 'selected':''}}>{{$global_currency_code->alphabetic_code.' - '.$global_currency_code->currency}}</option>
                            @else
                                @if($company_chart_of_account->parent_company->country_currency->currency_code == $global_currency_code->alphabetic_code)
                                    <option value="{{$global_currency_code->id}}" selected>{{$global_currency_code->alphabetic_code.' - '.$global_currency_code->currency}}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('currency'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('tax_account') ? ' has-error' : '' }}">
                <label for="tax_account" class="col-xs-4 control-label text-right text-white">Tax Account</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="tax_account" name="tax_account">
                        <option value="">- select -</option>
                        @foreach($company_tax_accounts->sortBy('tax_code') as $company_tax_account)
                            <option value="{{$company_tax_account->id}}" {{old('tax_account',$company_chart_of_account->tax_account) == $company_tax_account->id ? 'selected':''}}>{{$company_tax_account->tax_code.' - '.$company_tax_account->name.' - '.number_format($company_tax_account->tax_rate,0)}}%</option>
                        @endforeach
                    </select>

                    @if ($errors->has('tax_account'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tax_account') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('opening_balance') ? ' has-error' : '' }}">
                <label for="opening_balance" class="col-xs-4 control-label text-right text-white">Opening Balance</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control custom-number-format" id="opening_balance" name="opening_balance" style="margin: 0 auto; float: unset;" value="{{number_format((int)old('opening_balance',str_replace(',','',$company_chart_of_account->opening_balance)),2)}}" placeholder="#,###,###.##">

                    @if ($errors->has('opening_balance'))
                        <span class="help-block">
                            <strong>{{ $errors->first('opening_balance') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','opening_balance'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif

                <div class="col-xs-2 text-center">
                    <label for="locked" class="col-xs-9 control-label text-right text-white">Locked</label>
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="locked" name="locked" {{old('locked',$company_chart_of_account->locked) ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>

                    @if ($errors->has('locked'))
                        <span class="help-block">
                            <strong>{{ $errors->first('locked') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('terms','locked'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('adjustments') ? ' has-error' : '' }}">
                <label for="adjustments" class="col-xs-4 control-label text-right text-white">Adjustments</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control custom-number-format" id="adjustments" name="adjustments" style="margin: 0 auto; float: unset;" value="{{number_format((int)old('adjustments',str_replace(',','',$company_chart_of_account->adjustments)),2)}}" placeholder="#,###,###.##">

                    @if ($errors->has('adjustments'))
                        <span class="help-block">
                            <strong>{{ $errors->first('adjustments') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','adjustments'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('final_balance') ? ' has-error' : '' }}">
                <label for="final_balance" class="col-xs-4 control-label text-right text-white">Final Balance</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control custom-number-format" id="final_balance" name="final_balance" style="margin: 0 auto; float: unset;" value="{{number_format((int)old('final_balance',str_replace(',','',$company_chart_of_account->final_balance)),2)}}" placeholder="#,###,###.##">

                    @if ($errors->has('final_balance'))
                        <span class="help-block">
                            <strong>{{ $errors->first('final_balance') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','final_balance'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-xs-4 control-label text-right text-white">Description</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <textarea type="text" class="form-control" id="description" name="description" style="margin: 0 auto; float: unset; height: 100px;">{{old('description',$company_chart_of_account->description)}}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('chart_of_account_group_lists','description'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('company-chart-of-accounts')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Update</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bs-warning-modal" role="dialog" aria-labelledby="mySmallModalLabel" style="top: 30%;">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Warning!</h4>
        </div>
        <div class="modal-body text-center">
            This selection is not reversable, Continue?
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" id="no-btn">No</button>
            <button class="btn btn-success" data-dismiss="modal" id="yes-btn">Yes</button>
        </div>
    </div>
  </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('[name=nca]').select2();
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
        $('[name=opening_balance],[name=adjustments],[name=final_balance]').blur(function(){
            calc1 = 0;
            setTimeout(()=>{
                if($(this).val() > 0) {
                    if($(this).val())
                        calc1 = Number($(this).val());
                    $(this).val(addCommas(calc1.toFixed(2)));
                }
            },500);
        })
        $('select').select2({dropdownAutoWidth:true});
        var groupWarn = true;
        var currencyWarn = true;
        $('[name=group]').change(function(){
            $('[name=group_hidden]').val($(this).val());
            if(groupWarn && $("[name=group] option:selected").text().toLowerCase().indexOf('bank') >= 0) {
                groupWarn = false;
                $('.bs-warning-modal').modal('show');
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#group').val('').change();
                    groupWarn = true;
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                    $('[name=currency]').parent().parent().show();
                });
            }
            else
                $('[name=currency]').parent().parent().hide();
        });
        if($("[name=group] option:selected").text().toLowerCase().indexOf('bank') >= 0) {
            $('[name=group]').attr('disabled',true);
            $('[name=currency]').attr('disabled',true);
        }
        else
            $('[name=group]').change();
        $('#currency').change(function(){
            $('[name=currency_hidden]').val($(this).val());
            if(currencyWarn) {
                currencyWarn = false;
                $('.bs-warning-modal').modal('show');
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#currency').val('').change();
                    currencyWarn = true;
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                });
            }
        });
    });
</script>
@stop
@section('css')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .select2-container { float: inherit; }
    .select2-selection { height: 36px !important; }
    #select2-type-container,
    #select2-normal_sign-container,
    #select2-map_no-container,
    #select2-group-container,
    #select2-class-container,
    #select2-tax_account-container,
    #select2-currency-container {
        text-align: left;
        padding: 3px 14px;
    }
    #select2-nca-container { text-align: left; }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #fff;
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
        left: 7px;
        top: 2px;
        width: 10px;
        height: 17px;
        border: solid #000;
        border-width: 0 5px 5px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
@stop