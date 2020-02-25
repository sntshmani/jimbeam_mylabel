<?php

namespace Drupal\beam_export\Exporter;

use Drupal\beam_code\Query\CodeQuery;
use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\beam_order\Query\OrderQuery;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EntityExporter {

  protected function setHeader($activeSheetIndex, $headers) {
    $this->spreadsheet->setActiveSheetIndex($activeSheetIndex);
    foreach ($headers as $col => $header) {
      $this->spreadsheet->setActiveSheetIndex($activeSheetIndex)
        ->setCellValueByColumnAndRow($col + 1, 1, $header);
    }
  }

  protected function setBold() {
    $last_column = $this->spreadsheet->getActiveSheet()->getHighestColumn();
    $bold_cells_first_row = 'A1:' . $last_column . '1';
    $this->spreadsheet->getActiveSheet()->getStyle($bold_cells_first_row)->getFont()->setBold(true);
  }
}
