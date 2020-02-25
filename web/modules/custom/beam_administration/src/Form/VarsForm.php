<?php

namespace Drupal\beam_administration\Form;

use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class VarsForm extends FormBase {

  public function getFormId() {
    return 'beam_vars';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['web_version'] = [
      '#type' => 'textfield',
      '#title' => t('Web Version'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('web_version'),
      '#description' => t('Bottom box in development version')
    ];

    $form['web_domain'] = [
      '#type' => 'textfield',
      '#title' => t('Web Domain'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('web_domain'),
      '#description' => t('Set current domain. In prod .jimbeam to keep cookies with web')
    ];

    $form['link_drinksmart'] = [
      '#type' => 'textfield',
      '#title' => t('Link Drinksmart'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('link_drinksmart')
    ];

    $form['link_terms'] = [
      '#type' => 'textfield',
      '#title' => t('Link Terms & Condition'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('link_terms')
    ];

    $form['link_privacy'] = [
      '#type' => 'textfield',
      '#title' => t('Link Privacy Policy'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('link_privacy')
    ];

    $form['contact_mail'] = [
      '#type' => 'email',
      '#title' => t('Contact email'),
      '#description' => t('Default country (EN)'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('contact_mail')
    ];

    $form['footer_copyright'] = [
      '#type' => 'text_format',
      '#title' => t('Footer Copyright'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('footer_copyright'),
      '#format' => 'full_html',
    ];

    // Group Buy
    $form['group_buy'] = array(
      '#type' => 'fieldset',
      '#title' => t('Buy'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['group_buy']['link_buy'] = [
      '#type' => 'textfield',
      '#title' => t('Link Buy'),
      '#required' => TRUE,
      '#default_value' => \Drupal::state()->get('link_buy')
    ];

    $options = \Drupal::state()->get('show_link_buy');
    $form['group_buy']['show_link_buy'] = [
      '#type' => 'checkboxes',
      '#title' => t('Show link Buy'),
      '#options' => OrderHelper::getLanguages(),
      '#default_value' => $options
    ];

    // Group cyrillic
    $form['group_cyrillic'] = array(
      '#type' => 'fieldset',
      '#title' => t('Cyrillic'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $countries = \Drupal::state()->get('countries_cyrillic');
    $form['group_cyrillic']['countries_cyrillic'] = [
      '#type' => 'checkboxes',
      '#title' => t('Cyrillic countries'),
      '#options' => CountryHelper::getCountries(),
      '#default_value' => $countries
    ];

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $vars = ['web_version', 'web_domain', 'link_drinksmart', 'link_terms', 'link_privacy', 'contact_mail', 'link_buy', 'show_link_buy', 'countries_cyrillic'];
    foreach ($vars as $var) \Drupal::state()->set($var, $form_state->getValue($var));

    $footer_copyright = $form_state->getValue('footer_copyright');  // FULL HTML
    \Drupal::state()->set('footer_copyright', $footer_copyright['value']);

    \Drupal::messenger()->addMessage(t('Saved variables'));
  }
}
