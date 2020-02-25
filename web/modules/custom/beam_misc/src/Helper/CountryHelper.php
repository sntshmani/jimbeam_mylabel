<?php

namespace Drupal\beam_misc\Helper;

use Drupal\beam_country\Entity\Country;
use Drupal\Core\Locale\CountryManager;
use Drupal\Core\Url;
use Drupal\language\Entity\ConfigurableLanguage;

class CountryHelper {

  public static function getCountries() {
    $database = \Drupal::database();
    $query =  $database->query('SELECT code FROM {beam_country} ORDER BY code ASC')->fetchCol();
    $countries = CountryManager::getStandardList();
    $result = [];

    foreach ($query as $record) {
      $result[$record] = $countries[$record];
    }

    return $result;
  }

  public static function getCountriesProperties() {
    // Only get enabled countries
    $database = \Drupal::database();
    $query =  $database->query('SELECT code, default_language FROM {beam_country} WHERE enabled = :enabled
        ORDER BY code ASC', [':enabled' => 1])->fetchAll();
    $countries = CountryManager::getStandardList();
    $result = [];

    foreach ($query as $record) {
      $countryName = $countries[$record->code];
      $language = \Drupal::languageManager()->getLanguage($record->default_language);

      $result[] = [
        'code' => $record->code,
        'default_language' => $record->default_language,
        'default_language_name' => TranslateHelper::getUntranslated($language->getName()),
        'name' => $countryName->getUntranslatedString(), // to get in English
      ];
    }

    return $result;
  }

  public static function getCountryIDByCode($code) {
    $database = \Drupal::database();
    return $database->query('SELECT id FROM {beam_country} WHERE code = :code', [':code' => $code])->fetchField();
  }

  public static function getCountryNameByCode($code) {
    $countries = CountryManager::getStandardList();
    return $countries[$code];
  }

  public static function getUntranslatedCountryNameByCode($code) {
    $country = self::getCountryNameByCode($code);
    return TranslateHelper::getUntranslated($country);
  }

  public static function getCountryCodeByID($countryID) {
    $database = \Drupal::database();
    return $database->query('SELECT code FROM {beam_country} WHERE id = :id', [':id' => $countryID])->fetchField();
  }

  public static function getDefaultLanguageByCode($code) {
    $database = \Drupal::database();
    return $database->query('SELECT default_language FROM {beam_country} WHERE code = :code', [':code' => $code])->fetchField();
  }

  public static function getOptionsByCode($code) {
    $database = \Drupal::database();
    $options = $database->query('SELECT options FROM {beam_country} WHERE code = :code', [':code' => $code])->fetchField();

    return MiscHelper::textareaKeysToArray($options);
  }

  public static function getOptionsByCodeArray($code) {
    $options = self::getOptionsByCode($code);

    $result = [];
    foreach ($options as $option) $result[$option['key']] = $option['value'];

    return $result;
  }
  public static function getOptionsByCodeField($code) {
    $options = self::getOptionsByCode($code);

    $result = [];
    foreach ($options as $option) $result[$option['value']] = $option['value'];

    return $result;
  }

  public static function getProhibitedByCode($code) {
    $database = \Drupal::database();
    $words = $database->query('SELECT prohibited FROM {beam_country} WHERE code = :code', [':code' => $code])->fetchField();

    return MiscHelper::textareaToArray($words);
  }

  public static function getEnabledImageLabelByCode($code) {
    $database = \Drupal::database();
    return $database->query('SELECT label_image FROM {beam_country} WHERE code = :code', [':code' => $code])->fetchField();
  }

  public static function fieldReferenceForm(&$form) {
    // Set country value by default
    $country = UserHelper::getCountry();
    $countryCode = $country->getCode();
    $countryID = $country->id();

    $form['country_id']['widget']['#options'] = [$countryID => $countryCode];
    $form['country_id']['widget']['#default_value'] = [$countryID];
  }
}
