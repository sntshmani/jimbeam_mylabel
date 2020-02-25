<?php

namespace Drupal\beam_customer\Exporter;

use Drupal\beam_code\Query\CodeQuery;
use Drupal\beam_customer\Query\CustomerQuery;
use Drupal\beam_export\Exporter\EntityExporter;
use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\CustomerHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_misc\Helper\UserHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CustomerExporter extends EntityExporter {

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
    $header = CustomerQuery::header();
    $header = array_column($header, 'data');

    $this->setHeader(0, $header);
  }

  private function result() {
    $result = CustomerQuery::excel();
    $countries = CountryHelper::getCountries();

    $this->spreadsheet->setActiveSheetIndex(0);
    $i = 2;
    $sheet = $this->spreadsheet->setActiveSheetIndex(0);

    foreach ($result as $record) {
      $countryCode = CountryHelper::getCountryCodeByID($record->country_id);
      $customerName = join(' ', [$record->name, $record->surname]);
      $phone = CustomerHelper::getPhoneFull($record);

      $sheet->setCellValueByColumnAndRow(1, $i, $record->id);
      $sheet->setCellValueByColumnAndRow(2, $i, $customerName);
      $sheet->setCellValueByColumnAndRow(3, $i, $record->email);
      $sheet->setCellValueByColumnAndRow(4, $i, $phone ? $phone : '');
      $sheet->setCellValueByColumnAndRow(5, $i, $record->address1);
      $sheet->setCellValueByColumnAndRow(6, $i, $record->address2);
      $sheet->setCellValueByColumnAndRow(7, $i, $record->address3);
      $sheet->setCellValueByColumnAndRow(8, $i, $record->city);
      $sheet->setCellValueByColumnAndRow(9, $i, $countryCode ? $countries[$countryCode] : NULL);
      $sheet->setCellValueByColumnAndRow(10, $i, $record->postal_code);
      $i++;
    }
  }
}
