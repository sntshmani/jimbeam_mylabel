<?php

namespace Drupal\beam_order\Query;

use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CustomerHelper;
use Drupal\beam_misc\Helper\DisplayHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\Core\Link;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;

class OrderFieldsQuery {

  public static function code($codeId) {
    return $codeId ? CodeHelper::getLabelByID($codeId) : '';
  }

  public static function imagePicture($pictureId, $display) {
    if ($display == 'view') {
      $imagePicture = $pictureId ? DisplayHelper::imageDisplay($pictureId, 'order_list') : NULL;
      return $imagePicture ? Markup::create('<img src="' . $imagePicture . '">') : '';
    }
    else {
      $imagePicture = OrderHelper::getImagePictureByID($pictureId);
      return $imagePicture ? $imagePicture : '';
    }
  }

  public static function pdfUrl($pdfUrl, $status, $display) {
    $statusGenerated = OrderHelper::getStatusGeneratedPDF();

    if (in_array($status, $statusGenerated)) { // Only visible with generated and downloaded
      if ($display == 'view') {
        if ($pdfUrl) {
          $url = file_create_url($pdfUrl);
          return Link::fromTextAndUrl('Download PDF', Url::fromUri($url, ['attributes' => ['target' => '_blank']]));
        }
        return '';
      }
      else return $pdfUrl ? $pdfUrl : '';
    }
    return '';
  }

  public static function customer($customerId, $display) {
    $customerName = $customerId ? CustomerHelper::getCustomerNameByID($customerId) : '';
    if ($display == 'view') {
      if ($customerId && $customerName) return Link::fromTextAndUrl($customerName, Url::fromRoute('entity.beam_customer.canonical', ['beam_customer' => $customerId]));
      return '';
    }
    else return $customerName;
  }

  public static function customerFirstName($customerId, $display) {
    $customerName = $customerId ? CustomerHelper::getCustomerFirstNameByID($customerId) : '';
    if ($display == 'view') {
      if ($customerId && $customerName) return Link::fromTextAndUrl($customerName, Url::fromRoute('entity.beam_customer.canonical', ['beam_customer' => $customerId]));
      return '';
    }
    else return $customerName;
  }

  public static function subheadExcel($subhead, $countryCode) {
    if ($countryCode) {
      $isBlank = OrderHelper::isBlankSubhead($subhead, $countryCode);
      return $isBlank ? '' : $subhead;
    }
    return $subhead;
  }
}
