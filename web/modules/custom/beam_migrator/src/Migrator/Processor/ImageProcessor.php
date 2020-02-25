<?php

namespace Drupal\beam_migrator\Migrator\Processor;

use Drupal\Core\File\FileSystemInterface;

class ImageProcessor {

  public static function processInternal($filename) {
    $moduleHandler = \Drupal::service('module_handler');
    $modulePath = $moduleHandler->getModule('beam_migrator')->getPath();
    $modulePath = \Drupal::service('file_system')->realpath($modulePath);
    $filePath = join('/', [$modulePath, 'resources', 'images', $filename]);
    $doc = file_get_contents($filePath);
    $file = file_save_data($doc, 'public://' . $filename, FileSystemInterface::EXISTS_RENAME);
    return $file->id();
  }
}
