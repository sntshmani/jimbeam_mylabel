<?php

namespace Drupal\beam_administration\Form;

use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CountryOptionsForm extends FormBase {

  /**
   * @return string
   * @TODO DELETE. Now using options in country entity
   */
  public function getFormId() {
    return 'beam_country_options';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $countries = CountryHelper::getCountries();

    foreach ($countries as $code => $name) {
      $var = 'co_' . $code . '_options';
      $form[$var] = [
        '#type' => 'textarea',
        '#title' => $name,
        '#required' => TRUE,
        '#default_value' => \Drupal::state()->get($var),
        '#description' => t('key|value'),
      ];
    }

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $countries = CountryHelper::getCountries();

    foreach ($countries as $code => $country) {
      $var = 'co_' . $code . '_options';
      $value = $values[$var];
      \Drupal::state()->set($var, $value);
    }

    \Drupal::messenger()->addMessage('Saved options by country');
  }
}
