<?php

namespace Drupal\beam_administration\Form;

use Drupal\file\Entity\File;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\beam_administration\Import\ImportProcessor;

class ImportCodesForm extends FormBase {

  public function getFormId() {
    return 'import_codes';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $countries = CountryHelper::getCountries();

    $form['country'] = [
      '#type' => 'select',
      '#title' => t('Country'),
      '#options' => $countries,
      '#required' => TRUE,
    ];
    $form['unlimited'] = [
      '#type' => 'checkbox',
      '#dafault_value' => 0,
      '#title' => t('Unlimited'),
      '#required' => false,
    ];
    $form['remaining'] = [
      '#type' => 'textfield',
      '#attributes' => [
        ' type' => 'number',
      ],
      '#title' => t('Remaining uses'),
      '#default_value' => 0,
      '#required' => true,
    ];
    $form['provider'] = [
      '#type' => 'textfield',
      '#title' => t('Provider'),
      '#required' => false,
    ];
    $form['file'] = [
      '#type' => 'managed_file',
      '#title' => t('File'),
      '#description' => t('Upload file (csv)'),
      '#upload_location' => 'public://import/',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('csv'),
      ),
      '#required' => TRUE,
    ];

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => t('Import codes'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $formValues = [
      'country' => $form_state->getValue('country'),
      'unlimited' => $form_state->getValue('unlimited'),
      'remaining' => $form_state->getValue('remaining'),
      'provider' => $form_state->getValue('provider'),
    ];

    $file_id = $form_state->getValue('file');
    $filename = $this->getFile($file_id);
    $import = new ImportProcessor();
    $import->run($formValues, $filename);

    \Drupal::messenger()->addMessage(t('Imported codes'));

  }

  private function getFile($id) {
    $file_id = array_shift($id);
    $file = File::load($file_id);
    $filename = $file->getFileUri();
    return \Drupal::service('file_system')->realpath($filename);
  }
}
