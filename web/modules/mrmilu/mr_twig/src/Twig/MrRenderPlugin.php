<?php

/**
 * @file
 * Contains \Drupal\mr_twig\Twig\MrBlockExtension.
 */

namespace Drupal\mr_twig\Twig;

/**
 * Class DefaultService.
 *
 * @package Drupal\mr_twig
 */
class MrRenderPlugin extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'mr_render_plugin';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('mr_render_plugin', array($this, 'mr_render_plugin'), array(
        'is_safe' => array('html'),
      )),
    );
  }

  /**
   * The php function to load a given block
   */
  public function mr_render_plugin($plugin_id) {
    $block_manager = \Drupal::service('plugin.manager.block');
    $config = [];// You can hard code configuration or you load from settings.
    $plugin_block = $block_manager->createInstance($plugin_id, $config);
    $render = $plugin_block->build();
    return $render;
  }
}
