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

class EntityLoadMigrator {

  protected $type;

  public function __construct($type) {
    $this->type = $type;
  }

  public function load() {
    print ('Loading: ' . $this->type) . PHP_EOL;
    $ids = \Drupal::entityQuery($this->type)
      ->execute();
    $storage_handler = \Drupal::entityTypeManager()->getStorage($this->type);
    $storage_handler->loadMultiple($ids);
  }
}
