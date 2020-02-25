<?php

namespace Drupal\beam_export\Helper;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExportHelper {

  public static function buildForm($varThis, &$form) {
    $form['export_excel'] = [
      '#type' => 'submit',
      '#value' => 'Export to Excel',
      '#submit' => [
        [$varThis, 'exportToExcel'],
      ],
    ];
    $form['export_csv'] = [
      '#type' => 'submit',
      '#value' => 'Export to CSV',
      '#submit' => [
        [$varThis, 'exportToCSV'],
      ],
    ];
  }

  public static function submitForm($exporter, $filename, $extension) {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-16');
    header('Content-Disposition: attachment; filename="' . $filename);

    $spreadsheet = $exporter->export();

    try {
      $writer = IOFactory::createWriter($spreadsheet, ucfirst($extension));
      ob_end_clean();

      $writer->save("php://output");
      exit();
    } catch (Exception $e) {
    }
  }
}
