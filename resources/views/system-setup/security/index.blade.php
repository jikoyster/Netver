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
												<a class="nav-link active" data-toggle="tab" href="#feature-options">Feature Options</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#access-control-level">ACL</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#roles">Roles</a>
                                            </li>
                                            <li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#user-groups">User Groups</a>
                                            </li>
                                            <li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#permissions">Permissions</a>
											</li>
											
										</ul>
                                        <!-- FEATURE OPTIONS CONTENT -->
										<div class="tab-content">
											<div class="tab-pane active" id="feature-options" role="tabpanel">
												@include('system-setup.security.feature-options')
                                            </div>
											<div class="tab-pane" id="access-control-level" role="tabpanel">
                                                @include('system-setup.security.acl')
                                            </div>
                                            

											<div class="tab-pane" id="roles" role="tabpanel">
                                                @include('system-setup.security.roles')
                                            </div>
                                            

                                            <div class="tab-pane" id="user-groups" role="tabpanel">
                                                @include('system-setup.security.user-groups')
                                            </div>
                                            
                                            <div class="tab-pane" id="permissions" role="tabpanel">
                                                @include('system-setup.security.permissions')
											</div>
											
										</div>
									</div>
								</div>
						
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
        </div>

@include('FOOT')        