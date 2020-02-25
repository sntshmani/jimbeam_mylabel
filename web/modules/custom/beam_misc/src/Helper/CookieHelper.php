<?php

namespace Drupal\beam_misc\Helper;

use Drupal\beam_country\Entity\Country;

class CookieHelper {

  public static function getCustomerLanguage() {
    $customerCountry = isset($_COOKIE['customer-country']) ? strtolower($_COOKIE['customer-country']) : NULL;
    if ($customerCountry) return CountryHelper::getDefaultLanguageByCode($customerCountry);

    return NULL;
  }

  public static function getCustomerCountry() {
    return isset($_COOKIE['customer-country']) ? $_COOKIE['customer-country'] : NULL;
  }

  public static function setCustomerCountryValues() {
    $countryID = UserHelper::getCountryID();
    $countryCode = CountryHelper::getCountryCodeByID($countryID);
    // By default expire = 0 and path = '/'
    return [
      [
        'name' => 'ageGatePassed',
        'value' => 'true',
      ],
      [
        'name' => 'customer-country',
        'value' => $countryCode,
      ],
    ];
  }

  public static function getCustomerCountryID() {
    $countryCode = self::getCustomerCountry();
    return $countryCode ? CountryHelper::getCountryIDByCode($countryCode) : NULL;
  }

  public static function getCustomerCountryEntity() {
    $countryID = self::getCustomerCountryID();
    return $countryID ? Country::load($countryID) : NULL;
  }

  public static function getDomain() {
    $webDomain =  \Drupal::state()->get('web_domain');
    $webHost = \Drupal::request()->getHost();
    if (strpos($webHost, $webDomain) !== false) { // webDomain inside webHose
      return $webDomain;
    }
    else return $webHost;
  }
}
