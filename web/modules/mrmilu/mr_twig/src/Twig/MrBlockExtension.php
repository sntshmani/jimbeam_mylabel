<?php

/**
 * @file
 * Contains \Drupal\mr_twig\Twig\MrBlockExtension.
 */

namespace Drupal\mr_twig\Twig;
use Drupal\block_content\Entity\BlockContent;

/**
 * Class DefaultService.
 *
 * @package Drupal\mr_twig
 */
class MrBlockExtension extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'mr_block_display';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('mr_block_display', array($this, 'mr_block_display'), array(
        'is_safe' => array('html'),
      )),
    );
  }

  /**
   * The php function to load a given block
   */
  public function mr_block_display($block_id, $arg = '') {
    $entity = BlockContent::load($block_id);
    $build = array();
    if (!empty($entity)) {
      $build = [
        '#theme' => 'block',
        '#attributes' => [],
        '#contextual_links' => [
          'block' => [
            'route_parameters' => ['block' => $entity->id()],
          ],
        ],
        '#configuration' => [
          'provider' => '',
          'plugin_id' => $entity->bundle(),
        ],
        '#plugin_id' => $entity->bundle(),
        '#base_plugin_id' => $entity->bundle(),
        '#derivative_plugin_id' => '',
        '#id' => $entity->id(),
        'content' => \Drupal::entityTypeManager()->getViewBuilder('block_content')->view($entity),
        '#cache' => array(
          'tags' => $entity->getCacheTags(),
          'contexts' => $entity->getCacheContexts(),
        ),
      ];

      $build['#cache']['contexts'][] = 'user.permissions';
      if (\Drupal::currentUser()->hasPermission('access in-place editing')) {
        $build['#attributes']['data-quickedit-entity-id'] = $entity->getEntityTypeId() . '/' . $entity->id();
      }

      if (!$entity->isNew()) {
        $build['#contextual_links']['block_content'] = array(
          'route_parameters' => array('block_content' => $entity->id()),
          'metadata' => array('changed' => $entity->getChangedTime()),
        );
      }
    }
    return $build;
  }
}
