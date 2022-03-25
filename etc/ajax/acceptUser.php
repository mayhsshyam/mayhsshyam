<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/22/2022
 */

if (!isset($_SESSION)) {
    session_start();
    require '../../config/settingsFiles.php';
}

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (true) {
    class acceptUser
    {
        private $applier_sql = "UPDATE lo_tblapplier SET apply=:app where id=:id;";
        private $conn        = '';
        public  $status      = '';

        public function setConn($conn): void
        {
            $this->conn = $conn;
        }

        public function acceptUserFunc($mode, $id)
        {
            $ret = false;
            try {
                $stmt = $this->conn->prepare($this->applier_sql);
                $stmt->execute(['app' => $mode, 'id' => $id]);
                $ret          = true;
                $this->status = true;

            } catch (PDOException $e) {
                $this->status = false;
            }
            return $ret;
        }

    }
}
if ($_POST) {
    $retData  = [];
    $res=false;
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $dbClass = new db();
    $accept  = new acceptUser();
    $accept->setConn($dbClass->getConn());
    if ($_POST['mode'] == 'accept') {
        $mode = '1';
        $res  = $accept->acceptUserFunc($mode, $_POST['uid']);
    } elseif ($_POST['mode'] == 'deny') {
        $mode = '2';
        $res  = $accept->acceptUserFunc($mode, $_POST['uid']);
    }
    if ($accept->status || $res) {
        $retData = [
            'result' => 'success',
        ];
    } else {
        $retData = [
            'result' => 'fail',
            'err'=>$accept->status
        ];
    }

echo json_encode($retData);

}
