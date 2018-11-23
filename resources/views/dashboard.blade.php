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
						@include('genTopBar')
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
								<h3 class="m-subheader__title ">Dashboard</h3>
							</div>
							<div>
								<span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
									<span class="m-subheader__daterange-label">
										<span class="m-subheader__daterange-title"></span>
										<span class="m-subheader__daterange-date m--font-brand"></span>
									</span>
									<a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="la la-angle-down"></i>
									</a>
								</span>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">

						<!--Begin::Section-->
						


						<!--End::Section-->

						<!--Begin::Section-->
						<div class="m-portlet">
							<div class="m-portlet__body  m-portlet__body--no-padding">
								<div class="row m-row--no-padding m-row--col-separator-xl">
									<div class="col-xl-4">

										<!--begin:: Widgets/Stats2-1 -->
										<div class="m-widget1">
											<div class="m-widget1__item">
												<div class="row m-row--no-padding align-items-center">
													<div class="col">
														<h3 class="m-widget1__title">Member Profit</h3>
														<span class="m-widget1__desc">Awerage Weekly Profit</span>
													</div>
													<div class="col m--align-right">
														<span class="m-widget1__number m--font-brand">+$17,800</span>
													</div>
												</div>
											</div>
											<div class="m-widget1__item">
												<div class="row m-row--no-padding align-items-center">
													<div class="col">
														<h3 class="m-widget1__title">Orders</h3>
														<span class="m-widget1__desc">Weekly Customer Orders</span>
													</div>
													<div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">+1,800</span>
													</div>
												</div>
											</div>
											<div class="m-widget1__item">
												<div class="row m-row--no-padding align-items-center">
													<div class="col">
														<h3 class="m-widget1__title">Issue Reports</h3>
														<span class="m-widget1__desc">System bugs and issues</span>
													</div>
													<div class="col m--align-right">
														<span class="m-widget1__number m--font-success">-27,49%</span>
													</div>
												</div>
											</div>
										</div>

										<!--end:: Widgets/Stats2-1 -->
									</div>
									<div class="col-xl-4">

										<!--begin:: Widgets/Daily Sales-->
										<div class="m-widget14">
											<div class="m-widget14__header m--margin-bottom-30">
												<h3 class="m-widget14__title">
													Daily Dummy
												</h3>
												<span class="m-widget14__desc">
													Check out each collumn for more details
												</span>
											</div>
											<div class="m-widget14__chart" style="height:120px;">
												<canvas id="m_chart_daily_sales"></canvas>
											</div>
										</div>

										<!--end:: Widgets/Daily Sales-->
									</div>
									<div class="col-xl-4">

										<!--begin:: Widgets/Profit Share-->
										<div class="m-widget14">
											<div class="m-widget14__header">
												<h3 class="m-widget14__title">
													Profit Share
												</h3>
												<span class="m-widget14__desc">
													Profit Share between customers
												</span>
											</div>
											<div class="row  align-items-center">
												<div class="col">
													<div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
														<div class="m-widget14__stat">45</div>
													</div>
												</div>
												<div class="col">
													<div class="m-widget14__legends">
														<div class="m-widget14__legend">
															<span class="m-widget14__legend-bullet m--bg-accent"></span>
															<span class="m-widget14__legend-text">37% Sport Tickets</span>
														</div>
														<div class="m-widget14__legend">
															<span class="m-widget14__legend-bullet m--bg-warning"></span>
															<span class="m-widget14__legend-text">47% Business Events</span>
														</div>
														<div class="m-widget14__legend">
															<span class="m-widget14__legend-bullet m--bg-brand"></span>
															<span class="m-widget14__legend-text">19% Others</span>
														</div>
													</div>
												</div>
											</div>
										</div>

										<!--end:: Widgets/Profit Share-->
									</div>
								</div>
							</div>
						</div>

						<!--End::Section-->

						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-4">

								<!--begin:: Widgets/Blog-->
								<div class="m-portlet m-portlet--head-overlay m-portlet--full-height  m-portlet--rounded-force">
									<div class="m-portlet__head m-portlet__head--fit-">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text m--font-light">
													Lorem Ipsum
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light">
														2018
													</a>
													<div class="m-dropdown__wrapper">
														<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
														<div class="m-dropdown__inner">
															<div class="m-dropdown__body">
																<div class="m-dropdown__content">
																	<ul class="m-nav">
																		<li class="m-nav__section m-nav__section--first">
																			<span class="m-nav__section-text">Orders</span>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-share"></i>
																				<span class="m-nav__link-text">Pending</span>
																			</a>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-chat-1"></i>
																				<span class="m-nav__link-text">Delivered</span>
																			</a>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-info"></i>
																				<span class="m-nav__link-text">Canceled</span>
																			</a>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																				<span class="m-nav__link-text">Approved</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget27 m-portlet-fit--sides">
											<div class="m-widget27__pic">
												<img src="../assets/doctracc/assets/app/media/img/bg/bg-4.jpg" alt="">
												<h3 class="m-widget27__title m--font-light">
													<span>
														<span>$</span>256,100</span>
												</h3>
												<div class="m-widget27__btn">
													<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--bolder">Inclusive All Earnings</button>
												</div>
											</div>
											<div class="m-widget27__container">

												<!-- begin::Nav pills -->
												<ul class="m-widget27__nav-items nav nav-pills nav-fill" role="tablist">
													<li class="m-widget27__nav-item nav-item">
														<a class="nav-link active" data-toggle="pill" href="#m_personal_income_quater_1">Quater 1</a>
													</li>
													<li class="m-widget27__nav-item nav-item">
														<a class="nav-link" data-toggle="pill" href="#m_personal_income_quater_2">Quater 2</a>
													</li>
													<li class="m-widget27__nav-item nav-item">
														<a class="nav-link" data-toggle="pill" href="#m_personal_income_quater_3">Quater 3</a>
													</li>
													<li class="m-widget27__nav-item nav-item">
														<a class="nav-link" data-toggle="pill" href="#m_personal_income_quater_4">Quater 4</a>
													</li>
												</ul>

												<!-- end::Nav pills -->

												<!-- begin::Tab Content -->
												<div class="m-widget27__tab tab-content m-widget27--no-padding">
													<div id="m_personal_income_quater_1" class="tab-pane active">
														<div class="row  align-items-center">
															<div class="col">
																<div id="m_chart_personal_income_quater_1" class="m-widget27__chart" style="height: 160px">
																	<div class="m-widget27__stat">37</div>
																</div>
															</div>
															<div class="col">
																<div class="m-widget27__legends">
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-accent"></span>
																		<span class="m-widget27__legend-text">37% Case</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-warning"></span>
																		<span class="m-widget27__legend-text">42% Events</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-brand"></span>
																		<span class="m-widget27__legend-text">19% Others</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div id="m_personal_income_quater_2" class="tab-pane fade">
														<div class="row  align-items-center">
															<div class="col">
																<div id="m_chart_personal_income_quater_2" class="m-widget27__chart" style="height: 160px">
																	<div class="m-widget27__stat">70</div>
																</div>
															</div>
															<div class="col">
																<div class="m-widget27__legends">
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-focus"></span>
																		<span class="m-widget27__legend-text">57% Case</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-success"></span>
																		<span class="m-widget27__legend-text">20% Events</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-danger"></span>
																		<span class="m-widget27__legend-text">19% Others</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div id="m_personal_income_quater_3" class="tab-pane fade">
														<div class="row  align-items-center">
															<div class="col">
																<div id="m_chart_personal_income_quater_3" class="m-widget27__chart" style="height: 160px">
																	<div class="m-widget27__stat">67</div>
																</div>
															</div>
															<div class="col">
																<div class="m-widget27__legends">
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-info"></span>
																		<span class="m-widget27__legend-text">47% Case</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-danger"></span>
																		<span class="m-widget27__legend-text">55% Events</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-brand"></span>
																		<span class="m-widget27__legend-text">27% Others</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div id="m_personal_income_quater_4" class="tab-pane fade">
														<div class="row  align-items-center">
															<div class="col">
																<div id="m_chart_personal_income_quater_4" class="m-widget27__chart" style="height: 160px">
																	<div class="m-widget27__stat">77</div>
																</div>
															</div>
															<div class="col">
																<div class="m-widget27__legends">
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-warning"></span>
																		<span class="m-widget27__legend-text">37% Case</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-primary"></span>
																		<span class="m-widget27__legend-text">65% Events</span>
																	</div>
																	<div class="m-widget27__legend">
																		<span class="m-widget27__legend-bullet m--bg-danger"></span>
																		<span class="m-widget27__legend-text">33% Others</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<!-- end::Tab Content -->
											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Blog-->
							</div>
							<div class="col-xl-4">

								<!--begin:: Widgets/Blog-->
								<div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
									<div class="m-portlet__head m-portlet__head--fit">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text m--font-light">
													Finance Stats
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light">
														2018
													</a>
													<div class="m-dropdown__wrapper">
														<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
														<div class="m-dropdown__inner">
															<div class="m-dropdown__body">
																<div class="m-dropdown__content">
																	<ul class="m-nav">
																		<li class="m-nav__section m-nav__section--first">
																			<span class="m-nav__section-text">Reports</span>
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
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget28">
											<div class="m-widget28__pic m-portlet-fit--sides"></div>
											<div class="m-widget28__container">

												<!-- begin::Nav pills -->
												<ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
													<li class="m-widget28__nav-item nav-item">
														<a class="nav-link active" data-toggle="pill" href="#menu11">
															<span>
																<i class="fa flaticon-pie-chart"></i>
															</span>
															<span>GMI Taxes</span>
														</a>
													</li>
													<li class="m-widget28__nav-item nav-item">
														<a class="nav-link" data-toggle="pill" href="#menu21">
															<span>
																<i class="fa flaticon-file-1"></i>
															</span>
															<span>IMT Invoice</span>
														</a>
													</li>
													<li class="m-widget28__nav-item nav-item">
														<a class="nav-link" data-toggle="pill" href="#menu31">
															<span>
																<i class="fa flaticon-clipboard"></i>
															</span>
															<span>Main Notes</span>
														</a>
													</li>
												</ul>

												<!-- end::Nav pills -->

												<!-- begin::Tab Content -->
												<div class="m-widget28__tab tab-content">
													<div id="menu11" class="m-widget28__tab-container tab-pane active">
														<div class="m-widget28__tab-items">
															<div class="m-widget28__tab-item">
																<span>Company Name</span>
																<span>SLT Back-end Solutions</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>INE Number</span>
																<span>D330-1234562546</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>Total Charges</span>
																<span>USD 1,250.000</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>Project Description</span>
																<span>Creating Back-end Components</span>
															</div>
														</div>
													</div>
													<div id="menu21" class="m-widget28__tab-container tab-pane fade">
														<div class="m-widget28__tab-items">
															<div class="m-widget28__tab-item">
																<span>Project Description</span>
																<span>Back-End Web Architecture</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>Total Charges</span>
																<span>USD 2,170.000</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>INE Number</span>
																<span>D110-1234562546</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>Company Name</span>
																<span>SLT Back-end Solutions</span>
															</div>
														</div>
													</div>
													<div id="menu31" class="m-widget28__tab-container tab-pane fade">
														<div class="m-widget28__tab-items">
															<div class="m-widget28__tab-item">
																<span>Total Charges</span>
																<span>USD 3,450.000</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>Project Description</span>
																<span>Creating Back-end Components</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>Company Name</span>
																<span>SLT Back-end Solutions</span>
															</div>
															<div class="m-widget28__tab-item">
																<span>INE Number</span>
																<span>D510-7431562548</span>
															</div>
														</div>
													</div>
												</div>

												<!-- end::Tab Content -->
											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Blog-->
							</div>
							<div class="col-xl-4">

								<!--begin:: Packages-->
								<div class="m-portlet m--bg-warning m-portlet--bordered-semi m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text m--font-light">
													Packages
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light">
														2018
													</a>
													<div class="m-dropdown__wrapper">
														<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
														<div class="m-dropdown__inner">
															<div class="m-dropdown__body">
																<div class="m-dropdown__content">
																	<ul class="m-nav">
																		<li class="m-nav__section m-nav__section--first">
																			<span class="m-nav__section-text">Reports</span>
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
																		<li class="m-nav__section m-nav__section--first">
																			<span class="m-nav__section-text">Export</span>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																				<span class="m-nav__link-text">PDF</span>
																			</a>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																				<span class="m-nav__link-text">Excel</span>
																			</a>
																		</li>
																		<li class="m-nav__item">
																			<a href="" class="m-nav__link">
																				<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																				<span class="m-nav__link-text">CSV</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">

										<!--begin::Widget 29-->
										<div class="m-widget29">
											<div class="m-widget_content">
												<h3 class="m-widget_content-title">Monthly Income</h3>
												<div class="m-widget_content-items">
													<div class="m-widget_content-item">
														<span>Total</span>
														<span class="m--font-accent">$680</span>
													</div>
													<div class="m-widget_content-item">
														<span>Change</span>
														<span class="m--font-brand">+15%</span>
													</div>
													<div class="m-widget_content-item">
														<span>Licenses</span>
														<span>29</span>
													</div>
												</div>
											</div>
											<div class="m-widget_content">
												<h3 class="m-widget_content-title">Taxes info</h3>
												<div class="m-widget_content-items">
													<div class="m-widget_content-item">
														<span>Total</span>
														<span class="m--font-accent">22.50</span>
													</div>
													<div class="m-widget_content-item">
														<span>Change</span>
														<span class="m--font-brand">+15%</span>
													</div>
													<div class="m-widget_content-item">
														<span>Count</span>
														<span>701</span>
													</div>
												</div>
											</div>
											<div class="m-widget_content">
												<h3 class="m-widget_content-title">Partners Sale</h3>
												<div class="m-widget_content-items">
													<div class="m-widget_content-item">
														<span>Total</span>
														<span class="m--font-accent">$680</span>
													</div>
													<div class="m-widget_content-item">
														<span>Change</span>
														<span class="m--font-brand">+15%</span>
													</div>
													<div class="m-widget_content-item">
														<span>Licenses</span>
														<span>29</span>
													</div>
												</div>
											</div>
										</div>

										<!--end::Widget 29-->
									</div>
								</div>

								<!--end:: Packages-->
							</div>
						</div>

						<!--End::Section-->

						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-8">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Application Status
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab">
														Last Month
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
														All Time
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget11_tab1_content">

												<!--begin::Widget 11-->
												<div class="m-widget11">
													<div class="table-responsive">

														<!--begin::Table-->
														<table class="table">

															<!--begin::Thead-->
															<thead>
																<tr>
																	<td class="m-widget11__label">#</td>
																	<td class="m-widget11__app">Application</td>
																	<td class="m-widget11__sales">Sales</td>
																	<td class="m-widget11__change">Change</td>
																	<td class="m-widget11__price">Avg Price</td>
																	<td class="m-widget11__total m--align-right">Total</td>
																</tr>
															</thead>

															<!--end::Thead-->

															<!--begin::Tbody-->
															<tbody>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Vertex 2.0</span>
																		<span class="m-widget11__sub">Vertex To By Again</span>
																	</td>
																	<td>19,200</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_1_1" style="display: block; width: 100px; height: 50px;" width="125" height="62" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$63</td>
																	<td class="m--align-right m--font-brand">$14,740</td>
																</tr>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Metronic</span>
																		<span class="m-widget11__sub">Powerful Admin Theme</span>
																	</td>
																	<td>24,310</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_1_2" style="display: block; width: 100px; height: 50px;" width="125" height="62" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$39</td>
																	<td class="m--align-right m--font-brand">$16,010</td>
																</tr>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Apex</span>
																		<span class="m-widget11__sub">The Best Selling App</span>
																	</td>
																	<td>9,076</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_1_3" style="display: block; width: 100px; height: 50px;" width="125" height="62" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$105</td>
																	<td class="m--align-right m--font-brand">$37,200</td>
																</tr>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Cascades</span>
																		<span class="m-widget11__sub">Design Tool</span>
																	</td>
																	<td>11,094</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_1_4" style="display: block; width: 100px; height: 50px;" width="125" height="62" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$16</td>
																	<td class="m--align-right m--font-brand">$8,520</td>
																</tr>
															</tbody>

															<!--end::Tbody-->
														</table>

														<!--end::Table-->
													</div>
													<div class="m-widget11__action m--align-right">
														<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--hover-brand">Generate Report</button>
													</div>
												</div>

												<!--end::Widget 11-->
											</div>
											<div class="tab-pane" id="m_widget11_tab2_content">

												<!--begin::Widget 11-->
												<div class="m-widget11">
													<div class="table-responsive">

														<!--begin::Table-->
														<table class="table">

															<!--begin::Thead-->
															<thead>
																<tr>
																	<td class="m-widget11__label">#</td>
																	<td class="m-widget11__app">Application</td>
																	<td class="m-widget11__sales">Sales</td>
																	<td class="m-widget11__change">Change</td>
																	<td class="m-widget11__price">Avg Price</td>
																	<td class="m-widget11__total m--align-right">Total</td>
																</tr>
															</thead>

															<!--end::Thead-->

															<!--begin::Tbody-->
															<tbody>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Loop</span>
																		<span class="m-widget11__sub">CRM System</span>
																	</td>
																	<td>19,200</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px">
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_2_1" style="display: block; width: 0px; height: 0px;" height="0" width="0" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$63</td>
																	<td class="m--align-right m--font-brand">$34,740</td>
																</tr>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Selto</span>
																		<span class="m-widget11__sub">Powerful Website Builder</span>
																	</td>
																	<td>24,310</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px">
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_2_2" style="display: block; width: 0px; height: 0px;" height="0" width="0" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$39</td>
																	<td class="m--align-right m--font-brand">$46,010</td>
																</tr>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Jippo</span>
																		<span class="m-widget11__sub">The Best Selling App</span>
																	</td>
																	<td>9,076</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px">
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_2_3" style="display: block; width: 0px; height: 0px;" height="0" width="0" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$105</td>
																	<td class="m--align-right m--font-brand">$67,800</td>
																</tr>
																<tr>
																	<td>
																		<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																			<input type="checkbox">
																			<span></span>
																		</label>
																	</td>
																	<td>
																		<span class="m-widget11__title">Verto</span>
																		<span class="m-widget11__sub">Web Development Tool</span>
																	</td>
																	<td>11,094</td>
																	<td>
																		<div class="m-widget11__chart" style="height:50px; width: 100px">
																			<iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
																			<canvas id="m_chart_sales_by_apps_2_4" style="display: block; width: 0px; height: 0px;" height="0" width="0" class="chartjs-render-monitor"></canvas>
																		</div>
																	</td>
																	<td>$16</td>
																	<td class="m--align-right m--font-brand">$18,520</td>
																</tr>
															</tbody>

															<!--end::Tbody-->
														</table>

														<!--end::Table-->
													</div>
													<div class="m-widget11__action m--align-right">
														<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--hover-brand">Generate Report</button>
													</div>
												</div>

												<!--end::Widget 11-->
											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>
							<div class="col-xl-4">

								<!--begin:: Widgets/Latest Updates-->
								<div class="m-portlet m-portlet--full-height m-portlet--fit ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Latest Updates
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
														Today
													</a>
													<div class="m-dropdown__wrapper">
														<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
														<div class="m-dropdown__inner">
															<div class="m-dropdown__body">
																<div class="m-dropdown__content">
																	<ul class="m-nav">
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
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
											<div class="m-widget4__item">
												<div class="m-widget4__ext">
													<a href="#" class="m-widget4__icon m--font-brand">
														<i class="flaticon-interface-3"></i>
													</a>
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__text">
														Make Metronic Great Again
													</span>
												</div>
												<div class="m-widget4__ext">
													<span class="m-widget4__number m--font-accent">+500</span>
												</div>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__ext">
													<a href="#" class="m-widget4__icon m--font-brand">
														<i class="flaticon-folder-4"></i>
													</a>
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__text">
														Green Maker Team
													</span>
												</div>
												<div class="m-widget4__ext">
													<span class="m-widget4__stats m--font-info">
														<span class="m-widget4__number m--font-accent">-64</span>
													</span>
												</div>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__ext">
													<a href="#" class="m-widget4__icon m--font-brand">
														<i class="flaticon-line-graph"></i>
													</a>
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__text">
														Make Apex Great Again
													</span>
												</div>
												<div class="m-widget4__ext">
													<span class="m-widget4__stats m--font-info">
														<span class="m-widget4__number m--font-accent">+1080</span>
													</span>
												</div>
											</div>
											<div class="m-widget4__item m-widget4__item--last">
												<div class="m-widget4__ext">
													<a href="#" class="m-widget4__icon m--font-brand">
														<i class="flaticon-diagram"></i>
													</a>
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__text">
														A Programming Language
													</span>
												</div>
												<div class="m-widget4__ext">
													<span class="m-widget4__stats m--font-info">
														<span class="m-widget4__number m--font-accent">+19</span>
													</span>
												</div>
											</div>
											<div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="m_chart_latest_updates" style="display: block; height: 120px; width: 381px;" width="476" height="150" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Latest Updates-->
							</div>
						</div>

						<!--End::Section-->

						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-6 col-lg-12">

								<!--Begin::Portlet-->
								<div class="m-portlet  m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Recent Activities
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
													<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
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
																			<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Cancel</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-scrollable" data-scrollable="true" data-height="380" data-mobile-height="300">

											<!--Begin::Timeline 2 -->
											<div class="m-timeline-2">
												<div class="m-timeline-2__items  m--padding-top-25 m--padding-bottom-30">
													<div class="m-timeline-2__item">
														<span class="m-timeline-2__item-time">10:00</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-danger"></i>
														</div>
														<div class="m-timeline-2__item-text  m--padding-top-5">
															Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
															<br> incididunt ut labore et dolore magna
														</div>
													</div>
													<div class="m-timeline-2__item m--margin-top-30">
														<span class="m-timeline-2__item-time">12:45</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-success"></i>
														</div>
														<div class="m-timeline-2__item-text m-timeline-2__item-text--bold">
															AEOL Meeting With
														</div>
														<div class="m-list-pics m-list-pics--sm m--padding-left-20">
															<a href="#">
																<img src="../assets/doctracc/assets/app/media/img/users/100_4.jpg" title="">
															</a>
															<a href="#">
																<img src="../assets/doctracc/assets/app/media/img/users/100_13.jpg" title="">
															</a>
															<a href="#">
																<img src="../assets/doctracc/assets/app/media/img/users/100_11.jpg" title="">
															</a>
															<a href="#">
																<img src="../assets/doctracc/assets/app/media/img/users/100_14.jpg" title="">
															</a>
														</div>
													</div>
													<div class="m-timeline-2__item m--margin-top-30">
														<span class="m-timeline-2__item-time">14:00</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-brand"></i>
														</div>
														<div class="m-timeline-2__item-text m--padding-top-5">
															Make Deposit
															<a href="#" class="m-link m-link--brand m--font-bolder">USD 700</a> To ESL.
														</div>
													</div>
													<div class="m-timeline-2__item m--margin-top-30">
														<span class="m-timeline-2__item-time">16:00</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-warning"></i>
														</div>
														<div class="m-timeline-2__item-text m--padding-top-5">
															Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
															<br> incididunt ut labore et dolore magna elit enim at minim
															<br> veniam quis nostrud
														</div>
													</div>
													<div class="m-timeline-2__item m--margin-top-30">
														<span class="m-timeline-2__item-time">17:00</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-info"></i>
														</div>
														<div class="m-timeline-2__item-text m--padding-top-5">
															Placed a new order in
															<a href="#" class="m-link m-link--brand m--font-bolder">SIGNATURE MOBILE</a> marketplace.
														</div>
													</div>
													<div class="m-timeline-2__item m--margin-top-30">
														<span class="m-timeline-2__item-time">16:00</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-brand"></i>
														</div>
														<div class="m-timeline-2__item-text m--padding-top-5">
															Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
															<br> incididunt ut labore et dolore magna elit enim at minim
															<br> veniam quis nostrud
														</div>
													</div>
													<div class="m-timeline-2__item m--margin-top-30">
														<span class="m-timeline-2__item-time">17:00</span>
														<div class="m-timeline-2__item-cricle">
															<i class="fa fa-genderless m--font-danger"></i>
														</div>
														<div class="m-timeline-2__item-text m--padding-top-5">
															Received a new feedback on
															<a href="#" class="m-link m-link--brand m--font-bolder">FinancePro App</a> product.
														</div>
													</div>
												</div>
											</div>

											<!--End::Timeline 2 -->
										</div>
									</div>
								</div>

								<!--End::Portlet-->
							</div>
							<div class="col-xl-6 col-lg-12">

								<!--Begin::Portlet-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Recent Notifications
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
														Today
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content" role="tab">
														Month
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget2_tab1_content">

												<!--Begin::Timeline 3 -->
												<div class="m-timeline-3">
													<div class="m-timeline-3__items">
														<div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time">09:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Bob
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--warning">
															<span class="m-timeline-3__item-time">10:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Sean
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time">11:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit eiusmdd tempor
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--success">
															<span class="m-timeline-3__item-time">12:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--danger">
															<span class="m-timeline-3__item-time">14:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit,consectetur eiusmdd
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Derrick
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time">15:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit,consectetur
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Iman
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time">17:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit consectetur eiusmdd tempor
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Aziko
																	</a>
																</span>
															</div>
														</div>
													</div>
												</div>

												<!--End::Timeline 3 -->
											</div>
											<div class="tab-pane" id="m_widget2_tab2_content">

												<!--Begin::Timeline 3 -->
												<div class="m-timeline-3">
													<div class="m-timeline-3__items">
														<div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time m--font-focus">09:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Contrary to popular belief, Lorem Ipsum is not simply random text.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Bob
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--warning">
															<span class="m-timeline-3__item-time m--font-warning">10:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	There are many variations of passages of Lorem Ipsum available.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Sean
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time m--font-primary">11:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Contrary to popular belief, Lorem Ipsum is not simply random text.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--success">
															<span class="m-timeline-3__item-time m--font-success">12:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	The standard chunk of Lorem Ipsum used since the 1500s is reproduced.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--danger">
															<span class="m-timeline-3__item-time m--font-warning">14:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Latin words, combined with a handful of model sentence structures.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Derrick
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time m--font-info">15:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Contrary to popular belief, Lorem Ipsum is not simply random text.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Iman
																	</a>
																</span>
															</div>
														</div>
														<div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time m--font-danger">17:00</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem Ipsum is therefore always free from repetition, injected humour.
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Aziko
																	</a>
																</span>
															</div>
														</div>
													</div>
												</div>

												<!--End::Timeline 3 -->
											</div>
										</div>
									</div>
								</div>

								<!--End::Portlet-->
							</div>
						</div>

						<!--End::Section-->

						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-8">
								<div class="m-portlet m-portlet--mobile ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Exclusive Datatable Sample
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
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
										<div class="m_datatable" id="m_datatable_latest_orders"></div>

										<!--end: Datatable -->
									</div>
								</div>
							</div>
							<div class="col-xl-4">

								<!--begin:: Widgets/Audit Log-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Audit Log
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
														Today
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab">
														Week
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab3_content" role="tab">
														Month
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget4_tab1_content">
												<div class="m-scrollable" data-scrollable="true" data-height="400" style="height: 400px; overflow: hidden;">
													<div class="m-list-timeline m-list-timeline--skin-light">
														<div class="m-list-timeline__items">
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
																<span class="m-list-timeline__text">12 new users registered</span>
																<span class="m-list-timeline__time">Just now</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
																<span class="m-list-timeline__text">System shutdown
																	<span class="m-badge m-badge--success m-badge--wide">pending</span>
																</span>
																<span class="m-list-timeline__time">14 mins</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
																<span class="m-list-timeline__text">New invoice received</span>
																<span class="m-list-timeline__time">20 mins</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
																<span class="m-list-timeline__text">DB overloaded 80%
																	<span class="m-badge m-badge--info m-badge--wide">settled</span>
																</span>
																<span class="m-list-timeline__time">1 hr</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
																<span class="m-list-timeline__text">System error -
																	<a href="#" class="m-link">Check</a>
																</span>
																<span class="m-list-timeline__time">2 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--brand"></span>
																<span class="m-list-timeline__text">Production server down</span>
																<span class="m-list-timeline__time">3 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
																<span class="m-list-timeline__text">Production server up</span>
																<span class="m-list-timeline__time">5 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
																<span href="" class="m-list-timeline__text">New order received
																	<span class="m-badge m-badge--danger m-badge--wide">urgent</span>
																</span>
																<span class="m-list-timeline__time">7 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
																<span class="m-list-timeline__text">12 new users registered</span>
																<span class="m-list-timeline__time">Just now</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
																<span class="m-list-timeline__text">System shutdown
																	<span class="m-badge m-badge--success m-badge--wide">pending</span>
																</span>
																<span class="m-list-timeline__time">14 mins</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
																<span class="m-list-timeline__text">New invoice received</span>
																<span class="m-list-timeline__time">20 mins</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
																<span class="m-list-timeline__text">DB overloaded 80%
																	<span class="m-badge m-badge--info m-badge--wide">settled</span>
																</span>
																<span class="m-list-timeline__time">1 hr</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
																<span class="m-list-timeline__text">New invoice received</span>
																<span class="m-list-timeline__time">20 mins</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
																<span class="m-list-timeline__text">DB overloaded 80%
																	<span class="m-badge m-badge--info m-badge--wide">settled</span>
																</span>
																<span class="m-list-timeline__time">1 hr</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
																<span class="m-list-timeline__text">System error -
																	<a href="#" class="m-link">Check</a>
																</span>
																<span class="m-list-timeline__time">2 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--brand"></span>
																<span class="m-list-timeline__text">Production server down</span>
																<span class="m-list-timeline__time">3 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
																<span class="m-list-timeline__text">Production server up</span>
																<span class="m-list-timeline__time">5 hrs</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
																<span href="" class="m-list-timeline__text">New order received
																	<span class="m-badge m-badge--danger m-badge--wide">urgent</span>
																</span>
																<span class="m-list-timeline__time">7 hrs</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="m_widget4_tab2_content">
											</div>
											<div class="tab-pane" id="m_widget4_tab3_content">
											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Audit Log-->
							</div>
						</div>

						<!--End::Section-->

						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-8">

								<!--begin:: Widgets/Best Sellers-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Sample Data
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget5_tab1_content" role="tab">
														Last Month
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content" role="tab">
														last Year
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab3_content" role="tab">
														All time
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">

										<!--begin::Content-->
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">

												<!--begin::m-widget5-->
												<div class="m-widget5">
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product6.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Great Logo Designn
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-label">
																		author:
																	</span>
																	<span class="m-widget5__info-author-name">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">19,200</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">1046</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product10.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Branding Mockup
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">24,583</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">3809</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product11.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Awesome Mobile App
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">10,054</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">1103</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
												</div>

												<!--end::m-widget5-->
											</div>
											<div class="tab-pane" id="m_widget5_tab2_content" aria-expanded="false">

												<!--begin::m-widget5-->
												<div class="m-widget5">
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product11.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Branding Mockup
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">24,583</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">3809</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product6.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Great Logo Designn
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">19,200</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">1046</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product10.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Awesome Mobile App
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">10,054</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">1103</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
												</div>

												<!--end::m-widget5-->
											</div>
											<div class="tab-pane" id="m_widget5_tab3_content" aria-expanded="false">

												<!--begin::m-widget5-->
												<div class="m-widget5">
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product10.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Branding Mockup
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">10.054</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">1103</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product11.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Great Logo Designn
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">24,583</span>
																<br>
																<span class="m-widget5__sales">sales</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">3809</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
													<div class="m-widget5__item">
														<div class="m-widget5__content">
															<div class="m-widget5__pic">
																<img class="m-widget7__img" src="../assets/doctracc/assets/app/media/img/products/product6.jpg" alt="">
															</div>
															<div class="m-widget5__section">
																<h4 class="m-widget5__title">
																	Awesome Mobile App
																</h4>
																<span class="m-widget5__desc">
																	Make Doctracc Great Again.Lorem Ipsum Amet
																</span>
																<div class="m-widget5__info">
																	<span class="m-widget5__author">
																		Author:
																	</span>
																	<span class="m-widget5__info-author m--font-info">
																		Fly themes
																	</span>
																	<span class="m-widget5__info-label">
																		Released:
																	</span>
																	<span class="m-widget5__info-date m--font-info">
																		23.08.17
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget5__content">
															<div class="m-widget5__stats1">
																<span class="m-widget5__number">19,200</span>
																<br>
																<span class="m-widget5__sales">1046</span>
															</div>
															<div class="m-widget5__stats2">
																<span class="m-widget5__number">1046</span>
																<br>
																<span class="m-widget5__votes">votes</span>
															</div>
														</div>
													</div>
												</div>

												<!--end::m-widget5-->
											</div>
										</div>

										<!--end::Content-->
									</div>
								</div>

								<!--end:: Widgets/Best Sellers-->
							</div>
							<div class="col-xl-4">

								<!--begin:: Widgets/Authors Profit-->
								<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Authors Profit
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
														All
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
																			<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Cancel</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget4">
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--logo">
													<img src="../assets/doctracc/assets/app/media/img/client-logos/logo5.png" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Trump Themes
													</span>
													<br>
													<span class="m-widget4__sub">
														Make Doctracc Great Again
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$2500</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--logo">
													<img src="../assets/doctracc/assets/app/media/img/client-logos/logo4.png" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														StarBucks
													</span>
													<br>
													<span class="m-widget4__sub">
														Good Coffee & Snacks
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">-$290</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--logo">
													<img src="../assets/doctracc/assets/app/media/img/client-logos/logo3.png" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Phyton
													</span>
													<br>
													<span class="m-widget4__sub">
														A Programming Language
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$17</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--logo">
													<img src="../assets/doctracc/assets/app/media/img/client-logos/logo2.png" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														GreenMakers
													</span>
													<br>
													<span class="m-widget4__sub">
														Make Green Great Again
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">-$2.50</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__img m-widget4__img--logo">
													<img src="../assets/doctracc/assets/app/media/img/client-logos/logo1.png" alt="">
												</div>
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														FlyThemes
													</span>
													<br>
													<span class="m-widget4__sub">
														A Let's Fly Fast Again Language
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$200</span>
												</span>
											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Authors Profit-->
							</div>
						</div>

						<!--End::Section-->
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