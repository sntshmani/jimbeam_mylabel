<?php

namespace Drupal\beam_order\Helper;

use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_order\Submit\OrderViewSubmit;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class OrderViewHelper {

  public static function filterFields($varThis, $get, &$form) {
    $form['order-view']['filter'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['action-links']],
    ];
    $form['order-view']['filter']['status'] = [
      '#type' => 'select',
      '#title' => t('Filter status'),
      '#default_value' => isset($get['status']) ? $get['status'] : NULL,
      '#options' => ['' => t('- Select -')] + OrderHelper::getStatusList() + ['all' => t('All')],
    ];
    $form['order-view']['filter']['elements_per_page'] = [
      '#type' => 'select',
      '#title' => t('Elements per page'),
      '#default_value' => isset($get['elements_per_page']) ? $get['elements_per_page'] : 1,
      '#options' => [20 => 20, 30 => 30, 50 => 50],
    ];
    $form['order-view']['filter']['submit-filter'] = [
      '#type' => 'submit',
      '#value' => t('Filter'),
      '#attributes' => [
        'id' => 'export-button',
        'class' => ['button button--primary']
      ],
      '#submit' => [
        [$varThis, 'filterForm'],
      ]
    ];
  }

  public static function applyChangesFields($varThis, $get, &$form) {
    $form['order-view']['change'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['action-links']],
    ];
    $form['order-view']['change']['change'] = [
      '#type' => 'select',
      '#title' => t('Change status'),
      '#default_value' => isset($get['change']) ? $get['change'] : NULL,
      '#options' => ['' => t('- Select -')] + OrderHelper::getStatusList(),
    ];
    $form['order-view']['change']['submit-change'] = [
      '#type' => 'submit',
      '#value' => t('Apply'),
      '#attributes' => [
        'id' => 'apply-button',
        'class' => ['button button--primary']
      ],
      '#submit' => [
        [$varThis, 'applyChangesForm'],
      ]
    ];
  }

  public static function submitActions($varThis, &$form) {
    $form['order-view']['actions-order'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['action-links']],
    ];
    $form['order-view']['actions-order']['export-excel'] = [
      '#type' => 'submit',
      '#value' => 'Export to Excel',
      '#attributes' => [
        'id' => 'export-button',
        'class' => ['button button--primary']
      ],
      '#submit' => [
        [$varThis, 'exportToExcel'],
      ],
    ];
    $form['order-view']['actions-order']['export-csv'] = [
      '#type' => 'submit',
      '#value' => 'Export to CSV',
      '#attributes' => [
        'id' => 'export-button',
        'class' => ['button button--primary']
      ],
      '#submit' => [
        [$varThis, 'exportToCSV'],
      ],
    ];

    $form['order-view']['actions-order']['generate'] = [
      '#type' => 'submit',
      '#value' => 'Generate label',
      '#attributes' => [
        'id' => 'generate-button',
        'class' => ['button button--primary']
      ],
      '#submit' => [
        [$varThis, 'generateForm'],
      ],
    ];

    $form['order-view']['actions-order']['download'] = [
      '#type' => 'submit',
      '#value' => 'Download PDF with labels',
      '#attributes' => [
        'id' => 'download-button',
        'class' => ['button button--primary']
      ],
      '#submit' => [
        [$varThis, 'downloadForm'],
      ],
    ];

    $form['order-view']['actions-order']['add'] = [
      '#title' => t('Add label'),
      '#type' => 'link',
      '#url' => Url::fromRoute('beam_order.add_label'),
      '#attributes' => [
        'class' => ['button button--primary']
      ],
    ];
  }

  public static function filterParams($get, FormStateInterface $form_state, $paramsName) {
    $params = [];
    // Order and sort
    if ($get) {
      foreach ($get as $key => $value) {
        $params[$key] = $value;
      }
    }
    // Filter params
    foreach ($paramsName as $var) {
      $value = $form_state->getValue($var);
      if (isset($value) && is_numeric($value)) $params[$var] = $value;
      else unset($params[$var]);
    }

    return $params;
  }

  public static function applyChangesForm(array &$form, FormStateInterface $form_state) {
    $params = OrderViewHelper::filterParams($_GET, $form_state, ['change']);
    if (isset($params['change'])) {
      OrderViewSubmit::changeBulkStatus($form, $form_state, $params['change']);
    }
    \Drupal::messenger()->addMessage(t('Changed status'));
  }
}
