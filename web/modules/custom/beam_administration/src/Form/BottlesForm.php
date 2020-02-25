<?php

namespace Drupal\beam_administration\Form;

use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class BottlesForm extends FormBase {

  public function init() {
    return [
      'bottles' => OrderHelper::getBottles(),
      'label' => OrderHelper::getLabelOptions(),
      'options' => [
        'front' => t('Front'),
        'lateral_bottle_70cl' => t('Lateral Photo 70cl'),
        'lateral_bottle_75cl' => t('Lateral Photo 75cl'),
        'lateral_bottle_1l' => t('Lateral Photo 1l'),
        'lateral_bottle_15l' => t('Lateral Photo 15l'),
        'lateral_bottle_70cl_without_picture' => t('Lateral Photo 70cl without picture'),
        'lateral_bottle_75cl_without_picture' => t('Lateral Photo 75cl without picture'),
        'lateral_bottle_1l_without_picture' => t('Lateral Photo 1l without picture'),
        'lateral_bottle_15l_without_picture' => t('Lateral Photo 15l without picture'),
      ]
    ];
  }

  public function getFormId() {
    return 'beam_bottles';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $init = $this->init();

    // Bottles by size
    $form['group_bottles'] = array(
      '#type' => 'fieldset',
      '#title' => 'Bottles Front',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    foreach ($init['bottles'] as $key => $label) {
      $fileId = \Drupal::state()->get($key);
      $form['group_bottles'][$key] = array(
        '#type' => 'managed_file',
        '#title' => $label,
        '#description' => t('Upload image, allowed extensions: jpg png'),
        '#upload_location' => 'public://import/',
        '#upload_validators'  => array(
          'file_validate_extensions' => array('jpg png'),
        ),
        '#default_value' => $fileId ? [$fileId] : NULL,
        '#required' => TRUE,
      );
    }


    // Image label by bottle
    foreach ($init['bottles'] as $keyBottle => $labelBottle) {
      $form['group_bottles_label'][$keyBottle] = array(
        '#type' => 'fieldset',
        '#title' => 'Label ' . $labelBottle,
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
      );
      foreach ($init['label'] as $key => $label) {
        $keyLabel = $keyBottle . '_' . $key;
        $fileId = \Drupal::state()->get($keyLabel);
        $form['group_bottles_label'][$keyBottle][$keyLabel] = array(
          '#type' => 'managed_file',
          '#title' => $label,
          '#description' => t('Upload image, allowed extensions: jpg png'),
          '#upload_location' => 'public://import/',
          '#upload_validators'  => array(
            'file_validate_extensions' => array('jpg png'),
          ),
          '#default_value' => $fileId ? [$fileId] : NULL,
          '#required' => TRUE,
        );
      }
    }

    $form['group_bottles_step3'] = array(
      '#type' => 'fieldset',
      '#title' => 'Bottles Step 3',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    foreach ($init['options'] as $key => $label) {
      $varState = 'bottle_step3_' . $key;
      $fileId = \Drupal::state()->get($varState);
      $form['group_bottles_step3'][$varState] = array(
        '#type' => 'managed_file',
        '#title' => t('Bottle step 3 ' . $label),
        '#description' => t('Upload image, allowed extensions: jpg png'),
        '#upload_location' => 'public://import/',
        '#upload_validators'  => array(
          'file_validate_extensions' => array('jpg png'),
        ),
        '#default_value' => $fileId ? [$fileId] : NULL,
        '#required' => TRUE,
      );
    }

    $fileId = \Drupal::state()->get('image_label');
    $form['image_label'] = array(
      '#type' => 'managed_file',
      '#title' => t('Image label'),
      '#description' => t('Upload image, allowed extensions: jpg png'),
      '#upload_location' => 'public://import/',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('jpg png'),
      ),
      '#default_value' => $fileId ? [$fileId] : NULL,
      '#required' => FALSE,
      '#weight' => 10,
    );

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#weight' => 100,
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $init = $this->init();
    foreach ($init['bottles'] as $keyBottle => $bottle) {
      $fileId = $form_state->getValue($keyBottle);
      $this->setFile($keyBottle, $fileId);

      foreach ($init['label'] as $key => $label) {
        $keyLabel = $keyBottle . '_' . $key;
        $fileId = $form_state->getValue($keyLabel);
        $this->setFile($keyLabel, $fileId);
      }
    }

    foreach ($init['options'] as $key => $label) {
      $varState = 'bottle_step3_' . $key;
      $fileId = $form_state->getValue($varState);
      $this->setFile($varState, $fileId);
    }

    $vars = ['image_label'];
    foreach ($vars as $var) {
      $fileId = $form_state->getValue($var);
      $this->setFile($var, $fileId);
    }

    \Drupal::messenger()->addMessage(t('Saved files'));
  }

  private function setFile($varState, $fileId) {
    if ($fileId) {
      $fileId = array_shift($fileId);
      \Drupal::state()->set($varState, $fileId);
    }
    else \Drupal::state()->delete($varState);
  }
}
