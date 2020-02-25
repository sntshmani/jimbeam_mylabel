<?php

namespace Drupal\beam_code\Controller;

use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityStorageException;
use Symfony\Component\HttpFoundation\JsonResponse;

class CodeAPIController extends ControllerBase {

  public function validate() {
    $label = isset($_GET['coupon_code']) ? $_GET['coupon_code'] : NULL;

    $availableCoupon = CodeHelper::availableCoupon($label);

    try {
      return new JsonResponse([
        'result' => $availableCoupon,
      ], 200);
    } catch (EntityStorageException $e) {
      return new JsonResponse([
        'message' => t('An error occurred'),
      ], 400);
    }
  }
}
