<?php
/**
 * Created by PhpStorm.
 * User: brainstream
 * Date: 12/2/22
 * Time: 5:20 PM
 */
session_start();
require "config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (isset($_SESSION['status']) && $_SESSION['status'] == 1):
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $pageName = "Contact Us " . SITE_NAME;
    $_SESSION['curPage'] = 'contactus';
    $reqFiles->get_header($pageName);
?>
    <div class="form-header">
        CONTACT US FORM
    </div>
    <div class="form-border">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
              name="register_form" method="post" enctype="multipart/form-data"
              class="" id="register_form">

        </form>
    </div>

</div>

<?php
    $reqFiles->get_footer();
 else:
    echo 'Cannot call directly';
endif;
