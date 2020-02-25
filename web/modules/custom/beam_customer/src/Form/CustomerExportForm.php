<?php

namespace Drupal\beam_customer\Form;

use Drupal\beam_customer\Exporter\CustomerExporter;
use Drupal\beam_export\Helper\ExportHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomerExportForm extends FormBase {

  public function getFormId() {
    return 'beam_code_export';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    ExportHelper::buildForm($this, $form);
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Do nothing
  }

  public function exportToExcel(array &$form, FormStateInterface $form_state) {
    // $extension = $form_state->getValue('extension');
    $extension = 'xlsx';
    $exporter = new CustomerExporter();
    $filename = 'customer-' . time() . '.' . $extension;

    ExportHelper::submitForm($exporter, $filename, $extension);

  }

  public function exportToCSV(array &$form, FormStateInterface $form_state) {
    // $extension = $form_state->getValue('extension');
    $extension = 'csv';
    $exporter = new CustomerExporter();
    $filename = 'customer-' . time() . '.' . $extension;

    ExportHelper::submitForm($exporter, $filename, $extension);

  }
}
