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
										<div class="tab-content">
											<div class="tab-pane active" id="feature-options" role="tabpanel">
												<!-- This IS -->

													<div class="m-portlet m-portlet--mobile">
                                                        <div class="m-portlet__head">
                                                            <div class="m-portlet__head-caption">
                                                                <div class="m-portlet__head-title">
                                                                    <h3 class="m-portlet__head-text">
                                                                        Feature Options
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
                                            

											<div class="tab-pane" id="access-control-level" role="tabpanel">
												<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Access Control Level
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
									<div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="m_table_1_length"><label>Show <select name="m_table_1_length" aria-controls="m_table_1" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="m_table_1_filter" class="dataTables_filter"><label>Search:<input class="form-control form-control-sm" placeholder="" aria-controls="m_table_1" type="search"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="m_table_1" role="grid" aria-describedby="m_table_1_info" style="width: 1150px;">
									
									
									
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
                                            

											<div class="tab-pane" id="roles" role="tabpanel">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
												survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                                            </div>
                                            

                                            <div class="tab-pane" id="user-groups" role="tabpanel">
                                            <div class="m-portlet m-portlet--mobile">
                                                        <div class="m-portlet__head">
                                                            <div class="m-portlet__head-caption">
                                                                <div class="m-portlet__head-title">
                                                                    <h3 class="m-portlet__head-text">
                                                                        User Groups
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
                                                                        <td>
                                                                            <a href="#">
                                                                                <i class="m-menu__link-icon flaticon-edit"></i>
                                                                            </a>
                                                                            
                                                                            <a href="#">
                                                                                <i class="m-menu__link-icon flaticon-delete-2"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            <div class="tab-pane" id="permissions" role="tabpanel">
                                                <center>
                                                    <h1>PERMISSIONS</h1>
                                                </center>
											</div>
											
										</div>
									</div>
								</div>
						
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
        </div>

@include('FOOT')        