<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 2/9/2022
 */

class validToLogin
{
    private $conn                = '';
    private $data                = '';
    private $validToRegister_sql = "";
    private $user                = "";
    public  $status;
    private $updateUser_sql      = 'UPDATE ' . PREFIX . 'tblusers SET is_live = :live WHERE user_email =:email LIMIT 1';

    /**
     * @param string $conn
     */
    private function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param string $data
     */
    private function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param array  $selCol
     * @param string $table
     *
     * @return mixed
     */
    private function check(array $selCol, string $table)
    {
        $col                       = implode(", ", $selCol);
        $this->validToRegister_sql = 'SELECT ' . $col . ' FROM ' . PREFIX . $table . ' WHERE user_email = :email ORDER BY id LIMIT 1';
        $stmt                      = $this->conn->prepare($this->validToRegister_sql);
        $stmt->execute(['email' => $this->data]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * @param        $conn
     * @param string $email
     *
     * @return bool
     */
    public function validToLoginFunc($conn, string $email)
    {
        $ret = false;
        $col = ['verify_status', 'is_verify'];
        $this->setConn($conn);
        $this->setData($email);
        $chR = $this->check($col, 'tblotp');
        $res = $chR == null ? true : $chR;
        if ((!is_array($res) && $res) || ($res['is_verify'] == 1 && $res['verify_status'] == 0)) {
            $this->status = false;
        } else {
            if ($res['is_verify'] == 0) {
                $this->status = "<b>You are Banned.</b>";
            } elseif ($res['is_verify'] == 1 && $res['verify_status'] == 1) {
                $ret          = true;
                $this->status = true;
            } else {
                $this->status = "Something Wrong...";
            }
        }
        return $ret;
    }

    /**
     * @param array $user
     *
     * @return bool
     */
    public function userAvailCheck(array $user)
    {
        $this->setUser($user);
        $ret = false;
        $col = ['is_deleted', 'user_password', 'is_live'];
        $chR = $this->check($col, 'tblusers');
        $res = count($chR) == 1 ? true : $chR;
        if ($res == true && is_array($res)) {
            $this->status = "Password is not correct";
            if ($this->checkPassword($chR['user_password'])) {
                if ($this->upDateUser($this->user['email'])) {
                    $this->status = '';
                    $ret          = true;
                } else {
                    $this->status = "Something.. Wrong";
                }
            }
        } elseif (count($chR) == 0) {
            $this->status = "Email is Not Found";
        } else {
            //Here check whether User is deleted or not
            if (is_array($res) && $res['is_deleted'] == 1) {
                $this->status = "<b>You are Banned.</b>";
            } else {
                $this->status = "Something Wrong...";
            }
        }
        return $ret;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    private function checkPassword($pass)
    {
        $ret = false;
        if (md5($this->user['password']) == $pass) {
            $ret = true;
        }
        return true;
    }

    /**
     * @param $email
     *
     * @return bool
     */
    private function upDateUser($email)
    {
        $ret = false;
        try {
            $stmt = $this->conn->prepare($this->updateUser_sql);
            $stmt->execute(['live' => 'Y', 'email' => $email]);
            $ret = true;
        } catch (PDOException $e) {
//            $ret = 'DataBase Error: ' . $e->getCode() . $e->getMessage();
            $ret = false;
        }
        return $ret;
    }
}

$validToLogin = new validToLogin();
