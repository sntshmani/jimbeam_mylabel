<?php

namespace Drupal\beam_misc\Helper;

class CustomerHelper {

  public static function getCustomerNameByID($id) {
    $database = \Drupal::database();
    $result = $database->query('SELECT name, surname FROM {beam_customer} WHERE id = :id', [':id' => $id])->fetchAssoc();

    return join(' ', $result);
  }

  public static function getCustomerFirstNameByID($id) {
    $database = \Drupal::database();
    return $database->query('SELECT name FROM {beam_customer} WHERE id = :id', [':id' => $id])->fetchField(0);
  }

  public static function getPhoneFull($record) {
    return $record->phone_code && $record->phone ?  '(' . $record->phone_code . ') ' . $record->phone : NULL;
  }
}
