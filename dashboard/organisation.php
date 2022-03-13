<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 2/10/2022
 */

require _DIR . "/etc/jobs/appliedJob.php";
$applyJob = new appliedJob();
$applyJob->setConn($conn);
$jobList = $applyJob->getJobs($userDetail['Id']);
?>
<div class="wrapper">
			
			<!-- Start Navigation -->

			<!-- End Navigation -->
			<div class="clearfix"></div>
			
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url(<?php echo _HOME . '/assets/img/banner-3.jpg'; ?>);">
				<div class="container">
					<h1>Organization Profile </h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
		
		<!-- Candidate Profile Start -->
        <section class="detail-desc advance-detail-pr gray-bg">
            <div class="container white-shadow">
                <div class="row">
                    <div class="detail-pic"><img src="<?php echo _UPLOAD_URL . '/images/' . $userDetail['u_image']; ?>" class="img" alt="" /></div>
                </div>
				
                <div class="row bottom-mrg">
                    <div class="col-md-12 col-sm-12">
                        <div class="advance-detail detail-desc-caption">
                            <h4><?php echo $userDetail['fname']; ?></h4>
                            <ul>
                                <li><strong class="j-view">742</strong>Job Post</li>
                                <li><strong class="j-shared"></strong></li>
                                <li><strong class="j-applied">570</strong>Job Approved</li>
                            </ul>
                        </div>
                    </div>
                </div>
				
                <div class="row no-padd">
                    <div class="detail pannel-footer">

                    </div>
                </div>
				
            </div>
        </section>
		
        <section class="full-detail-description full-detail gray-bg">
            <div class="container">
                <div class="col-md-12 col-sm-12">
                    <div class="full-card">
                      <div class="deatil-tab-employ tool-tab">
							<ul class="nav simple nav-tabs" id="simple-design-tab">
								<li class="active"><a href="#about">About</a></li>
								<li><a href="#address">Address</a></li>
								<li><a href="#post-job">Job Posted</a></li>
								<li><a href="#friends">Employee</a></li>
								<li><a href="#messages">Social Media</a></li>
								<li><a href="#settings">Edit Profile</a></li>
							</ul>
							<!-- Start All Sec -->
							<div class="tab-content">
								<!-- Start About Sec -->
								<div id="about" class="tab-pane fade ">
									<h3>About Company</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla interdum sed diam ac fermentum. Mauris nec pellentesque neque. Cras nec diam euismod, congue sapien eu, fermentum libero. Vestibulum quis sem.</p>
								</div>
								<!-- End About Sec -->
								
								<!-- Start Address Sec -->
								<div id="address" class="tab-pane fade in active">
									<h3>Address Info</h3>
									<ul class="job-detail-des">
										<li><span>Address:</span><?php echo ($userDetail['user_address'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?></li>
										<li><span>City:</span><?php echo ($userDetail['user_city'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?></li>
										<li><span>State:</span><?php echo ($userDetail['user_state'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?></li>
										<li><span>Country:</span>India</li>

										<li><span>Telephone:</span>+91 123 456 7854</li>
										<li><span>Email:</span><?php echo ($userDetail['user_email'] == NULL) ? '  ---  ' : $userDetail['user_email'] ?></li>
									</ul>
								</div>
								<!-- End Address Sec -->
								
								<!-- Start Job List -->
								<div id="post-job" class="tab-pane fade">
									<h3>You have 22 job post</h3>
									<div class="row">
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-1.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Autodesk <span class="cmp-tagline">(Software Company)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
											<span class="tg-themetag tg-featuretag">Premium</span>
										</article>
										
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-2.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Google <span class="cmp-tagline">(Software Company)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
										</article>
										
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-3.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Honda <span class="cmp-tagline">(Motor Agency)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
										</article>
										
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-4.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Microsoft <span class="cmp-tagline">(Software Company)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
											<span class="tg-themetag tg-featuretag">Premium</span>
										</article>
										
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-5.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Skype <span class="cmp-tagline">(Software Company)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
										</article>
										
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-6.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Virtue <span class="cmp-tagline">(Development Company)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
										</article>
										
										<article>
											<div class="mng-company">
												<div class="col-md-2 col-sm-2">
													<div class="mng-company-pic"><img src="assets/img/com-7.jpg" class="img-responsive" alt=""></div>
												</div>
												
												<div class="col-md-5 col-sm-5">
													<div class="mng-company-name">
														<h4>Twitter <span class="cmp-tagline">(Social Media Company)</span></h4><span class="cmp-time">10 Hour Ago</span></div>
												</div>
												
												<div class="col-md-4 col-sm-4">
													<div class="mng-company-location">
														<p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
													</div>
												</div>
												
												<div class="col-md-1 col-sm-1">
													<div class="mng-company-action"><a href="#"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></div>
												</div>
												
											</div>
											<span class="tg-themetag tg-featuretag">Premium</span>
										</article>
									</div>
									<div class="row">
										<ul class="pagination">
											<li><a href="#">«</a></li>
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>
											<li><a href="#">»</a></li>
										</ul>
									</div>
								</div>
								<!-- End Job List -->
								
								<!-- Start Friend List -->
								<div id="friends" class="tab-pane fade">
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status pending">Pending</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-1.png" class="img-responsive" alt=""></div>
													<h4>Charles Hopman</h4><span>Web designer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status available">Available</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-2.png" class="img-responsive" alt=""></div>
													<h4>Ethan Marion</h4><span>IOS designer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status pending">Pending</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-3.png" class="img-responsive" alt=""></div>
													<h4>Zara Clow</h4><span>UI/UX designer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status pending">Pending</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-4.png" class="img-responsive" alt=""></div>
													<h4>Henry Crooks</h4><span>PHP Developer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status available">Available</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-2.png" class="img-responsive" alt=""></div>
													<h4>Joseph Macfarlan</h4><span>App Developer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status pending">Pending</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-1.png" class="img-responsive" alt=""></div>
													<h4>Zane Joyner</h4><span>Html Expert</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status pending">Pending</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-3.png" class="img-responsive" alt=""></div>
													<h4>Anna Hoysted</h4><span>UI/UX Designer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status available">Available</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-4.png" class="img-responsive" alt=""></div>
													<h4>Spencer Birdseye</h4><span>SEO Expert</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="col-md-4 col-sm-4">
											<div class="manage-cndt">
												<div class="cndt-status pending">Pending</div>
												<div class="cndt-caption">
													<div class="cndt-pic"><img src="assets/img/can-1.png" class="img-responsive" alt=""></div>
													<h4>Eden Macaulay</h4><span>Web designer</span>
													<p>Our analysis team at Megriosft use end to end innovation proces</p>
												</div><a href="#" title="" class="cndt-profile-btn">View Profile</a>
											</div>
										</div>
										
										<div class="row">
											<ul class="pagination">
												<li><a href="#">«</a></li>
												<li class="active"><a href="#">1</a></li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
												<li><a href="#">4</a></li>
												<li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>
												<li><a href="#">»</a></li>
											</ul>
										</div>
									</div>
								</div>
								<!-- End Friend List -->
								
							<!-- Start Media -->
								<div id="messages" class="tab-pane fade">
									<div class="inbox-body inbox-widget">
											<div class="row no-mrg">
										<h3>Edit Social Media Link</h3>
										<div class="edit-pro">
											<div class="col-md-4 col-sm-6">
												<label>Facebook</label>
												<input type="text" class="form-control" placeholder="Facebook">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>Twitter</label>
												<input type="text" class="form-control" placeholder="Twitter">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>Instagram</label>
												<input type="text" class="form-control" placeholder="Instagram">
											</div>
												<div class="col-md-4 col-sm-6">
												<label>Gmail</label>
												<input type="text" class="form-control" placeholder="Gmail">
											</div>
												<div class="col-md-4 col-sm-6">
												<label>Linked In</label>
												<input type="text" class="form-control" placeholder="Linked In">
											</div>
												<div class="col-md-4 col-sm-6">
												<label>XBox</label>
												<input type="text" class="form-control" placeholder="Linked In">
											</div>
											
											<div class="col-sm-12">
												<button type="button" class="update-btn">Update Now</button>
											</div>
										</div>
									</div>
								</div>
							</div>
								<!-- End Media -->
								
								<!-- Start Settings -->
								<div id="settings" class="tab-pane fade">
									<div class="row no-mrg">
										<h3>Edit Profile</h3>
										<div class="edit-pro">
											<div class="col-md-4 col-sm-6">
												<label>First Name</label>
												<input type="text" class="form-control" placeholder="Matthew">
											</div>
										
											<div class="col-md-4 col-sm-6">
												<label>Last Name</label>
												<input type="text" class="form-control" placeholder="Dana">
											</div>
											
											<div class="col-md-4 col-sm-6">
												<label>Phone</label>
												<input type="text" class="form-control" placeholder="+91 258 475 6859">
											</div>
											
											<div class="col-md-4 col-sm-6">
												<label>Address</label>
												<input type="text" class="form-control" placeholder="204 Lowes Alley">
											</div>

											  <div class="col-md-4 col-sm-6">
            									<label >Since</label>
          										<input type="Date" class="form-control"  placeholder="Since" required>
          									</div>

											
											<div class="col-md-4 col-sm-6">
												<label>Organization</label>
												<input type="text" class="form-control" placeholder="Software Developer">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>City</label>
												<input type="text" class="form-control" placeholder="Chandigarh">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>State</label>
												<input type="text" class="form-control" placeholder="Punjab">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>Country</label>
												<input type="text" class="form-control" placeholder="India">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>Old Password</label>
												<input type="password" class="form-control" placeholder="*********">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>New Password</label>
												<input type="password" class="form-control" placeholder="*********">
											</div>
											<div class="col-md-4 col-sm-6">
												<label>Confirm Password</label>
												<input type="password" class="form-control" placeholder="*********">
											</div>
											
											<div class="col-sm-12">
												<button type="button" class="update-btn">Update Now</button>
											</div>
										</div>
									</div>
								</div>
								<!-- End Settings -->
							</div>
							<!-- Start All Sec -->
						</div>  
                    </div>
                </div>
            </div>
        </section>
			<!-- Footer Section Start -->




			<!-- Footer Section End -->
			

			

			<!-- Scripts
			================================================== -->
			<script type="text/javascript" src="assets/plugins/js/jquery.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/viewportchecker.js"></script>
			<script type="text/javascript" src="assets/plugins/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/bootsnav.js"></script>
			<script type="text/javascript" src="assets/plugins/js/select2.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/wysihtml5-0.3.0.js"></script>
			<script type="text/javascript" src="assets/plugins/js/bootstrap-wysihtml5.js"></script>
			<script type="text/javascript" src="assets/plugins/js/datedropper.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/dropzone.js"></script>
			<script type="text/javascript" src="assets/plugins/js/loader.js"></script>
			<script type="text/javascript" src="assets/plugins/js/owl.carousel.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/slick.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/gmap3.min.js"></script>
			<script type="text/javascript" src="assets/plugins/js/jquery.easy-autocomplete.min.js"></script>
			<!-- Custom Js -->
			<script src="assets/js/custom.js"></script>
			<script src="assets/js/jQuery.style.switcher.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#styleOptions').styleSwitcher();
				});
			</script>
			<script>
				function openRightMenu() {
					document.getElementById("rightMenu").style.display = "block";
				}

				function closeRightMenu() {
					document.getElementById("rightMenu").style.display = "none";
				}
			</script>
		</div>
	</body>

<!-- employer-profile41:42-->
</html>
