<?php

namespace Drupal\beam_country\Controller;

use Drupal\beam_country\Entity\Country;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for api.
 */
class CountryController extends ControllerBase {

  public function edit() {
    $countryId = UserHelper::getCountryID();
    $country = Country::load($countryId);

    $form = \Drupal::service('entity.form_builder')->getForm($country);
    $renderer = \Drupal::service('renderer');
    $formRender = $renderer->render($form);

    return [
      '#type' => 'markup',
      '#markup' => $formRender,
    ];
  }
}
