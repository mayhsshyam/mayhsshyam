<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/19/2022
 */

session_start();
require "../config/settingsFiles.php";
use config\settingsFiles\settingsFiles as settings;
$reqFiles = new settings();
$reqFiles->get_required_files();

$pageName = "THANKYOU PAGE" . SITE_NAME;
$_SESSION['curPage'] = 'postnew';
$reqFiles->get_header($pageName);

if(isset($_SESSION['jobApply']) && $_SESSION['jobApply']){
    unset($_SESSION['jobApply']);
}
?>

<div class="wrapper">

    <div class="clearfix"></div>

    <!-- Header Title Start -->
    <section class="inner-header-title blank">
        <div class="container">
            <h1>THANK YOU</h1>
            <h3>YOUR JOB IS APPLIED </h3>
        </div>
    </section>
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12">
        <a href="<?php echo _HOME.'/dashboard/index.php'?>" class="btn btn-success btn-primary small-btn">Go To Dashboard</a>
    </div>

</div>
</body>
</html>
