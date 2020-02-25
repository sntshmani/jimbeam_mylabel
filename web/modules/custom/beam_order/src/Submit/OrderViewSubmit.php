<?php

namespace Drupal\beam_order\Submit;

use Drupal\beam_misc\Helper\MiscHelper;
use Drupal\beam_order\Entity\Order;
use Drupal\beam_order\Serializer\OrderAPISerializer;
use Drupal\beam_pdf\PDFGenerator;
use Drupal\beam_pdf\PDFDownloader;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderViewSubmit {

  public static function generate(array &$form, FormStateInterface $form_state) {
    $entities = self::getEntities($form, $form_state);
    $values = OrderAPISerializer::generatorLabelToArray($entities);
    $pdfGenerator = new PDFGenerator();

    try {
      $result = $pdfGenerator->createPdfs($values);
      self::updateOrders($entities, $result);
      return  [
        'message' => t('Generated labels'),
        'type' => 'status'
      ];
    }
    catch (\Exception $e) {
      self::updateStatus($entities, 5);
      return  [
        'message' => 'An error occurred',
        'type' => 'error'
      ];
    }
  }

  public static function download(array &$form, FormStateInterface $form_state) {
    $entities = self::getEntities($form, $form_state);
    $values = OrderAPISerializer::downloadPdfToArray($entities);
    $pdfDownloader = new PDFDownloader();

    try {
      $result = $values ? $pdfDownloader->merge($values) : [];
      if ($result) self::updateStatus($entities, 3);
      return  [
        'message' => 'Downloaded pdf',
        'type' => 'status'
      ];
    }
    catch (\Exception $e) {
      return  [
        'message' => 'An error occurred',
        'type' => 'error'
      ];
    }
  }

  public static function changeBulkStatus(array &$form, FormStateInterface $form_state, $status) {
    if ($status == 2) self::generate($form, $form_state);
    else {
      $entities = self::getEntities($form, $form_state);
      self::updateStatus($entities, $status);
    }
  }

  private static function getEntities(array &$form, FormStateInterface $form_state) {
    $options = $form['table']['#options'];

    $input = $form_state->getUserInput();
    $values = $input['table'];

    $ids = [];
    foreach ($values as $value) {
      if (!is_null($value)) {
        $ids[] = $options[$value]['id'];
      }
    }

    return Order::loadMultiple($ids);
  }

  private static function updateStatus($entities, $value) {
    foreach ($entities as $entity) {
      $entity->setStatus($value);
      if ($value == 5) {
        $entity->setPdfUrl(null);
        self::deleteFile($entity->id());
      }
      $entity->save();
    }
  }

  private static function deleteFile($id) {
    $filepath = MiscHelper::pathPublicFile('drawing-' . $id . '.pdf');
    if (file_exists($filepath)) \Drupal::service('file_system')->delete($filepath);
  }

  private static function updateOrders($entities, $values) {
    foreach ($entities as $entity) {
      if (isset($values[$entity->id()])) {
        $entity->setStatus($values[$entity->id()]['status']);  // Finished
        $entity->setPdfUrl($values[$entity->id()]['url']);
        $entity->save();
      }
    }
  }
}
