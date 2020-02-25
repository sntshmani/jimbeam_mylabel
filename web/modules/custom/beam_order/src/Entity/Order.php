<?php

namespace Drupal\beam_order\Entity;

use Drupal\beam_code\Entity\Code;
use Drupal\beam_country\Entity\Country;
use Drupal\beam_customer\Entity\Customer;
use Drupal\beam_misc\Helper\EntityHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_order\Save\OrderSave;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Link;
use Drupal\Core\Locale\CountryManager;
use Drupal\Core\Url;
use Drupal\user\UserInterface;

/**
 * Defines the Order entity.
 *
 * @ingroup beam_order
 *
 * @ContentEntityType(
 *   id = "beam_order",
 *   label = @Translation("Order"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\beam_order\Entity\OrderViewsData",
 *     "form" = {
 *       "delete" = "Drupal\beam_order\Form\OrderDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\beam_order\OrderHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\beam_order\OrderAccessControlHandler",
 *   },
 *   base_table = "beam_order",
 *   translatable = FALSE,
 *   admin_permission = "administer order entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/label/{beam_order}",
 *     "delete-form" = "/label/{beam_order}/delete",
 *   },
 *   field_ui_base_route = "beam_order.settings"
 * )
 */
class Order extends ContentEntityBase implements OrderInterface {


  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['bottle'] = EntityHelper::createFieldList('Bottle', FALSE, OrderHelper::getBottles());

    $fields['image_picture'] = EntityHelper::createFieldImage('Image Picture', FALSE);
    $fields['image_subhead'] = EntityHelper::createFieldTextfield('Image Subhead', TRUE);
    $fields['image_label'] = EntityHelper::createFieldTextfield('Image Label', FALSE);

    $fields['pdf_url'] = EntityHelper::createFieldTextfield('PDF Url', FALSE);

    $fields['code_id'] = EntityHelper::createFieldEntityReference('Coupon Code', 'beam_code');
    $fields['country_id'] = EntityHelper::createFieldEntityReference('Country', 'beam_country', TRUE);
    $fields['customer_id'] = EntityHelper::createFieldEntityReference('Customer', 'beam_customer');

    $fields['terms'] = EntityHelper::createFieldBoolean('Terms & Conditions');
    $fields['privacy_policy'] = EntityHelper::createFieldBoolean('Privacy Policy');
    $fields['offers_jimbeam'] = EntityHelper::createFieldBoolean('Offers Jimbeam');
    $fields['offers_beamsuntory'] = EntityHelper::createFieldBoolean('Offers Beam Suntory');

    $fields['uid'] = EntityHelper::createFieldEntityReference('User', 'user');
    $fields['status'] = EntityHelper::createFieldBoolean('Status');

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel('Created')
      ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }

  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    if ($this->isNew()) {
      OrderSave::preSave($this);
    }
  }

  public function getBottle() {
    $bottle = $this->getBottleKey();
    if ($bottle) {
      $bottles = OrderHelper::getBottles();
      return $bottles[$bottle];
    }
    return NULL;
  }

  public function getBottleKey() {
    return $this->get('bottle')->value;
  }

  public function getImagePicture() {
    $fileEntity = $this->get('image_picture')->entity;
    if ($fileEntity) {
      return file_create_url($fileEntity->getFileUri());
    }
    return NULL;
  }

  public function getImagePictureLabel() {
    $fileEntity = $this->get('image_picture')->entity;
    if ($fileEntity) {
      $url = file_create_url($fileEntity->getFileUri());
      $urlObject = Url::fromUri($url, ['attributes' => ['target' => '_blank']]);
      return Link::fromTextAndUrl('View image', $urlObject);
    }
    return NULL;
  }

  public function getImageSubhead() {
    return $this->get('image_subhead')->value;
  }

  public function getImageLabel() {
    return $this->get('image_label')->value;
  }

  public function getCodeID() {
    return $this->get('code_id')->target_id;
  }

  public function getCodeLabel() {
    $id = $this->getCodeID();
    if ($id) {
      $code = Code::load($id);
      return $code->getLabel();
    }
    return NULL;
  }

  public function getCustomerID() {
    return $this->get('customer_id')->target_id;
  }

  public function getCustomer() {
    $customerID = $this->getCustomerID();
    if ($customerID) {
      $customer = Customer::load($customerID);
      return $customer->getCustomerName();
    }
    return NULL;
  }

  public function getCustomerMail() {
    return $this->get('customer_id')->entity->email->value;
  }

  public function getCountryID() {
    return $this->get('country_id')->target_id;
  }

  public function getCountryCode() {
    return $this->get('country_id')->entity->code->value;
  }

  public function getCountry() {
    $id = $this->getCountryID();
    if ($id) {
      $country = Country::load($id);
      return $country->getCountry();
    }
    return NULL;
  }


  public function getTerms() {
    return $this->get('terms')->value ? 'TRUE' : 'FALSE';
  }

  public function getPrivacyPolicy() {
    return $this->get('privacy_policy')->value ? 'TRUE' : 'FALSE';
  }

  public function getOffersJimbeam() {
    return $this->get('offers_jimbeam')->value ? 'TRUE' : 'FALSE';
  }

  public function getOffersBeamSuntory() {
    return $this->get('offers_beamsuntory')->value ? 'TRUE' : 'FALSE';
  }

  public function getStatus() {
    return $this->get('status')->value;
  }

  public function getPdfUrl() {
    return $this->get('pdf_url')->value;
  }

  public function getCreatedTime() {
    $value = $this->get('created')->value;
    return date('m/d/Y H:i:s', $value);
  }

  public function setBottle($bottle)
  {
    $this->set('bottle', $bottle);
    return $this;
  }

  public function setImagePicture($imagePicture) {
    $this->set('image_picture', $imagePicture);
    return $this;
  }

  public function setImageSubhead($imageSubhead) {
    $this->set('image_subhead', $imageSubhead);
    return $this;
  }
  public function setImageLabel($imageLabel) {
    $this->set('image_label', $imageLabel);
    return $this;
  }

  public function setCouponID($codeID) {
    $this->set('code_id', $codeID);
    return $this;
  }

  public function setCustomerID($customerID) {
    $this->set('customer_id', $customerID);
    return $this;
  }

  public function setCountryID($countryID)
  {
    $this->set('country_id', $countryID);
    return $this;
  }

  public function setTerms($terms)
  {
    $this->set('terms', $terms);
    return $this;
  }

  public function setPrivacyPolicy($privacyPolicy)
  {
    $this->set('privacy_policy', $privacyPolicy);
    return $this;
  }

  public function setOffersJimbeam($offersJimbeam)
  {
    $this->set('offers_imbeam', $offersJimbeam);
    return $this;
  }

  public function setOffersBeamsuntory($offersBeamsuntory)
  {
    $this->set('offers_beamsuntory', $offersBeamsuntory);
    return $this;
  }

  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  public function setStatus($status) {
    $this->set('status', $status);
    return $this;
  }

  public function setPdfUrl($pdfUrl) {
    $this->set('pdf_url', $pdfUrl);
    return $this;
  }

  public function getOwner()
  {
    return $this->get('uid')->entity;
  }

  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  public function getOwnerLabel() {
    $owner = $this->getOwner();
    return $owner ? $owner->getUsername() : NULL;
  }

  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }

  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }
}
