<?php

namespace Drupal\beam_generator\Plugin\Action;

use Drupal\beam_order\Entity\Order;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Action\ActionBase;
use Drupal\Core\Annotation\Action;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Session\AccountInterface;

/**
 * Push term in front.
 *
 * @Action(
 *   id = "beam_order_download",
 *   label = @Translation("Download pdf with labels"),
 *   type = "beam_order"
 * )
 */

class DownloadPdf extends ActionBase {

  /**
   * Checks object access.
   *
   * @param mixed $object
   *   The object to execute the action on.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   (optional) The user for which to check access, or NULL to check access
   *   for the current user. Defaults to NULL.
   * @param bool $return_as_object
   *   (optional) Defaults to FALSE.
   *
   * @return bool|\Drupal\Core\Access\AccessResultInterface
   *   The access result. Returns a boolean if $return_as_object is FALSE (this
   *   is the default) and otherwise an AccessResultInterface object.
   *   When a boolean is returned, the result of AccessInterface::isAllowed() is
   *   returned, i.e. TRUE means access is explicitly allowed, FALSE means
   *   access is either explicitly forbidden or "no opinion".
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    return AccessResult::allowedIfHasPermission($account, 'view order entities');
  }

  /**
   * Executes the plugin.
   * @param Order|null $entity
   */
  public function execute(Order $entity = NULL) {
    $picture = $entity->getImagePicture();
    $subhead = $entity->getImageSubhead();
    $label = $entity->getImageLabel();
    // @TODO Call External url
  }
}
