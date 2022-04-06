<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 2/10/2022
 */

require _DIR . "/etc/jobs/providedJob.php";
$provideJob = new providedJob();
$provideJob->setConn($conn);
$jobList = $provideJob->getProvidedJobs($userDetail['Id']);
$pending = $provideJob->getRequestJobs($userDetail['Id'], 'pending');
$accept  = $provideJob->getRequestJobs($userDetail['Id'], 'apply');

?>
<div class="wrapper   ">
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url(<?php echo _HOME . '/assets/img/banner-3.jpg'; ?>);">
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
                <div class="detail-pic"><img src="<?php echo _UPLOAD_URL . '/images/' . $userDetail['u_image']; ?>"
                                             class="img" alt=""/><a href="#" class="detail-edit" title="edit"><i class="fa fa-pencil"></i></a></div>
            </div>

            <div class="row bottom-mrg">
                <div class="col-md-12 col-sm-12">
                    <div class="advance-detail detail-desc-caption">
                        <h4><?php echo $userDetail['fname']; ?></h4>
                        <ul>
                            <li>
                                <strong class="j-view"><?php echo (isset($jobList) && is_array($jobList) && count($jobList) > 0) ? count($jobList) : 0 ?></strong>Job
                                Post
                            </li>
                            <li><strong class="j-shared"></strong></li>
                            <li>
                                <strong class="j-applied"><?php echo (isset($accept)) ? count($accept):0; ?></strong>Job
                                Approved
                            </li>
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
                            <li class="active"><a href="#my-info">My Info</a></li>
                            <li><a href="#post-job">Job Posted</a></li>
                            <li><a href="#jobrequest">Job Request</a></li>
                            <li><a href="#settings">Edit Profile</a></li>
                            <li><a href="#change-password">Change Password</a></li>
                            <li><a href="#social-media">Social Media</a></li>
                        </ul>
                        <!-- Start All Sec -->
                        <div class="tab-content">
                            <!-- Start About Sec -->
                            <div id="my-info" class="tab-pane fade fade in active">
                                <h3 class="my-profile-h3">About Company</h3>
                                <h4 class="my-profile-h4">> My Information</h4>

                                <ul class="job-detail-des">
                                    <li>
                                        <span>Organization Name:</span><?php echo ($userDetail['org_name'] == "NULL" || $userDetail['org_name'] == NULL) ? '* <span title="It was good people know with your oranization name"> Update Organization Name</span>' : $userDetail['org_name']; ?>
                                    </li>

                                    <li>
                                        <span>Email:</span><?php echo ($userDetail['user_email'] == NULL) ? '  ---  ' : $userDetail['user_email'] ?>
                                    </li>
                                    <li><span>Mobile No. :</span><?php echo $userDetail['user_contactNumber']; ?></li>

                                </ul>
                                <h4 class="my-profile-h4">Address Info</h4>
                                <ul class="job-detail-des">
                                    <li>
                                        <span>Address:</span><?php echo ($userDetail['user_address'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?>
                                    </li>
                                    <li>
                                        <span>City:</span><?php echo ($userDetail['user_city'] == NULL) ? '  ---  ' : $userDetail['user_city'] ?>
                                    </li>
                                    <li>
                                        <span>State:</span><?php echo ($userDetail['user_state'] == NULL) ? '  ---  ' : $userDetail['user_state'] ?>
                                    </li>
                                    <li>
                                        <span>Country:</span><?php echo ($userDetail['user_country'] == NULL) ? '  ---  ' : $userDetail['user_country'] ?>
                                    </li>


                                </ul>
                            </div>
                            <!-- End About Sec -->
                            <!-- Start Job List -->
                            <div id="post-job" class="tab-pane fade">
                                <div class="row">
                                    <?php
                                    if ($jobList && $provideJob->status) {
                                        foreach ($jobList as $jobs) {

                                            //for job type
                                            if ($jobs['job_hours'] == 1) {
                                                $jobs['job_hours'] = 'Full Time';
                                            } elseif ($jobs['job_hours'] == 2) {
                                                $jobs['job_hours'] = 'Part Time';
                                            } elseif ($jobs['job_hours'] == 0) {
                                                $jobs['job_hours'] = 'Flexible Time';
                                            }
                                            //                for location
                                            if ($jobs['user_type'] == "O") {
                                                if ($jobs['job_location'] != "0" && $jobs['job_location'] != "NULL" && $jobs['job_location'] != "") {
                                                    $location = $jobs['job_location'];
                                                } elseif (!empty($jobs['user_state']) && !empty($jobs['user_country'])) {

                                                    $location = $jobs['user_state'] . ', ' . $jobs['user_country'];
                                                } else {
                                                    $location = '';
                                                }
                                            } else {
                                                //                ADMIN ADDRESS
                                                $location = 'GUJARAT, INDIA';
                                            }
                                            if (!isset($jobs['profile_userName'])) {
                                                $jobs['profile_userName'] = "USER";
                                            }
                                            //for date jobs
                                            $datepost  = date_create(date("Y-m-d H:i:s", strtotime($jobs['date_created'])));
                                            $today     = date_create(date("Y-m-d H:i:s"));
                                            $date_diff = date_diff($datepost, $today);
                                            if ($date_diff->y < 1) {
                                                if ($date_diff->m < 1) {
                                                    if ($date_diff->d < 1) {
                                                        $datepost = "New";
                                                    } else {
                                                        $datepost = $date_diff->d . ' days ago';
                                                    }
                                                } else {
                                                    $datepost = $date_diff->m . ' months ago';
                                                }
                                            } else {
                                                $datepost = $date_diff->y . ' years ago';

                                            }
                                            ?>
                                            <article class="myjobListarticle">
                                                <div class="mng-company">
                                                    <div class="col-md-2 col-sm-2">
                                                        <div class="mng-company-pic"><img
                                                                    src="<?php echo _UPLOAD_URL . 'images/' . $jobs['user_photo']; ?>"
                                                                    class="img-responsive"
                                                                    alt="<?php echo $jobs["profile_userName"] . '\'s image' ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5 col-sm-5">
                                                        <div class="mng-company-name">
                                                            <h4><?php echo $jobs['job_title']; ?> <span
                                                                        class="cmp-tagline"></span>
                                                            </h4>
                                                            <span class="cmp-time">Vacancy: <?php echo $jobs['job_vacancy']; ?></span><br>
                                                            <span class="cmp-time">Created On: <?php echo date("m/d/Y", strtotime($jobs['date_created'])); ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-3">
                                                        <div class="mng-company-location">
                                                            <?php if ($location) {
                                                                echo ' <p><i class="fa fa-map-marker"></i>' . $location . '</p> ';
                                                            } ?>
                                                        </div>
                                                        <span class="cmp-time">Category: <?php echo $jobs['job_hours']; ?></span>
                                                    </div>

                                                    <div class="col-md-2 col-sm-2 ">
                                                        <div class="mng-company-action">
                                                            <?php
                                                            echo '<a href="' . _HOME . '/job/editJob.php?id=' . base64_encode($jobs['jobId']) . '" class="view-job">
                                                             <i class="fa fa-pencil"></i></a>';
                                                            echo '<span data-id="' . $jobs['jobId'] . '" class="my-delete-job"><i class="fa fa-trash-o"></i></span>';
                                                            echo '<a href="' . _HOME . '/job/detailview/jobDetailView.php?id=' . base64_encode($jobs['jobId']) . '" class="view-job">
                                                             <i class="fa fa-eye"></i></a>';
                                                            ?>

                                                        </div>
                                                    </div>

                                                </div>
                                                <span class="tg-themetag tg-featuretag"><?php echo $datepost; ?></span>
                                            </article>
                                            <?php
                                        }
                                    } else {
                                        echo " <article>
                                        <div class='mng-company'>
                                        NO JOBS FOUND
                                        </div></article>";
                                    }
                                    ?>


                                </div>
                            </div>
                            <!-- End Job List -->
                            <!-- Start Friend List -->
                            <div id="jobrequest" class="tab-pane fade in ">
                                <ul class="nav simple nav-tabs" id="simple-design-tab">
                                    <li class="active"><a href="#jobPending">Pending</a></li>
                                    <li><a href="#jobApproved">Approved</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="jobPending" class="tab-pane fade in active" >
                                <div class="row">
                                    <?php
                                    if (count($pending) >0):
                                        foreach ($pending as $val): ?>
                                            <div class="col-md-4 col-sm-4 card-point">
                                                <div class="manage-cndt">

                                                    <div class="cndt-caption">
                                                        <div class="cndt-pic"><img
                                                                    src="<?php echo _UPLOAD_URL . '/images/' . $val['image_user']; ?>"
                                                                    class="img-responsive" alt=""></div>
                                                        <h4><?php echo $val['fname'] . ' ' . $val['lname']; ?></h4>
                                                        <?php echo (isset($val['category_subname'])) ? '<span>' . $val['category_subname'] . '</span>' : ''; ?>
                                                        <p><?php echo ($val['job_detail'] != NULL && $val['job_detail'] != '') ? $val['job_detail'] : ''; ?></p>
                                                    </div>

                                                    <a title="" class="cndt-profile-btn accept-user"
                                                       data-au-id="<?php echo $val['appl_id']; ?>">Accept</a>
                                                    <a title="" class="cndt-profile-btn deny-user"
                                                       data-du-id="<?php echo $val['appl_id']; ?>">Deny</a>
                                                    <a title="" class="cndt-profile-btn gotouserprofile"
                                                       data-up-id="<?php echo $val['id_puser']; ?>">View User
                                                        Profile</a>
                                                    <?php
                                                    $jid =base64_encode($val['job_id']);
                                                    $link = _HOME.'/job/detailview/jobDetailView.php?id='.$jid;
                                                    ?>
                                                    <a href="<?php echo $link; ?>" title="" class="cndt-profile-btn gotojob">View Job</a>
                                                </div>
                                            </div>
                                        <?php endforeach;
                                    else:
                                        echo "<div class='col-lg-12 mt-4 text-center'><h4>NO PENDING REQUEST</h4>  </div>";
                                    endif;
                                    ?>
                                </div>
                                    </div>

                                    <div id="jobApproved" class="tab-pane" >
                                <div class="row">
                                    <?php
                                    if (count($accept) >0):
                                        foreach ($accept as $val): ?>
                                            <div class="col-md-4 col-sm-4 card-point">
                                                <div class="manage-cndt">

                                                    <div class="cndt-caption">
                                                        <div class="cndt-pic"><img
                                                                    src="<?php echo _UPLOAD_URL . '/images/' . $val['image_user']; ?>"
                                                                    class="img-responsive" alt=""></div>
                                                        <h4><?php echo $val['fname'] . ' ' . $val['lname']; ?></h4>
                                                        <?php echo (isset($val['category_subname'])) ? '<span>' . $val['category_subname'] . '</span>' : ''; ?>
                                                        <p><?php echo ($val['job_detail'] != NULL && $val['job_detail'] != '') ? $val['job_detail'] : ''; ?></p>
                                                    </div>

                                                    <a title="" class="cndt-profile-btn gotouserprofile"
                                                       data-up-id="<?php echo $val['id_puser']; ?>">View User
                                                        Profile</a>
                                                    <?php
                                                    $jid =base64_encode($val['job_id']);
                                                    $link = _HOME.'/job/detailview/jobDetailView.php?id='.$jid;
                                                    ?>
                                                    <a href="<?php echo $link; ?>" title="" class="cndt-profile-btn gotojob">View Job</a>
                                                </div>
                                            </div>
                                        <?php endforeach;
                                    else:
                                        echo "<div class='col-lg-12 mt-4 text-center'><h4>NO Approved REQUEST</h4>  </div>";
                                    endif;
                                    ?>
                                </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End Friend List -->
                            <!-- Start Settings -->
                            <div id="settings" class="tab-pane fade">
                                <div class="row no-mrg">
                                    <div class="verify-msg prof"></div>

                                    <h3 class="my-profile-h3">Edit Profile</h3>
                                    <div class="edit-pro">
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                                              name="jobseeker_edit_form" method="post"
                                              class="" id="jobseeker_edit_form">
                                            <h4 class="my-profile-h4">> Personal Info</h4>
                                            <div class="col-md-4 col-sm-6">
                                                <label>First Name</label>
                                                <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $userDetail['fname']; ?>"  required>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <label>Last Name</label>
                                                <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $userDetail['lname']; ?>" required>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <label>Mobile Number</label>
                                                <input type="number"  name="contact_no" id="contact_no" class="form-control" value="<?php echo $userDetail['user_contactNumber']; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <label>Date of Birth</label>
                                                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo date("Y-m-d",strtotime($userDetail['dob'])); ?>" required>
                                            </div>
                                            <div class="col-md-8 col-sm-6">
                                                <label>Address</label>
                                                <input type="text"  name="address" id="address" class="form-control" placeholder="<?php echo $userDetail['user_address'] == NULL?'Enter your Address' : ''; ?>" value="<?php echo $userDetail['user_address'] != NULL?$userDetail['user_address'] :''; ?>" maxlength="150" required>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <label>City</label>
                                                <input type="text" class="form-control" id="city"
                                                       value="<?php echo $userDetail['user_city']; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <input type="hidden" id="state-id" value="<?php echo $userDetail['user_state']; ?>">
                                                <label>State</label>
                                                <span  id="state-code">
                                                <input type="text" name="state" class="d-block" id="state">
                                            </span>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <input type="hidden" id="country-id" value="<?php echo $userDetail['user_country']; ?>">
                                                <label>Country</label>
                                                <select name = "country" id="country">
                                                    <option>select country</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 col-sm-12" style="padding-right:15px;padding-left:15px; margin-top:10px!important; margin-bottom: 25px!important;">
                                                <label>Gender</label>
                                                <span style="padding-left:50px; ">Male</span>
                                                <input type="radio" name="gender" class="gender" id="gender_male" value="M" <?php echo isset($userDetail['gender']) && $userDetail['gender'] =="M" ? 'checked':'';?>>
                                                <span style="padding-left:50px; ">Female</span>

                                                <input type="radio" name="gender" class="gender"  id="gender_female" value="F" <?php echo isset($userDetail['gender']) && $userDetail['gender'] =="F" ? 'checked':'';?>>
                                                <span style="padding-left:50px; ">Others</span>
                                                <input type="radio" name="gender" class="gender"  id="gender_othermale" value="N" <?php echo isset($userDetail['gender']) && $userDetail['gender'] =="N" ? 'checked':'';?>>
                                            </div>


                                            <h4 class="my-profile-h4">> User Profile Info</h4>

                                            <div class="col-md-4 col-sm-6">
                                                <label>Organization Name</label>
                                                <input type="text" name="orgName" class="form-control" id="orgName"
                                                       value="<?php echo $userDetail['org_name']; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <label>User Experience</label>
                                                <input type="number" name="user_exp" class="form-control" id="user_exp"
                                                       value="<?php echo $userDetail['jobS_exp']; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <label>User Occupation</label>
                                                <input type="text" name="user_occ" class="form-control" id="user_occ"
                                                       value="<?php echo $userDetail['jobS_occupation']; ?>">
                                            </div>

                                            <div class="col-sm-12">
                                               <button type="submit" name="submit" id="submi-edit-profile" class="update-btn">Update Now</button>
                                            </div>
                                            <input type="hidden" id="uid" value="<?php echo $userDetail['Id']; ?>"
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Settings -->
                            <div id="change-password" class="tab-pane fade ">
                                <div class="inbox-body inbox-widget">
                                    <div class="row no-mrg">
                                        <div class="verify-msg pass"></div>

                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                                              name="jobseeker_pass_form" method="post"
                                              class="" id="jobseeker_pass_form">
                                            <h3 class="my-profile-h3">Change Password</h3>
                                            <div class="edit-pro">
                                                <div class="col-md-4 col-sm-6">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control" id="oldpass" placeholder="Old Password">
                                                    <span class="pass_error error"></span>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" id="newpass" placeholder="New Password">
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control" id="cpass" placeholder="Confirm Password">
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="button" class="update-btn confirm_pass_button">Update Now</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Media -->
                            <div id="social-media" class="tab-pane fade">
                                <div class="inbox-body inbox-widget">
                                    <div class="row no-mrg">
                                        <h3 class="my-profile-h3">Edit Social Media Link</h3>
                                        <div class="edit-pro">
                                            <div class="col-md-6 col-sm-6">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control" placeholder="Facebook">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <label>Twitter</label>
                                                <input type="text" class="form-control" placeholder="Twitter">
                                            </div>

                                            <div class="col-md-6 col-sm-6">
                                                <label>Gmail</label>
                                                <input type="text" class="form-control" placeholder="Gmail">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <label>Linked In</label>
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
                        </div>
                        <!-- Start All Sec -->
                    </div>
                </div>
            </div>
        </div>
    </section>
