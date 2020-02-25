<?php

namespace Drupal\beam_misc\Helper;

use Mobile_Detect;

class DeviceHelper {

  const DEVICE_MOBILE = 'mobile';
  const DEVICE_DESKTOP = 'desktop';

  public static function getDevice() {
    $detect = new Mobile_Detect();

    if ($detect->isMobile()) {
      return self::DEVICE_MOBILE;
    }
    return self::DEVICE_DESKTOP;
  }

}
