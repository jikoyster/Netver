@extends('layouts.app')

@section('content')
<div class="container" style="width: 1440px;">
<div class="col-md-12">
    @if ($errors->any())
        <div class="alert spacer text-center">
            @foreach ($errors->all() as $error)
                <h4><strong class="text-red">{{ $error }}</strong></h4>
            @endforeach
        </div>
    @endif
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('company-vendor.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Vendor</strong></h3>
                </div>
            </div>

            <div class="col-md-1 form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="margin: 0;">
                <div style="width: 50%; float: right;">
                    <label for="title" class="control-label text-right text-white">Title</label>
                    <div class="col-md-12 text-center" style="padding: 0; float: unset;">
                        <input type="text" class="form-control" id="title" name="title" style="margin: 0 auto; float: unset; padding: 7px;" value="{{old('title')}}">
                    </div>
                </div>
            </div>

            <div class="col-md-2 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" style="margin: 0;">
                <label for="first_name" class="control-label text-right text-white">First Name</label>
                <div class="col-md-12 text-center" style="padding: 0; float: unset;">
                    <input type="text" class="form-control" id="first_name" name="first_name" style="margin: 0 auto; float: unset;" value="{{old('first_name')}}">
                </div>
            </div>

            <div class="col-md-2 form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}" style="margin: 0;">
                <label for="middle_name" class="control-label text-right text-white">Middle Name</label>
                <div class="col-md-12 text-center" style="padding: 0; float: unset;">
                    <input type="text" class="form-control" id="middle_name" name="middle_name" style="margin: 0 auto; float: unset;" value="{{old('middle_name')}}">
                </div>
            </div>

            <div class="col-md-2 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}" style="margin: 0;">
                <label for="last_name" class="control-label text-right text-white">Last Name</label>
                <div class="col-md-12 text-center" style="padding: 0; float: unset;">
                    <input type="text" class="form-control" id="last_name" name="last_name" style="margin: 0 auto; float: unset;" value="{{old('last_name')}}">
                </div>
            </div>

            <div class="col-md-1 form-group{{ $errors->has('suffix') ? ' has-error' : '' }}" style="margin: 0;">
                <div style="width: 50%;">
                    <label for="suffix" class="control-label text-right text-white">Suffix</label>
                    <div class="col-md-12 text-center" style="padding: 0; float: unset;">
                        <input type="text" class="form-control" id="suffix" name="suffix" style="margin: 0 auto; float: unset; padding: 7px;" value="{{old('suffix')}}">
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-1 control-label text-right text-white">&nbsp;</label>
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="col-md-4 pull-right form-control" id="phone" name="phone" style="margin: 0 auto; width: inherit; float: unset;" value="{{old('phone')}}">
                    <label for="phone" class="col-md-4 control-label text-right text-white pull-right">Phone</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                <label for="company" class="col-md-2 control-label text-right text-white">Company</label>

                <div class="col-md-7 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="company" name="company" style="margin: 0 auto; float: unset;" value="{{old('company')}}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="col-md-4 pull-right form-control" id="fax" name="fax" style="margin: 0 auto; width: inherit; float: unset;" value="{{old('fax')}}">
                    <label for="fax" class="col-md-4 control-label text-right text-white pull-right">Fax</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-2 control-label text-right text-white">Email</label>

                <div class="col-md-7 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="email" name="email" style="margin: 0 auto; float: unset;" value="{{old('email')}}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="col-md-4 pull-right form-control" id="account_no" name="account_no" style="margin: 0 auto; width: inherit; float: unset;" value="{{old('account_no')}}">
                    <label for="account_no" class="col-md-4 control-label text-right text-white pull-right">Our Account No</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                <label for="display_name" class="col-md-2 control-label text-right text-white">Display Name</label>

                <div class="col-md-7 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="display_name" name="display_name" style="margin: 0 auto; float: unset;" value="{{old('display_name')}}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="col-md-4 pull-right form-control" id="currency" name="currency" style="margin: 0 auto; width: inherit; float: unset;">
                        <option value="">select</option>
                        @foreach($global_currency->unique('currency')->sortBy('currency') as $code)
                            @if($company->multi_currency)
                                <option value="{{$code->id}}" {{old('currency') == $code->id ? 'selected':''}}>{{$code->currency}}</option>
                            @else
                                @if($company->country_currency->currency_code == $code->alphabetic_code)
                                    <option value="{{$code->id}}" selected>{{$code->currency}}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <label for="currency" class="col-md-4 control-label text-right text-white pull-right">Currency</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('use_display_name') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-7 text-center">
                    <label for="use_display_name" style="text-align: left; padding-left: 0;" class="col-md-4 control-label text-white">Print on cheque as</label>
                    <label for="use_display_name" class="pull-right control-label text-white" style="text-align: left; padding-left: 0;">Use Display Name</label>
                    <label class="container-check pull-right">
                      <input type="checkbox" class="form-control pull-right" id="use_display_name" name="use_display_name" {{old('use_display_name') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="form-group{{ $errors->has('billing_rate') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="col-md-4 pull-right form-control" id="billing_rate" name="billing_rate" style="margin: 0 auto; width: inherit; float: unset;" value="{{old('billing_rate')}}">
                    <label for="billing_rate" class="col-md-4 control-label text-right text-white pull-right">Billing Rate</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('print_cheque_as') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-7 pull-left text-center">
                    <input type="text" class="form-control" id="print_cheque_as" name="print_cheque_as" style="margin: 0 auto; float: unset;" value="{{old('print_cheque_as')}}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('tax_id') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="col-md-4 pull-right form-control" id="tax_id" name="tax_id" style="margin: 0 auto; width: inherit; float: unset;" value="{{old('tax_id')}}">
                    <label for="tax_id" class="col-md-4 control-label text-right text-white pull-right">Tax ID</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                <label for="website" class="col-md-2 control-label text-right text-white">Website</label>

                <div class="col-md-7 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="website" name="website" style="margin: 0 auto; float: unset;" value="{{old('website')}}">
                </div>
            </div>
            <div class="form-group{{ $errors->has('registration_type') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <label for="registration_type" class="col-md-5 control-label text-right text-white pull-left">Registration Type</label>
                    <select type="text" class="col-md-4 pull-left form-control" id="registration_type" name="registration_type" style="margin: 0 auto; width: 58%; float: unset;">
                        <option value="">select</option>
                        @foreach($registration_types as $type)
                            <option value="{{$type->id}}" {{old('registration_type') == $type->id ? 'selected':''}}>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-7 pull-left text-center">
                    <textarea type="text" class="form-control" id="description" name="description" style="margin: 0 auto; float: unset; height: 100px;">{{old('description')}}</textarea>
                </div>
            </div>
            <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto 20px auto; float: unset;">
                    <label for="term" class="col-md-5 control-label text-right text-white pull-left">Term</label>
                    <select type="text" class="col-md-4 pull-left form-control" id="term" name="term" style="margin: 0 auto; width: 58%; float: unset;">
                        <option value="">select</option>
                        @foreach($company->terms as $term)
                            <option value="{{$term->id}}" {{old('term') == $term->id ? 'selected':''}}>{{$term->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <label for="trade" class="col-md-5 control-label text-right text-white pull-left">Trade</label>
                    <select type="text" class="col-md-4 pull-left form-control" id="trade" name="trade" style="margin: 0 auto; width: 58%; float: unset;">
                        <option value="">select</option>
                        @foreach($company->trades as $trade)
                            <option value="{{$trade->id}}" {{old('trade') == $trade->id ? 'selected':''}}>{{$trade->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('subcontractor') ? ' has-error' : '' }}">
                <label for="subcontractor" class="col-md-2 control-label text-right text-white">Subcontractor</label>

                <div class="col-md-3 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select type="text" class="form-control" id="subcontractor" name="subcontractor">
                        <option value="">select</option>
                        <option {{old('subcontractor') == 'Yes' ? 'selected':''}}>Yes</option>
                        <option {{old('subcontractor') == 'No' ? 'selected':''}}>No</option>
                    </select>
                </div>
            </div>
            <div class="form-group{{ $errors->has('credit_limit') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <label for="credit_limit" class="col-md-5 control-label text-right text-white pull-left">Credit Limit</label>
                    <input type="text" class="col-md-4 pull-left form-control" id="credit_limit" name="credit_limit" style="margin: 0 auto; width: inherit; float: unset;" value="{{old('credit_limit')}}">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <div class="col-md-4 pull-right text-center" style="margin: 0 auto; float: unset;">
                    <label for="status" class="col-md-5 control-label text-right text-white pull-left">Status</label>
                    <select class="col-md-4 pull-left form-control" id="status" name="status" style="margin: 0 auto; width: 58%; float: unset;">
                        <option value="">-select-</option>
                        @foreach(['Active','Suspended','Closed'] as $status)
                            <option {{old('status') == $status ? 'selected':''}}>{{$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8 form-group{{ $errors->has('track_payment_t4a') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="track_payment_t4a" name="track_payment_t4a" {{old('track_payment_t4a') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                    <label for="track_payment_t4a" class="col-md-7 control-label text-white" style="text-align: left; padding-left: 0;">Track payment for T4A</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('track_payment_5018') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="track_payment_5018" name="track_payment_5018" {{old('track_payment_5018') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                    <label for="track_payment_5018" class="col-md-7 control-label text-white" style="text-align: left; padding-left: 0;">Track payment for 5018</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('track_payment_1099') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="track_payment_1099" name="track_payment_1099" {{old('track_payment_1099') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                    <label for="track_payment_1099" class="col-md-7 control-label text-white" style="text-align: left; padding-left: 0;">Track payment for 1099</label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 form-group{{ $errors->has('vendor_is_tax_agency') ? ' has-error' : '' }}">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <label class="container-check pull-left">
                      <input type="checkbox" class="form-control pull-right" id="vendor_is_tax_agency" name="vendor_is_tax_agency" {{old('vendor_is_tax_agency') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">
                      <span class="checkmark"></span>
                    </label>
                    <label for="vendor_is_tax_agency" class="col-md-7 control-label text-white" style="text-align: left; padding-left: 0;">This Vendor is Tax Agency</label>
                </div>
            </div>

            <div class="form-group col-md-12" style="margin-top: 17px;">
                <div class="text-right" style="margin: 0 auto; float: unset;">
                    <button type="button" onclick="window.location='{{route('company-vendor.address',[Request::segment(3)])}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Address</strong>
                    </button>
                    <button type="button" onclick="window.location='{{route('company-vendors')}}'" class="btn yellow-gradient" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                    <button type="submit" class="btn" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@stop
@section('script')
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
        var timeouteTimer = 0;
        $('[name=credit_limit],[name=billing_rate]').keyup(function(){
            clearTimeout(timeouteTimer);
            calc1 = 0;
            timeouteTimer = setTimeout(()=>{
                var theNumber = parseFloat($(this).val().replace(/,/g, ''));
                if(theNumber > 0) {
                    if(theNumber)
                        calc1 = Number(theNumber);
                    $(this).val(addCommas(calc1.toFixed(2)));
                } else {
                    $(this).val('');
                }
            },1500);
        });
        $('[name=trade],[name=currency],[name=registration_type],[name=term]').select2({dropdownAutoWidth:true});
        $('[name=subcontractor]').change(function(){
            $('[name=track_payment_t4a],[name=track_payment_5018],[name=track_payment_1099]').val(0).parent().parent().parent().hide();
            if($(this).val() == 'Yes') {
                @if($company->country_currency)
                    @if($company->country_currency->id == 2)
                        $('[name=track_payment_t4a],[name=track_payment_5018]').parent().parent().parent().show();
                    @elseif($company->country_currency->id == 4)
                        $('[name=track_payment_1099]').parent().parent().parent().show();
                    @endif
                @endif
            }
        }).change();
    });
</script>
@stop
@section('css')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .select2-container { float: inherit; }
    .select2-selection { height: 36px !important; }
    #select2-trade-container,
    #select2-currency-container,
    #select2-registration_type-container,
    #select2-term-container {
        text-align: left;
        padding: 3px 14px;
    }
    .has-error .form-control,
    .has-error .select2-selection {
        background-color: #f1b9b8;
    }
    .clearfix { margin: 7px; }
    .form-group { margin-bottom: 0; }
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
    #credit_limit, #billing_rate {
        text-align: right;
    }
</style>
@stop