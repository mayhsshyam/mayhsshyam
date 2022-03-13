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

$reqFiles = new settings();
$reqFiles->get_required_files();
if ((isset($_SESSION['status']) && $_SESSION['status'] == 1)):
    if ((isset($_SESSION['user']) && ($_SESSION['user'] == "new" || $_SESSION['user'] = "old"))):
        if (isset($_SESSION['jobSuccess'])) {
            unset($_SESSION['jobSuccess']);
        }
        $reqFiles->get_valid_checker();
        $dbconn  = new db();
        $conn    = $dbconn->getConn();
        $checker = new validChecker();
        if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            $userDetailBASIC = $checker->getUserByEmail($conn, $_SESSION['email']);
            if (is_array($userDetailBASIC)) {
                foreach ($userDetailBASIC as $name => $value) {
                    $_SESSION[$name] = $value;
                }
            }
            $userDetail = $checker->getUserByEmailALL($conn, $_SESSION['email']);
        }
        if ($userDetail) {
            $pageName            = $userDetail['fname'] . "'s Dashborad" . SITE_NAME;
            $_SESSION['curPage'] = 'dashboard';
            $reqFiles->get_header($pageName);

            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] == 'J' && $userDetail['type'] == 'J') {
                    require "jobseeker.php";
                } else {
                    require "organisation.php";
                }
            }
            ?>
        <?php    $reqFiles->get_footer();
        } else {
            echo "SOME ERROR GO BACK AND LOGIN AGAIN";
        }
    else:
        defined("OWNER") or die("You are not allowed to access");
    endif;
else:
    header("location: " . _HOME . "/index.php");
endif; ?>
