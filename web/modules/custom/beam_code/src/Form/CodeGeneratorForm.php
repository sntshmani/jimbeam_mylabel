<?php

namespace Drupal\beam_code\Form;

use Drupal\beam_misc\FormHelper\CodeFormHelper;
use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CodeGeneratorForm extends FormBase {

  public function getFormId() {
    return 'beam_code_generator';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    CodeFormHelper::buildForm($form);

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    CodeFormHelper::submitForm($form_state);
  }
}
