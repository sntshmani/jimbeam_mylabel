<?php

namespace Drupal\beam_order\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Order entities.
 *
 * @ingroup beam_order
 */
interface OrderInterface extends ContentEntityInterface, EntityOwnerInterface {

  public function getBottle();
  public function getBottleKey();
  public function getImagePicture();
  public function getImagePictureLabel();
  public function getImageSubhead();
  public function getImageLabel();
  public function getCodeID();
  public function getCodeLabel();
  public function getCustomerID();
  public function getCustomer();
  public function getCountryID();
  public function getTerms();
  public function getPrivacyPolicy();
  public function getOffersJimbeam();
  public function getOffersBeamSuntory();
  public function getStatus();
  public function getCreatedTime();
  public function getOwnerLabel();
  public function getPdfUrl();

  public function setBottle($bottle);
  public function setImagePicture($imagePicture);
  public function setImageSubhead($imageSubhead);
  public function setImageLabel($imageLabel);
  public function setCouponID($couponID);
  public function setCustomerID($customerID);
  public function setTerms($terms);
  public function setCountryID($countryID);
  public function setPrivacyPolicy($privacyPolicy);
  public function setOffersJimbeam($offersJimbeam);
  public function setOffersBeamsuntory($offersBeamsuntory);
  public function setStatus($status);
  public function setPdfUrl($pdfUrl);
  public function setCreatedTime($timestamp);
}
