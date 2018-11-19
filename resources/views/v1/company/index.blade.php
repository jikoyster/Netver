@extends('layouts.app')

@section('content')
<div class="container">
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
	<div class="row">
        <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin: 0 auto; float: unset;">
                    <h3><strong class="text-white">Company Profile</strong></h3>
                </div>
            </div>
        <div class="col-xs-12">

          <!-- Nav tabs -->
          <!-- <ul class="nav nav-tabs col-xs-12" role="tablist">
            <li role="presentation" class="active"><a href="#company" aria-controls="company" role="tab" data-toggle="tab"><strong>Company</strong></a></li>
            <li role="presentation"><a href="#taxes" aria-controls="taxes" role="tab" data-toggle="tab"><strong>Taxes</strong></a></li>
            <li role="presentation"><a href="#template" aria-controls="template" role="tab" data-toggle="tab"><strong>Template</strong></a></li>
            <li role="presentation"><a href="#accounts" aria-controls="accounts" role="tab" data-toggle="tab"><strong>Accounts</strong></a></li>
            <li role="presentation"><a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab"><strong>Permissions</strong></a></li>
            <li role="presentation"><a href="#emails" aria-controls="emails" role="tab" data-toggle="tab"><strong>Emails</strong></a></li>
            <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab"><strong>Notes</strong></a></li>
            <li role="presentation"><a href="#periods" aria-controls="periods" role="tab" data-toggle="tab"><strong>Periods</strong></a></li>
            <li role="presentation"><a href="#hierarchy" aria-controls="hierarchy" role="tab" data-toggle="tab"><strong>Hierarchy</strong></a></li>
            <li role="presentation"><a href="#segments" aria-controls="segments" role="tab" data-toggle="tab"><strong>Segments</strong></a></li>
          </ul> -->

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="company">
                <form enctype="multipart/form-data" class="form-horizontal" method="POST" id="companyForm" action="{{ route('company-profile.edit',[$companies[0]->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$companies[0]->id}}">
                    <div class="clearfix" style="height: 70px;"></div>
                    <div class="col-xs-12 form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                        <label for="account_no" class="col-xs-2 control-label text-right text-white">Account No</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="account_no" type="text" class="form-control" name="account_no" required value="{{old('account_no',$companies[0]->account_no)}}" readonly>

                            @if ($errors->has('account_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('account_no') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','account_no'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="display_name" class="col-xs-2 control-label text-right text-white">Display Name</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="display_name" type="text" class="form-control" name="display_name" required value="{{old('display_name',$companies[0]->display_name)}}">

                            <span class="help-block display_name">
                                <strong>{{ $errors->first('display_name') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','display_name'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('legal_name') ? ' has-error' : '' }}">
                        <label for="legal_name" class="col-xs-2 control-label text-right text-white">Legal Name</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="legal_name" type="text" class="form-control" name="legal_name" required value="{{old('legal_name',$companies[0]->legal_name)}}">

                            <span class="help-block legal_name">
                                <strong>{{ $errors->first('legal_name') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','legal_name'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="company_logo" class="col-xs-2 control-label text-right text-white">Company Logo</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset; overflow: hidden;">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly="" value="{{$companies[0]->company_logo}}">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="company_logo" name="company_logo">
                                    </span>
                                </span>
                            </div>

                            <span class="help-block company_logo">
                                <strong>{{ $errors->first('company_logo') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','company_logo'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('trade_name') ? ' has-error' : '' }}">
                        <label for="trade_name" class="col-xs-2 control-label text-right text-white">Trade Name</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="trade_name" type="text" class="form-control" name="trade_name" required value="{{old('trade_name',$companies[0]->trade_name)}}">

                            <span class="help-block trade_name">
                                <strong>{{ $errors->first('trade_name') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','trade_name'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="company_email" class="col-xs-2 control-label text-right text-white">Company Email</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="company_email" type="text" class="form-control" name="company_email" required value="{{old('company_email',$companies[0]->company_email)}}">

                            <span class="help-block company_email">
                                <strong>{{ $errors->first('company_email') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','company_email'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('registration_type') ? ' has-error' : '' }}">
                        <label for="registration_type" class="col-xs-2 control-label text-right text-white">Registration Type</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <select id="registration_type" class="form-control" name="registration_type">
                                <option value="">select</option>
                                @foreach($registration_types as $registration_type)
                                    @if(old('registration_type',$companies[0]->registration_type_id) == $registration_type->id)
                                        <option selected value="{{$registration_type->id}}">{{$registration_type->name}}</option>
                                    @else
                                        <option value="{{$registration_type->id}}">{{$registration_type->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <span class="help-block registration_type">
                                <strong>{{ $errors->first('registration_type') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','registration_type_id'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="phone" class="col-xs-2 control-label text-right text-white">Phone</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="phone" type="text" class="form-control" name="phone" required value="{{old('phone',$companies[0]->phone)}}">

                            <span class="help-block phone">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','phone'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-xs-2 control-label text-right text-white">Country</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input type="hidden" name="country_hidden">
                            <select id="country" class="form-control" name="country" {{$companies[0]->country?'disabled':''}}>
                                <option value="">select</option>
                                @foreach($countries as $country)
                                    @if(old('country_hidden',$companies[0]->country) == $country->id)
                                        <option selected value="{{$country->id}}">{{$country->country_name}}</option>
                                    @else
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <span class="help-block country">
                                <strong>{{ $errors->first('country_hidden') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','country'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="fax" class="col-xs-2 control-label text-right text-white">Fax</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input id="fax" type="text" class="form-control" name="fax" value="{{old('fax',$companies[0]->fax)}}">

                            <span class="help-block fax">
                                <strong>{{ $errors->first('fax') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','fax'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('home_currency') ? ' has-error' : '' }}">
                        <label for="home_currency" class="col-xs-2 control-label text-right text-white">Home Currency</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input type="hidden" name="home_currency_hidden">
                            <select id="home_currency" class="form-control" name="home_currency" {{$companies[0]->country?'disabled':''}}>
                                <option value="">select</option>
                                @foreach($countries as $country)
                                    @if(old('home_currency',$companies[0]->country) == $country->id)
                                        <option selected value="{{$country->id}}">{{$country->currency_code}}</option>
                                    @else
                                        <option value="{{$country->id}}">{{$country->currency_code}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <span class="help-block home_currency">
                                <strong>{{ $errors->first('home_currency_hidden') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('country_currencies','currency_code'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="multi_currency" class="col-xs-2 control-label text-right text-white">Multi Currency</label>

                        <div class="pull-left" style="margin: 0 auto; float: unset; padding: 0 14px;">
                            <input type="hidden" name="multi_currency_hidden" value="{{$companies[0]->multi_currency ? 'true':'false'}}">
                            <input id="multi_currency" type="checkbox" style="width: 20px; height: 20px;" name="multi_currency" {{old('multi_currency',$companies[0]->multi_currency) ? 'checked':''}} {{$companies[0]->multi_currency?'disabled':''}}>

                            <span class="help-block multi_currency">
                                <strong>{{ $errors->first('multi_currency') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','multi_currency'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('industry') ? ' has-error' : '' }}">
                        <label for="industry" class="col-xs-2 control-label text-right text-white">Industry</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <select id="industry" class="form-control" name="industry">
                                <option value="">select</option>
                                @foreach($naics as $code)
                                    <option {{$companies[0]->industry == $code->id ? 'selected':''}} value="{{$code->id}}">{{$code->code.' - '.$code->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('industry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('industry') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','industry'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="time_zone" class="col-xs-2 control-label text-right text-white">Time Zone</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <select id="time_zone" class="form-control" name="time_zone">
                                <option value="">select</option>
                                @foreach($timezone_datas as $timezone)
                                    @if(old('time_zone',$companies[0]->time_zone) == $timezone->id)
                                        <option selected value="{{$timezone->id}}">{{$timezone->name}}</option>
                                    @else
                                        <option value="{{$timezone->id}}">{{$timezone->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <span class="help-block time_zone">
                                <strong>{{ $errors->first('time_zone') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','time_zone'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group{{ $errors->has('tax_jurisdiction') ? ' has-error' : '' }}">
                        <label for="tax_jurisdiction" class="col-xs-2 control-label text-right text-white">Tax Jurisdiction</label>

                        <div class="col-xs-4 pull-left" style="margin: 0 auto; float: unset;">
                            <input type="hidden" name="tax_jurisdiction_hidden">
                            <select id="tax_jurisdiction" class="form-control" name="tax_jurisdiction" {{$companies[0]->tax_jurisdiction?'disabled':''}}>
                                <option>select</option>
                            </select>

                            <span class="help-block tax_jurisdiction">
                                <strong>{{ $errors->first('tax_jurisdiction_hidden') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','tax_jurisdiction'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif

                        <label for="daylight_saving_time" class="col-xs-2 control-label text-right text-white">Daylight Saving Time</label>

                        <div class="pull-left" style="margin: 0 auto; float: unset; padding: 0 14px;">
                            <input id="daylight_saving_time" type="checkbox" style="width: 20px; height: 20px;" name="daylight_saving_time" {{old('daylight_saving_time',$companies[0]->daylight_saving_time) ? 'checked':''}}>

                            <span class="help-block daylight_saving_time">
                                <strong>{{ $errors->first('daylight_saving_time') }}</strong>
                            </span>
                        </div>
                        @if($title = auth()->user()->table_column_description('companies','daylight_saving_time'))
                            <div class="" style="padding: 0;">
                                <span class="pull-left glyphicon glyphicon-info-sign" style="font-size: 30px; color: #fff; cursor: pointer; position: absolute; z-index: 9;" data-toggle="tooltip"  title="<?=$title?>"></span>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 form-group">
                        <div class="col-xs-4 pull-right text-right">
                            <button type="button" onclick="window.location='{{route('company.address',[Request::segment(3)])}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                                <strong>Address</strong>
                            </button>
                            <button type="submit" class="btn pull-right btn-success" style="margin: 0 7px;"><strong class="text-white">Save</strong></button>
                            <button type="button" onclick="window.location='{{route('companies')}}'" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                                <strong>Back</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="taxes">taxes</div>
            <div role="tabpanel" class="tab-pane" id="template">template</div>
            <div role="tabpanel" class="tab-pane" id="accounts">accounts</div>
            <div role="tabpanel" class="tab-pane" id="permissions">permissions</div>
            <div role="tabpanel" class="tab-pane" id="emails">emails</div>
            <div role="tabpanel" class="tab-pane" id="notes">notes</div>
            <div role="tabpanel" class="tab-pane" id="periods">periods</div>
            <div role="tabpanel" class="tab-pane" id="hierarchy">hierarchy</div>
            <div role="tabpanel" class="tab-pane" id="segments">segments</div>
          </div>

        </div>
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
@section('css')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .nav-tabs {
        border: none;
        display: table;
    }
    .nav-tabs>li {
        float: unset;
        display: table-cell;
        text-align: center;
    }
    .nav-tabs>li>a {
        background-color: #f5f8fa;
        color: #000;
        margin: 0;
        border-radius: 0;
        border: none;
    }
    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        background-color: transparent;
        color: #fff;
        border: none;
    }
    li.active a > strong {
        color: #fff;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        max-width: 100px;
        max-height: 37px;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .select2-selection {
        height: 36px !important;
        padding: 3px 0;
    }
</style>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        
        }); 

        $('[role="presentation"]').click(function(){
            $('[role="presentation"]').removeClass('active');
            $(this).addClass('active');

            $('[role="tabpanel"]').removeClass('active show');
            $($(this).find('a').attr('href')).addClass('active show');
        });

        $('#nextBtn').click(function(){
            $('.help-block.trade_name').find('strong').html('');
            $('.help-block.display_name').find('strong').html('');
            $('.help-block.legal_name').find('strong').html('');
            $('.help-block.company_email').find('strong').html('');
            $('.help-block.registration_type').find('strong').html('');
            $('.help-block.phone').find('strong').html('');
            $('.help-block.country').find('strong').html('');
            $('.help-block.fax').find('strong').html('');
            $('.help-block.time_zone').find('strong').html('');
            $('.help-block.company_logo').find('strong').html('');
            $('.help-block.home_currency').find('strong').html('');
            $('.help-block.tax_jurisdiction').find('strong').html('');
            $.post( "<?=route('company-profile.edit',[$companies[0]->id])?>", {
                _token: $('[name=_token]').val(),
                trade_name: $('[name=trade_name]').val(),
                display_name: $('[name=display_name]').val(),
                legal_name: $('[name=legal_name]').val(),
                company_email: $('[name=company_email]').val(),
                registration_type: $('[name=registration_type]').val(),
                phone: $('[name=phone]').val(),
                country: $('[name=country]').val(),
                fax: $('[name=fax]').val(),
                time_zone: $('[name=time_zone]').val(),
                multi_currency: $('[name=multi_currency]').is(":checked"),
                daylight_saving_time: $('[name=daylight_saving_time]').is(":checked"),
                company_logo: $('[name=company_logo]').val(),
                home_currency: $('[name=home_currency]').val(),
                tax_jurisdiction: $('[name=tax_jurisdiction]').val(),
                ajax: true
            }).success(function(data){
                var a = $('[role="presentation"].active').next().find('a');
                a.click();
                $('[role="tabpanel"]').removeClass('active show');
                $(a.attr('href')).addClass('active show');
            }).error(function(error){
                if(error.responseJSON.errors.trade_name)
                    $('.help-block.trade_name').find('strong').html(error.responseJSON.errors.trade_name[0]);
                if(error.responseJSON.errors.display_name)
                    $('.help-block.display_name').find('strong').html(error.responseJSON.errors.display_name[0]);
                if(error.responseJSON.errors.legal_name)
                    $('.help-block.legal_name').find('strong').html(error.responseJSON.errors.legal_name[0]);
                if(error.responseJSON.errors.company_email)
                    $('.help-block.company_email').find('strong').html(error.responseJSON.errors.company_email[0]);
                if(error.responseJSON.errors.registration_type)
                    $('.help-block.registration_type').find('strong').html(error.responseJSON.errors.registration_type[0]);
                if(error.responseJSON.errors.phone)
                    $('.help-block.phone').find('strong').html(error.responseJSON.errors.phone[0]);
                if(error.responseJSON.errors.country)
                    $('.help-block.country').find('strong').html(error.responseJSON.errors.country[0]);
                if(error.responseJSON.errors.fax)
                    $('.help-block.fax').find('strong').html(error.responseJSON.errors.fax[0]);
                if(error.responseJSON.errors.time_zone)
                    $('.help-block.time_zone').find('strong').html(error.responseJSON.errors.time_zone[0]);
                if(error.responseJSON.errors.company_logo)
                    $('.help-block.company_logo').find('strong').html(error.responseJSON.errors.company_logo[0]);
                if(error.responseJSON.errors.home_currency)
                    $('.help-block.home_currency').find('strong').html(error.responseJSON.errors.home_currency[0]);
                if(error.responseJSON.errors.tax_jurisdiction)
                    $('.help-block.tax_jurisdiction').find('strong').html(error.responseJSON.errors.tax_jurisdiction[0]);
            });
        });

        $('[name=country]').change(function(){
            $('[name=home_currency]').val($(this).val());
            $('#select2-home_currency-container').html($('[name=home_currency] option:selected').text());
            if($(this).val()) {
                getStateProvince($(this).val())
            } else {
                $('#tax_jurisdiction').html('<option>select</option>');
            }
        });
        $('[name=home_currency]').change(function(){
            $('[name=country]').val($(this).val());
            $('#select2-country-container').html($('[name=country] option:selected').text());
            if($(this).val()) {
                getStateProvince($(this).val())
            } else {
                $('#tax_jurisdiction').html('<option>select</option>');
            }
        });
        let getStateProvince = function(val) {
            $('[name=home_currency]').val(val);
            $.get( "<?=route('country.state',[''])?>/"+val, function( data ) {
                let option = "<option value=''>select</option>";
                for(var a = 0; a < data.length; a++) {
                    if('<?=old('tax_jurisdiction_hidden',$companies[0]->tax_jurisdiction) ?: 'x'?>' == data[a]['id'] || '<?=old('state_province')?>' == data[a]['id'])
                        option += "<option value='"+data[a]['id']+"' selected>"+data[a]['state_province_name']+"</option>";
                    else
                        option += "<option value='"+data[a]['id']+"'>"+data[a]['state_province_name']+"</option>";
                }
                $('#tax_jurisdiction').html(option);
                $('[name=tax_jurisdiction_hidden]').val($('[name=tax_jurisdiction]').val());
                if($('[name=tax_jurisdiction_hidden]').val())
                    $('[name=tax_jurisdiction]').attr('disabled',true);
            });
            $('[name=country_hidden],[name=home_currency_hidden]').val(val);
        }
        getStateProvince($('#country').val());
        $('select').select2();
        
        var countryWarn = true;
        var homCurrencyWarn = true;
        var taxJurisdictionWarn = true;
        $('#country, #home_currency, #tax_jurisdiction').change(function(){
            if(countryWarn && $(this).attr('id') == 'country') {
                countryWarn = false;
                $('.bs-warning-modal').modal('show');


                $('[name=country_hidden').val($(this).val());
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#country').val('').change();
                    countryWarn = true;
                    $('[name=country_hidden').val('');
                    $('[name=home_currency_hidden').val('');
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                    $('[name=home_currency]').attr('disabled',true);
                });


            } else if(homCurrencyWarn && $(this).attr('id') == 'home_currency') {
                homCurrencyWarn = false;
                $('.bs-warning-modal').modal('show');


                $('[name=home_currency_hidden').val($(this).val());
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#home_currency').val('').change();
                    homCurrencyWarn = true;
                    $('[name=country_hidden').val('');
                    $('[name=home_currency_hidden').val('');
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                    $('[name=country]').attr('disabled',true);
                });


            } else if(taxJurisdictionWarn && $(this).attr('id') == 'tax_jurisdiction') {
                taxJurisdictionWarn = false;
                $('.bs-warning-modal').modal('show');


                $('[name=tax_jurisdiction_hidden').val($(this).val());
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#tax_jurisdiction').val('').change();
                    taxJurisdictionWarn = true;
                    $('[name=tax_jurisdiction_hidden').val('');
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                });

            }
        });
        
        @if(!$companies[0]->multi_currency)
        var multiCurrencyWarn = true;
        $('#multi_currency').click(function(){
            if(multiCurrencyWarn && $(this).attr('id') == 'multi_currency') {
                multiCurrencyWarn = false;
                $('.bs-warning-modal').modal('show');
                $('.bs-warning-modal #no-btn').off().on('click',function(){
                    $('#multi_currency').attr('checked',false);
                    multiCurrencyWarn = true;
                    $('[name=multi_currency_hidden').val(false);
                });
                $('.bs-warning-modal #yes-btn').off().on('click',()=>{
                    $(this).attr('disabled',true);
                    $('[name=multi_currency_hidden').val(true);
                });
            }
        });
        @endif
        if($("[name=country_hidden]").val())
            $("[name=country]").attr('disabled',true);
        if($("[name=home_currency_hidden]").val())
            $("[name=home_currency]").attr('disabled',true);
    });
</script>
@stop