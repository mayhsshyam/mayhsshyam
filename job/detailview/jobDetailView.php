<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/10/2022
 */
session_start();
require "../../config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

$reqFiles                = new settings();
$reqFiles->get_required_files();
if (isset($_SESSION['user'])):
    $pageName = "Detail Job" . SITE_NAME;
    $_SESSION['curPage'] = 'jobview';
    $reqFiles->get_header($pageName);
    $reqFiles->get_valid_checker();
    $valid = new validChecker();
    $db = NEW db();
    $conn = $db->getConn();
    $user  = $valid->getUserByEmail($conn,$_SESSION['email']);

    if ($_POST && $_POST['post_job']) {
        $err = [];
        $reqFiles->get_valid_checker();
    }

class jobView
{
    private $job_sql ="SELECT * FROM " .PREFIX."tbljobs WHERE id = :job AND is_reported=\"N\"";
    private $conn   = "";
    public  $status = "";

    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return string
     */
    public function getJobSql(): string
    {
        return $this->job_sql;
    }
    public function jobDetailVIewFunc($data){
        $ret = false;
        try{
            $stmt = $this->conn->prepare($this->job_sql);
            $stmt->execute(['job'=>$data['jobId']]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->status = true;
            $ret = $res;
        }catch (PDOException $e){
            $this->status = false;

        }
        return $ret;
    }

}
    $data =['jobId'=> base64_decode($_GET['id'])];

    $jobConn = $db->getConn();
    $jobView = new jobView();
    $jobView->setConn($jobConn);
    $result = $jobView->jobDetailVIewFunc($data);


        ?>
        <div class="wrapper">
        <div class="clearfix"></div>

        <!-- Title Header Start -->
        <section class="inner-header-title"
                 style="background-image:url(<?php echo _HOME . '/assets/img/banner-4.jpg'; ?>);">
            <div class="container">
                <h1>Job Detail</h1>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- Title Header End -->
        <!-- Job Detail Start -->
        <section class="detail-desc">
            <div class="container white-shadow">
                <?php if($jobView->status == true &&$result): ?>

                <div class="row">

                    <div class="detail-pic">
                        <img src="assets/img/com-2.jpg" class="img" alt=""/>
                        <a href="#" class="detail-edit" title="edit"></a>
                    </div>

                    <div class="detail-status">
                        <span>2 Days Ago</span>
                    </div>

                </div>

                <div class="row bottom-mrg">
                    <div class="col-md-8 col-sm-8">
                        <div class="detail-desc-caption">
                            <h4>Google</h4>
                            <span class="designation">Software Development Company</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <ul>
                                <li><i class="fa fa-briefcase"></i><span>Full time</span></li>
                                <li><i class="fa fa-flask"></i><span>3 Year Experience</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="get-touch">
                            <h4>Get in Touch</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i><span>Menlo Park, CA</span></li>
                                <li><i class="fa fa-envelope"></i><span>danieldax704@gmail.com</span></li>
                                <li><i class="fa fa-globe"></i><span>microft.com</span></li>
                                <li><i class="fa fa-phone"></i><span>0 123 456 7859</span></li>
                                <li><i class="fa fa-money"></i><span>$1000 -$1200/Month</span></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="row no-padd">
                    <div class="detail pannel-footer">
                        <div class="col-md-5 col-sm-5">
                            <ul class="detail-footer-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>

                        <div class="col-md-7 col-sm-7">
                            <div class="detail-pannel-footer-btn pull-right">
                                <a href="#" class="footer-btn grn-btn" title="">Quick Apply</a>
                                <a href="#" class="footer-btn blu-btn" title="">Report</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </section>
        <!-- Job Detail End -->

        <!-- Job full detail Start -->
        <section class="full-detail-description full-detail">
            <div class="container">
                <?php if($jobView->status == true &&$result): ?>

                <div class="row row-bottom">
                    <h2 class="detail-title">Job Responsibilities</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

                <div class="row row-bottom">
                    <h2 class="detail-title">Skill Requirement</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <ul class="detail-list">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</li>
                    </ul>
                </div>

                <div class="row row-bottom">
                    <h2 class="detail-title">Qualification</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <ul class="detail-list">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    </ul>
                </div>
                                <?php else:?>
                                    <div class="row ro-butoom">
                                        <h2 class="detail-title">No Such Job Availabel</h2>


                                    </div>

                                <?php endif;?>


            </div>

        </section>
        <?php

    $reqFiles->get_footer();
else:
    echo 'Cannot call directly';
endif;
