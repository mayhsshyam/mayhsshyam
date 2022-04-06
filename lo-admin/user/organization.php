<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 4/3/2022
 */
require "../../config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;

$configFiles = new settings();
$configFiles->get_required_files();
$_SESSION['cur_page'] = 'org_edit';
$pageName             = "Organization Dashboard " . SITE_NAME;
$configFiles->get_header_admin();

?>
EDIT PROFILE

<?php
$configFiles->get_footer_admin();
