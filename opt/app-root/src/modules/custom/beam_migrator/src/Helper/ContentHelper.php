<?php

namespace Drupal\beam_migrator\Helper;

class ContentHelper {

  public static function getEntities() {
    return ['node', 'paragraph'];
  }

  public static function getMenus() {
    return ['main', 'main-mobile', 'footer', 'footer-bottom'];
  }
}
