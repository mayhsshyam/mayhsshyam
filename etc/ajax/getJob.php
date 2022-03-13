<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/2/2022
 */

if (!isset($_SESSION)) {
    session_start();
    require '../../config/settingsFiles.php';

}

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (true) {
    class getJob
    {
        private $getJob_sql = "";
        private $conn       = "";
        public  $status     = "";

        public function setConn($conn)
        {
            $this->conn = $conn;
        }

        /**
         * @return string
         */
        public function getGetJobSql(): string
        {
            return $this->getJob_sql;
        }

        public function getJobFunc($sortlist)
        {
            $ret = false;
            if (!empty($sortlist)) {
                $select_sql = "SELECT job.id as 'job_id', job.*, user.user_fname, user.user_photo, puser.profile_userName, user.user_type,user.user_email,user.user_country, user.user_state,puser.profile_userName, puser.org_name ";
                $join_table =" FROM " . PREFIX . "tbljobs as job INNER JOIN " . PREFIX . "tblusers as user ON job.user_id = user.id INNER JOIN " . PREFIX . "tblprofileuser as puser ON puser.user_id = user.id INNER JOIN " . PREFIX . "tblcategory as cat ON cat.id = job.category_id ";
                $condition = " WHERE job.is_reported ='N'";
                if (isset($sortlist['locate']) && $sortlist['locate'] != '') {
                    $condition .= " AND job.job_location='" . $sortlist['locate'] . "' ";
                }
                if (isset($sortlist['type']) && $sortlist['type'] != '') {
                    $condition .= " AND job.job_hours='" . $sortlist['type'] . "' ";
                }
                if (isset($sortlist['category']) && $sortlist['category'] != '') {
                    if($sortlist['category']=='all'){
                        $select_sql .= "";
                    }else{

                        $condition .= " AND cat.category_subname='" . $sortlist['category'] . "' ";
                    }
                }

                $condition .= " ORDER BY job.date_created ASC";
//
//                if ($sortlist['limit'] != '') {
//
//                    $condition .= ' LIMIT ' . ((intval($sortlist['limit'])-1)*($sortlist['offset'])) . ', ' . intval($sortlist['offset']);
//
//                }
                $this->getJob_sql = $select_sql.$join_table.$condition;
            }
            try {
                $stmt = $this->conn->prepare($this->getJob_sql);
                $stmt->execute();
                $res          = $stmt->fetchALL(PDO::FETCH_ASSOC);
                $this->status = true;
                $ret          = $res;
            } catch (PDOException $e) {
                $this->status = "ERROR on getting job";
                $ret          = $e;
            }
            return $ret;
        }


        public function getTotalRecordsRow(){
            $select_sql = "SELECT count(job.id) as 'total' FROM " . PREFIX . "tbljobs as job INNER JOIN " . PREFIX . "tblusers as user ON job.user_id = user.id INNER JOIN " . PREFIX . "tblprofileuser as puser ON puser.user_id = user.id INNER JOIN " . PREFIX . "tblcategory as cat ON cat.id = job.category_id ";
            $condition = " WHERE job.is_reported ='N'";
            try {
                $stmt = $this->conn->prepare($select_sql.$condition);
                $stmt->execute();
                $res          = $stmt->fetchALL(PDO::FETCH_ASSOC);
                $this->status = true;
                $ret          = $res;
            } catch (PDOException $e) {
                $this->status = "ERROR on getting job";
                $ret          = $e;
            }
            return $ret;
        }

    }
}

