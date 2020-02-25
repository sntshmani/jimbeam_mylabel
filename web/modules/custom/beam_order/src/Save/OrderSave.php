<?php

namespace Drupal\beam_order\Save;

use Drupal\beam_code\Entity\Code;
use Drupal\beam_customer\Entity\Customer;
use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\beam_order\Entity\Order;
use Drupal\beam_order\Helper\MailerHelper;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Locale\CountryManager;
use Drupal\file\Entity\File;

class OrderSave {

  public static function preSave(Order $entity) {
    $mailer = new MailerHelper();
    if ($mailer) {  // Do nothing if validation fails
      // @TODO Enable send mail with final template
      $toCustomer = $entity->getCustomerMail();
      // self::mailCustomer($mailer, $toCustomer);

      $countryId = $entity->getCountryID();
      $toAdmin = UserHelper::getAdminCountryMail($countryId);
      // if ($toAdmin) self::mailAdmin($mailer, $toAdmin);
    }
  }

  private static function mailCustomer($mailer, $to) {
    $subject = 'Customer form';
    $body = 'Lorem ipsum customer';
    self::sendMail($mailer, $to, $subject, $body);
  }

  private static function mailAdmin($mailer, $to) {
    $subject = 'Admin form';
    $body = 'Lorem ipsum admin';
    self::sendMail($mailer, $to, $subject, $body);
  }

  private static function sendMail($mailer, $to, $subject, $body) {
    try {
      $mailer->sendMail($subject, $to, $body);
    }
    catch(\Exception $e) {
      // Prevents error
    }
  }

  public static function saveImagePicture(&$values) {
    if ($values['image_picture']) {
      $fid = $values['image_picture'];
      $file = File::load($fid);
      $values['image_picture'] = $file;
    }
    else $values['image_picture'] = NULL;
  }

  public static function saveImageSubhead(&$values) {
    $values['image_subhead'] = $values['image_subhead_value'];
  }

  public static function saveCouponID(&$values) {
    $values['code_id'] = $values['coupon_code'] ? CodeHelper::getId($values['coupon_code'], $values['country_id']) : NULL;
  }

  public static function saveCountryID(&$values) {
    $values['country_id'] = CookieHelper::getCustomerCountryID();
  }

  public static function saveCustomer(&$values) {
    if (!isset($values['coupon_code'])) $values['name'] = 'PRIVATE FORM';
    $customer = Customer::create($values);
    $customer->save();

    $values['customer_id'] = $customer->id();
  }

  public static function updateCouponCode($id) {
    if ($id) {
      $code = Code::load($id);
      $unlimited = $code->getUnlimited();
      if (!$unlimited) {
        // Decrease remaining field
        $remaining = $code->getRemaining();
        $remaining--;
        $code->setRemaining($remaining);
      }
      $current = $code->getCurrent();
      $current++;
      $code->setCurrent($current);

      $code->save();
    }
  }

  private static function getEmailBody(Order $entity) {
    return
      t('Name') . ': ' . $entity->getName() . '<br />' .
      t('Email') . ': ' . $entity->getEmail() . '<br />' .
      t('Telephone') .': ' . $entity->getPhone() . '<br />' .
      t('Surname') .': ' . $entity->getSurname() . '<br />';
  }
}
