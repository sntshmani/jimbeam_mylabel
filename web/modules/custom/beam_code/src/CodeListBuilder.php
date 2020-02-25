<?php

namespace Drupal\beam_code;

use Drupal\beam_code\Query\CodeQuery;
use Drupal\beam_misc\Helper\DisplayHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Coupon entities.
 *
 * @ingroup beam_code
 */
class CodeListBuilder extends EntityListBuilder {

  protected $limit = 50;

  public function load() {
    $result = CodeQuery::result($this->buildHeader(), $this->limit);

    return $this->storage->loadMultiple($result);
  }

  public function buildHeader() {
    $isAdmin = UserHelper::isAdmin();

    $header = CodeQuery::header();

    if ($isAdmin) return $header + ['operations' => 'Operations'];
    return $header;
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $isAdmin = UserHelper::isAdmin();

    $row['id'] = $entity->id();
    $row['label'] = $entity->getLabel();
    $row['country'] = $entity->getCountry();
    $row['unlimited'] = $entity->getUnlimitedLabel();
    $row['remaining'] = $entity->getUnlimited() ? t('Unlimited') : $entity->getRemaining();
    $row['current'] = $entity->getCurrent();
    $row['provider'] = $entity->getProvider();

    if ($isAdmin) {
      $parent = parent::buildRow($entity);
      DisplayHelper::getUntranslatedOperations($parent);
      return $row + $parent;
    }
    return $row;
  }

}
