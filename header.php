<?php /**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */
var_dump($_SESSION);
$pageName = isset($pageName) ? $pageName : "Welcome Page" . SITE_NAME;
?>
<!DOCTYPE Html>
<html lang="en">
<head>
    <title><?php echo $pageName; ?></title>
    <!--        All css-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo _HOME . '/assets/logos/head.png'; ?>" sizes="70">
    <link href="<?php echo _HOME . '/assets/bootstrap/b_css/bootstrap.css'; ?>" rel="stylesheet">
    <link href="<?php echo _HOME . '/assets/css/jquery-ui.min.css'; ?>" rel="stylesheet">
    <!--        All script-->
    <script src="<?php echo _HOME . '/assets/js/jq-3.6.0.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo _HOME . '/assets/js/jquery-ui.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo _HOME . '/assets/js/jquery.validate.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo _HOME . '/assets/js/additional-methods.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo _HOME . '/assets/bootstrap/b_js/bootstrap.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo _HOME . '/assets/bootstrap/b_js/bootstrap.bundle.min.js'; ?>"
            type="text/javascript"></script>
    <?php if (isset($_SESSION['access']) && $_SESSION['access'] == 'USER'): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo _HOME . '/assets/css/style.css'; ?>">
    <?php elseif (isset($_SESSION['access']) && $_SESSION['access'] == 'ADMIN'): ?>
    <?php else:
        echo "Something is missing...<br> <b>Access</b> is not getting.";
    endif; ?>
    <?php if ($_SERVER['SCRIPT_NAME'] === "/index.php"): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo _HOME . '/assets/css/animate.css'; ?>">
        <style>
            .banner-image .btn-login a {
                position: absolute;
                right: 25%;
                top: 65%;
            }

            .banner-image {
                background: url("<?php echo _HOME.'/assets/images/golden.gif'; ?>");
                /*background: url("ccard 8.jpg");*/
                background-size: cover;
                border-color: transparent;
                filter: grayscale(45%);
            }
        </style>
    <?php endif; ?>
</head>
<body>

<div class="navigation">
    <?php include "navigation.php" ?>
</div>
<?php
if (isset($_SESSION['access']) && (isset($curFile) && $curFile == "index"))
    include "welcome.php"; ?>
