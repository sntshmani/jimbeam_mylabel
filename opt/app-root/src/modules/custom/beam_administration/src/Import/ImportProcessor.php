<?php

namespace Drupal\beam_administration\Import;

use Drupal\beam_code\Entity\Code;
use Drupal\beam_misc\Helper\CountryHelper;

class ImportProcessor {

  public function run($formValues, $filename) {
    $excel = new Reader($filename);
    $excelValues = $excel->getData();

    $operations = [];
    foreach ($excelValues as $values) {
      $operations[] = ['\Drupal\beam_administration\Import\ImportProcessor::runCallback', [$values, $formValues]];
    }
    $batch = [
      'operations' => $operations,
      'finished' => ['\Drupal\beam_administration\Import\ImportProcessor::runCallbackFinished']
    ];
    batch_set($batch);
  }

  public static function runCallback($values, $formValues, &$context) {
    $code = Code::create([
      'label' => $values[0],
      'country_id' => CountryHelper::getCountryIDByCode($formValues['country']),
      'unlimited' => $formValues['unlimited'],
      'remaining' => $formValues['remaining'],
      'current' => 0,
      'provider' => $formValues['provider'],
    ]);
    $code->save();

    $context['results'][] = $code->id();
  }


  public static function runCallbackFinished($success, $results, $operations) {
    if ($success) $message = t('Successful import!');
    else $message = t('An error occurred');
    \Drupal::messenger()->addMessage($message);
  }
}
