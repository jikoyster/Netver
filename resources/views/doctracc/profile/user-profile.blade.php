@section('header-custom-scripts')
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/doctracc/assets/vendors/custom/profile-myscript.js"></script>
@stop


<form id="userProfileForm" class="m-form m-form--fit m-form--label-align-right">
@foreach ($users as $key => $data)
	<div class="m-portlet__body ">
		<div class="form-group m-form__group m--margin-top-10">
			<div class="alert m-alert m--hide" role="alert">
				<span class="message"></span>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-10 ml-auto">
				<h3 class="m-form__section">Personal Details</h3>
			</div>
		</div>
		<!-- ID -->
		<div class="form-group m-form__group row">
			<label for="example-text-input" class="col-2 col-form-label">ID</label>
			<div class="col-7">
				<input class="form-control m-input" name="id" value="{{ $data->system_user_id }}" type="text" readonly>
			</div>
		</div>
		<!-- email -->
		<div class="form-group m-form__group row">
			<label for="example-text-input" class="col-2 col-form-label">Email</label>
			<div class="col-7">
				<input class="form-control m-input" name="email" value="{{ $data->email }}" type="text" readonly/>
			</div>
		</div>
		<!-- first_name -->
		<div class="form-group m-form__group row">
			<label for="example-text-input" class="col-2 col-form-label">First Name</label>
			<div class="col-7">
				<input class="form-control m-input" name="first_name" value="{{ $data->first_name }}" type="text"/>
			</div>
		</div>
		<!-- last_name -->
		<div class="form-group m-form__group row">
			<label for="example-text-input" class="col-2 col-form-label">Last Name</label>
			<div class="col-7">
				<input class="form-control m-input" name="last_name" value="{{ $data->last_name }}" type="text"/>
			</div>
		</div>
		<!-- home_phone -->
		<div class="form-group m-form__group row">
			<label for="example-text-input" class="col-2 col-form-label">Home Phone</label>
			<div class="col-7">
				<input class="form-control m-input" name="home_phone" value="{{ $data->home_phone }}" type="text">
			</div>
		</div>
		<!-- mobile_phone -->
		<div class="form-group m-form__group row">
			<label for="example-text-input" class="col-2 col-form-label">Mobile Phone</label>
			<div class="col-7">
				<input class="form-control m-input" name="mobile_phone" value="{{ $data->mobile_phone }}" type="text">
			</div>
		</div>

		
	
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<div class="row">
					<div class="col-2">
					</div>
					<div class="col-7">
						<button id="saveUserProfileButton" type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>&nbsp;&nbsp;
						<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
					</div>
				</div>
			</div>
		</div>

	</div>
@endforeach
</form>