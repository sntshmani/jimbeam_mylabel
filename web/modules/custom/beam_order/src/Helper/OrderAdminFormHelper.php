<?php

namespace Drupal\beam_order\Helper;

use Drupal\beam_country\Entity\Country;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\ImageHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\file\Entity\File;

class OrderAdminFormHelper {

  public static function getCountry() {
    $countryID = UserHelper::getCountryID();
    $country = Country::load($countryID);
    return $country->getCode();
  }

  public static function getCountryEntity() {
    $countryID = UserHelper::getCountryID();
    return Country::load($countryID);
  }

  public static function getIDCountry() {
    return UserHelper::getCountryID();
  }

  public static function getBottles($country) {
    $bottles = OrderHelper::getEnabledBottles($country);

    $result = [];
    foreach ($bottles as $key => $bottle) {
      $result[$key] = $bottle['title'];
    }

    return $result;
  }

  public static function getPhoneCode($country) {
    $phoneCodes = OrderHelper::getPhoneCodes();
    return $country ? $phoneCodes[$country] : NULL;
  }

  public static function getImageID($form_state, $country) {
    $showPicture = CountryHelper::getEnabledImageLabelByCode($country);
    $imagickID = NULL;
    if ($showPicture) {
      $fileID = $form_state->getValue('picture');
      $file = File::load($fileID[0]);
      $uri = $file->getFileUri();
      $imagickContents = ImageHelper::imageToDrawing($uri);
      $imagickFile = ImageHelper::saveImage($imagickContents, 'public://' . $file->label());
      $imagickID = $imagickFile['id'];
    }

    return $imagickID;
  }
}
