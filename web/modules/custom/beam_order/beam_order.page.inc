<?php

/**
 * @file
 * Contains beam_order.page.inc.
 *
 * Page callback for Order entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Order templates.
 *
 * Default template: beam_order.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_beam_order(array &$variables) {
  // Fetch Order Entity Object.
  $beam_order = $variables['elements']['#beam_order'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
