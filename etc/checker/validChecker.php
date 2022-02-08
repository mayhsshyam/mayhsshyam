<?php
/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */

class validChecker{
    public $passLen = 8;
    public $phoneLen = 10;

    /* clead data
    *	trim , clean tags
    *	remove whitespaces
    */
    public function cleanData($data){
        $data_valid = false;
        if(is_array($data)){
            foreach ($data as $name => $datas) {
                $datas =  trim($datas);
                $datas = str_replace(" ", "", $datas);
                $datas = strip_tags($datas);
                $datas = htmlspecialchars($datas);
                $data_valid[$name] = $datas;
            }
        }else{
            $data_valid = trim($data);
            $data_valid = strip_tags($data_valid);
            $data_valid = str_replace(" ", "", $data_valid);
            $data_valid = htmlspecialchars($data_valid);

        }

        return $data_valid;
    }

    public function email($email=''){
        $checker = false;
        if(!empty($email)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $checker = true;
            }
        }
        return $checker;
    }
    public function phone($number=''){
        $checker = false;
        if(!empty($number)){
            $number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
            $checker = strlen($number) == $this->phoneLen ? true : false;
        }
        return $checker;
    }
    public function pass_confirm($pass='', $cpass=''){
        $checker = false;
        if(isset($pass) && isset($cpass)){
            $pass  = filter_var($pass, FILTER_SANITIZE_STRING);
            $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
            if(($pass!='' && $cpass !='') &&(!empty($pass) &&!empty($cpass))) {
                if(strlen($pass) != $this->passLen){
                    $checker = 'Password is incorrect';
                }elseif(strlen($cpass) != $this->passLen){
                    $checker = 'Confirm Password is incorrect';
                }elseif(strcmp($pass,$cpass)!=0){
                    $checker = 'Password is mismatch';
                }else{
                    $checker = true;
                }
            }else{
                $checker = 'Password or COnfirm-password is empty';
            }
        }
        return $checker;
    }
}
