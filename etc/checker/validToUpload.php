<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 2/5/2022
 */

abstract class validToUpload{
    protected $file;
    public $status;
    abstract protected function validToUploadFunc(array $file,$type ='',string $fieldname);
    abstract protected function uploadFunc();
}

class uploadImageFunc extends validToUpload{
    private $fDir = _UPLOAD.'/images';
    private $iFn ='';
    private $fFile= '';

    public function validToUploadFunc(array $file, $type = '', string $fieldname)
    {
        $ret = false;
        // TODO: Implement validToUploadFunc() method.
        if($type!=''){
            $this->file = $file;
            $this->iFn = $fieldname;
            $ret = $this->imageCheck();
        }
        return $ret;
    }

    private function imageCheck(){
        $this->fFile = $this->fDir. basename($this->file[$this->iFn]['name']);
        $this->status = ['fake'=>'','size'=>'','ext'=>''];
        //check image is real or fake
        $this->imageRealorFake();
        //check image size
        $this->imageSize();
        //check image necessary extension
        $this->allowExt();
        return $this->checkStatus();
    }
    private function imageRealorFake(){
        $check = getimagesize($this->file[$this->iFn]["tmp_name"]);
        if(!$check){
            $this->status['fake'] = "File is not an image";
        }
    }

    private function imageSize(){
        if($this->file[$this->iFn]['size'] > 500000){
            $this->status['size'] = "Image is large";
        }
    }

    private function allowExt(){
        $ext = strtolower(pathinfo($this->fFile, PATHINFO_EXTENSION));
        $allowExt = ['jpeg','jpg'];
        if(!in_array($ext,$allowExt) ){
            $this->status['ext'] = "Sorry only " . implode(", ", $allowExt) . " files are allowed.";
        }
    }

    private function checkStatus(){
        $status = true;
        $newStatus =[];
        foreach ($this->status as $key=>$value){
            if($value!=''){
                $newStatus[$key] = $value;
                $status = 'error';
            }
        }
        $this->status = $newStatus;
        return $status;
    }

    protected function uploadFunc(){

    }

}

class uploadResumeFunc extends validToUpload{
    private $fDir = _UPLOAD.'/resumes';
    public function validToUploadFunc(array $file, $type = '', string $fieldname)
    {
        // TODO: Implement validToUploadFunc() method.
        if($type!=''){
            $this->file = $file;
            $ret = $this->resumeCheck();
        }
        return $ret;
    }
    private function resumeCheck(){
        return 123;
    }
    protected function uploadFunc(){

    }

}
