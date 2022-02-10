<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 2/10/2022
 */

session_start();
require "../config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (isset($_SESSION['status']) && $_SESSION['status'] == 1):
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $reqFiles->get_valid_checker();
    $dbconn = new db();
    $conn            = $dbconn->getConn();
    $checker = new validChecker();

    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        $userDetail = $checker->getUserByEmail($conn,$_SESSION['email']);
    }
    $_SESSION['userType'] = $userDetail['user_type'];
    $pageName = $userDetail['user_fname']."'s Dashborad" . SITE_NAME;
    $reqFiles->get_header($pageName);
    $_SESSION['curPage'] = 'dashboard';

    $reqFiles->get_footer();

endif;
?>
