<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 1/8/2022
 */
defined("OWNER") or die("You are not allowed to access");

class validToRegister
{
    private $conn                = '';
    private $data                = '';
    private $validToRegister_sql = "";
    private $user                = "";
    public  $status;
    private $insertUser_sql      = 'INSERT INTO ' . PREFIX . 'tblusers (user_fname,user_lname,user_email,user_contactNumber,user_dob,user_category,user_occupation,user_country,user_state,user_city,user_address,user_photo,user_password,user_type,is_live,is_deleted)VALUES(:u_fname,:u_lname,:u_email,:u_cn,:u_dbo,:u_cat,:u_occ,:u_con,:u_st,:u_ct,:u_ad,:u_ph,:u_pass,:u_type,:live,:deleted)';

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
    public function validToRegisterFunc($conn, string $email)
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

    public function userAvailCheck($user)
    {
        $this->setUser($user);
        $ret = false;
        $col = ['user_fname', 'is_deleted'];
        $chR = $this->check($col, 'tblusers');
        $res = $chR == null ? true : $chR;
        if ($res == true && !is_array($res)) {
            $ret = $this->insertUser();
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

    private function insertUser()
    {
        $ret = false;
        try {

            $setUpIn              = [
                'u_fname' => $this->user['fname'], 'u_lname' => $this->user['lname'],
                'u_email' => $this->user['email'], 'u_cn' => $this->user['cn'], 'u_dbo' => $this->user['dbo'],
                'u_cat'   => $this->user['cat'], 'u_occ' => $this->user['occupation'],
                'u_con'   => $this->user['country'], 'u_st' => $this->user['state'], 'u_ct' => $this->user['city'],
                'u_ad'    => $this->user['address'], 'u_ph' => $this->user['photo'], 'u_pass' => $this->user['pass'],
                'u_type'  => $this->user['jobType'], 'live' => $this->user['live'], 'delete' => $this->user['delete']];
            $stmt                 = $this->conn->prepare($this->insertUser_sql);
            $stmt->execute([$setUpIn]);
            $ret = true;
        } catch (PDOException $e) {
            $ret = 'DataBase Error: ' . $e->getCode();
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

}

$validToRegister = new validToRegister();
