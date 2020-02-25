<?php

namespace Drupal\beam_order\Serializer;

use Drupal\beam_misc\Helper\MiscHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_order\Entity\Order;

class OrderAPISerializer {

  public static function generatorLabelToArray($entities) {
    $values = [];
    $statusGenerated = OrderHelper::getStatusGeneratedPDF();
    $countriesCyrillic = MiscHelper::getValuesVarsArray('countries_cyrillic');

    foreach ($entities as $entity) {
      if (!in_array($entity->getStatus(), $statusGenerated)) {  // Prevents generate labels if order is Generated PDF or Downloaded
        $countryCode = $entity->getCountryCode();
        $subhead = $entity->getImageSubhead();
        $isBlank = OrderHelper::isBlankSubhead($subhead, $countryCode);
        $values[] =  [
          'id' =>  $entity->id(),
          'picture' => $entity->getImagePicture(),
          'subhead' => $isBlank ? '' : $subhead,
          'label' => $entity->getImageLabel(),
          'bottle' => $entity->getBottleKey(),
          'alphabet' => in_array($countryCode, $countriesCyrillic) ? 'cyrillic' : 'latin'
        ];
      }
    }

    return $values;
  }

  public static function downloadPdfToArray($entities) {
    $values = [];
    $statusGenerated = OrderHelper::getStatusGeneratedPDF();
    foreach ($entities as $entity) {
      if (in_array($entity->getStatus(), $statusGenerated) && $entity->getPdfUrl()) {  // Only generated or downloaded with PDF
        $values[] =  [
          'id' =>  $entity->id(),
          'pdf_url' => $entity->getPdfUrl(),
        ];
      }
    }

    return $values;
  }
}
