<?php

namespace Drupal\beam_code\Form;

use Drupal\beam_code\Exporter\CodeExporter;
use Drupal\beam_export\Helper\ExportHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CodeExportForm extends FormBase {

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
    $extension = 'xlsx';
    $exporter = new CodeExporter();
    $filename = 'code-' . time() . '.' . $extension;

    ExportHelper::submitForm($exporter, $filename, $extension);

  }

  public function exportToCSV(array &$form, FormStateInterface $form_state) {
    $extension = 'csv';
    $exporter = new CodeExporter();
    $filename = 'code-' . time() . '.' . $extension;

    ExportHelper::submitForm($exporter, $filename, $extension);

  }
}
