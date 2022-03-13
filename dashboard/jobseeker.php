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
?>
<div class="wrapper">

    <!-- Start Navigation -->

    <!-- End Navigation -->
    <div class="clearfix"></div>
    <!-- Title Header Start -->
    <section class="inner-header-title"
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
                        <h4><?php echo $userDetail['fname']; ?></h4>
                        <ul>

                            <li><strong class="j-view"><?php echo count($jobList); ?></strong>Job applied</li>
                            <li><strong class="j-shared"></strong></li>
                            <li><strong class="j-applied">0</strong>Job Approved</li>

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
<!--                --><?php //var_export($userDetail); ?>

                <div class="deatil-tab-employ tool-tab">
                    <ul class="nav simple nav-tabs" id="simple-design-tab">
                        <li class="active"><a href="#about">About</a></li>
                        <li><a href="#address">Address</a></li>
                        <li><a href="#post-job">Job Applied</a></li>

                        <li><a href="#messages">Social Media </a></li>
                        <li><a href="#settings">Edit Profile</a></li>
                    </ul>
                    <!-- Start All Sec -->
                    <div class="tab-content">
                        <!-- Start About Sec -->
                        <div id="about" class="tab-pane fade in active ">
                            <h3>About <?php echo $userDetail['fname']; ?></h3>
                            <ul class="job-detail-des">
                                <li><span>First Name:</span><?php echo $userDetail['fname']; ?></li>
                                <li><span>Last Name:</span><?php echo $userDetail['lname']; ?></li>
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
                        </div>
                        <!-- End About Sec -->

                        <!-- Start Address Sec -->
                        <div id="address" class="tab-pane fade ">
                            <h3>Address Info</h3>
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

                                <li>
                                    <span>Email:</span><?php echo ($userDetail['user_email'] == NULL) ? '  ---  ' : $userDetail['user_email'] ?>
                                </li>
                            </ul>
                        </div>
                        <!-- End Address Sec -->

                        <!-- Start Job List -->
                        <div id="post-job" class="tab-pane fade "
                        ">
                        <div class="row">
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
                                                            src="<?php echo _UPLOAD_URL .'images/'. $jobs['user_photo']; ?>"
                                                            class="img-responsive"
                                                            alt="<?php echo $jobs["profile_userName"] . '\'s image' ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-5 col-sm-5">
                                                <div class="mng-company-name">
                                                    <h4><?php echo $company; ?> <span class="cmp-tagline"></span></h4>
                                                    <span class="cmp-time">USER NAME: <?php echo $jobs["profile_userName"]; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-4">
                                                <div class="mng-company-location">
                                                    <?php if ($location) {
                                                        echo ' <p><i class="fa fa-map-marker"></i>' . $location . '</p> ';
                                                    } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-1 col-sm-1 ">
                                                <div class="mng-company-action">
                                                    <?php
                                                    if($jobs['apply'] == "0"){
                                                        echo '<span data-id="'.$jobs['appl_job_id'].'" class="delete-job">
                                                             <i class="fa fa-trash-o"></i></span>';
                                                    }
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

                    <!-- End Friend List -->

                    <!-- Start Media -->
                    <div id="messages" class="tab-pane fade ">
                        <div class="inbox-body inbox-widget">
                            <div class="row no-mrg">
                                <h3>Edit Social Media Link</h3>
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

                                    <h3>More Information</h3>
                                    <div class="col-12">
                                        <label>Upload Resume</label>
                                        <form action="http://codeminifier.com/upload-target"
                                              class="dropzone dz-clickable profile-pic">
                                            <div class="dz-default dz-message">
                                                <i class="fa fa-cloud-upload"></i>
                                                <span>Drop files here to upload</span>
                                            </div>
                                        </form>
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
                    <div id="settings" class="tab-pane fade ">
                        <div class="row no-mrg">
                            <h3>Edit Profile</h3>
                            <div class="edit-pro">
                                <div class="col-md-4 col-sm-6">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $userDetail['user_fname ']; ?>">
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $userDetail['user_lname']; ?>">
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $userDetail['user_contactNumber']; ?>">
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Address">
                                </div>


                                <div class="col-md-4 col-sm-6">
                                    <label>Date of Birth</label>
                                    <input type="Date" class="form-control" placeholder="<?php echo $userDetail['user_dob']; ?>"
                                           required>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <label>Job Category</label>
                                    <input type="text" class="form-control" placeholder="Software Developer">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $userDetail['user_city']; ?>">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label>State</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $userDetail['user_state']; ?>">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label>Country</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $userDetail['user_country']; ?>">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control" >
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" >
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" >
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
    <p class="hiddenUrl base"><?php echo _HOME ; ?></p>
    </div>
</section>
