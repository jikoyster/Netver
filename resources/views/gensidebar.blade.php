<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                <a href="/" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Dashboard</span>
                            <span class="m-menu__link-badge">
                                <span class="m-badge m-badge--danger">2</span>
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            
            <!-- System Setup Menu Item -->
            <li id="System-Setup" class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                    <span class="m-menu__link-text">System Setup</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Base</span>
                            </span>
                        </li>

                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="{{url('system-setup/menus')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Menus</span>
                            </a>
                        </li>
                        
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="{{url('system-setup/security')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Security</span>
                            </a>
                        </li>

                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">General</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Country</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Province and States</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Currency Codes</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Historical Exchange Rates</span>
                                        </a>
                                    </li>                                  
                                </ul>
                            </div>
                        </li>

                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Users</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Users List</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">New User</span>
                                        </a>
                                    </li>                             
                                </ul>
                            </div>
                        </li>
                        
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Name and Items List</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">NAICS</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Journals</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Registration Type</span>
                                        </a>
                                    </li>                              
                                </ul>
                            </div>
                        </li>

                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="bootstrap.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Field Informations</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!-- /System Setup Menu Item -->


            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-graphic"></i>
                    <span class="m-menu__link-text">Global <!-- Accounting --> Setup</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Base</span>
                            </span>
                        </li>

                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">General Settings</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text"><!--Global--> Accounting Setup</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Tax Setting</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Tax Setting</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Maps</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Terms</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Ledgers</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Other Settings</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Account Types</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Account Signs</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Account Groups</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="bootstrap.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">Account Class</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Account Payables</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            
                        </li>
                        
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-map"></i>
                    <span class="m-menu__link-text">Organization</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="profile.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Our Profile</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="#" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Companies</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-profile-1"></i>
                    <span class="m-menu__link-text">Clients</span>
                    <!-- <i class="m-menu__ver-arrow la la-angle-right"></i> -->
                </a>
            </li>

            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="/accountants" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-book"></i>
                    <span class="m-menu__link-text">Accountants</span>
                    <!-- <i class="m-menu__ver-arrow la la-angle-right"></i> -->
                </a>
                
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-folder-2"></i>
                    <span class="m-menu__link-text">Reports</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="/ui-reports" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Bugs and Errors</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__toggle"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="m-menu__link-icon flaticon-logout"></i>
                    <span class="m-menu__link-text">Log Out</span>
                    <!-- <i class="m-menu__ver-arrow la la-angle-right"></i> -->

                    <form id="logout-form" action="/logout" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </a>
            </li>
            
            <!--
            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Page Viewer</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true">
                -- <a href="snippets/pages/user/login-1.html" class="m-menu__link m-menu__toggle"> --
                
                <a href="/login" class="m-menu__link m-menu__toggle"> 
                    <span class="m-menu__link-text">Login Form</span>

                </a>

            </li> -->
            
            
        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>

