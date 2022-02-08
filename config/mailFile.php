<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 1/16/2022
 */



namespace config\mailFile;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class mailFile
{
    private   $ownerEmail     = "adesarashyam22112001@gmail.com";
    private   $ownerEmailPass = "shyam22112001mayhs";
    private   $ownerEmailBCC  = "shyamadesara7911@gmail.com";
    private   $filePath       = [];
    protected $mail;
    public    $status;

    public function __construct()
    {
        if (!class_exists('PHPMailer')) {

            $this->mail = new PHPMailer;
        }
    }

    /**
     * @param string $userEmail
     * @param string $subject
     * @param string $content
     * @param bool   $attachment
     * @param bool   $bcc
     *
     * @return bool|string
     * @throws Exception
     */
    private function setupMail(string $userEmail, string $subject, string $content, bool $attachment = false, bool $bcc = false)
    {
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $this->ownerEmail;
        $this->mail->Password   = $this->ownerEmailPass;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;
        // Sender info
        $this->mail->setFrom($this->ownerEmail, 'LOOKOUT');
        // Add a recipient
        $this->mail->addAddress($userEmail);
        $this->mail->isHTML(true);
        if ($bcc) {
            $this->mail->addBCC($this->ownerEmailBCC);

        }
        if ($attachment) {
            if (is_array($this->filePath) && (count($this->filePath) > 0)) {
                foreach ($this->filePath as $file) {
                    $this->mail->addAttachment($file);
                }
            }
        }
        $this->mail->Subject = $subject;
        $this->mail->Body    = $content;
        // Send email
        if (!$this->mail->send()) {
            $this->status = '<b>Message could not be sent. Mailer Error:</b> ' . $this->mail->ErrorInfo;
        } else {
            $this->status = true;
        }
        return $this->status;
    }

    /**
     * @param string $userEmail
     * @param string $subject
     * @param string $content
     *
     * @return bool|string
     * @throws Exception
     */
        public function sendMail(string $userEmail, string $subject, string $content)
    {
        $ret = $this->setupMail($userEmail, $subject, $content);
        return $ret;
    }

    /**
     * @param string $userEmail
     * @param string $subject
     * @param string $content
     * @param bool   $attachment
     * @param array  $filesPath
     * @param bool   $bcc
     *
     * @return bool|string
     * @throws Exception
     */
    public function sendMailWithAttachment(string $userEmail, string $subject, string $content, bool $attachment = false, array $filesPath, bool $bcc = false)
    {
        if ((is_array($filesPath) && count($filesPath) > 0) && $attachment) {
            foreach ($filesPath as $filePath) {
                $this->filePath [] = _UPLOAD . $filePath;
            }
            $ret = $this->setupMail($userEmail, $subject, $content, $attachment, $bcc);
        } else {
            $ret = 'Files are not correct';
        }
        return $ret;
    }

    public function getStatus(){
        return $this->status;
    }

}
