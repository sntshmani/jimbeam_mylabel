<?php

namespace Drupal\beam_code\Exporter;

use Drupal\beam_code\Query\CodeQuery;
use Drupal\beam_export\Exporter\EntityExporter;
use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\UserHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CodeExporter extends EntityExporter {

  protected $spreadsheet = NULL;

  public function __construct() {
    $this->spreadsheet = new Spreadsheet();
  }

  public function export() {
    $this->header();
    $this->result();

    $this->spreadsheet->setActiveSheetIndex(0);
    $this->setBold();

    return $this->spreadsheet;
  }

  private function header() {
    $header = CodeQuery::header();
    $header = array_column($header, 'data');

    $this->setHeader(0, $header);
  }

  private function result() {
    $result = CodeQuery::excel();
    $countries = CountryHelper::getCountries();
    $this->spreadsheet->setActiveSheetIndex(0);
    $i = 2;
    $sheet = $this->spreadsheet->setActiveSheetIndex(0);

    foreach ($result as $record) {
      $countryCode = CountryHelper::getCountryCodeByID($record->country_id);
      $remaining = $record->remaining ? $record->remaining : 0;
      $current = $record->current ? $record->current : 0;

      $sheet->setCellValueByColumnAndRow(1, $i, $record->id);
      $sheet->setCellValueByColumnAndRow(2, $i, $record->label);
      $sheet->setCellValueByColumnAndRow(3, $i, $countryCode ? $countries[$countryCode] : NULL);
      $sheet->setCellValueByColumnAndRow(4, $i, CodeHelper::getBooleanValue($record->unlimited));
      $sheet->setCellValueByColumnAndRow(5, $i, $remaining);
      $sheet->setCellValueByColumnAndRow(6, $i, $current);
      $sheet->setCellValueByColumnAndRow(7, $i, $record->provider);
      $i++;
    }
  }
}
