<?php

namespace Drupal\beam_misc;

use Drupal\beam_misc\StackMiddleware\CookieCustomerCountry;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceModifierInterface;

/**
 * Overrides the Core PageCache service.
 */
class BeamMiscServiceProvider implements ServiceModifierInterface {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $container->getDefinition('http_middleware.page_cache')->setClass(CookieCustomerCountry::class);
  }
}
