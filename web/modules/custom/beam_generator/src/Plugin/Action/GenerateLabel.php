<?php

namespace Drupal\beam_generator\Plugin\Action;

use Drupal\beam_order\Entity\Order;
use Drupal\beam_order\Serializer\OrderAPISerializer;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Action\ActionBase;
use Drupal\Core\Annotation\Action;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Generate label in bottle.
 *
 * @Action(
 *   id = "beam_order_generate_label",
 *   label = @Translation("Generate label in bottle"),
 *   type = "beam_order"
 * )
 */

class GenerateLabel extends ActionBase {

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

  public function execute(Order $entity = NULL) {
    $values = OrderAPISerializer::generatorLabelToArray($entity);

    // @TODO Call External url and update status. Testing with put
    $url = Url::fromRoute('beam_order.order_form', [], ['absolute' => TRUE])->toString();
    // $url = Url::fromRoute('beam_generator.print_label', ['beam_order' => $entity->id()], ['absolute' => TRUE])->toString();

    try {
      $putParams = OrderAPISerializer::printLabelToArray($entity);
      $client = \Drupal::httpClient();
      $response = $client->request('POST', $url, $values);

      $code = $response->getStatusCode();
      if ($code == 200) {
        $body = $response->getBody()->getContents();
        return $body;
      }


      $request = \Drupal::httpClient()->get($url, $values);
      $aa = $request->getStatusCode();
      $body = $request->getBody();
      $response = json_decode($request->getBody());
      //$entity->setStatus(1);
      //$entity->save();
    }
    catch (RequestException $e) {
      return new JsonResponse(array('error' => 'Web connection problems.'), 500);
    }

  }
}
