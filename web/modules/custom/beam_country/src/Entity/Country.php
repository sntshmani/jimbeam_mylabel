<?php

namespace Drupal\beam_country\Entity;

use Drupal\beam_misc\Helper\EntityHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_misc\Helper\TranslateHelper;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Locale\CountryManager;

/**
 * Defines the Country entity.
 *
 * @ingroup beam_country
 *
 * @ContentEntityType(
 *   id = "beam_country",
 *   label = @Translation("Country"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\beam_country\CountryListBuilder",
 *     "views_data" = "Drupal\beam_country\Entity\CountryViewsData",
 *     "form" = {
 *       "default" = "Drupal\beam_country\Form\CountryForm",
 *       "add" = "Drupal\beam_country\Form\CountryForm",
 *       "edit" = "Drupal\beam_country\Form\CountryForm",
 *       "delete" = "Drupal\beam_country\Form\CountryDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\beam_country\CountryHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\beam_country\CountryAccessControlHandler",
 *   },
 *   base_table = "beam_country",
 *   translatable = FALSE,
 *   admin_permission = "administer country entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "code",
 *   },
 *   links = {
 *     "canonical" = "/country/{beam_country}",
 *     "add-form" = "/country/add",
 *     "edit-form" = "/country/{beam_country}/edit",
 *     "delete-form" = "/country/{beam_country}/delete",
 *     "collection" = "/admin/country",
 *   },
 * )
 */
class Country extends ContentEntityBase implements CountryInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['code'] = EntityHelper::createFieldList('Country', TRUE, CountryManager::getStandardList());

    $fields['prohibited'] = EntityHelper::createFieldTextarea('Black list', 'Separated by commas (,)', FALSE);
    $fields['options'] = EntityHelper::createFieldTextarea('Personalized text from the dropdown list', 'key | value', TRUE);

    $bottles = OrderHelper::getBottles();
    foreach ($bottles as $key => $label) $fields[$key] = EntityHelper::createFieldBoolean($label);
    $fields['label_image'] = EntityHelper::createFieldBoolean(t('Enable picture in step 2'));

    $fields['language'] = EntityHelper::createFieldList('Language', TRUE, OrderHelper::getLanguages(), TRUE);
    $fields['default_language'] = EntityHelper::createFieldList('Default Language', TRUE, OrderHelper::getLanguages(), FALSE);

    $fields['enabled'] = EntityHelper::createFieldBoolean(t('Enabled country'));

    return $fields;
  }

  public static function postDelete(EntityStorageInterface $storage, array $entities) {
    parent::postDelete($storage, $entities);
    $bottles = OrderHelper::getBottles();

    foreach ($entities as $entity) {
      $country = $entity->getCode();
      // Also delete country options
      $varOptions = 'co_' . $country . '_options';
      \Drupal::state()->delete($varOptions);
    }
  }

  public function getCode() {
    return $this->get('code')->value;
  }

  public function getCountry() {
    $country = $this->getCode();
    if ($country) {
      $countries = CountryManager::getStandardList();
      $countryName = $countries[$country];
      return $countryName->getUntranslatedString();
    }
    return NULL;
  }

  public function getCountryLanguages() {
    $langValues = $this->get('language')->getValue();
    $languages = OrderHelper::getLanguages();
    $result = [];
    foreach ($langValues as $value) {
      $result[] = TranslateHelper::getUntranslated($languages[$value['value']]);
    }

    return join(', ', $result);
  }

  public function getDefaultLanguage() {
    $lang = $this->get('default_language')->value;
    if ($lang) {
      $languages = OrderHelper::getLanguages();
      return TranslateHelper::getUntranslated($languages[$lang]);
    }
    return NULL;
  }

  public function getCodeLanguages() {
    $langValues = $this->get('language')->getValue();

    return array_column($langValues, 'value');
  }

  public function setCode($code) {
    $this->set('code', $code);
    return $this;
  }

  public function isEnabled() {
    return $this->get('enabled')->value;
  }


  public function getProhibitedWords() {
    return $this->get('prohibited')->value;
  }

  public function getSubheadOptions() {
    return $this->get('options')->value;
  }

  public function isEnabledBottleOption($key) {
    return $this->get($key)->value;
  }

}
