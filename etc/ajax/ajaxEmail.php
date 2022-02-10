<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 1/7/2022
 */

session_start();
require '../../config/settingsFiles.php';

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (true) {
    class ajaxEmail
    {
        private $conn                = '';
        public  $status;
        private $checkValidEmail_sql = "SELECT id,user_email from " . PREFIX . "tblusers WHERE user_email=? ORDER BY id";

        /**
         * @param string $conn
         */
        public function setConn($conn)
        {
            $this->conn = $conn;
        }

        /**
         * @param $email
         *
         * @return bool|string
         */
        public function checkValidEmail($email)
        {
            $res = false;
            if (!isset($this->status) && $this->status != 'error') {
                try {
                    $stmt = $this->conn->prepare($this->checkValidEmail_sql);
                    $stmt->execute([$email]);
                    $res = $stmt->fetchAll();
                    if (isset($_SESSION['curPage'])) {
                        if ($_SESSION['curPage'] == 'register') {
                            $res = count($res) > 0 ? false : true;
                        }
                        if ($_SESSION['curPage'] == 'login') {
                            $res = count($res) == 1 ? true : false;
                        }
                        $this->status = 'success';
                    } else {
                        $res          = 'Refress The Page';
                        $this->status = 'error';
                    }
                } catch (PDOException $e) {
//                    $res          = '<strong>' . $e->getCode() . '</strong> ' . $e->getMessage();
                    $res          = "Db Error";
                    $this->status = 'error';

                }
            }
            return $res;
        }
    }
}
if ($_POST && !empty($_POST['email'])) {
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    //email clean and check
    $reqFiles->get_valid_checker();
    $valid      = new validChecker();
    $dbFile     = new db();
    $emailClass = new ajaxEmail();

    $data    = $valid->cleanData($_POST['email']);
    $retData = [];
    if (!$valid->email($data)) {
        $emailClass->status = 'error';
        $retData['status']  = $emailClass->status;
    } else {
        $emailClass->setConn($dbFile->getConn());
        $res               = $emailClass->checkValidEmail($data);
        $retData['status'] = $emailClass->status;
        $retData['page']   = isset($_SESSION['curPage']) ? $_SESSION['curPage'] : '';

        if ($emailClass->status == 'success') {
            $retData['valid'] = $res;
        }
    }

    echo json_encode($retData);

}
