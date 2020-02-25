<?php

namespace Drupal\beam_generator\Controller;

use Drupal\beam_order\Entity\Order;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityStorageException;
use Symfony\Component\HttpFoundation\JsonResponse;

class GeneratorAPIController extends ControllerBase {

  public function generateLabel() {
    // @TODO Not here
  }

  public function printLabel(Order $beam_order) {
    // @TODO get PDF URL
    $values = json_decode(file_get_contents('php://input'), TRUE);
    $pdfUrl = 'https://www.soundczech.cz/temp/lorem-ipsum.pdf'; // $values['pdf_url'];

    try {
      // Update status and set Completed
      $beam_order->setStatus(3);
      $beam_order->setPdfUrl($pdfUrl);
      $beam_order->save();

      return new JsonResponse([
        'result' => true,
      ], 200);
    } catch (EntityStorageException $e) {
      return new JsonResponse([
        'message' => t('An error occurred'),
      ], 400);
    }
  }

  public function downloadLabel() {
    // @TODO Not here
  }
}
