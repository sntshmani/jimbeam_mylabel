<?php

namespace Drupal\beam_customer;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Customer entity.
 *
 * @see \Drupal\beam_customer\Entity\Customer.
 */
class CustomerAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\beam_customer\Entity\CustomerInterface $entity */

    switch ($operation) {

      case 'view':

        return AccessResult::allowedIfHasPermission($account, 'view customer entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit customer entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete customer entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add customer entities');
  }


}
