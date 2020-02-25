<?php

/**
 * @file
 * Contains \Drupal\mr_twig\Twig\MrImageStyle.
 */

namespace Drupal\mr_twig\Twig;
use Drupal\image\Entity\ImageStyle;

/**
 * Class DefaultService.
 *
 * @package Drupal\mr_twig
 */
class MrImageStyle extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'mr_image_style';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('mr_image_style', [$this, 'mr_image_style']),
    );
  }

  /**
   * The php function to load a given block
   */
  public function mr_image_style($uri, $image_style) {
    $image_factory = \Drupal::service('image.factory');
    $image = $image_factory->get($uri);
    if ($image->isValid()) return ImageStyle::load($image_style)->buildUrl($uri);
    else return file_create_url($uri);
  }
}
