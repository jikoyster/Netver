@include('HEAD')

        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">Security</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">System Setup</span>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">Security</span>
										</a>
									</li>
								</ul>
							</div>
							
						</div>
					</div>
                    <!-- END: Subheader -->
                    

                    <div class="m-content">
						<div class="m-portlet">
									
									<div class="m-portlet__body">
										<ul class="nav nav-pills nav-fill" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" data-toggle="tab" href="#m-tab1">Feature Options</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#m-tab2">ACL</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#m-tab3">Roles</a>
                                            </li>
                                            <li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#m-tab4">User Groups</a>
                                            </li>
                                            <li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#m-tab5">Permissions</a>
											</li>
											
										</ul>
                                        <!-- FEATURE OPTIONS CONTENT -->
										<div class="tab-content">
											<div class="tab-pane active" id="m-tab1" role="tabpanel">
												@include('system-setup.security.feature-options')
                                            </div>
											<div class="tab-pane" id="m-tab2" role="tabpanel">
                                                @include('system-setup.security.acl')
                                            </div>
                                            

											<div class="tab-pane" id="m-tab3" role="tabpanel">
                                                @include('system-setup.security.roles')
                                            </div>
                                            

                                            <div class="tab-pane" id="m-tab4" role="tabpanel">
                                                @include('system-setup.security.user-groups')
                                            </div>
                                            
                                            <div class="tab-pane" id="m-tab5" role="tabpanel">
                                                @include('system-setup.security.permissions')
											</div>
											
										</div>
									</div>
								</div>
						
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
        </div>

@include('FOOT')        