if ($_POST) {
    $retData  = [];
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $reqFiles->get_valid_checker();
    $valid   = new validChecker();
    $dbClass = new db();
    // clean and check again
    $noremove = ['category' => $_POST['category']];
    $data     = $valid->cleanData($_POST, $noremove);
    $getJob   = new getJob();
    $getJob->setConn($dbClass->getConn());

    $res = $getJob->getJobFunc($data);
    $output = '';
    if(is_array($res)) {
        foreach ($res as $jobs) {
            //for job type
            if ($jobs['job_hours'] == 1) {
                $jobs['job_hours'] = 'Full Time';
            } elseif ($jobs['job_hours'] == 2) {
                $jobs['job_hours'] = 'Part Time';
            } elseif ($jobs['job_hours'] == 0) {
                $jobs['job_hours'] = 'Flexible Time';
            }
//                for company name else user name
            if ($jobs['user_type'] == "O") {
                if ($jobs['org_name'] == "NULL" || $jobs['org_name'] == NULL) {
                    $company = $jobs['user_fname'];
                } else {
                    $company = $jobs['org_name'];
                }
            } else {
                $company = "LOOKOUT";
            }
//                for location
            if ($jobs['user_type'] == "O") {
                if ($jobs['job_location'] != "0" && $jobs['job_location'] != "NULL" && $jobs['job_location'] != "") {
                    $location = $jobs['job_location'];
                } elseif (!empty($jobs['user_state']) && !empty($jobs['user_country'])) {

                    $location = $jobs['user_state'] . ', ' . $jobs['user_country'];
                } else {
                    $location = '';
                }
            } else {
//                ADMIN ADDRESS
                $location = 'GUJARAT, INDIA';
            }
            if (!isset($jobs['profile_userName'])) {
                $jobs['profile_userName'] = "USER";
            }
            //for date jobs
            $datepost  = date_create(date("Y-m-d H:i:s", strtotime($jobs['date_created'])));
            $today     = date_create(date("Y-m-d H:i:s"));
            $date_diff = date_diff($datepost, $today);
            if ($date_diff->y < 1) {
                if ($date_diff->m < 1) {
                    if ($date_diff->d < 1) {
                        $datepost = "New";
                    } else {
                        $datepost = $date_diff->d . ' days ago';
                    }
                } else {
                    $datepost = $date_diff->m . ' months ago';
                }
            } else {
                $datepost = $date_diff->y . ' years ago';

            }

            $output .= '<div class="item-click">
            <article>
                <div class="brows-job-list">
                    <div class="col-md-1 col-sm-2 small-padding">
                        <div class="brows-job-company-img">
                            <a href="job-detail.html"><img
                                        src="' . _HOME . "/uploads/images/" . $jobs["user_photo"] . '"
                                        alt="' . $jobs["profile_userName"] . '"\'s image
                                        class="img-responsive"/></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-5">
                        <div class="brows-job-position">
                            <a href="job-detail.html"><h3>' . $jobs['job_title'] . '</h3></a>
                            <p>
                                <span><?php echo $company; ?></span><span class="brows-job-sallery"><i
                                            class="fa fa-money"></i>$' . $jobs["job_amt"] . '</span>
                                <span class="job-type bg-trans-primary cl-primary">' . $jobs["job_hours"] . '</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="brows-job-location">';
            if ($location) {
                $output .= ' <p><i class="fa fa-map-marker"></i>' . $location . '</p> ';
            }
            $output .= '</div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="brows-job-link">
                            <a href="'._HOME. '/job/detailview/jobDetailView.php?id='.base64_encode($jobs['job_id'])  .'" class="btn btn-default">View Details</a>
                        </div>
                    </div>
                </div>
                <span class="tg-themetag tg-featuretag">' . $datepost . '</span>
            </article>
        </div>';
        }
        $offset = $_POST['offset'];
//        $total_row = $getJob->getTotalRecordsRow();
        $page = ceil(count($res)/$offset);
        $button='';

        for($i=1;$i<=$page;$i++){
            $button .='<li><a class="pagingdat" data-page="'.$i.'">'.$i.'</a></li>';
        }
        $retData = [
            'result'=>true,
            'res'=> $output,
            'pagbut'=> $button,
        ];
    }else{
        $retData =[
            'result'=>false,
            'res'=>$res
        ];
    }

    echo json_encode($retData);
}
