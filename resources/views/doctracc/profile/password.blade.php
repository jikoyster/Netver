<div id="changePassword">

    @foreach($users as $key => $data)
    <form id="changePasswordForm" class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="form-group m-form__group m--margin-top-10">
                <div class="alert m-alert m--hide" role="alert">
                    <span class="message"></span>
                </div>
            </div>

            <input type="hidden" name="id" value="{{$data->system_user_id}}" />

            <div class="form-group m-form__group row">
                <div class="col-10 ml-auto">
                    <h3 class="m-form__section">Change Password</h3>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">Old Password</label>
                <div class="col-7">
                    <input class="form-control m-input" name="old_password" type="password">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">New Password</label>
                <div class="col-7">
                    <input class="form-control m-input" name="new_password" type="password" id="new_password">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">Confirm Password</label>
                <div class="col-7">
                    <input class="form-control m-input" name="rpassword" type="password">
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-7">
                        <button id="changePasswordButton" type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save
                            changes</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach

</div>