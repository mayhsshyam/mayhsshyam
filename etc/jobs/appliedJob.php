<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/10/2022
 */

class appliedJob
{
    private $sql    = "";
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

            $sql = "SELECT app.id as 'appl_id', app.job as 'appl_job_id', app.*, jobs.*, user.*,pu.* FROM " . PREFIX . "tblapplier as app INNER JOIN " . PREFIX . "tbljobs as jobs ON jobs.id = app.job INNER JOIN " . PREFIX . "tblusers as user ON user.id = jobs.user_id INNER JOIN " . PREFIX . "tblprofileuser as pu ON pu.user_id = user.id WHERE app.user_id =? AND user.is_deleted =\"N\" AND app.is_delete =\"N\" GROUP BY app.job ORDER BY jobs.job_title";

            try {
                $stmt = $this->conn->prepare($sql);
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
}
