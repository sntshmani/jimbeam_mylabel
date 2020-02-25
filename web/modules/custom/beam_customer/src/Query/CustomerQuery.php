<?php

namespace Drupal\beam_customer\Query;

use Drupal\beam_misc\Helper\UserHelper;

class CustomerQuery {

  public static function header() {
    return [
      'id' => [
        'data'=> 'ID',
        'field' => 'id',
        'specifier' => 'id',
        'sort' => 'DESC'
      ],
      'customer' => [
        'data' => 'Customer Name',
        'field' => ['name'],
        'specifier' => 'name',
      ],
      'email' => [
        'data' => 'Email',
        'field' => 'email',
        'specifier' => 'email',
      ],
      'phone' => [
        'data' => 'Phone'
      ],
      'address1' => [
        'data' => 'Address 1',
        'field' => 'address1',
        'specifier' => 'address1',
      ],
      'address2' => [
        'data' => 'Address 2',
        'field' => 'address2',
        'specifier' => 'address2',
      ],
      'address3' => [
        'data' => 'Address 3',
        'field' => 'address3',
        'specifier' => 'address3',
      ],
      'city' => [
        'data' => 'City',
        'field' => 'city',
        'specifier' => 'city',
      ],
      'country' => [
        'data' => 'Country',
        'field' => 'country_id',
        'specifier' => 'country_id',
      ],
      'postal_code' => [
        'data' => 'Postal Code',
        'field' => 'postal_code',
        'specifier' => 'postal_code',
      ],
    ];
  }

  public static function result($header, $limit) {
    $isCountry = UserHelper::isCountry();
    $country = UserHelper::getCountryID();

    $query = \Drupal::service('entity.query')->get('beam_customer');
    if ($isCountry && $country) $query->condition('country_id', $country);

    $query->pager($limit);
    $query->tableSort($header);

    return $query->execute();
  }

  public static function excel() {
    $isCountry = UserHelper::isCountry();
    $country = UserHelper::getCountryID();

    $database = \Drupal::database();
    $query = $database->select('beam_customer', 'customer');
    $query->fields('customer');

    if ($isCountry && $country) $query->condition('customer.country_id', $country);
    $query->execute();

    return $query->execute()->fetchAll();
  }
}
