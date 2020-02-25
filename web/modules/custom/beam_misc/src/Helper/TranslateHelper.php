<?php

namespace Drupal\beam_misc\Helper;


class TranslateHelper {

  public static function getUntranslated($name) {
    $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();

    $database = \Drupal::database();
    $query = $database->select('locales_source', 'ls');
    $query->join('locales_target', 'lt', 'ls.lid = lt.lid');
    $query->fields('ls', ['source'])
      ->condition('lt.language', $langcode)
      ->condition('lt.translation', $name)
      ->execute();
    $result = $query->execute()->fetchField();

    return $result ? $result : $name;
  }

}
