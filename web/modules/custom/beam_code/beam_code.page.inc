<?php

/**
 * @file
 * Contains beam_code.page.inc.
 *
 * Page callback for Coupon entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Coupon templates.
 *
 * Default template: beam_code.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_beam_code(array &$variables) {
  // Fetch Coupon Entity Object.
  $beam_code = $variables['elements']['#beam_code'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
