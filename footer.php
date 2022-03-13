<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */
?>
</div>
<?php if (isset($data) && $data) { ?>
    <footer class="footer">
        <div class="row lg-menu">
            <div class="container">
                <div class="col-md-4 col-sm-4"><img src="<?php echo _HOME . "/assets/img/footer-logo.png"; ?>"
                                                    class="img-responsive" alt=""/>
                </div>
                <div class="col-md-8 co-sm-8 pull-right">
                    <ul>
                        <li><a href="<?php echo _HOME . '/index.php'; ?>" title="">Home</a></li>
                        <li><a href="#" title="">FAQ</a></li>
                        <li><a href="<?php echo _HOME . '/contactUs.php'; ?>">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row no-padding">
            <div class="container">
                <div class="col-md-3 col-sm-12">
                    <div class="footer-widget">
                        <h3 class="widgettitle widget-title">About Lookout</h3>

                        <div class="textwidget">
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>

                            <p>7860 North Park Place<br>San Francisco, CA 94120</p>

                            <p><strong>Email:</strong> Support@careerdesk</p>

                            <p><strong>Call:</strong> <a href="tel:+15555555555">555-555-1234</a></p>
                            <ul class="footer-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h3 class="widgettitle widget-title">All Navigation</h3>

                        <div class="textwidget">
                            <div class="textwidget">
                                <ul class="footer-navigation">
                                    <li><a href="manage-company.html" title="">Front-end Design</a></li>
                                    <li><a href="manage-company.html" title="">Android Developer</a></li>
                                    <li><a href="manage-company.html" title="">CMS Development</a></li>
                                    <li><a href="manage-company.html" title="">PHP Development</a></li>
                                    <li><a href="manage-company.html" title="">IOS Developer</a></li>
                                    <li><a href="manage-company.html" title="">Iphone Developer</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h3 class="widgettitle widget-title">All Categories</h3>

                        <div class="textwidget">
                            <ul class="footer-navigation">
                                <li><a href="manage-company.html" title="">Front-end Design</a></li>
                                <li><a href="manage-company.html" title="">Android Developer</a></li>
                                <li><a href="manage-company.html" title="">CMS Development</a></li>
                                <li><a href="manage-company.html" title="">PHP Development</a></li>
                                <li><a href="manage-company.html" title="">IOS Developer</a></li>
                                <li><a href="manage-company.html" title="">Iphone Developer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <div class="clearfix"></div>

<?php } ?>


<!-- Scripts==================================================-->
<script src="<?php echo _HOME . '/assets/js/style.js'; ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/viewportchecker.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/bootstrap.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/bootsnav.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/select2.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/wysihtml5-0.3.0.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/bootstrap-wysihtml5.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/datedropper.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/dropzone.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/loader.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/owl.carousel.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/slick.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo _HOME . "/assets/plugins/js/gmap3.min.js"; ?> "></script>
<script type="text/javascript"
        src="<?php echo _HOME . "/assets/plugins/js/jquery.easy-autocomplete.min.js"; ?> "></script>
<script src="<?php echo _HOME . '/assets/js/validChecker.js'; ?>" type="text/javascript"></script>
<link href="<?php echo _HOME . '/assets/css/custom_style.css'; ?>" rel="stylesheet">

<?php if ((isset($_SESSION['access']) && $_SESSION['access'] == 'USER') && ($_SESSION['curPage'] == "register" || $_SESSION['curPage'] == "login")): ?>
    <script src="<?php echo _HOME . '/assets/js/ajax_js/email_checker.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo _HOME . '/assets/js/ajax_js/verifyEmail.js'; ?>" type="text/javascript"></script>

<?php elseif (isset($_SESSION['access']) && $_SESSION['access'] == 'USER' && ($_SESSION['curPage'] == "postnew")) : ?>
    <script src="<?php echo _HOME . '/assets/js/postjob.js'; ?>"></script>
<?php elseif (isset($_SESSION['access']) && $_SESSION['access'] == 'USER' && ($_SESSION['curPage'] == "mysetting")) : ?>
    <script src="<?php echo _HOME . '/assets/js/ajax_js/jobs.js'; ?>"></script>

<?php elseif (isset($_SESSION['access']) && $_SESSION['access'] == 'USER' && ($_SESSION['curPage'] == "dashboard")) : ?>
    <script src="<?php echo _HOME . '/assets/js/ajax_js/jobPaging.js'; ?>"></script>

    <!--<script>
        $('#company-dob').dateDropper();
    </script>-->
<?php endif; ?>
<script src="<?php echo _HOME . '/assets/js/jQuery.style.switcher.js'; ?>"></script>

<script type="text/javascript">$(document).ready(function () {
        $('#styleOptions').styleSwitcher();
    });</script>
<script>function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }

    function closeRightMenu() {
        document.getElementById("rightMenu").style.display = "none";
    }</script>
</body>
</html>
