<?php

namespace Drupal\beam_administration\Import;

use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Reader {

  protected $reader = NULL;
  protected $spreadsheet = NULL;

  public function __construct($filename) {
    $this->reader = new Csv();
    $this->reader->setDelimiter(';');
    $this->reader->setEnclosure('');

    $this->spreadsheet = $this->reader->load($filename);
  }

  public function getData() {
    return $this->spreadsheet->getActiveSheet()->toArray();
  }
};
