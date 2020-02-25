<?php

namespace Drupal\beam_order\Exporter;

use Drupal\beam_export\Exporter\EntityExporter;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_order\Query\Header\OrderHeader;
use Drupal\beam_order\Query\OrderFieldsQuery;
use Drupal\beam_order\Query\OrderQuery;
use Drupal\beam_order\Helper\OrderQueryHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OrderExporter extends EntityExporter {

  protected $spreadsheet = NULL;
  protected $ids = [];

  public function __construct(array $ids = []) {
    $this->spreadsheet = new Spreadsheet();
    $this->ids = $ids;
  }

  public function export() {
    $this->header();
    $this->result();

    $this->spreadsheet->setActiveSheetIndex(0);
    $this->setBold();

    return $this->spreadsheet;
  }

  private function header() {
    $header = OrderHeader::headerExport();
    $header = array_values($header);

    $this->setHeader(0, $header);
  }

  private function result() {
    $ids = $this->getIds();
    $result = OrderQuery::excel($ids);
    $countries = CountryHelper::getCountries();

    $this->spreadsheet->setActiveSheetIndex(0);
    $i = 2;
    $sheet = $this->spreadsheet->setActiveSheetIndex(0);

    foreach ($result as $record) {
      $view = OrderQueryHelper::recordQueryToArray($record, $countries, 'excel');
      $sheet->setCellValueByColumnAndRow(1, $i, $view['customer']);
      $sheet->setCellValueByColumnAndRow(2, $i, $view['address1']);
      $sheet->setCellValueByColumnAndRow(3, $i, $view['postal_code']);
      $sheet->setCellValueByColumnAndRow(4, $i, $view['city']);
      $sheet->setCellValueByColumnAndRow(5, $i, $view['country']);
      $sheet->setCellValueByColumnAndRow(6, $i, $view['phone']);
      $sheet->setCellValueByColumnAndRow(7, $i, $view['email']);
      $sheet->setCellValueByColumnAndRow(8, $i, OrderFieldsQuery::subheadExcel($view['image_subhead'], $view['country_code']));
      $sheet->setCellValueByColumnAndRow(9, $i, $view['image_label']);
      $sheet->setCellValueByColumnAndRow(10, $i, '');
      $sheet->setCellValueByColumnAndRow(11, $i, '1');
      $sheet->setCellValueByColumnAndRow(12, $i, $view['first_name']);
      $sheet->setCellValueByColumnAndRow(13, $i, $view['bottle_size']);
      $sheet->setCellValueByColumnAndRow(14, $i, $view['created']);

      $i++;
    }
  }

  /**
   * @return array
   */
  public function getIds() {
    return $this->ids;
  }
}
