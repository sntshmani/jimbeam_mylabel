<?php

namespace Drupal\beam_pdf;

require drupal_get_path('module', 'beam_pdf') .'/libraries/PDFMerger/PDFMerger.php';

use PDFMerger\PDFMerger;

class PDFDownloader {


  public function __construct() {}

  public function merge($values) {
    error_reporting(0);

    $pdf = new PDFMerger();
    foreach ($values as $value) {
      if ($value['pdf_url']) {
        $file = file_create_url($value['pdf_url']);
        $url = __DIR__ . '/../../../..' . file_url_transform_relative($file);
        $pdf->addPDF($url);
      }
    }

    try {
      return $pdf->merge('download', 'labels.pdf');
    }
    catch (\Exception $e) {
      return false;
    }
  }
}
