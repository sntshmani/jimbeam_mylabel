<?php

namespace Drupal\beam_administration\Form;

use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_pages\Helper\PagesHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class StepLabelForm extends FormBase {

  public function getFormId() {
    return 'beam_step_label_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $vars = PagesHelper::getStepLabel();

    foreach ($vars as $key => $step) {
      $form[$key] = [
        '#type' => $step['type'],
        '#title' => $step['label'],
        '#required' => TRUE,
        '#default_value' => \Drupal::state()->get($key),
      ];
      if ($step['type'] == 'textfield') $form[$key]['#maxlength'] = 255;
      elseif($step['type'] == 'text_format') $form[$key]['#format'] = 'full_html';
    }

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $vars = PagesHelper::getStepLabel();
    foreach ($vars as $key => $step) {
      if (in_array($step['type'], ['textfield', 'textarea'])) \Drupal::state()->set($key, $form_state->getValue($key));
      else {
        $value = $form_state->getValue($key);
        \Drupal::state()->set($key, $value['value']);
      }
    }

    \Drupal::messenger()->addMessage(t('Saved Step text'));
  }

}
