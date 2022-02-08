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
    public  $status;

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
        $col = implode(", ", $selCol);
        $this->validToRegister_sql = 'SELECT ' . $col . ' FROM ' . PREFIX . $table.' WHERE user_email = :email ORDER BY id LIMIT 1';
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
        $col = ['verify_status','is_verify'];
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
                $ret = true;
                $this->status = true;
            }else{
                $this->status = "Something Wrong...";
            }
        }
        return $ret;
    }

    public function userAvailCheck(){
        $ret = false;
        $col = ['user_fname','is_deleted'];
        $chR = $this->check($col,'tblusers');
        $res = $chR == null ? true : $chR;
        if($res == true && !is_array($res)){
            $ret = $this->insertUser();
        }else{
            //Here check whether User is deleted or not
            if(is_array($res) && $res['is_deleted']==1){
                $this->status = "<b>You are Banned.</b>";
            }else{
                $this->status = "Something Wrong...";
            }
        }
        return $ret;
    }

    private function insertUser(){
        $ret = false;

        return $ret;
    }

}
$validToRegister = new validToRegister();
