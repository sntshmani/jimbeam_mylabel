<?php

namespace Drupal\beam_misc\Helper;

use Drupal\beam_country\Entity\Country;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\File\FileSystemInterface;
use Drupal\file\Entity\File;
use Imagick;

class OrderHelper {

  public static function getBottlesKeys() {
    return ['bottle_70cl', 'bottle_75cl', 'bottle_1l', 'bottle_15l'];
  }

  public static function getBottles() {
    return [
      'bottle_70cl' => t('Bottle 70cl'),
      'bottle_75cl' => t('Bottle 75cl'),
      'bottle_1l' => t('Bottle 1l'),
      'bottle_15l' => t('Bottle 1.5l')
    ];
  }

  public static function getBottlesSize() {
    return [
      'bottle_70cl' => '0.7',
      'bottle_75cl' => '0.75',
      'bottle_1l' => '1',
      'bottle_15l' => '1.5'
    ];
  }

  public static function getStatusList() {
    return [
      0 => t('New'),
      1 => t('Validated'),
      2 => t('PDF generated'),
      3 => t('Downloaded'),
      4 => t('Rejected'),
      5 => t('Error'),
     ];
  }

  public static function getStatusGeneratedPDF() {
    return [2, 3];
  }

  public static function getBottle($key) {
    if ($key) {
      $bottles = self::getBottles();
      return $bottles[$key];
    }
    return NULL;
  }

  public static function getBottleSize($key) {
    $bottles = self::getBottlesSize();
    return $bottles[$key];
  }

  public static function getLabelOptions() {
    return [
      'label_with_image' => t('Label with image'),
      'label_without_image' => t('Label without image'),
    ];
  }

  public static function getEnabledBottles(Country $country) {
    $bottles = OrderHelper::getBottlesProperties();
    $keys = OrderHelper::getBottlesKeys();

    $bottlesResult = [];
    foreach ($keys as $key) {
      $enabled = $country->isEnabledBottleOption($key);
      if ($enabled) $bottlesResult[$key] = $bottles[$key];
    }

    return $bottlesResult;
  }


  public static function getBottlesProperties() {
    return [
      'bottle_70cl' => [
        'title' => t('70 CL BOTTLE'),
        'default' => 'bottle_70clDefault',
        'bottle' => DisplayHelper::imageUri(\Drupal::state()->get('bottle_70cl')),
      ],
      'bottle_75cl' => [
        'title' => t('75 CL BOTTLE'),
        'default' => 'bottle_75clDefault',
        'bottle' => DisplayHelper::imageUri(\Drupal::state()->get('bottle_75cl')),
      ],
      'bottle_1l' => [
        'title' => t('1 L BOTTLE'),
        'default' => 'bottle_1lDefault',
        'bottle' => DisplayHelper::imageUri(\Drupal::state()->get('bottle_1l')),
      ],
      'bottle_15l' => [
        'title' => t('1,5 L BOTTLE'),
        'default' => 'bottle_15lDefault',
        'bottle' => DisplayHelper::imageUri(\Drupal::state()->get('bottle_15l')),
      ],
    ];
  }

  public static function getLanguages() {
    $languages = \Drupal::languageManager()->getLanguages();
    $result = [];

    foreach ($languages as $language) {
      $result[$language->getId()] = $language->getName();
    }

    return $result;
  }

  public static function getSubheadOptions() {
    // @TODO DELETE. Now using options in country entity
    $country = CookieHelper::getCustomerCountry();
    $values = \Drupal::state()->get('co_' . $country . '_options');
    $values = preg_split('/[\r\n]+/', $values, -1, PREG_SPLIT_NO_EMPTY);

    $result = array();
    foreach ($values as $record) {
      list($key, $value) = explode('|', $record);
      $result[] = [
        'key' => $key,
        'value' => $value
      ];
    }
    return $result;
  }

  public static function getFixedImagesBottles() {
    return [
      'image_label' => DisplayHelper::imageDisplay(\Drupal::state()->get('image_label'), 'label'),
      'bottle_step3_front' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_front'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_70cl' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_70cl'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_75cl' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_75cl'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_1l' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_1l'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_15l' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_15l'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_70cl_without_picture' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_70cl_without_picture'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_75cl_without_picture' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_75cl_without_picture'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_1l_without_picture' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_1l_without_picture'), 'bottle_step3'),
      'bottle_step3_lateral_bottle_15l_without_picture' => DisplayHelper::imageDisplay(\Drupal::state()->get('bottle_step3_lateral_bottle_15l_without_picture'), 'bottle_step3'),
    ];
  }

  public static function getStatusLabel($status) {
    $options = self::getStatusList();

    return $options[$status];
  }

  public static function getPhoneCodes() {
    $path = drupal_get_path('module', 'beam_order') . '/resources/phone.json';
    $json = file_get_contents($path);
    return json_decode($json, true);
  }

  public static function getPhoneCodeByCountry($country) {
    $resultJson = self::getPhoneCodes();
    return $resultJson[$country];
  }

  public static function getImagePictureByID($id) {
    if ($id) {
      $file = File::load($id);
      return file_create_url($file->getFileUri());
    }

    return NULL;
  }

  public static function isProhibitedWord($label) {
    // Called in order/label admin form and Bottle form Step 2
    $countryCode = CookieHelper::getCustomerCountry();
    $prohibited = $countryCode ? CountryHelper::getProhibitedByCode($countryCode) : [];

    return MiscHelper::inArrayInsensitive($label, $prohibited);
  }

  public static function isBlankSubhead($subhead, $countryCode) {
    $options = CountryHelper::getOptionsByCodeArray($countryCode);
    $key = array_search($subhead, $options);
    return $key == 'blank';
  }
}
