<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */
?>
        <footer class="footer">
            <div class="container footer-container">
                <?php if( (isset($_SESSION['access'] ) && $_SESSION['access'] == 'USER') && ($_SERVER['SCRIPT_NAME'] === "/login.php" || $_SERVER['SCRIPT_NAME'] === "/register.php")): ?>
                    <script src="<?php echo _HOME. '/assets/js/validChecker.js'; ?>" type="text/javascript"></script>
                    <script src="<?php echo _HOME. '/assets/js/ajax_js/email_checker.js'; ?>" type="text/javascript"></script>
                    <script src="<?php echo _HOME. '/assets/js/ajax_js/verifyEmail.js'; ?>" type="text/javascript"></script>
                    <link href="<?php echo _HOME.'/assets/css/custom_style.css'; ?>" rel="stylesheet" >
                <?php elseif( isset($_SESSION['access'] ) && $_SESSION['access'] == 'ADMIN'): ?>
                <?php elseif( isset($_SESSION['access'] ) && $_SESSION['access'] == 'USER' ): ?>
                    <script src="<?php echo _HOME. '/assets/js/parallax.min.js'; ?>" type="text/javascript"></script>
                    <script src="<?php echo _HOME.'/assets/js/style.js'; ?>" type="text/javascript"></script>

                <?php endif; ?>
            </div>
        </footer>
    </body>
</html>
