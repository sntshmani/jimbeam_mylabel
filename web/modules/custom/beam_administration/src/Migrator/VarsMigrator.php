<?php

namespace Drupal\beam_administration\Migrator;

use Drupal\Core\Serialization\Yaml;
use Drupal\beam_administration\Helper\AdministrationHelper;

class VarsMigrator {

  private $path;
  public function __construct() {
    $this->path = AdministrationHelper::getFilePath();
  }

  public function export() {
    $vars = AdministrationHelper::getVars();
    $result = [];
    foreach ($vars as $var) {
      $result[$var] = \Drupal::state()->get($var);
    }

    return $result;
  }

  public function write($result) {
    $yaml = Yaml::encode($result);
    file_put_contents($this->path, $yaml);
  }

  public function read() {
    $yaml = file_get_contents($this->path);
    return $yaml;
  }

  public function import($yaml) {
    $result = Yaml::decode($yaml);
    foreach ($result as $key => $value) {
      \Drupal::state()->set($key, $value);
    }
  }

}
