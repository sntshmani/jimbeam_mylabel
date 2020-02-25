<?php

namespace Drupal\beam_pages\Controller;

use Drupal\beam_misc\Helper\DisplayHelper;
use Drupal\beam_pages\Helper\PagesHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\Core\Controller\ControllerBase;

class CustomBottlePrivateController extends ControllerBase {

  public function page() {
    $displayOptions = PagesHelper::getDisplayOptions(false);

    return [
        '#theme' => 'custom_bottle_private_form',
      ] + $displayOptions;
  }
}
