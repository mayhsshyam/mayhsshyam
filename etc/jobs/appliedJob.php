<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/10/2022
 */

class appliedJob
{
    private $sql    = "SELECT app.id as 'appl_id', app.job as 'appl_job_id', app.*, jobs.*, user.*,pu.* FROM lo_tblapplier as app INNER JOIN lo_tbljobs as jobs ON jobs.id = app.job INNER JOIN lo_tblusers as user ON user.id = jobs.user_id INNER JOIN lo_tblprofileuser as pu ON pu.user_id = user.id WHERE app.user_id =? AND jobs.is_deleted ='N' AND user.is_deleted ='N'";
    private $conn   = "";
    public  $status = "";

    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    public function getappliedJob($id)
    {
        $ret = false;

        if (!empty($id) && $id != '') {
            try {
                $sql =" AND app.apply='0' AND app.is_delete =\"N\" GROUP BY app.job ORDER BY jobs.job_title";
                $stmt = $this->conn->prepare($this->sql.$sql);
                $stmt->execute([$id]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $this->status = true;
                if(count($res)>0){
                    $ret = $res;
                }else{
                    $ret = false;
                }

            } catch (PDOException $e) {
                $this->status = false;
            }
        }
        return $ret;
    }
    public function getJobs($id){

    }
    public function getAppliedJobs($id){
        $ret = false;
        if (!empty($id) && $id != '') {
            try {
                $sql =" AND app.apply ='1' GROUP BY app.job ORDER BY jobs.job_title";
                $stmt = $this->conn->prepare($this->sql.$sql);
                $stmt->execute([$id]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $this->status = true;
                if(count($res)>0){
                    $ret = $res;
                }else{
                    $ret = false;
                }

            } catch (PDOException $e) {
                $this->status = false;
            }
        }
        return $ret;
    }
}
