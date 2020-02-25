<?php

namespace Drupal\beam_order\Controller;

use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for api.
 */
class ProhibitedAPIController extends ControllerBase {

  public function form() {
    $label = isset($_GET['label']) ? $_GET['label'] : NULL;

    try {
      $exists = OrderHelper::isProhibitedWord($label);
      return new JsonResponse([
        'result' => $exists,
      ], 200);
    } catch (\Exception $e) {
      return new JsonResponse([
        'result' => false
      ], 400);
    }
  }
}
