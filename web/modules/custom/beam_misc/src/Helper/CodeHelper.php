<?php

namespace Drupal\beam_misc\Helper;

use \Drupal\Core\Database\Query\Condition;

class CodeHelper {

  public static function getCountId() {
    $database = \Drupal::database();
    return $database->query('SELECT COUNT(id) FROM {beam_code}')->fetchField();
  }

  public static function availableCoupon($label, $country = NULL) {
    // Called in Code Validation API (without country as param) and Label Admin Form (with country)
    if (!$country) $country = CookieHelper::getCustomerCountry();
    $database = \Drupal::database();
    $query = $database->select('beam_code', 'code');
    $query->join('beam_country', 'country', 'code.country_id = country.id');
    $query->fields('code')
      ->condition('code.label', $label)
      ->condition('country.code', $country)
      ->range(0, 1)
      ->execute();

    $result = $query->execute()->fetchAssoc();

    if ($result) {
      $unlimited = $result['unlimited'] ? $result['unlimited'] : FALSE;
      $remaining = $result['remaining'] ? $result['remaining'] : 0;

      return $unlimited || $remaining > 0;
    }

    return FALSE;
  }

  public static function getId($label, $countryId) {
    $database = \Drupal::database();
    return $database->query('SELECT id FROM {beam_code} WHERE label = :label AND country_id = :country_id', [':label' => $label, ':country_id' => $countryId])->fetchField();
  }

  public static function getLabelByID($id) {
    $database = \Drupal::database();
    return $database->query('SELECT label FROM {beam_code} WHERE id = :id', [':id' => $id])->fetchField();
  }

  public static function getBooleanValue($value) {
    return $value ? 'TRUE' : 'FALSE';
  }

  public static function getAvailablesCoupons() {
    // Called in label admin form
    $countryCode = UserHelper::getCountryCode();

    $database = \Drupal::database();
    $query = $database->select('beam_code', 'code');
    $query->join('beam_country', 'country', 'code.country_id = country.id');
    $query->addField('code', 'id', 'id');
    $query->addField('code', 'label', 'label');
    $query->condition('country.code', $countryCode);
    $or = new Condition('OR');
    $or->condition('code.unlimited', 1)
      ->condition('code.remaining', 0, '>');
    $query->condition($or)
      ->execute();

    $result = $query->execute()->fetchAll();
    $codes = [];
    foreach ($result as $record) $codes[$record->id] = $record->label;

    return $codes;
  }
}
