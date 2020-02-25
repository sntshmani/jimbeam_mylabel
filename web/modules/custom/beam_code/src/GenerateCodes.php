<?php

namespace Drupal\beam_code;

use Drupal\beam_code\Entity\Code;
use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\MiscHelper;

class GenerateCodes {

  public static function generate($countryId, $countryCode, $provider, &$context) {
    $exists = TRUE; // Enter first time
    $label = NULL;

    while ($exists) {
      $label = $countryCode ? $countryCode . MiscHelper::randomAlphanumeric(6) : MiscHelper::randomAlphanumeric(8);
      $exists = CodeHelper::getId($label, $countryId);
    }

    $code = Code::create([
      'label' => $label,
      'country_id' => $countryId,
      'unlimited' => FALSE,
      'remaining' => 1,
      'current' => 0,
      'provider' => $provider,
    ]);
    $code->save();

    $context['results'][] = $code->id();
  }

  public static function generateFinishedCallback($success, $results, $operations) {
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'Generated coupon code.', 'Generated @count coupon codes.'
      );
    }
    else {
      $message = 'Finished with an error.';
    }
    \Drupal::messenger()->addMessage($message);
  }

}
