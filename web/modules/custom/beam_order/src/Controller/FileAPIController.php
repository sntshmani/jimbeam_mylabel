<?php

namespace Drupal\beam_order\Controller;

use Drupal\beam_misc\Helper\ImageHelper;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for api.
 */
class FileAPIController extends ControllerBase {

  public function form() {
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array($extension, ImageHelper::getValidExtensions())) {
      $fileContents = file_get_contents($_FILES['file']['tmp_name']);
      $fileResult = ImageHelper::saveImage($fileContents, 'public://' . $filename);

      $fileContentsDrawing = ImageHelper::imageToDrawing($fileResult['uri']);
      $fileResultDrawing = ImageHelper::saveImage($fileContentsDrawing, 'public://drawing-' . $filename);

      return new JsonResponse([
        'file' => $fileResultDrawing['id'],
        'file_url' => $fileResultDrawing['url'],
        'message' => t('File saved'),
      ], 200);
    }

    return new JsonResponse([
      'message' => t('An error occurred'),
    ], 400);
  }

  public function draw() {
    $filename = str_replace(' ', '_', $_FILES['file']['name']);  // Replace space with _ to prevent errors
    $tmpName = $_FILES['file']['tmp_name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array($extension, ImageHelper::getValidExtensions())) {
      // Save image to apply image_style in next steps
      $fileContents = file_get_contents($tmpName);
      $fileResult = ImageHelper::saveImage($fileContents, 'public://' . $filename);

      // Apply Imagick
      $fileContentsDrawing = ImageHelper::imageToDrawing($fileResult['uri']);
      $fileResultDrawing = ImageHelper::saveImage($fileContentsDrawing, 'public://drawing-' . $filename);

      return new JsonResponse([
        'file' => $fileResultDrawing['id'],
        'file_url' => $fileResultDrawing['url'],
        'message' => t('File saved'),
      ], 200);
    }
    return new JsonResponse([
      'message' => t('An error occurred'),
    ], 400);
  }
}
