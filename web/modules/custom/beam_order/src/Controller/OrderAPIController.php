<?php

namespace Drupal\beam_order\Controller;

use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\DisplayHelper;
use Drupal\beam_order\Entity\Order;
use Drupal\beam_order\Save\OrderSave;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityStorageException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Url;

/**
 * Controller routines for api.
 */
class OrderAPIController extends ControllerBase {

  public function form() {
    $values = json_decode(file_get_contents('php://input'), TRUE);

    OrderSave::saveCountryID($values);
    OrderSave::saveImagePicture($values);
    OrderSave::saveImageSubhead($values);
    if (isset($values['coupon_code'])) OrderSave::saveCouponID($values);
    OrderSave::saveCustomer($values);

    $entity = Order::create($values);

    // Set attributes programatically
    $current = \Drupal::currentUser();
    if ($current->id()) $entity->setOwnerId($current->id());
    $entity->setStatus(0);

    try {
      if (isset($values['coupon_code'])) OrderSave::updateCouponCode($values['code_id']);
      $entity->save();
      return new JsonResponse([
        'url' => Url::fromRoute('entity.node.canonical', ['node' => 2])->toString(),
        'message' => t('Form sent'),
      ], 200);
    } catch (EntityStorageException $e) {
      return new JsonResponse([
        'message' => t('An error occurred'),
      ], 400);
    }
  }

  public function labelImage() {
    $bottle = isset($_GET['bottle']) ? $_GET['bottle'] : NULL;
    $countryCode = CookieHelper::getCustomerCountry();
    $showPictureLabel = $countryCode ? CountryHelper::getEnabledImageLabelByCode($countryCode) : false;

    $key = $showPictureLabel ? 'label_with_image' : 'label_without_image';
    $keyLabel = $bottle . '_' . $key;

    try {
      return new JsonResponse([
        'result' => [
          'desktop' => DisplayHelper::imageDisplay(\Drupal::state()->get($keyLabel), 'label'),
          'responsive' => DisplayHelper::imageDisplay(\Drupal::state()->get($keyLabel), 'label_responsive'),
          'responsive_half' => DisplayHelper::imageDisplay(\Drupal::state()->get($keyLabel), 'label_responsive_half'),
        ],
      ], 200);
    } catch (EntityStorageException $e) {
      return new JsonResponse([
        'message' => t('An error occurred'),
      ], 400);
    }
  }
}
