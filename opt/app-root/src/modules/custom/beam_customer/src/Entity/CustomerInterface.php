<?php

namespace Drupal\beam_customer\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface for defining Customer entities.
 *
 * @ingroup beam_customer
 */
interface CustomerInterface extends ContentEntityInterface {

  public function getCustomerName();
  public function getName();
  public function getSurname();
  public function getAddress1();
  public function getAddress2();
  public function getAddress3();
  public function getCity();
  public function getPostalCode();
  public function getCountryID();
  public function getEmail();
  public function getPhone();
  public function getPhoneCode();

  public function setName($name);
  public function setSurname($surname);
  public function setAddress1($address1);
  public function setAddress2($address2);
  public function setAddress3($address3);
  public function setCity($city);
  public function setPostalCode($postalCode);
  public function setCountryID($countryID);
  public function setEmail($email);
  public function setPhone($phoneNumber);
  public function setPhoneCode($phoneCode);
}
