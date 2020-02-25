<?php

namespace Drupal\beam_customer\Entity;

use Drupal\beam_country\Entity\Country;
use Drupal\beam_misc\Helper\EntityHelper;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Customer entity.
 *
 * @ingroup beam_customer
 *
 * @ContentEntityType(
 *   id = "beam_customer",
 *   label = @Translation("Customer"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\beam_customer\CustomerListBuilder",
 *     "views_data" = "Drupal\beam_customer\Entity\CustomerViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\beam_customer\Form\CustomerForm",
 *       "edit" = "Drupal\beam_customer\Form\CustomerForm",
 *       "delete" = "Drupal\beam_customer\Form\CustomerDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\beam_customer\CustomerHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\beam_customer\CustomerAccessControlHandler",
 *   },
 *   base_table = "beam_customer",
 *   translatable = FALSE,
 *   admin_permission = "administer customer entities",
 *   entity_keys = {
 *     "id" = "id",
 *   },
 *   links = {
 *     "canonical" = "/customer/{beam_customer}",
 *     "edit-form" = "/customer/{beam_customer}/edit",
 *     "delete-form" = "/customer/{beam_customer}/delete",
 *     "collection" = "/admin/customer",
 *   },
 *   field_ui_base_route = "beam_customer.settings"
 * )
 */
class Customer extends ContentEntityBase implements CustomerInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = EntityHelper::createFieldTextfield('Name', FALSE);
    $fields['surname'] = EntityHelper::createFieldTextfield('Surname', FALSE);

    $fields['email'] = EntityHelper::createFieldEmail('E-mail', TRUE);
    $fields['phone_code'] = EntityHelper::createFieldTextfield('Phone Code', FALSE);
    $fields['phone'] = EntityHelper::createFieldTextfield('Phone Number', FALSE);

    $fields['address1'] = EntityHelper::createFieldTextfield('Address Line 1', FALSE);
    $fields['address2'] = EntityHelper::createFieldTextfield('Address Line 2', FALSE);
    $fields['address3'] = EntityHelper::createFieldTextfield('Address Line 3', FALSE);

    $fields['city'] = EntityHelper::createFieldTextfield('Town / City', FALSE);
    $fields['postal_code'] = EntityHelper::createFieldTextfield('Postal Code', FALSE);

    $fields['country_id'] = EntityHelper::createFieldEntityReference('Country', 'beam_country', TRUE);

    return $fields;
  }

  public function getCustomerName() {
    $result = [
      $this->getName(),
      $this->getSurname()
    ];
    return join(' ', $result);
  }

  public function getName() {
    return $this->get('name')->value;
  }

  public function getSurname() {
    return $this->get('surname')->value;
  }

  public function getAddress1() {
    return $this->get('address1')->value;
  }

  public function getAddress2() {
    return $this->get('address2')->value;
  }

  public function getAddress3() {
    return $this->get('address3')->value;
  }

  public function getCity() {
    return $this->get('city')->value;
  }

  public function getCountryID() {
    return $this->get('country_id')->target_id;
  }

  public function getCountry() {
    $id = $this->getCountryID();
    if ($id) {
      $country = Country::load($id);
      return $country->getCountry();
    }
    return NULL;
  }

  public function getPostalCode() {
    return $this->get('postal_code')->value;
  }

  public function getEmail() {
    return $this->get('email')->value;
  }

  public function getPhoneFull() {
    if ($this->getPhoneCode() && $this->getPhone()) return '(' . $this->getPhoneCode() . ') ' . $this->getPhone();
    return NULL;
  }

  public function getPhone() {
    return $this->get('phone')->value;
  }

  public function getPhoneCode() {
    return $this->get('phone_code')->value;
  }


  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  public function setSurname($surname) {
    $this->set('surname', $surname);
    return $this;
  }

  public function setAddress1($address1) {
    $this->set('address1', $address1);
    return $this;
  }

  public function setAddress2($address2) {
    $this->set('address2', $address2);
    return $this;
  }

  public function setAddress3($address3) {
    $this->set('address3', $address3);
    return $this;
  }

  public function setCity($city) {
    $this->set('city', $city);
    return $this;
  }

  public function setPostalCode($postalCode) {
    $this->set('postal_code', $postalCode);
    return $this;
  }

  public function setCountryID($countryID) {
    $this->set('country_id', $countryID);
    return $this;
  }

  public function setEmail($email)
  {
    $this->set('email', $email);
    return $this;
  }

  public function setPhone($phone) {
    $this->set('phone', $phone);
    return $this;
  }

  public function setPhoneCode($phoneCode) {
    $this->set('phone_code', $phoneCode);
    return $this;
  }
}
