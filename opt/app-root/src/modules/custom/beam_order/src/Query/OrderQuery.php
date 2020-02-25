<?php

namespace Drupal\beam_order\Query;

use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\beam_order\Helper\OrderQueryHelper;

class OrderQuery {

  public static function excel($ids = []) {
    return self::query('excel', $ids);
  }

  public static function view() {
    $result = self::query('view');
    $countries = CountryHelper::getCountries();
    $view = [];

    foreach ($result as $record) {
      $view[$record->id] = OrderQueryHelper::recordQueryToArray($record, $countries, 'view');
    }

    return $view;
  }

  private static function query($display, $ids = []) {
    $isCountry = UserHelper::isCountry();
    $country = UserHelper::getCountryID();

    $database = \Drupal::database();
    $query = $database->select('beam_order', 'beam_order');
    if (!empty($ids)) {
      $query->condition('beam_order.id', $ids, 'IN');
    }
    $query->leftJoin('beam_code', 'code', 'beam_order.code_id = code.id');
    $query->leftJoin('beam_customer', 'customer', 'beam_order.customer_id = customer.id');
    $query->leftJoin('beam_country', 'country', 'beam_order.country_id = country.id');
    $query->leftJoin('comment_entity_statistics', 'cs', 'beam_order.id = cs.entity_id');
    $query->fields('beam_order');

    $query->addField('customer', 'id', 'customer_id');
    $query->addField('customer', 'email', 'email');
    $query->addField('customer', 'address1', 'address1');
    $query->addField('customer', 'address2', 'address2');
    $query->addField('customer', 'address3', 'address3');
    $query->addField('customer', 'postal_code', 'postal_code');
    $query->addField('customer', 'city', 'city');
    $query->addField('customer', 'phone', 'phone');
    $query->addField('customer', 'phone_code', 'phone_code');

    $query->addField('cs', 'comment_count', 'comment_count');

    if ($display == 'view') self::filterCondition($query, $_GET);

    if ($isCountry && $country) $query->condition('beam_order.country_id', $country);

    self::orderBy($query, $display);
    if ($display == 'view') {
      $num_elements = !empty($_GET['elements_per_page']) ? $_GET['elements_per_page'] : 20;
      $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit($num_elements);
      return $pager->execute()->fetchAll();
    }
    else return $query->execute()->fetchAll();
  }

  private static function filterCondition(&$query, $get) {
    if (isset($get['status'])) $query->condition('beam_order.status', $get['status']);
  }

  private static function orderBy(&$query, $display) {
    if ($display == 'excel') $query->orderBy('beam_order.id', 'ASC');
    else {
      if (isset($_GET['order'])) {
        $orderAlias = self::orderAlias($_GET['order']);
        $query->orderBy($orderAlias, $_GET['sort']);
      }
      else {
        $query->orderBy('beam_order.id', 'DESC');
      }
    }
  }

  private static function orderAlias($order) {
    if ($order == 'ID') return 'beam_order.id';
    elseif ($order == 'Customer Code') return 'code.label';
    elseif ($order == 'Subhead') return 'beam_order.image_subhead';
    elseif ($order == 'Label') return 'beam_order.image_label';
    elseif ($order == 'Customer Name') return 'customer.name';
    elseif ($order == 'Email') return 'customer.email';
    elseif ($order == 'Address 1') return 'customer.address1';
    elseif ($order == 'Address 2') return 'customer.address2';
    elseif ($order == 'Address 3') return 'customer.address3';
    elseif ($order == 'City') return 'customer.city';
    elseif ($order == 'Postal Code') return 'customer.postal_code';
    elseif ($order == 'Country') return 'country.code';
    elseif ($order == 'Terms & Conditions') return 'beam_order.terms';
    elseif ($order == 'Privacy Policy') return 'beam_order.privacy_policy';
    elseif ($order == 'Offers Jimbeam') return 'beam_order.offers_jimbeam';
    elseif ($order == 'Offers Beam Suntory') return 'beam_order.offers_beamsuntory';
    elseif ($order == 'Status') return 'beam_order.status';
    elseif ($order == 'Created') return 'beam_order.created';

    return 'beam_order.id'; // Default
  }
}
