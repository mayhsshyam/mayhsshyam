<?php
/**
 * Created by PhpStorm.
 * User: brainstream
 * Date: 19/2/22
 * Time: 11:34 PM
 */
session_start();
require "../config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

$reqFiles = new settings();
$reqFiles->get_required_files();
if (isset($_SESSION['user']) && isset($_SESSION['access'])):


    if (isset($_SESSION['jobSuccess'])) {
        unset($_SESSION['jobSuccess']);
    }
    $reqFiles->get_valid_checker();
    $dbconn  = new db();
    $conn    = $dbconn->getConn();
    $checker = new validChecker();
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        $userDetail = $checker->getUserByEmailALL($conn, $_SESSION['email']);
    }
    if (is_array($userDetail) && $userDetail['permit'] == '1') {
        $pageName            = "My Setting Page " . SITE_NAME;
        $_SESSION['curPage'] = 'mysetting';
        $reqFiles->get_header($pageName);
        ?>

        <div class="verify-msg hide ">
        </div>
        <?php
        if (isset($err) && count($err) > 0) {
            $html = '<div class="ml-2 mr-2">';
            foreach ($err as $errors => $val) {
                $valid = $errors == 'valid' ? true : false;
                foreach ($val as $name => $value) {
                    if ($valid) {
                        $html .= '<div class="alert alert-danger">' . $value . ' <button class="btn btn-sm btn-outline-danger float-right close_err">X</button> </div>';
                    } else {
                        $html .= '<div class="alert alert-warning">' . $value . ' <button class="btn btn-sm btn-outline-warning float-right close_err">X</button> </div>';
                    }
                }
            }
            $html .= '</div>';
            echo $html;
        }

        if (isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 'J' && $userDetail['type'] == 'J') {
                require "jobseeker.php";
            } else {
                require "organisation.php";
            }
        }

        $reqFiles->get_footer();
    } else {
        echo "<div style='height: 500px;'>USER NOT FOUND.</div>";
    }
else:

endif;

?>
