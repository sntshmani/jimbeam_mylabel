<?php

namespace Drupal\beam_administration\Helper;

use Drupal\beam_pages\Helper\PagesHelper;

class AdministrationHelper {

  public static function getVars() {
    $vars = ['web_version', 'web_domain', 'link_drinksmart', 'link_terms', 'link_privacy', 'contact_mail', 'footer_copyright', 'link_buy', 'show_link_buy', 'countries_cyrillic',
      'sn_facebook', 'sn_twitter', 'sn_instagram'];
    $steps = array_keys(PagesHelper::getStepLabel());

    return array_merge($vars, $steps);
  }

  public static function getFilePath() {
    $module_path = drupal_get_path('module', 'beam_administration');
    return $module_path . '/includes/variables.yml';
  }
}
