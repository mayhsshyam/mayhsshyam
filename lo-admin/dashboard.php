<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/27/2022
 */
session_start();
require "../config/settingsFiles.php";
use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;
$configFiles = new settings();
$configFiles->get_required_files();
$_SESSION['cur_page'] = 'index';
$pageName             = "Admin Dashboard " . SITE_NAME;
$configFiles->get_header_admin($pageName);
$configFiles->get_valid_checker();
$db = new db();
$valid = new validChecker();
$userDetail = $valid->getUserByEmail($db->getConn(),$_SESSION['email']);
foreach ($userDetail as $name =>$vallue){
    $_SESSION[$name]=$vallue;
}
require _DIR_ADMIN . "/etc/validToAdminDash.php";
$counts = new validToAdminDash();
$counts->setConn($db->getConn());
$getCounts=$counts->getAllUsers();
$getJobCounts = $counts->getTotalJobs();

?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="container">
                <div class="col-md-4 col-sm-6">
                    <div class="dash-widget">
                        <span class="dash-widget-bg1"><i class="fa fa-building" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3><?php echo $getCounts['users_count']['org']; ?></h3>
                            <span class="widget-title1">Organization <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="dash-widget">
                        <span class="dash-widget-bg2"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3><?php echo $getCounts['users_count']['jobseek']; ?></h3>
                            <span class="widget-title2">Jobseeker <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="dash-widget">
                        <span class="dash-widget-bg3"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3><?php echo $getJobCounts['job_count']; ?></h3>
                            <span class="widget-title3">Jobs <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$configFiles->get_footer_admin();
