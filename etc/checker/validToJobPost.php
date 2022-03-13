<?php
/**
 * Created by PhpStorm.
 * User: brainstream
 * Date: 19/2/22
 * Time: 5:55 PM
 */

class validToJobPost
{

    private $insertPost_sql = "INSERT INTO ".PREFIX."tbljobs(user_id, job_title, job_desc, job_amt, job_hours, job_miniexp, job_vacancy, job_location, job_skillRequire, category_id, is_reported, job_createdBy, job_lastlyEdited) VALUES (:userid,:title,:descp,:amt,:hrs,:minexp,:vcc,:location,:skill,:cat,:rep,:creat,:lastedit)";
    private $getId_sql = "SELECT id from " .PREFIX."tblusers WHERE user_email = :email LIMIT 1";
    private $data = '';
    private $conn = '';
    public $user = "";
    public $status = "";

    public function validToJobPostFunc($conn,$data){
        $ret = false;
        $this->conn = $conn;
        $this->data = $data;
        $u_id = $this->getId($_SESSION['email']) ;
        $u_catid = $this->getCategoryId();
        if($u_id&&$u_catid){
            $res = $this->insertJobPost();
            if($res){
                $ret = true;
            }
        }else{
            $ret = false;
        }
        return $ret;
    }

    private function insertJobPost(){
        $this->data['cat'] = $this->data['cat'] == 0 ? 'OTHERS' : $this->data['cat'];
        try{
            $stmt = $this->conn->prepare($this->insertPost_sql);
            var_dump($this->user);
            $stmt->bindParam('userid',$this->user, PDO::PARAM_INT);
            $stmt->bindParam('title',$this->data['jobtitle'], PDO::PARAM_STR);
            $stmt->bindParam('descp',$this->data['jobdescription'], PDO::PARAM_STR);
            $stmt->bindParam('amt',$this->data['jobamt'], PDO::PARAM_INT);
            $stmt->bindParam('hrs',$this->data['jobhours']);
            $stmt->bindParam('minexp',$this->data['minexp'], PDO::PARAM_INT);
            $stmt->bindParam('vcc',$this->data['jobvcc'], PDO::PARAM_INT);
            $stmt->bindParam('location',$this->data['jobLocation'], PDO::PARAM_STR);
            $stmt->bindParam('skill',$this->data['skillRequire'], PDO::PARAM_STR);
            $stmt->bindParam('cat',$this->data['cat'], PDO::PARAM_STR);
            $stmt->bindParam('rep',$this->data['report'], PDO::PARAM_STR);
            $stmt->bindParam('creat',$this->data['creat'], PDO::PARAM_STR);
            $stmt->bindParam('lastedit',$this->data['lastedit'], PDO::PARAM_STR);
            $stmt->execute();
            $this->status = 'Success';
            $ret = true;

        }catch(PDOException $e){
            $this->status = "Database Error to Insert Post ". $e->getMessage();
            $ret = false;
        }
        return $ret;
    }

    private function getId($email){
        $ret = false;
        try{
            $stmt = $this->conn->prepare($this->getId_sql);
            $stmt->execute(['email'=>$email]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->user = $res['id'];
            $ret = true;
        }catch (PDOException $e){
            $this->status= "Email not found";
        }
        return $ret;
    }

    private function getCategoryId(){

        try{
            $stmt = $this->conn->prepare("SELECT id FROM " . PREFIX . "tblcategory WHERE category_subname =:subname");
            $stmt->execute(['subname'=> $this->data['cat']]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->data['cat']= $res['id'];
            $ret = true;
        }catch (PDOException $e){
            $ret = false;
        }
        return $ret;
    }

}
$validToJobPost = new validToJobPost();
