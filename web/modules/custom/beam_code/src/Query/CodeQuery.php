<?php

namespace Drupal\beam_code\Query;

use Drupal\beam_misc\Helper\UserHelper;

class CodeQuery {

  public static function header() {
    return [
      'id' => [
        'data' => 'ID',
        'field' => 'id',
        'specifier' => 'id',
      ],
      'label' => [
        'data' => 'Code',
        'field' => 'label',
        'specifier' => 'label',
      ],
      'country' => [
        'data' => 'Country',
        'field' => 'country_id',
        'specifier' => 'country_id',
      ],
      'unlimited' => [
        'data' => 'Unlimited',
        'field' => 'unlimited',
        'specifier' => 'unlimited',
      ],
      'remaining' => [
        'data' => 'Remaining uses',
        'field' => 'remaining',
        'specifier' => 'remaining',
      ],
      'current' => [
        'data' => 'Current uses',
        'field' => 'current',
        'specifier' => 'current',
      ],
      'provider' => [
        'data' => 'Provider',
        'field' => 'provider',
        'specifier' => 'provider',
      ],
    ];

  }

  public static function result($header, $limit) {
    $isCountry = UserHelper::isCountry();
    $country = UserHelper::getCountryID();

    $query = \Drupal::service('entity.query')->get('beam_code');
    if ($isCountry && $country) $query->condition('country_id', $country);

    $query->pager($limit);
    $query->tableSort($header);

    return $query->execute();
  }

  public static function excel() {
    $isCountry = UserHelper::isCountry();
    $country = UserHelper::getCountryID();

    $database = \Drupal::database();
    $query = $database->select('beam_code', 'code');
    $query->fields('code');

    if ($isCountry && $country) $query->condition('code.country_id', $country);
    $query->execute();

    return $query->execute()->fetchAll();
  }
}
