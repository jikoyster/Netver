
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-chart-of-account.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Company Chart of Account</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-xs-4 control-label text-right text-white">Account No.</label>

                <div class="col-xs-2 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="account_no" name="account_no" style="margin: 0 auto; float: unset;" value="{{old('account_no')}}">
                </div>
                @if ($errors->has('account_no'))
                    <span class="help-block pull-left">
                        <strong>{{ $errors->first('account_no') }}</strong>
                    </span>
                @endif
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','name'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_type_id') ? ' has-error' : '' }}">
                <label for="account_type_id" class="col-xs-4 control-label text-right text-white">Type</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_type_id" name="account_type_id">
                        <option value="">-select-</option>
                        @foreach($account_types as $type)
                            @if(old('account_type_id') == $type->id)
                                <option selected value="{{$type->id}}">{{$type->name}}</option>
                            @else
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('account_type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_type_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_type_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('sign_id') ? ' has-error' : '' }}">
                <label for="sign_id" class="col-xs-4 control-label text-right text-white">Normal Sign</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="sign_id" name="sign_id">
                        <option value="">-select-</option>
                        @foreach($signs as $sign)
                            @if(old('sign_id') == $sign->id)
                                <option selected value="{{$sign->id}}">{{$sign->name}}</option>
                            @else
                                <option value="{{$sign->id}}">{{$sign->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('sign_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sign_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','sign_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('map_no') ? ' has-error' : '' }}">
                <label for="map_no" class="col-xs-4 control-label text-right text-white">Map No</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="map_no" name="map_no">
                        <option value="">-select-</option>
                        @foreach($maps as $map)
                            <option value="{{$map->id}}" {{old('map_no') == $map->id ? 'selected':''}}>
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
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','map_no'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_group_id') ? ' has-error' : '' }}">
                <label for="account_group_id" class="col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="hidden" name="account_group_id_hidden">
                    <select class="form-control" id="account_group_id" name="account_group_id">
                        <option value="">-select-</option>
                        @foreach($account_groups as $group)
                            @if(old('account_group_id') == $group->id)
                                <option selected value="{{$group->id}}">{{$group->code.' - '.$group->name}}</option>
                            @else
                                <option value="{{$group->id}}">{{$group->code.' - '.$group->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('account_group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_group_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_group_id'))
                    <div class="col-xs-2" style="padding: 0;">
                        <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer;" data-toggle="tooltip"  title="<?=$title?>"></span>
                    </div>
                @endif
            </div>

            <div class="form-group{{ $errors->has('account_class_id') ? ' has-error' : '' }}">
                <label for="account_class_id" class="col-xs-4 control-label text-right text-white">Class</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="account_class_id" name="account_class_id">
                        <option value="">-select-</option>
                        @foreach($account_classes as $class)
                            @if(old('account_class_id') == $class->id)
                                <option selected value="{{$class->id}}">{{$class->code.' - '.$class->name}}</option>
                            @else
                                <option value="{{$class->id}}">{{$class->code.' - '.$class->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('account_class_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_class_id') }}</strong>
                        </span>
                    @endif
                </div>
                @if($title = auth()->user()->table_column_description('global_chart_of_accounts','account_class_id'))
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
                            @if($company->multi_currency)
                                <option value="{{$global_currency_code->id}}" {{old('currency') == $global_currency_code->id ? 'selected':''}}>{{$global_currency_code->alphabetic_code.' - '.$global_currency_code->currency}}</option>
                            @else
                                @if($company->country_currency->currency_code == $global_currency_code->alphabetic_code)
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
                            <option value="{{$company_tax_account->id}}" {{old('tax_account') == $company_tax_account->id ? 'selected':''}}>{{$company_tax_account->tax_code.' - '.$company_tax_account->name.' - '.number_format($company_tax_account->tax_rate,0)}}%</option>
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
                    <input type="text" class="form-control custom-number-format" id="opening_balance" name="opening_balance" style="margin: 0 auto; float: unset;" value="{{number_format((int)old('opening_balance'),2)}}" placeholder="#,###,###.##">

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
                      <input type="checkbox" class="form-control pull-right" id="locked" name="locked" {{old('locked') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
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
                    <input type="text" class="form-control custom-number-format" id="adjustments" name="adjustments" style="margin: 0 auto; float: unset;" value="{{number_format((int)old('adjustments'),2)}}" placeholder="#,###,###.##">

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
                    <input type="text" class="form-control custom-number-format" id="final_balance" name="final_balance" style="margin: 0 auto; float: unset;" value="{{number_format((int)old('final_balance'),2)}}" placeholder="#,###,###.##">

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
                    <textarea type="text" class="form-control" id="description" name="description" style="margin: 0 auto; float: unset; height: 100px;">{{old('description')}}</textarea>

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
            	<div class="col-xs-4"></div>
                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
