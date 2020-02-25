<?php

namespace Drupal\beam_order\Helper;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailerHelper {

  public $fromEmail;
  public $mailer;

  public function __construct() {
    // @TODO
    $host = \Drupal::state()->get('smtp_host', 'smtp.sendgrid.net');
    $port = \Drupal::state()->get('smtp_port', 587);
    $username = 'todo';
    $password = 'todo';

    $transport = (new Swift_SmtpTransport($host, $port))
      ->setUsername($username)
      ->setPassword($password);

    $this->mailer = new Swift_Mailer($transport);

    $system_site_config = \Drupal::config('system.site');
    $this->fromEmail = $system_site_config->get('mail');
  }

  public function setFromEmail($fromEmail) {
    $this->fromEmail = $fromEmail;
  }

  public function createMessage($subject, $to, $body) {
    return (new Swift_Message($subject))
      ->setFrom($this->fromEmail)
      ->setTo($to)
      ->setBody($body, 'text/html');
  }

  public function sendMail($subject, $to, $body) {
    $message = $this->createMessage($subject, $to, $body);
    return $this->send($message);
  }

  public function send(Swift_Message $message) {
    return $this->mailer->send($message);
  }
}
