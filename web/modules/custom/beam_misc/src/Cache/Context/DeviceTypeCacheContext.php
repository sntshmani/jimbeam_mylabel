<?php

namespace Drupal\beam_misc\Cache\Context;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Cache\Context\CacheContextInterface;
use Drupal\beam_misc\Helper\DeviceHelper;

class DeviceTypeCacheContext implements CacheContextInterface {

  public static function getLabel() {
    return t("Device type");
  }

  public function getContext() {
    return DeviceHelper::getDevice();
  }

  public function getCacheableMetadata() {
    return new CacheableMetadata();
  }
}
