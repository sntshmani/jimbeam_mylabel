<?php

namespace Drupal\beam_customer;

use Drupal\beam_customer\Query\CustomerQuery;
use Drupal\beam_misc\Helper\DisplayHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Customer entities.
 *
 * @ingroup beam_customer
 */
class CustomerListBuilder extends EntityListBuilder {

  protected $limit = 50;
  private $isAdmin;
  private $isCountry;

  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage) {
    parent::__construct($entity_type, $storage);
    $this->isAdmin = UserHelper::isAdmin();
    $this->isCountry = UserHelper::isCountry();
  }

  public function load() {
    $result = CustomerQuery::result($this->buildHeader(), $this->limit);

    return $this->storage->loadMultiple($result);
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = CustomerQuery::header();

    if ($this->isAdmin || $this->isCountry) return $header + ['operations' => 'Operations'];
    return $header;
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $isAdmin = UserHelper::isAdmin();

    $row['id'] = Link::createFromRoute(
      $entity->id(),
      'entity.beam_customer.canonical',
      ['beam_customer' => $entity->id()]
    );
    $row['customer'] = $entity->getCustomerName();
    $row['email'] = $entity->getEmail();
    $row['phone'] = $entity->getPhoneFull();
    $row['address1'] = $entity->getAddress1();
    $row['address2'] = $entity->getAddress2();
    $row['address3'] = $entity->getAddress3();
    $row['city'] = $entity->getCity();
    $row['country'] = $entity->getCountry();
    $row['postal_code'] = $entity->getPostalCode();

    if ($this->isAdmin || $this->isCountry) {
      $parent = parent::buildRow($entity);
      DisplayHelper::getUntranslatedOperations($parent);
      return $row + $parent;
    }
    return $row;
  }

}
