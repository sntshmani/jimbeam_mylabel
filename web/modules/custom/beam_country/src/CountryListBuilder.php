<?php

namespace Drupal\beam_country;

use Drupal\beam_misc\Helper\DisplayHelper;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Country entities.
 *
 * @ingroup beam_country
 */
class CountryListBuilder extends EntityListBuilder {

  protected $limit = 50;

  public function load() {
    $query = \Drupal::service('entity.query')->get('beam_country');
    $header = $this->buildHeader();

    $query->pager($this->limit);
    $query->tableSort($header);

    $result = $query->execute();

    return $this->storage->loadMultiple($result);
  }

  public function buildHeader() {
    return [
      'code' => [
        'data'=> 'Country Code',
        'field' => 'code',
        'specifier' => 'code',
      ],
      'name' => 'Country Name',
      'languages' => 'Languages',
      'default_language' => 'Default language',
      'operations' => 'Operations'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] =  $entity->getCode();
    $row['name'] = $entity->getCountry();
    $row['languages'] = $entity->getCountryLanguages();
    $row['default_language'] = $entity->getDefaultLanguage();

    $parent = parent::buildRow($entity);
    DisplayHelper::getUntranslatedOperations($parent);
    return $row + $parent;
  }
}
