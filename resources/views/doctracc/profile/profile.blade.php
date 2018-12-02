@extends('layouts.doctracc.main')
@section('title', 'Profile')

@section('content')

<?php $loggedin_user = Session::get('loggedin_user'); ?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">

	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">My Profile</h3>
			</div>
		<!-- <div>
				<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
				 m-dropdown-toggle="hover" aria-expanded="true">
					<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
						<i class="la la-plus m--hide"></i>
						<i class="la la-ellipsis-h"></i>
					</a>
					<div class="m-dropdown__wrapper">
						<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
						<div class="m-dropdown__inner">
							<div class="m-dropdown__body">
								<div class="m-dropdown__content">
									<ul class="m-nav">
										<li class="m-nav__section m-nav__section--first m--hide">
											<span class="m-nav__section-text">Quick Actions</span>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-share"></i>
												<span class="m-nav__link-text">Activity</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-chat-1"></i>
												<span class="m-nav__link-text">Messages</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-info"></i>
												<span class="m-nav__link-text">FAQ</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-lifebuoy"></i>
												<span class="m-nav__link-text">Support</span>
											</a>
										</li>
										<li class="m-nav__separator m-nav__separator--fit">
										</li>
										<li class="m-nav__item">
											<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>

	<!-- END: Subheader -->
	<div class="m-content">
		<div class="row">
			<div class="col-xl-3 col-lg-4">
				@include('doctracc.profile.left-pane')
			</div>
			<div class="col-xl-9 col-lg-8">
				<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-tools">
							<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
										<i class="flaticon-share m--hide"></i>
										User Profile
									</a>
								</li>
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
										My Address
									</a>
								</li>
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
										Password
									</a>
								</li>
							</ul>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item m-portlet__nav-item--last">
									<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
									 m-dropdown-toggle="hover" aria-expanded="true">
										<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
											<i class="la la-gear"></i>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="m-nav">
															<li class="m-nav__section m-nav__section--first">
																<span class="m-nav__section-text">Quick Actions</span>
															</li>
															<li class="m-nav__item">
																<a href="" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-share"></i>
																	<span class="m-nav__link-text">Create Post</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-chat-1"></i>
																	<span class="m-nav__link-text">Send Messages</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-multimedia-2"></i>
																	<span class="m-nav__link-text">Upload File</span>
																</a>
															</li>
															<li class="m-nav__section">
																<span class="m-nav__section-text">Useful Links</span>
															</li>
															<li class="m-nav__item">
																<a href="" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-info"></i>
																	<span class="m-nav__link-text">FAQ</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																	<span class="m-nav__link-text">Support</span>
																</a>
															</li>
															<li class="m-nav__separator m-nav__separator--fit m--hide">
															</li>
															<li class="m-nav__item m--hide">
																<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="m_user_profile_tab_1">
							@include('doctracc.profile.user-profile')
						</div>

						<!-- ADDRESS TABCONTENT -->
						<div class="tab-pane " id="m_user_profile_tab_2">
							@include('doctracc.profile.address')
						</div>

						<!-- PASSWORD TABCONTENT -->
						<div class="tab-pane " id="m_user_profile_tab_3">
							@include('doctracc.profile.password')
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop