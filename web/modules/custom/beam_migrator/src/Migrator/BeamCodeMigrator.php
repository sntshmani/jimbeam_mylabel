<?php

namespace Drupal\beam_migrator\Migrator;

use Drupal\beam_administration\Import\Reader;
use Drupal\beam_migrator\Helper\ContentHelper;
use Drupal\beam_migrator\Migrator\Content\Block\BlockBodyMigrator;
use Drupal\beam_migrator\Migrator\Content\Block\BlockFooterMigrator;
use Drupal\beam_migrator\Migrator\Content\Block\BlockImageMigrator;
use Drupal\beam_migrator\Migrator\Content\Block\BlockThanksMigrator;
use Drupal\beam_migrator\Migrator\Content\BlockContent\BlockContentPopupMigrator;
use Drupal\beam_migrator\Migrator\Content\Node\NodePageMigrator;
use Drupal\beam_migrator\Migrator\Content\PagePersonaliseMigrator;
use Drupal\beam_migrator\Migrator\Content\PageTermsMigrator;
use Drupal\beam_migrator\Migrator\Content\PageThanksMigrator;
use Drupal\beam_code\Entity\Code;
use Drupal\beam_misc\Helper\CountryHelper;

class BeamCodeMigrator {

  protected $filename;
  protected $countryId;

  public function __construct($filename, $countryCode) {
    $this->filename = $filename;
    $this->countryId = CountryHelper::getCountryIDByCode($countryCode);
  }

  public function migrate() {
    print ('------------------------------') . PHP_EOL;
    $excel = new Reader($this->filename);
    $excelValues = $excel->getData();
    foreach ($excelValues as $key => $values) {
      $this->createCode($key, $values);
    }
  }

  private function createCode($key, $values) {
    $code = Code::create([
      'label' => $values[0],
      'country_id' => $this->countryId,
      'unlimited' => false,
      'remaining' => 1,
      'current' => 0,
      'provider' => NULL,
    ]);
    $code->save();

    print ($key . '- Created code ID: ' .$code->id()) . PHP_EOL;
  }
}
