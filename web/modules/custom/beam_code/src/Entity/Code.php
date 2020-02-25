<?php

namespace Drupal\beam_code\Entity;

use Drupal\beam_country\Entity\Country;
use Drupal\beam_misc\Helper\EntityHelper;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Code entity.
 *
 * @ingroup beam_code
 *
 * @ContentEntityType(
 *   id = "beam_code",
 *   label = @Translation("Code"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\beam_code\CodeListBuilder",
 *     "views_data" = "Drupal\beam_code\Entity\CodeViewsData",
 *     "form" = {
 *       "default" = "Drupal\beam_code\Form\CodeForm",
 *       "add" = "Drupal\beam_code\Form\CodeForm",
 *       "edit" = "Drupal\beam_code\Form\CodeForm",
 *       "delete" = "Drupal\beam_code\Form\CodeDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\beam_code\CodeHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\beam_code\CodeAccessControlHandler",
 *   },
 *   base_table = "beam_code",
 *   translatable = FALSE,
 *   admin_permission = "administer code entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "canonical" = "/code/{beam_code}",
 *     "add-form" = "/code/add",
 *     "edit-form" = "/code/{beam_code}/edit",
 *     "delete-form" = "/code/{beam_code}/delete",
 *     "collection" = "/admin/code",
 *   },
 * )
 */
class Code extends ContentEntityBase implements CodeInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = EntityHelper::createFieldTextfield('Label', TRUE);
    $fields['country_id'] = EntityHelper::createFieldEntityReference('Country', 'beam_country', TRUE);
    $fields['unlimited'] = EntityHelper::createFieldBoolean('Unlimited');
    $fields['remaining'] = EntityHelper::createFieldInteger('Remaining Uses', FALSE);
    $fields['current'] = EntityHelper::createFieldInteger('Current Uses', TRUE);
    $fields['provider'] = EntityHelper::createFieldTextfield('Provider', FALSE);

    return $fields;
  }


  public function getLabel() {
    return $this->get('label')->value;
  }

  public function setLabel($label) {
    $this->set('label', $label);
    return $this;
  }

  public function setCountryId($countryId) {
    $this->set('country_id', $countryId);
    return $this;
  }

  public function setProvider($provider) {
    $this->set('provider', $provider);
  }

  public function getRemaining() {
    return $this->get('remaining')->value ? $this->get('remaining')->value : 0;
  }

  public function getCurrent() {
    return $this->get('current')->value ? $this->get('current')->value : 0;
  }

  public function getUnlimited() {
    return $this->get('unlimited')->value ? $this->get('unlimited')->value : FALSE;
  }

  public function getProvider() {
    return $this->get('provider')->value;
  }

  public function getUnlimitedLabel() {
    return $this->getUnlimited() ? 'TRUE' : 'FALSE';
  }

  public function setUnlimited($unlimited) {
    $this->set('unlimited', $unlimited);
    return $this;
  }

  public function setRemaining($remaining) {
    $this->set('remaining', $remaining);
    return $this;
  }

  public function setCurrent($current) {
    $this->set('current', $current);
    return $this;
  }

  public function getCountryID() {
    return $this->get('country_id')->target_id;
  }

  public function getCountry() {
    $countryId = $this->getCountryID();
    if ($countryId) {
      $country = Country::load($countryId);
      return $country->getCountry();
    }
    return NULL;
  }
}
