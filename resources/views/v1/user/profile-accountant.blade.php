@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @if (session('status'))
            <div class="alert spacer text-center">
                <h4><strong class="text-white">{{ session('status') }}</strong></h4>
            </div>
        @endif
        <!-- <form class="form-horizontal" method="POST" action="{{ route('accountant.profile') }}"> -->
        {{Form::open(['route'=>'accountant-company.profile','class'=>'form-horizontal','method'=>'post','files'=>true])}}
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>PROFILE</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <label for="account_no" class="col-xs-4 control-label text-right text-white">Account No</label>

                <div class="col-md-2 col-sm-2 col-xs-2 pull-left" style="margin: 0 auto; float: unset;">
                    <input type="hidden" name="id" value="{{$company->id}}">
                    <input id="account_no" type="hidden" class="form-control" name="account_no" value="{{ $company->account_no }}" required autofocus style="margin: 0 auto; float: unset;">
                    <h3 class="text-white" style="margin: 0;"><strong>{{ $company->account_no }}</strong></h3>

                    @if ($errors->has('account_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_no') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('trade_name') ? ' has-error' : '' }}">
                <label for="trade_name" class="col-xs-4 control-label text-right text-white">Company Name</label>

                <div class="col-xs-4 text-center">
                    <input
                        id="trade_name"
                        type="text"
                        class="form-control"
                        name="trade_name"
                        value="{{ old('trade_name',$company->trade_name) }}"
                        required
                        {{($company->system_user_id) ? 'readonly':''}}
                        {{($company->new_system_user_id) ? 'readonly':''}}
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('trade_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('trade_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                <label for="designation_id" class="col-xs-4 control-label text-right text-white">Designation</label>

                <div class="col-xs-4 text-center">
                    <select class="form-control" name="designation_id">
                        <option value="">select</option>
                        @foreach($designations as $designation)
                            @if(old('designation_id'))
                                <option value="{{$designation->id}}" {{($designation->id == old('designation_id')) ? 'selected':''}}>{{$designation->name}}</option>
                            @else
                                <option value="{{$designation->id}}" {{($designation->id == $user->designation_id) ? 'selected':''}}>{{$designation->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('designation_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('designation_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('registration_type_id') ? ' has-error' : '' }}">
                <label for="registration_type_id" class="col-xs-4 control-label text-right text-white">Registration Type</label>

                <div class="col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" name="registration_type_id">
                        <option value="">select</option>
                        @foreach($registration_types as $type)
                            @if(old('registration_type_id'))
                                <option value="{{$type->id}}" {{($type->id == old('registration_type_id')) ? 'selected':''}}>{{$type->name}}</option>
                            @else
                                <option value="{{$type->id}}" {{($type->id == $company->registration_type_id) ? 'selected':''}}>{{$type->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('registration_type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('registration_type_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="country" class="col-xs-4 control-label text-right text-white">Country</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" name="country">
                        <option value="">select</option>
                        @foreach($countries as $country)
                            @if(old('country'))
                                <option value="{{$country->id}}" {{($country->id == old('country')) ? 'selected':''}}>{{$country->country_name}}</option>
                            @else
                                <option value="{{$country->id}}" {{($country->id == $company->country) ? 'selected':''}}>{{$country->country_name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('company_logo') ? ' has-error' : '' }}">
                <label for="company_logo" class="col-xs-4 control-label text-right text-white">Company Logo*</label>

                <div class="col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input
                        id="company_logo"
                        type="file"
                        class="form-control"
                        name="company_logo"
                        value="{{ old('company_logo',$company->company_logo) }}"
                        style="margin: 0 auto; float: left; width: 270px;">
                    @if($company->company_logo && 1 == 2)
                        <img src="{{asset('storage/company_logos/'.$company->company_logo)}}" style="width: 70px; float: right;">
                    @endif

                    @if ($errors->has('company_logo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_logo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                <label for="company_email" class="col-xs-4 control-label text-right text-white">Company Email</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input
                        id="company_email"
                        type="text"
                        class="form-control"
                        name="company_email"
                        value="{{ old('company_email',$company->company_email) }}"
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('company_email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-xs-4 control-label text-right text-white">Phone</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input
                        id="phone"
                        type="text"
                        class="form-control"
                        name="phone"
                        value="{{ old('phone',$company->phone) }}"
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                <label for="fax" class="col-xs-4 control-label text-right text-white">Fax</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input
                        id="fax"
                        type="text"
                        class="form-control"
                        name="fax"
                        value="{{ old('fax',$company->fax) }}"
                        
                        style="margin: 0 auto; float: unset;">

                    @if ($errors->has('fax'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fax') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('time_zone') ? ' has-error' : '' }}">
                <label for="time_zone" class="col-xs-4 control-label text-right text-white">Time Zone</label>

                <div class="col-md-3 col-sm-3 col-xs-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" name="time_zone">
                        <option value="">select</option>
                        @foreach($timezone_datas as $timezone_data)
                            @if(old('time_zone'))
                                <option value="{{$timezone_data->id}}" {{($timezone_data->id == old('time_zone')) ? 'selected':''}}>{{$timezone_data->name}}</option>
                            @else
                                <option value="{{$timezone_data->id}}" {{($timezone_data->id == $company->time_zone) ? 'selected':''}}>{{$timezone_data->name}}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('time_zone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('time_zone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('daylight_saving_time') ? ' has-error' : '' }}">
                <label for="daylight_saving_time" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Daylight Saving Time</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input type="checkbox" class="form-control pull-left" id="daylight_saving_time" name="daylight_saving_time" style="margin: 7px auto 0; width: 20px; height: 20px;" {{$company->daylight_saving_time == 'on' ? 'checked':''}}>

                    @if ($errors->has('daylight_saving_time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('daylight_saving_time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-4 col-xs-offset-2" style="padding-right: 0;">
                    <button type="button" onclick="window.location='{{route('user.address')}}'" class="btn pull-right" style="float: unset; margin: 0;"><strong>Add Address</strong></button>
                </div>
                <div class="col-xs-4 text-center">
                    <button type="submit" class="btn col-xs-5"><strong>Update</strong></button>
                </div>
            </div>

        </form>
    </div>
</div>
@stop