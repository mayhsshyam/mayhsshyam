<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 1/15/2022
 */

session_start();
require '../../config/settingsFiles.php';
require '../../config/mailFile.php';

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;
use config\mailFile\mailFile as mail;


if (true) {
    class sendVerifyCode
    {
        private $userEmail            = '';
        private $conn                 = '';
        private $code                 = '';
        private $codeLen              = 6;
        private $insertVerifyCode_sql = '';
        public  $status;


        public function __construct()
        {
            if (empty($this->code)) {
                $temp = '';
                for ($i = 1; $i <= $this->codeLen; $i++) {
                    $choice = rand(1, 2);
                    switch ($choice) {
                        case 1:
                            $temp .= $this->num();
                            break;

                        case 2:
                            $temp .= $this->alpha();
                            break;
                    }
                }
                $this->setCode($temp);
            }

        }

        /**
         * @param string $code
         */
        public function setCode(string $code): void
        {
            $this->code = $code;
        }

        /**
         * @return string
         */
        public function getCode(): string
        {
            return $this->code;
        }

        /**
         * @param string $userEmail
         */
        public function setUserEmail(string $userEmail): void
        {
            $this->userEmail = $userEmail;
        }

        /**
         * @return string
         */
        private function alpha(): string
        {
            $alpha  = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            $ret = $alpha[array_rand($alpha)];
            return $ret;
        }

        /**
         * @return string
         */
        private function num(): string
        {
            $num = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
            $num = $num[array_rand($num)];
            return $num;
        }

        /**
         * @param string $conn
         */
        public function setConn($conn): void
        {
            $this->conn = $conn;
        }

        /**
         * @return string
         */
        public function getConn()
        {
            return $this->conn;
        }

        public function mail($mail)
        {
            $ret = false;
            if (method_exists($mail, 'sendMail')) {
                $retDb = $this->dbInsertVerifyCode();
//                $this->status = true;
                if ($this->status) {
                    $subject     = 'LOOKOT EMAIL VERIFICATION CODE';
                    $bodyContent = '<h1>VERIFICATION CODE:</h1>';
                    $bodyContent .= '<p>Your code for email verification is <b>' . $this->getCode() . '</b>.<br> Regards LOOKOUT Team </p>';
                 $this->status = $mail->sendMail($this->userEmail, $subject, $bodyContent);
                    $this->status = 'success';
                    $ret          = true;
                } else {
                    $this->status = 'error';
                    $ret          = 'Something Wrong ... Try again Later';
                }
            } else {
                $this->status = 'error';
                $ret          = 'Something is wrong with email';
            }

            return $ret;
        }

        private function dbInsertVerifyCode()
        {
            $ret = '';
            try {
                $this->insertVerifyCode_sql = 'INSERT INTO ' . PREFIX . 'tblotp (user_email, verify_code, verify_status, is_verify) VALUES(:u_email, :v_code , :v_status, :is_v )';
                $stmt = $this->conn->prepare($this->insertVerifyCode_sql);
                $ret  = $stmt->execute(['u_email' => $this->userEmail, 'v_code' => $this->getCode(), 'v_status' => 0    , 'is_v' => 1]);
                $this->status = true;
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $this->insertVerifyCode_sql .= 'ON DUPLICATE KEY UPDATE verify_code = :u_code';
                    $stmt                       = $this->conn->prepare($this->insertVerifyCode_sql);
                    $ret                        = $stmt->execute(['u_email' => $this->userEmail, 'v_code' => $this->getCode(), 'v_status' => 0, 'is_v' => 0, 'u_code' => $this->getCode()]);
                    $this->status = true;
                } else {
                    $this->status = false;
                    $ret = "ERROR : " . $e->getCode();
                }
            }
            return $ret;
        }


    }
}
if ($_POST && !empty($_POST['email'])) {
    $retData  = [];
    $err      = '';
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $reqFiles->get_valid_checker();
    $valid   = new validChecker();
    $dbClass = new db();
    //email clean and check again
    $data = $valid->cleanData($_POST['email']);
    if ($valid->email($data)) {
        $emailClass = new sendVerifyCode();
        $emailClass->setUserEmail($data);
        //now all are setted for sending mail and storing otp generated code to db
        $emailClass->setConn($dbClass->getConn());
        require_once _DIR . '/etc/mail/src/PHPMailer.php';
        require_once _DIR . '/etc/mail/src/SMTP.php';
        require_once _DIR . '/etc/mail/src/Exception.php';
        $mailClass = new mail();
        $ret       = $emailClass->mail($mailClass);
        if ($ret != true) {
            $err = $ret;
            $ret = 'false';
        }
    }


    $retData = ['result' => $emailClass->status, 'error' => $err, 'email'=> $data, 'mail' => $ret];
    echo json_encode($retData);

}
