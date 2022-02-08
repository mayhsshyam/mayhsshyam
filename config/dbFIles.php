<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */


//all databse connection information will here
namespace config\dbFiles;

defined("OWNER") or die("You are not allowed to access");

class dbFIles{
    private $conn = '';

    public function __construct()
    {
        if(!defined("HOST")){
            define("HOST","localhost");
        }
        if(!defined("DBNAME")){
            define("DBNAME","lookout_db_proj7911");
        }
        if(!defined("T_DBNAME")){
            define("T_DBNAME","testlookout_db_proj7911");
        }
        if(!defined("USER")){
            define("USER","root");
        }
        if(!defined("PASS")){
            define("PASS","root123");
        }
        if(!defined("PREFIX")){
            define("PREFIX","lo_");
        }
    }

    private function conn(){
        try {
            $this->conn = new \PDO('mysql:host='.HOST.';dbname='.T_DBNAME,USER,PASS);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $con = 1;
        }catch(\PDOException $e){
            $error = '<strong>' . $e->getCode(). '</strong>' . $e->getMessage();
            $con = $error;
        }
        return $con;
    }
    /**
     * @return string
     */
    public function getConn()
    {
        $error = $this->conn();
        return $error == 1 ?$this->conn:$error;
    }

}
