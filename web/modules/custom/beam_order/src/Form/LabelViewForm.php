<?php

namespace Drupal\beam_order\Form;

use Drupal\beam_export\Helper\ExportHelper;
use Drupal\beam_order\Exporter\OrderExporter;
use Drupal\beam_order\Helper\OrderViewHelper;
use Drupal\beam_order\Query\Header\OrderHeader;
use Drupal\beam_order\Query\OrderQuery;
use Drupal\beam_order\Submit\OrderViewSubmit;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Controller routines for api.
 */
class LabelViewForm extends FormBase {

  public function getFormId() {
    return 'beam_label_view';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['order-view'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['action-links']],
    ];
    OrderViewHelper::filterFields($this, $_GET, $form);
    OrderViewHelper::applyChangesFields($this, $_GET, $form);
    OrderViewHelper::submitActions($this, $form);

    $header = OrderHeader::headerView();
    $options = OrderQuery::view();

    $form['table'] = [
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No labels'),
      '#js_select' => TRUE,
      '#attached' => ['library' => ['core/drupal.dialog.ajax']]
    ];

    $form['pager'] = [
      '#type' => 'pager'
    ];

    return $form;
  }

  /**
   * Form submission handler.
   */
  public function filterForm(array &$form, FormStateInterface $form_state) {
    $params = OrderViewHelper::filterParams($_GET, $form_state, ['status', 'elements_per_page']);
    $url = Url::fromRoute('<current>', [], ['query' => [$params]]);

    $form_state->setRedirectUrl($url);
  }

  public function applyChangesForm(array &$form, FormStateInterface $form_state) {
    OrderViewHelper::applyChangesForm($form, $form_state);
  }

  /**
   * Form submission handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Do nothing
  }

  /**
   * Form submission handler.
   */
  public function exportToExcel(array &$form, FormStateInterface $form_state) {
    $selected = [];
    foreach ($form_state->getValue('table') as $key => $value) {
      if ($key == $value) {
        $selected[] = $value;
      }
    }
    $extension = 'xlsx';
    $exporter = new OrderExporter($selected);
    $filename = 'order-' . time() . '.' . $extension;
    ExportHelper::submitForm($exporter, $filename, $extension);
  }

  /**
   * Form submission handler.
   */
  public function exportToCSV(array &$form, FormStateInterface $form_state) {
    $selected = [];
    foreach ($form_state->getValue('table') as $key => $value) {
      if ($key == $value) {
        $selected[] = $value;
      }
    }
    $extension = 'csv';
    $exporter = new OrderExporter($selected);
    $filename = 'order-' . time() . '.' . $extension;
    ExportHelper::submitForm($exporter, $filename, $extension);
  }

  public function generateForm(array &$form, FormStateInterface $form_state) {
    $result = OrderViewSubmit::generate($form, $form_state);
    \Drupal::messenger()->addMessage($result['message'], $result['type']);
  }

  public function downloadForm(array &$form, FormStateInterface $form_state) {
    $result = OrderViewSubmit::download($form, $form_state);
    \Drupal::messenger()->addMessage($result['message'], $result['type']);

    $form_state->setRedirectUrl(Url::fromRoute('<current>'));
  }
}
