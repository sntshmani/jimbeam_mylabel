<?php

namespace Drupal\beam_misc\Helper;

use Drupal\beam_country\Entity\Country;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginHelper {

  public static function redirectAfterLogin($routeName) {
    $url = Url::fromRoute($routeName)->toString();
    $response = new RedirectResponse($url);
    $response->send();
    return;
  }
}
