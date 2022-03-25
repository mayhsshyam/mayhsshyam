<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 2/10/2022
 */

require _DIR . "/etc/jobs/appliedJob.php";
$applyJob = new appliedJob();
$applyJob->setConn($conn);
$jobList = $applyJob->getappliedJob($userDetail['Id']);
$apply   = $applyJob->getAppliedJobs($userDetail['Id']);
?>
<div class="wrapper">

    <!-- Start Navigation -->

    <!-- End Navigation -->
    <div class="clearfix"></div>
    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url(<?php echo _HOME . '/assets/img/banner-3.jpg'; ?>);">
        <div class="container">
            <?php
            $user_detail_name = (isset($_SESSION['user']) && $_SESSION['user'] == 'new') ?
                'Welcome ' . $userDetail["fname"] : 'My profile';

            echo "<h1>" . $user_detail_name . "</h1>"; ?>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->
    <!-- Candidate Profile Start -->
    <section class="detail-desc advance-detail-pr gray-bg">
        <div class="container white-shadow">
            <div class="row">
                <div class="detail-pic"><img src="<?php echo _UPLOAD_URL . '/images/' . $userDetail['u_image']; ?>"
                                             class="img" alt=""/></div>
            </div>

            <div class="row bottom-mrg">
                <div class="col-md-12 col-sm-12">
                    <div class="advance-detail detail-desc-caption">
                        <h4><?php echo ucfirst($userDetail['fname'] ).' '.ucfirst($userDetail['lname']); ?></h4>
                        <ul>

                            <li><strong class="j-view"><?php if (isset($jobList) && $jobList) {
                                        echo count($jobList);
                                    } else {
                                        echo "0";
                                    }; ?></strong> Job applied
                            </li>
                            <li><strong class="j-shared"></strong></li>
                            <li><strong class="j-applied"><?php if (isset($jobList) && $apply) {
                                        echo count($apply);
                                    } else {
                                        echo "0";
                                    }; ?></strong>Job Approved
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row no-padd">
                <div class="detail pannel-footer"></div>
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
                        <li><a href="#post-job">Job Applied</a></li>
                        <li><a href="#settings">Edit Profile</a></li>
                        <li><a href="#change-password">Change Password</a></li>
                        <li><a href="#social-media-resume">Social Media & Resume</a></li>
                    </ul>
                    <!-- Start All Sec -->
                    <div class="tab-content">
                        <!-- Start About Sec -->
                        <div id="my-info" class="tab-pane fade in active">
                            <h3 class="my-profile-h3">About <?php echo ucwords($userDetail['fname']); ?></h3>
                            <h4 class="my-profile-h4">> My Information</h4>
                            <ul class="job-detail-des">
                                <li><span>First Name:</span><?php echo $userDetail['fname']; ?></li>
                                <li><span>Last Name:</span><?php echo $userDetail['lname']; ?></li>

                                <li>
                                    <span>Email:</span><?php echo ($userDetail['user_email'] == NULL) ? '  ---  ' : $userDetail['user_email'] ?>
                                </li>
                                <li><span>Mobile No. :</span><?php echo $userDetail['user_contactNumber']; ?></li>
                                <li><span>Gender:</span>
                                    <?php if ($userDetail['user_gender'] == 'M') {
                                        echo "Male";
                                    } elseif ($userDetail['user_gender'] == 'F') {
                                        echo "Female";
                                    } else {
                                        echo "Rather Not say";
                                    }; ?></li>
                                <li><span>DOB:</span><?php echo date("d/m/y", strtotime($userDetail['dob'])); ?></li>
                            </ul>
                            <br>
                            <h4 class="my-profile-h4">> Address Info</h4>

                            <ul class="job-detail-des">
                                <li>
                                    <span>Address:</span><?php echo ($userDetail['user_address'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?>
                                </li>
                                <li>
                                    <span>City:</span><?php echo ($userDetail['user_city'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?>
                                </li>
                                <li>
                                    <span>State:</span><?php echo ($userDetail['user_state'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?>
                                </li>
                                <li>
                                    <span>Country:</span><?php echo ($userDetail['user_country'] == NULL) ? '  ---  ' : $userDetail['user_address'] ?>
                                </li>
                            </ul>
                        </div>
                        <!-- End About Sec -->

                        <!-- Start Job List -->
                        <div id="post-job" class="tab-pane fade ">
                            <div class="row">
                                <h3 class="my-profile-h3">You Have <?php if (isset($jobList) && $jobList) {
                                        echo count($jobList);
                                    } else {
                                        echo "0";
                                    }; ?>  Job Applied</h3>

                                <?php
                                if ($jobList && $applyJob->status) {
                                    foreach ($jobList as $jobs) {
                                        //for job type
                                        if ($jobs['job_hours'] == 1) {
                                            $jobs['job_hours'] = 'Full Time';
                                        } elseif ($jobs['job_hours'] == 2) {
                                            $jobs['job_hours'] = 'Part Time';
                                        } elseif ($jobs['job_hours'] == 0) {
                                            $jobs['job_hours'] = 'Flexible Time';
                                        }
//                for company name else user name
                                        if ($jobs['user_type'] == "O") {
                                            if ($jobs['org_name'] == "NULL" || $jobs['org_name'] == NULL) {
                                                $company = $jobs['user_fname'];
                                            } else {
                                                $company = $jobs['org_name'];
                                            }
                                        } else {
                                            $company = "LOOKOUT";
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
                                        <article class="jobListarticle">
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
                                                        <h4><?php echo $jobs['job_title']; ?> <span class="cmp-tagline"></span>
                                                        </h4>
                                                        <span class="cmp-time">By: <?php echo $company; ?></span><br>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-4">
                                                    <div class="mng-company-location">
                                                        <?php if ($location) {
                                                            echo ' <p><i class="fa fa-map-marker"></i>' . $location . '</p> ';
                                                        } ?>
                                                        <span class="cmp-time">Category: <?php echo $jobs['job_hours']; ?></span><br>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-sm-1 ">
                                                    <div class="mng-company-action">
                                                        <?php
                                                        if ($jobs['apply'] == "0") {
                                                            echo '<span data-jid="' . $jobs['appl_id'] . '" class="delete-job" >
                                                             <i class="fa fa-trash-o"></i></span>';
                                                        }
                                                        echo '<a href="' ._HOME.'/job/detailview/jobDetailView.php?id='. base64_encode($jobs['appl_job_id']) . '" class="view-job">
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

                        <!-- Start Settings -->
                        <div id="settings" class="tab-pane fade ">
                            <div class="row no-mrg">

                                <h3 class="my-profile-h3">Edit Profile</h3>
                                <div class="verify-msg prof"></div>

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
                                            <label>User Category</label>
                                            <input type="number" name="user_exp" class="form-control" id="user_cat"
                                                   value="<?php echo $userDetail['user_city']; ?>">
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

                        <!-- Start Change Pass -->
                        <div id="change-password" class="tab-pane fade ">
                            <div class="inbox-body inbox-widget">
                                <div class="row no-mrg">
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
                                </div>
                            </div>
                        </div>
                        <!-- End Change Pass-->

                        <!-- Start Media -->
                        <div id="social-media-resume" class="tab-pane fade ">
                            <div class="inbox-body inbox-widget">
                                <div class="row no-mrg">
                                    <h3 class="my-profile-h3">Social Media Link</h3>
                                    <div class="edit-pro">
                                        <div class="col-md-6 col-sm-12">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" placeholder="Facebook">
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control" placeholder="Twitter">
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <label>Gmail</label>
                                            <input type="text" class="form-control" placeholder="Gmail">
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label>Linked In</label>
                                            <input type="text" class="form-control" placeholder="Linked In">
                                        </div>
                                        <h3 class="my-profile-h3">Resume</h3>
                                        <div class="col-md-4 col-sm-6">
                                            <label>Upload Resume</label>
                                            <br><br><br><br>
                                            <div class="row">
                                                <div class="detail-pic js">

                                                    <input type="file" name="upload-pic" id="upload-pic" class="inputfile" accept="application/pdf">
                                                    <label for="upload-pic"><i class="fa fa-upload" aria-hidden="true"></i><span></span></label>

                                                </div>
                                            </div>


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
                </div>
                <!-- Start All Sec -->
            </div>
        </div>
    </div>

    </div>
</section>
<script type="text/javascript">

</script>
