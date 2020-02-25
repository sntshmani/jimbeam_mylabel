<?php

namespace Drupal\beam_administration\Form;

use Drupal\beam_misc\FormHelper\CodeFormHelper;
use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CouponGeneratorForm extends FormBase {

  public function getFormId() {
    return 'coupon_generator';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    CodeFormHelper::buildForm($form);

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    CodeFormHelper::submitForm($form_state);
  }
}
