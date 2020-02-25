<?php


namespace Drupal\beam_misc\Helper;


use Drupal\user\Entity\User;

class UserHelper {

  public static function isAdmin() {
    $roles = \Drupal::currentUser()->getRoles();
    return in_array('administrator', $roles);
  }

  public static function isCountry() {
    $roles = \Drupal::currentUser()->getRoles();
    $exists = array_intersect(['admin_country', 'country'], $roles); // Returns array if exists, else empty array

    return $exists ? true : false;
  }

  public static function getUser() {
    return User::load(\Drupal::currentUser()->id());
  }

  public static function getCountry() {
    $user = self::getUser();
    return $user->field_country->entity;
  }

  public static function getCountryID() {
    $user = self::getUser();
    return $user->field_country->target_id;
  }

  public static function getCountryCode() {
    $user = self::getUser();
    return $user->field_country->entity->code->value;
  }

  public static function getNameByID($uid) {
    $database = \Drupal::database();
    return $database->query('SELECT name FROM {users_field_data} WHERE uid = :uid', [':uid' => $uid])->fetchField();
  }

  public static function getAdminCountryMail($countryId) {
    $database = \Drupal::database();
    $query = $database->select('users_field_data', 'ufd');
    $query->join('user__field_country', 'ufc', 'ufd.uid = ufc.entity_id');
    $query->join('user__roles', 'ur', 'ufd.uid = ur.entity_id');
    $query->fields('ufd', ['mail'])
      ->condition('ufc.field_country_target_id', $countryId)
      ->condition('ur.roles_target_id', 'admin_country')
      ->execute();

    return $query->execute()->fetchField();
  }
}
