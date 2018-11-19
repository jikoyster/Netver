@include('genheader');

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">

						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="/" class="m-brand__logo-wrapper">
										<img alt="" src="../assets/doctracc/assets/demo/default/media/img/logo/logo_default_dark.png" />
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">

									<!-- BEGIN: Left Aside Minimize Toggle -->
									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>

									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>

						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

							<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown"
										 m-dropdown-persistent="1">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<i class="flaticon-search-1"></i>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner ">
													<div class="m-dropdown__header">
														<form class="m-list-search__form">
															<div class="m-list-search__form-wrapper">
																<span class="m-list-search__form-input-wrapper">
																	<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
																</span>
																<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
																	<i class="la la-remove"></i>
																</span>
															</div>
														</form>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
															<div class="m-dropdown__content">
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
											<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
												<span class="m-nav__link-icon">
													<i class="flaticon-music-2"></i>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/doctracc/assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
														<span class="m-dropdown__header-title">9 New</span>
														<span class="m-dropdown__header-subtitle">User Notifications</span>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
																		Alerts
																	</a>
																</li>
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">Events</a>
																</li>
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">Logs</a>
																</li>
															</ul>
															<div class="tab-content">
																<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items">
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
																					<span class="m-list-timeline__text">12 new users registered</span>
																					<span class="m-list-timeline__time">Just now</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">System shutdown
																						<span class="m-badge m-badge--success m-badge--wide">pending</span>
																					</span>
																					<span class="m-list-timeline__time">14 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">New invoice received</span>
																					<span class="m-list-timeline__time">20 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">DB overloaded 80%
																						<span class="m-badge m-badge--info m-badge--wide">settled</span>
																					</span>
																					<span class="m-list-timeline__time">1 hr</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">System error -
																						<a href="#" class="m-link">Check</a>
																					</span>
																					<span class="m-list-timeline__time">2 hrs</span>
																				</div>
																				<div class="m-list-timeline__item m-list-timeline__item--read">
																					<span class="m-list-timeline__badge"></span>
																					<span href="" class="m-list-timeline__text">New order received
																						<span class="m-badge m-badge--danger m-badge--wide">urgent</span>
																					</span>
																					<span class="m-list-timeline__time">7 hrs</span>
																				</div>
																				<div class="m-list-timeline__item m-list-timeline__item--read">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">Production server down</span>
																					<span class="m-list-timeline__time">3 hrs</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">Production server up</span>
																					<span class="m-list-timeline__time">5 hrs</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items">
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																					<a href="" class="m-list-timeline__text">New order received</a>
																					<span class="m-list-timeline__time">Just now</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
																					<a href="" class="m-list-timeline__text">New invoice received</a>
																					<span class="m-list-timeline__time">20 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																					<a href="" class="m-list-timeline__text">Production server up</a>
																					<span class="m-list-timeline__time">5 hrs</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																					<a href="" class="m-list-timeline__text">New order received</a>
																					<span class="m-list-timeline__time">7 hrs</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																					<a href="" class="m-list-timeline__text">System shutdown</a>
																					<span class="m-list-timeline__time">11 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																					<a href="" class="m-list-timeline__text">Production server down</a>
																					<span class="m-list-timeline__time">3 hrs</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
																	<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
																		<div class="m-stack__item m-stack__item--center m-stack__item--middle">
																			<span class="">All caught up!
																				<br>No new logs.</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
										 m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
												<span class="m-nav__link-icon">
													<i class="flaticon-share"></i>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/doctracc/assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
														<span class="m-dropdown__header-title">Quick Actions</span>
														<span class="m-dropdown__header-subtitle">Shortcuts</span>
													</div>
													<div class="m-dropdown__body m-dropdown__body--paddingless">
														<div class="m-dropdown__content">
															<div class="data" data="false" data-height="380" data-mobile-height="200">
																<div class="m-nav-grid m-nav-grid--skin-light">
																	<div class="m-nav-grid__row">
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-file"></i>
																			<span class="m-nav-grid__text">Generate Report</span>
																		</a>
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-time"></i>
																			<span class="m-nav-grid__text">Add New Event</span>
																		</a>
																	</div>
																	<div class="m-nav-grid__row">
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-folder"></i>
																			<span class="m-nav-grid__text">Create New Task</span>
																		</a>
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-clipboard"></i>
																			<span class="m-nav-grid__text">Completed Tasks</span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										
										<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="../assets/doctracc/assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />
												</span>
												<span class="m-topbar__username m--hide">Nick</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/doctracc/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
																<img src="../assets/doctracc/assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />

																<!--
						<span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>
						-->
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">Mark Andre</span>
																<a href="" class="m-card-user__email m--font-weight-300 m-link">mark.andre@gmail.com</a>
															</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																<li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">Section</span>
																</li>
																<li class="m-nav__item">
																	<a href="/profile" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">My Profile</span>
																				<span class="m-nav__link-badge">
																					<span class="m-badge m-badge--success">2</span>
																				</span>
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-share"></i>
																		<span class="m-nav__link-text">Activity</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-chat-1"></i>
																		<span class="m-nav__link-text">Messages</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-info"></i>
																		<span class="m-nav__link-text">FAQ</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																		<span class="m-nav__link-text">Support</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="#" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li id="m_quick_sidebar_toggle" class="m-nav__item">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<i class="flaticon-grid-menu"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>

							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>

			<!-- END: Header -->

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				<!-- BEGIN: Left Aside -->
				@include('gensidebar')
				<!-- END: Left Aside -->
				
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">Global Accounting</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">General Settings</span>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">Global Accounting</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
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
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
						<div class="m-portlet">
									
									<div class="m-portlet__body">
										<ul class="nav nav-pills nav-fill" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" data-toggle="tab" href="#m_tabs_5_1">Global Chart of Accounts</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#m_tabs_5_2">Chart of Accounts Group</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#m_tabs_5_3">National Chart of Accounts</a>
											</li>
											
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="m_tabs_5_1" role="tabpanel">
												<!-- This IS -->

													<div class="m-portlet m-portlet--mobile">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Global Chart Of Account
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
														<span>
															<i class="la la-plus"></i>
															<span>New Record</span>
														</span>
													</a>
												</li>
												<li class="m-portlet__nav-item"></li>
												<li class="m-portlet__nav-item">
													<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
														<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
															<i class="la la-ellipsis-h m--font-brand"></i>
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
									<div class="m-portlet__body">

