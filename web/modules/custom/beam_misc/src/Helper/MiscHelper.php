<?php

namespace Drupal\beam_misc\Helper;

class MiscHelper {

  public static function randomAlphanumeric($length) {
    $allowedChars = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($allowedChars), 0, $length);
  }

  public static function textareaToArray($string) {
    return array_map('trim', explode(',', $string));
  }

  public static function textareaKeysToArray($string) {
    $values = preg_split('/[\r\n]+/', $string, -1, PREG_SPLIT_NO_EMPTY);

    $result = array();
    foreach ($values as $record) {
      list($key, $value) = explode('|', $record);
      $result[] = [
        'key' => $key,
        'value' => $value
      ];
    }
    return $result;
  }

  public static function inArrayInsensitive($string, $array) {
    return in_array(strtolower($string), array_map('strtolower', $array));
  }

  public static function setFileFormAPI($varState, $fileId) {
    if ($fileId) {
      $fileId = array_shift($fileId);
      \Drupal::state()->set($varState, $fileId);
    }
    else \Drupal::state()->delete($varState);
  }

  public static function getValuesVarsArray($var) {
    $options = \Drupal::state()->get($var);
    $result = [];
    if ($options) {
      foreach ($options as $key => $value) {
        if ($value) $result[] = $value;
      }
    }

    return $result;
  }

  public static function pathPublic() {
    $scheme = \Drupal::config('system.file')->get('default_scheme');
    return \Drupal::service('file_system')->realpath($scheme . "://") . '/';
  }

  public static function pathPublicFile($filename) {
    return self::pathPublic() . $filename;
  }
}
