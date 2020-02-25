<?php

namespace Drupal\beam_pages\Controller;

use Drupal\beam_pages\Helper\PagesHelper;
use Drupal\Core\Controller\ControllerBase;

class CustomBottleController extends ControllerBase {

  public function page() {

    $displayOptions = PagesHelper::getDisplayOptions();

    return [
      '#theme' => 'custom_bottle_form',
    ] + $displayOptions;
  }
}
