<?php

namespace Drupal\beam_administration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SocialNetworkForm extends FormBase {

  public function getFormId() {
    return 'beam_social_network';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['sn_facebook'] = [
      '#type' => 'textfield',
      '#title' => t('Facebook'),
      '#default_value' => \Drupal::state()->get('sn_facebook')
    ];

    $form['sn_twitter'] = [
      '#type' => 'textfield',
      '#title' => t('Twitter'),
      '#default_value' => \Drupal::state()->get('sn_twitter')
    ];

    $form['sn_instagram'] = [
      '#type' => 'textfield',
      '#title' => t('Instagram'),
      '#default_value' => \Drupal::state()->get('sn_instagram')
    ];

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $vars = ['sn_facebook', 'sn_twitter', 'sn_instagram'];
    foreach ($vars as $var) \Drupal::state()->set($var, $form_state->getValue($var));
    \Drupal::messenger()->addMessage(t('Saved Social Networks'));
  }
}