<div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
	<div class="row">
		<div class="col-sm-12 col-md-6"><div class="dataTables_length" id="m_table_1_length">
			<label>Show 
				<select name="m_table_1_length" aria-controls="m_table_1" class="custom-select custom-select-sm form-control form-control-sm">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select> 
				entries
			</label>
		</div>
	</div>
<div class="col-sm-12 col-md-6"><div id="m_table_1_filter" class="dataTables_filter"><label>Search:<input class="form-control form-control-sm" placeholder="" aria-controls="m_table_1" type="search"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="m_table_1" role="grid" aria-describedby="m_table_1_info" style="width: 1150px;">
</div>
										<!--begin: Datatable -->
										<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
											<thead>
												<tr>
													<th>Record ID</th>
													<th>Company Email</th>
													<th>Company Agent</th>
													<th>Company Name</th>
													<th>Status</th>
													<th>Type</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>nsailor0@livejournal.com</td>
													<td>Nixie Sailor</td>
													<td>Gleichner, Ziemann and Gutkowski</td>
													<td>3</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>2</td>
													<td>egiraldez1@seattletimes.com</td>
													<td>Emelita Giraldez</td>
													<td>Rosenbaum-Reichel</td>
													<td>6</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>3</td>
													<td>uluckin2@state.gov</td>
													<td>Ula Luckin</td>
													<td>Kulas, Cassin and Batz</td>
													<td>1</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>4</td>
													<td>ecure3@trellian.com</td>
													<td>Evangeline Cure</td>
													<td>Pfannerstill-Treutel</td>
													<td>1</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>5</td>
													<td>tst4@msn.com</td>
													<td>Tierney St. Louis</td>
													<td>Dicki-Kling</td>
													<td>2</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>6</td>
													<td>greinhard5@instagram.com</td>
													<td>Gerhard Reinhard</td>
													<td>Gleason, Kub and Marquardt</td>
													<td>5</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>7</td>
													<td>eshelley6@pcworld.com</td>
													<td>Englebert Shelley</td>
													<td>Jenkins Inc</td>
													<td>2</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>8</td>
													<td>hkite7@epa.gov</td>
													<td>Hazlett Kite</td>
													<td>Streich LLC</td>
													<td>6</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>9</td>
													<td>fmorby8@surveymonkey.com</td>
													<td>Freida Morby</td>
													<td>Haley, Schamberger and Durgan</td>
													<td>2</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>10</td>
													<td>ohelian9@usatoday.com</td>
													<td>Obed Helian</td>
													<td>Labadie, Predovic and Hammes</td>
													<td>1</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>11</td>
													<td>samya@earthlink.net</td>
													<td>Sibyl Amy</td>
													<td>Treutel-Ratke</td>
													<td>4</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>12</td>
													<td>nfoldesb@lycos.com</td>
													<td>Norri Foldes</td>
													<td>Strosin, Nitzsche and Wisozk</td>
													<td>3</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>13</td>
													<td>morhtmannc@weibo.com</td>
													<td>Myrna Orhtmann</td>
													<td>Miller-Schiller</td>
													<td>3</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>14</td>
													<td>skneathd@bizjournals.com</td>
													<td>Sioux Kneath</td>
													<td>Rice, Cole and Spinka</td>
													<td>4</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>15</td>
													<td>cjacmare@google.pl</td>
													<td>Christa Jacmar</td>
													<td>Brakus-Hansen</td>
													<td>1</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>16</td>
													<td>sgoraccif@thetimes.co.uk</td>
													<td>Shandee Goracci</td>
													<td>Bergnaum, Thiel and Schuppe</td>
													<td>5</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>17</td>
													<td>jcolvieg@mit.edu</td>
													<td>Jerrome Colvie</td>
													<td>Kreiger, Glover and Connelly</td>
													<td>3</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>18</td>
													<td>mplenderleithh@globo.com</td>
													<td>Michaelina Plenderleith</td>
													<td>Legros-Gleichner</td>
													<td>1</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>19</td>
													<td>lluthwoodi@constantcontact.com</td>
													<td>Lombard Luthwood</td>
													<td>Haag LLC</td>
													<td>1</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>20</td>
													<td>lchevinj@mapy.cz</td>
													<td>Leonora Chevin</td>
													<td>Mann LLC</td>
													<td>2</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>21</td>
													<td>tseakesk@jigsy.com</td>
													<td>Tannie Seakes</td>
													<td>Blanda Group</td>
													<td>6</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>22</td>
													<td>ywetherelll@webnode.com</td>
													<td>Yardley Wetherell</td>
													<td>Gerlach-Schultz</td>
													<td>2</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>23</td>
													<td>bpeascodm@devhub.com</td>
													<td>Bryn Peascod</td>
													<td>Larkin and Sons</td>
													<td>6</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>24</td>
													<td>cjeromsonn@ning.com</td>
													<td>Chrissie Jeromson</td>
													<td>Brakus-McCullough</td>
													<td>2</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>25</td>
													<td>gclampo@vistaprint.com</td>
													<td>Gusti Clamp</td>
													<td>Stokes Group</td>
													<td>6</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>26</td>
													<td>ojobbinsp@w3.org</td>
													<td>Otis Jobbins</td>
													<td>Ruecker, Leffler and Abshire</td>
													<td>4</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>27</td>
													<td>lhaycoxq@samsung.com</td>
													<td>Lonnie Haycox</td>
													<td>Feest Group</td>
													<td>1</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>28</td>
													<td>hcastellir@nationalgeographic.com</td>
													<td>Heddi Castelli</td>
													<td>Kessler and Sons</td>
													<td>5</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>29</td>
													<td>todowgaines@princeton.edu</td>
													<td>Tuck O'Dowgaine</td>
													<td>Simonis, Rowe and Davis</td>
													<td>1</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>30</td>
													<td>vcoshamt@simplemachines.org</td>
													<td>Vernon Cosham</td>
													<td>Kreiger-Nicolas</td>
													<td>4</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>31</td>
													<td>bmaccrackenu@hostgator.com</td>
													<td>Bryna MacCracken</td>
													<td>Hyatt-Witting</td>
													<td>2</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>32</td>
													<td>farnallv@vistaprint.com</td>
													<td>Freda Arnall</td>
													<td>Dicki, Morar and Stiedemann</td>
													<td>3</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>33</td>
													<td>pkringew@usatoday.com</td>
													<td>Pavel Kringe</td>
													<td>Goldner-Lehner</td>
													<td>4</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>34</td>
													<td>fnazaretx@si.edu</td>
													<td>Felix Nazaret</td>
													<td>Waters, Quigley and Keeling</td>
													<td>5</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>35</td>
													<td>pallanbyy@discovery.com</td>
													<td>Penrod Allanby</td>
													<td>Rodriguez Group</td>
													<td>2</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>36</td>
													<td>hpassbyz@wikimedia.org</td>
													<td>Hubey Passby</td>
													<td>Lemke-Hermiston</td>
													<td>2</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>37</td>
													<td>mrotlauf10@naver.com</td>
													<td>Magdaia Rotlauf</td>
													<td>Hettinger, Medhurst and Heaney</td>
													<td>3</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>38</td>
													<td>alawrance11@un.org</td>
													<td>Alfonse Lawrance</td>
													<td>Schuppe-Harber</td>
													<td>1</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>39</td>
													<td>kchettoe12@zdnet.com</td>
													<td>Kessiah Chettoe</td>
													<td>Mraz LLC</td>
													<td>5</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>40</td>
													<td>nfairbanks13@geocities.com</td>
													<td>Natka Fairbanks</td>
													<td>Mueller-Greenholt</td>
													<td>3</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>41</td>
													<td>spuvia14@alexa.com</td>
													<td>Shaw Puvia</td>
													<td>Veum LLC</td>
													<td>3</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>42</td>
													<td>adingate15@furl.net</td>
													<td>Alden Dingate</td>
													<td>Heidenreich Inc</td>
													<td>5</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>43</td>
													<td>cpeplay16@typepad.com</td>
													<td>Cherish Peplay</td>
													<td>McCullough-Gibson</td>
													<td>2</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>44</td>
													<td>nswetman17@washington.edu</td>
													<td>Nedi Swetman</td>
													<td>Gerhold Inc</td>
													<td>5</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>45</td>
													<td>ablick18@pinterest.com</td>
													<td>Ashley Blick</td>
													<td>Cummings-Goodwin</td>
													<td>4</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>46</td>
													<td>sharmant19@springer.com</td>
													<td>Saunders Harmant</td>
													<td>O'Kon-Wiegand</td>
													<td>3</td>
													<td>2</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>47</td>
													<td>mlaurencot1a@google.com</td>
													<td>Mellisa Laurencot</td>
													<td>Jacobs Group</td>
													<td>1</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>48</td>
													<td>omyderscough1b@printfriendly.com</td>
													<td>Orland Myderscough</td>
													<td>Gutkowski Inc</td>
													<td>5</td>
													<td>3</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>49</td>
													<td>diglesias1c@usa.gov</td>
													<td>Devi Iglesias</td>
													<td>Ullrich-Dibbert</td>
													<td>1</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
												<tr>
													<td>50</td>
													<td>btummasutti1d@google.es</td>
													<td>Bliss Tummasutti</td>
													<td>Legros-Cummings</td>
													<td>5</td>
													<td>1</td>
													<td nowrap></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

											</div>
											<div class="tab-pane" id="m_tabs_5_2" role="tabpanel">
												<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Row Grouping Example
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="#" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
												<span>
													<i class="la la-cart-plus"></i>
													<span>New Record</span>
												</span>
											</a>
										</li>
										<li class="m-portlet__nav-item"></li>
										<li class="m-portlet__nav-item">
											<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
												<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
													<i class="la la-ellipsis-h m--font-brand"></i>
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
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
									<div class="row"><div class="col-sm-12 col-md-6">
										<div class="dataTables_length" id="m_table_1_length">
											<label>
												Show 
												<select name="m_table_1_length" aria-controls="m_table_1" class="custom-select custom-select-sm form-control form-control-sm">
													<option value="10">10</option>
													<option value="25">25</option>
													<option value="50">50</option>
													<option value="100">100</option>
												</select> 
												entries
											</label>
										</div>
									</div>
									<div class="col-sm-12 col-md-6">
										<div id="m_table_1_filter" class="dataTables_filter">
											<label>Search:<input class="form-control form-control-sm" placeholder="" aria-controls="m_table_1" type="search"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="m_table_1" role="grid" aria-describedby="m_table_1_info" style="width: 1150px;">
									
									<thead>
										<tr role="row"><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 53.45px;" aria-label="Order ID: activate to sort column ascending">Order ID</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 114.45px;" aria-label="Ship City: activate to sort column ascending">Ship City</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 118.45px;" aria-label="Ship Address: activate to sort column ascending">Ship Address</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 119.45px;" aria-label="Company Agent: activate to sort column ascending">Company Agent</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 184.45px;" aria-label="Company Name: activate to sort column ascending">Company Name</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 60.45px;" aria-label="Ship Date: activate to sort column ascending">Ship Date</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 53.45px;" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="m_table_1" rowspan="1" colspan="1" style="width: 32.45px;" aria-label="Type: activate to sort column ascending">Type</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 69.5px;" aria-label="Actions">Actions</th></tr>
									</thead>
									<tbody>
										
									<tr class="group"><td colspan="10">Argentina</td></tr><tr role="row" class="odd">
											
											<td tabindex="0">60429-081</td>
											
											<td>La Tigra</td>
											<td>90574 Holmberg Pass</td>
											<td>Leelah McGaraghan</td>
											<td>Shanahan, Sanford and Pfannerstill</td>
											<td>9/16/2016</td>
											<td><span class="m-badge  m-badge--danger m-badge--wide">Danger</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">43538-171</td>
											
											<td>Oberá</td>
											<td>79213 Orin Street</td>
											<td>Kalli Gusticke</td>
											<td>Hegmann-Nitzsche</td>
											<td>10/26/2016</td>
											<td><span class="m-badge  m-badge--metal m-badge--wide">Delivered</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Armenia</td></tr><tr role="row" class="odd">
											
											<td tabindex="0">36987-1902</td>
											
											<td>Aghavnadzor</td>
											<td>1722 Acker Pass</td>
											<td>Niall Manton</td>
											<td>Kirlin and Sons</td>
											<td>12/24/2017</td>
											<td><span class="m-badge  m-badge--info m-badge--wide">Info</span></td>
											<td><span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">Online</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">58232-0030</td>
											
											<td>Norashen</td>
											<td>7 Northridge Pass</td>
											<td>Hyacinthe Couronne</td>
											<td>Mertz-Kessler</td>
											<td>10/30/2016</td>
											<td><span class="m-badge  m-badge--metal m-badge--wide">Delivered</span></td>
											<td><span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">Online</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">10237-739</td>
											
											<td>Getahovit</td>
											<td>117 Londonderry Road</td>
											<td>North Kington</td>
											<td>Harber, Wuckert and Dare</td>
											<td>3/13/2017</td>
											<td><span class="m-badge  m-badge--success m-badge--wide">Success</span></td>
											<td><span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">Online</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Australia</td></tr><tr role="row" class="even">
											
											<td tabindex="0">50211-001</td>
											
											<td>Eastern Suburbs Mc</td>
											<td>2 Thackeray Street</td>
											<td>Cathrin Tarren</td>
											<td>Miller-Quigley</td>
											<td>1/23/2018</td>
											<td><span class="m-badge  m-badge--success m-badge--wide">Success</span></td>
											<td><span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">Online</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">49035-522</td>
											
											<td>Eastern Suburbs Mc</td>
											<td>074 Algoma Drive</td>
											<td>Heddi Castelli</td>
											<td>Kessler and Sons</td>
											<td>1/12/2017</td>
											<td><span class="m-badge  m-badge--info m-badge--wide">Info</span></td>
											<td><span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">Online</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Austria</td></tr><tr role="row" class="even">
											
											<td tabindex="0">31722-529</td>
											
											<td>Sankt Andrä-Höch</td>
											<td>3038 Trailsway Junction</td>
											<td>Tierney St. Louis</td>
											<td>Dicki-Kling</td>
											<td>5/20/2017</td>
											<td><span class="m-badge  m-badge--metal m-badge--wide">Delivered</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Bangladesh</td></tr><tr role="row" class="odd">
											
											<td tabindex="0">64893-903</td>
											
											<td>Pirojpur</td>
											<td>40 Magdeline Trail</td>
											<td>Gabbie Marrow</td>
											<td>Balistreri LLC</td>
											<td>9/29/2016</td>
											<td><span class="m-badge  m-badge--info m-badge--wide">Info</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Belarus</td></tr><tr role="row" class="even">
											
											<td tabindex="0">43853-0010</td>
											
											<td>Shchuchin</td>
											<td>378 Fairview Terrace</td>
											<td>Nadine Cary</td>
											<td>Ebert, Dickinson and Koelpin</td>
											<td>7/23/2017</td>
											<td><span class="m-badge  m-badge--success m-badge--wide">Success</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">67596-001</td>
											
											<td>Horad Rechytsa</td>
											<td>15 Towne Way</td>
											<td>Byrle Scorey</td>
											<td>Cassin, Renner and Jerde</td>
											<td>12/30/2016</td>
											<td><span class="m-badge m-badge--brand m-badge--wide">Pending</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Belize</td></tr><tr role="row" class="even">
											
											<td tabindex="0">62985-5081</td>
											
											<td>Placencia</td>
											<td>81 Thierer Junction</td>
											<td>Roz Garrison</td>
											<td>Kutch, Zulauf and Bahringer</td>
											<td>5/26/2016</td>
											<td><span class="m-badge  m-badge--danger m-badge--wide">Danger</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Bosnia and Herzegovina</td></tr><tr role="row" class="odd">
											
											<td tabindex="0">49035-321</td>
											
											<td>Velagići</td>
											<td>925 Birchwood Drive</td>
											<td>Bartram Aughton</td>
											<td>Corkery, Schoen and Hagenes</td>
											<td>4/17/2016</td>
											<td><span class="m-badge m-badge--brand m-badge--wide">Pending</span></td>
											<td><span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">Online</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr class="group"><td colspan="10">Brazil</td></tr><tr role="row" class="even">
											
											<td tabindex="0">11673-479</td>
											
											<td>Conceição das Alagoas</td>
											<td>191 Stone Corner Road</td>
											<td>Michaelina Plenderleith</td>
											<td>Legros-Gleichner</td>
											<td>2/21/2018</td>
											<td><span class="m-badge m-badge--brand m-badge--wide">Pending</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">54092-515</td>
											
											<td>Canguaretama</td>
											<td>32461 Ridgeway Alley</td>
											<td>Sibyl Amy</td>
											<td>Treutel-Ratke</td>
											<td>3/8/2017</td>
											<td><span class="m-badge  m-badge--success m-badge--wide">Success</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">68084-747</td>
											
											<td>Flores da Cunha</td>
											<td>9 Mariners Cove Place</td>
											<td>Chick Creany</td>
											<td>Mueller-DuBuque</td>
											<td>4/28/2018</td>
											<td><span class="m-badge  m-badge--info m-badge--wide">Info</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">46123-036</td>
											
											<td>Torres</td>
											<td>3 Northfield Avenue</td>
											<td>Myrilla Denyukin</td>
											<td>Bauch Group</td>
											<td>6/9/2016</td>
											<td><span class="m-badge  m-badge--danger m-badge--wide">Danger</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">60429-617</td>
											
											<td>Simão Dias</td>
											<td>3090 Nobel Way</td>
											<td>Aguste Trevain</td>
											<td>Farrell-Collins</td>
											<td>3/9/2016</td>
											<td><span class="m-badge  m-badge--primary m-badge--wide">Canceled</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">54868-4635</td>
											
											<td>Marau</td>
											<td>0 Swallow Park</td>
											<td>Cristal Thurlborn</td>
											<td>Nolan, Auer and Kunde</td>
											<td>3/6/2018</td>
											<td><span class="m-badge  m-badge--metal m-badge--wide">Delivered</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">65162-752</td>
											
											<td>Arroio do Meio</td>
											<td>7310 5th Terrace</td>
											<td>Collette Petrelluzzi</td>
											<td>Kuphal-Hickle</td>
											<td>11/4/2017</td>
											<td><span class="m-badge  m-badge--success m-badge--wide">Success</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">43269-904</td>
											
											<td>Itambé</td>
											<td>559 Algoma Avenue</td>
											<td>Jasper Wrighton</td>
											<td>Roob-Balistreri</td>
											<td>4/3/2016</td>
											<td><span class="m-badge  m-badge--success m-badge--wide">Success</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">41163-367</td>
											
											<td>Jardim do Seridó</td>
											<td>942 Marquette Trail</td>
											<td>Mavis Chazelle</td>
											<td>Rodriguez, Berge and Rempel</td>
											<td>2/6/2017</td>
											<td><span class="m-badge m-badge--brand m-badge--wide">Pending</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">68472-079</td>
											
											<td>Blumenau</td>
											<td>330 Bunker Hill Crossing</td>
											<td>Dita Ditty</td>
											<td>Herzog, Bartell and Johns</td>
											<td>11/13/2016</td>
											<td><span class="m-badge  m-badge--info m-badge--wide">Info</span></td>
											<td><span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">Direct</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="even">
											
											<td tabindex="0">58930-038</td>
											
											<td>Bariri</td>
											<td>199 Quincy Alley</td>
											<td>Blake Colliss</td>
											<td>Williamson-Hills</td>
											<td>11/23/2016</td>
											<td><span class="m-badge  m-badge--info m-badge--wide">Info</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr><tr role="row" class="odd">
											
											<td tabindex="0">0024-5851</td>
											
											<td>Parobé</td>
											<td>2914 Nevada Drive</td>
											<td>Myriam Lethbury</td>
											<td>Weimann, Barrows and Mohr</td>
											<td>4/10/2018</td>
											<td><span class="m-badge  m-badge--danger m-badge--wide">Danger</span></td>
											<td><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Retail</span></td>
											<td nowrap="">
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a></td>
										</tr></tbody>
								</table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="m_table_1_info" role="status" aria-live="polite">Showing 1 to 25 of 50 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="m_table_1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="m_table_1_previous"><a href="#" aria-controls="m_table_1" data-dt-idx="0" tabindex="0" class="page-link"><i class="la la-angle-left"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="m_table_1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="m_table_1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="m_table_1_next"><a href="#" aria-controls="m_table_1" data-dt-idx="3" tabindex="0" class="page-link"><i class="la la-angle-right"></i></a></li></ul></div></div></div></div>
							</div>
						</div>
											</div>
											<div class="tab-pane" id="m_tabs_5_3" role="tabpanel">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
												survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
											</div>
											
										</div>
									</div>
								</div>
						
						

						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>
			</div>

			<!-- end:: Body -->

			<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							
						</div>
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">About</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">Privacy</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">T&C</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">Purchase</span>
									</a>
								</li>
								<li class="m-nav__item m-nav__item">
									<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
										<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>

			<!-- end::Footer -->
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Sidebar -->
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					

					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">Dummy Settings Only</a>
					</li>
					

				</ul>
				<div class="tab-content">
					
					<div class="tab-pane active" id="m_quick_sidebar_tabs_settings" role="tabpanel">
						<div class="m-list-settings m-scrollable">
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">General Settings</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Email Notifications</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Site Tracking</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">SMS Alerts</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Backup Storage</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Audit Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">System Settings</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">System Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Error Reporting</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Applications Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Backup Servers</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Audit Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end::Quick Sidebar -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

		<!--begin::Base Scripts -->
		<script src="../assets/doctracc/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../assets/doctracc/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Base Scripts -->

		<!--begin::Page Vendors Scripts -->
		<script src="../assets/doctracc/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>

		<!--end::Page Vendors Scripts -->

		<!--begin::Page Snippets -->
		<script src="../assets/doctracc/assets/app/js/dashboard.js" type="text/javascript"></script>

		<!--end::Page Snippets -->
	</body>

	<!-- end::Body -->
</html>