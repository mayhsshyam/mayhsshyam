<section>
<?php
/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */
$_SESSION['status'] = 1;
?>
<!-- Banner Image Button  -->
<div class="banner-image w-100 vh-100 justify-content-center align-items-center">
    <div class="btn-login content text-center mx-auto font-weight-bold">
        <a href="<?php echo _HOME.'/login.php'; ?>" role="button" class="btn btn-outline-warning btn-lg gap-2 col-6 mx-auto text-white"> Login </a>
    </div>
</div>
<!-- Banner image end -->
</section>
<section >
<!-- ICON CARD STARTED   -->
<div class="bg-light">
    <div class="container px-4 py-5" id="hanging-icons">
        <div class="row g- py-5 row-cols-1 row-cols-lg-4">
            <div class="col d-flex align-items-start">
                <div class="text-dark flex-shrink-0 me-3">
                    <span><img src="<?php echo _HOME."/assets/images/icon/s.png"; ?>">
                </div>
                    <div class="media-body">
                        <h2 class="heading mb-3">Search Millions of Jobs</h2>
                        <p>A small river named Duden flows by their place and supplies.</p>
                        </span>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="text-dark flex-shrink-0 me-3">
            <span><img src="<?php echo _HOME."/assets/images/icon/m.png"; ?>">
                </div>
                <div class="media-body">
                    <h2 class="heading mb-3">Easy To Manage Jobs</h2>
                    <p>A small river named Duden flows by their place and supplies.</p>
                    </span>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="text-dark flex-shrink-0 me-3">
                <span><img src="<?php echo _HOME."/assets/images/icon/em.png"; ?>">
                    </div>
                    <div class="media-body">
                        <h2 class="heading mb-3">Top Careers in dream field</h2>
                        <p>A small river named Duden flows by their place and supplies.</p>
                        </span>
                    </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="text-dark flex-shrink-0 me-3">
                <span><img src="<?php echo _HOME."/assets/images/icon/th.png"; ?>">
                    </div>
                    <div class="media-body">
                        <h2 class="heading mb-3">Search Expert Candidates</h2>
                        <p>A small river named Duden flows by their place and supplies.</p>
                        </span>
                    </div>
                </div>
            </div>
        </span>
    </div>
</div>
<!-- ICON CARD ENDED  -->
</section>
<section>
<!-- CUSTOMERS TEMP STARTED  -->
<hr style="color: black; height: 20px; margin: 10px 0px;">
<!-- CATEGORIES STARTED  -->
<?php include "others/welcomeCategories.php"; ?>
<!-- CATEGORIES ENDED -->
</section>
<section>
<hr style="color:black; height: 20px; margin: 10px 0px;">
<!-- CUSTOMERS TEMP STARTED  -->
<?php  include "others/customerReviews.php"; ?>
<!-- CUSTOMERS TEMP ENDED -->
</section>
