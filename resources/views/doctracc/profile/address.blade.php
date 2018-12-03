<form class="m-form m-form--fit m-form--label-align-right">
    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <div class="col-10 ml-auto">
                <h3 class="m-form__section">My Address</h3>
            </div>
        </div>

        <div class="form-group m-form__group row">
            <label for="country-input" class="col-2 col-form-label">Country</label>
            <div class="col-7">
                <select class="form-control m-input" id="country-input">
                @foreach($countries as $country)
                    <option value="{{$country->id}}">
                        {{$country->country_name}}
                    </option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="state_provinces-input" class="col-2 col-form-label">State/Province</label>
            <div class="col-7">
                <select class="form-control m-input" id="state_provinces-input">
                @foreach($state_provinces as $sp)
                    <option value="{{$sp->id}}">{{$sp->state_province_name}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="city-input" class="col-2 col-form-label">City</label>
            <div class="col-7">
                <input id="city-input" class="form-control m-input" value="" type="text">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="line1-input" class="col-2 col-form-label">Line 1</label>
            <div class="col-7">
                <input id="line1-input" class="form-control m-input" value="" type="text">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="line2-input" class="col-2 col-form-label">Line 2</label>
            <div class="col-7">
                <input id="line2-input" class="form-control m-input" value="" type="text">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="zipcode-input" class="col-2 col-form-label">Postal/Zip Code</label>
            <div class="col-7">
                <input id="zipcode-input" class="form-control m-input" value="" type="text">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="timezone-input" class="col-2 col-form-label">Time Zone</label>
            <div class="col-7">
                <input id="timezone-input" class="form-control m-input" value="" type="text">
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-7">
                    <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>&nbsp;&nbsp;
                    <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>