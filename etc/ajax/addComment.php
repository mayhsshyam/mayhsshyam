<?php
/**
 * Created by PhpStorm.
 * User: Shyam PC
 * Date: 3/22/2022
 * Time: 9:13 PM
 */

session_start();
require '../../config/settingsFiles.php';

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;
class addComment
{
    private $comment_sql = "INSERT INTO lo_tblcomments (user_id,job_id,comment_desc,comment_createdBy)VALUES(:uid,:jid,:com,:ccby)";
    private $commentAll_sql = "SELECT comm.comment_desc as 'title', comm.date_created as 'comment_date', pu.profile_userName as 'puname', u.user_fname as 'fname' FROM lo_tblcomments as comm INNER JOIN lo_tblusers as u ON u.id = comm.user_id INNER JOIN lo_tblprofileuser as pu ON pu.user_id = u.id  WHERE comm.job_id=:jid ORDER BY comm.date_created";
    private $conn = "";
    public $status ="";

    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    public function insertComment($data){
        $ret ="";
        try{
            $stmt=$this->conn->prepare($this->comment_sql);
            $stmt->execute(['uid'=>$data['uid'],'jid'=>$data['id'],'com'=>$data['comment'],'ccby'=>$data['type']]);
            $ret = true;
            $this->status = true;
        }catch (PDOException $e){
            $this->status = $e->getMessage();
        }
        return $ret;
    }

    public function getcomments($data){
        $ret ="";
        try{
            $stmt=$this->conn->prepare($this->commentAll_sql);
            $stmt->execute(['jid'=>$data['id']]);
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->status = true;
        }catch (PDOException $e){
            $this->status = $e->getMessage();
        }
        return $ret;
    }


}

if (isset($_POST)) {
    $retData  = [];
    $err      = '';
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $reqFiles->get_valid_checker();
    $valid   = new validChecker();
    $dbClass = new db();
    $comment = new addComment();
    $comment->setConn($dbClass->getConn());
    if($_POST['mode']=='getall'){
        unset($_POST['mode']);
        $data    = $valid->cleanData($_POST);
        $ret = $comment->getcomments($data);
        if(is_array($ret)&&count($ret)>0){
            $html ="<br>";
            foreach($ret as $val){
                $html .="<div > <b>".$val['puname']."</b><br> <span style='font-size: 25px;padding-left: 10px;' >".$val['title']."</span><br> <span class='pull-right'> Created On : ". $val['comment_date']."</span></div>";
                $html .="<br>";
            }
        }else{
            $html = "<div>No Comments</div>";
        }
        $retData['result']='sucess';
        $retData['status']=$html;

    }elseif($_POST['mode']=='insert'){
        unset($_POST['mode']);
        $noremovespaces = ['comment'=>$_POST['comment']];
        $data    = $valid->cleanData($_POST,$noremovespaces);
        $valiComment = $valid->comment($data['comment']);
        if($valiComment && !empty($data['id']) && !empty($data['type']) && !empty($data['uid']) ){
            $ret = $comment->insertComment($data);
            if($ret && $comment->status){
                $retData['result']='success';
            }else{
                $retData['result']='fail';
                $retData['error']='Comment is not inserted';
                $retData['status']=$comment->status;
            }

        }else{
            $retData['result']='fail';
            $retData['error']='Comment is large Or empty';
        }
    }

    echo json_encode($retData);
}
