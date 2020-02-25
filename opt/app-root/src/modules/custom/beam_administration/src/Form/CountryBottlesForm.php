<?php

namespace Drupal\beam_administration\Form;

use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CountryBottlesForm extends FormBase {

  public function getFormId() {
    return 'beam_country_bottles';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $bottles = OrderHelper::getBottles();
    $countries = CountryHelper::getCountries();
    $form['countries'] = [
      '#type' => 'value',
      '#value' => array_keys($countries),
    ];

    // Init table with bottles label as header
    $form['table'] = [
      '#type' => 'table',
      '#header' => [$this->t('Bottles')],
    ];

    foreach ($bottles as $name) {
      $form['table']['#header'][] = [
        'data' => $name,
        'class' => ['checkbox'],
      ];
    }

    foreach ($countries as $code => $name) {
      $form['table'][$code]['description'] = [
        '#type' => 'markup',
        '#markup' => $name,
      ];
      foreach ($bottles as $bottleMachine => $bottleName) {
        $varResult = 'cb_' . $code . '_' . $bottleMachine;
        $value = \Drupal::state()->get($varResult);

        $form['table'][$code][$bottleMachine] = [
          '#title' => $name . ': ' . $bottleName,
          '#title_display' => 'invisible',
          '#wrapper_attributes' => [
            'class' => ['checkbox'],
          ],
          '#type' => 'checkbox',
          '#default_value' => $value,
          '#attributes' => ['class' => ['rid-' . $bottleMachine, 'js-rid-' . $code]],
          '#parents' => [$code, $bottleMachine],
        ];
      }
    }

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $countries = $values['countries'];

    foreach ($countries as $country) {
      $countryValues = $values[$country];
      foreach ($countryValues as $bottleMachine => $value) {
        $varResult = 'cb_' . $country . '_' . $bottleMachine;
        \Drupal::state()->set($varResult, $value);
      }
    }

    \Drupal::messenger()->addMessage(t('Saved bottles by country'));
  }
}
