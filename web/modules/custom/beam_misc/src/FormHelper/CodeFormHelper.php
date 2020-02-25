<?php

namespace Drupal\beam_misc\FormHelper;

use Drupal\beam_misc\Helper\UserHelper;
use Drupal\Core\Form\FormStateInterface;

class CodeFormHelper {

  public static function buildForm(&$form) {

    $form['count_coupon'] = [
      '#type' => 'textfield',
      '#attributes' => [
        ' type' => 'number',
      ],
      '#title' => 'How many codes?',
      '#required' => true,
    ];
    $form['provider'] = [
      '#type' => 'textfield',
      '#title' => 'Provider',
      '#required' => false,
    ];

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => 'Generate codes',
    ];
  }

  public static function submitForm(FormStateInterface $form_state) {
    $count = $form_state->getValue('count_coupon');
    $provider = $form_state->getValue('provider');

    $country = UserHelper::getCountry();
    $countryId = $country->id();
    $countryCode = $country->getCode();

    $batch = [
      'title' => 'Generating codes...',
      'operations' => [],
      'init_message' => 'Initizialing...',
      'progress_message' => 'Generated @current codes out of @total.',
      'finished' => '\Drupal\beam_code\GenerateCodes::generateFinishedCallback'
    ];
    for ($i = 0; $i < $count; $i++) {
      $batch['operations'][] = ['\Drupal\beam_code\GenerateCodes::generate',[$countryId, $countryCode, $provider]];
    }

    batch_set($batch);

  }
}
