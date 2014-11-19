<?php

namespace Bo\AnnonceBundle\Mailer;

use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;

class Contact {

    private $mailer;
    private $subject;
    private $emailFrom;
    private $emailTo;
    private $message;
    private $fileAttachements = [];

    public function __construct(Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }

    public function prepareMail($mailer, $subject, $emailFrom, $emailTo, $message) {
        $this->setMailer($mailer);
        $this->setSubject($subject);
        $this->setEmailFrom($emailFrom);
        $this->setEmailTo($emailTo);
        $this->setMessage($message);
    }

    public function send() {
        $m = Swift_Message::newInstance();

        foreach ($this->getFileAttachements() as $path => $filename) {
            $m->attach(Swift_Attachment::fromPath($path)->setFilename($filename));
        }
        $m->setSubject($this->getSubject())
          ->setFrom($this->getEmailFrom())
          ->setTo($this->getEmailTo())
          ->setBody($this->getMessage());
        
        $this->getMailer()->send($m);
        return TRUE;
    }

    public function getMailer() {
        return $this->mailer;
    }

    public function setMailer($mailer) {
        $this->mailer = $mailer;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function getEmailFrom() {
        return $this->emailFrom;
    }

    public function setEmailFrom($emailFrom) {
        $this->emailFrom = $emailFrom;
    }

    public function getEmailTo() {
        return $this->emailTo;
    }

    public function setEmailTo($emailTo) {
        $this->emailTo = $emailTo;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getFileAttachements() {
        return $this->fileAttachements;
    }

    public function setFileAttachement($path, $filename) {
        
        $this->fileAttachements[$path] = $filename;
    }

}
