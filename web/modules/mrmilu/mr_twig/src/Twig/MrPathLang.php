<?php

namespace Drupal\mr_twig\Twig;
use Drupal\Core\Url;

/**
 * Class DefaultService.
 *
 * @package Drupal\mr_twig
 */
class MrPathLang extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'mr_path_lang';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('mr_path_lang', [$this, 'mr_path_lang']),
    );
  }

  /**
   * The php function to load a given block
   */
  public function mr_path_lang($name, $parameters, $options, $langcode) {
    if ($langcode) {
      if ($language = \Drupal::languageManager()->getLanguage($langcode)) {
        $options['language'] = $language;
      }
    }
    return Url::fromRoute($name, $parameters, $options)->toString();
  }
}
