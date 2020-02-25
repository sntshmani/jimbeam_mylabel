<?php


namespace Drupal\beam_misc\Helper;

use Drupal\beam_country\Entity\Country;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class DisplayHelper {

  public static function getThemePath($path) {
    global $base_url;
    $theme = \Drupal::theme()->getActiveTheme();
    return  $base_url . '/' . $theme->getPath() . $path;
  }

  public static function iconsDir() {
    return drupal_get_path('theme', 'beam_theme') . '/beam_front/src/assets/icons';
  }

  public static function imagesDir() {
    return drupal_get_path('theme', 'beam_theme') . '/beam_front/src/assets/images';
  }

  public static function getBlockId($title) {
    $ids = \Drupal::entityQuery('block_content')
      ->condition('info', $title)
      ->execute();

    return $ids ? reset($ids) : NULL;
  }

  public static function getDisplayBlock($id) {
    $database = \Drupal::database();
    $query = $database->select('node__field_display', 'display');
    $query->join('node__field_blocks', 'blocks', 'display.entity_id = blocks.entity_id');
    $query->fields('display', ['field_display_value'])
      ->condition('blocks.field_blocks_target_id', $id)
      ->execute();

    return $query->execute()->fetchField();
  }

  public static function linkBuy($variables, $currentLanguageId) {
    $showLinkBuy = \Drupal::state()->get('show_link_buy');
    $showLinkResult = [];
    if ($showLinkBuy) {
      foreach ($showLinkBuy as $key => $showLinkValue) {
        if ($showLinkValue) $showLinkResult[] = $showLinkValue;
      }
    }
    if (in_array($currentLanguageId, $showLinkResult)) return \Drupal::state()->get('link_buy');

    return NULL;
  }

  public static function imageDisplay($id, $displayMode) {
    if ($id) {
      $file = File::load($id);
      if ($file) {
        $url = ImageStyle::load($displayMode)->buildUrl($file->getFileUri());
        return file_url_transform_relative($url);
      }
    }
    return NULL;
  }

  public static function imageUri($id) {
    if ($id) {
      $file = File::load($id);
      if ($file) return $file->getFileUri();
    }

    return NULL;
  }

  public static function getLanguagesCustomer() {
    $siteLanguages = \Drupal::languageManager()->getLanguages();

    $customerCountry = CookieHelper::getCustomerCountry();
    if ($customerCountry) {
      $idCountry = CountryHelper::getCountryIDByCode($customerCountry);
      if ($idCountry) {
        $country = Country::load($idCountry);
        $customerLanguages = $country->getCodeLanguages();

        $result = [];
        foreach ($customerLanguages as $language) {
          $result[$language] = TranslateHelper::getUntranslated($siteLanguages[$language]->getName());
        }

        return $result;
      }
    }

    // If country doesn't exist, return only English
    return $siteLanguages['en'];
  }

  public static function renderBlock($pluginId) {
    $block_manager = \Drupal::service('plugin.manager.block');
    $config = [];// You can hard code configuration or you load from settings.
    $plugin_block = $block_manager->createInstance($pluginId, $config);
    $build = $plugin_block->build();
    $render = render($build);

    return $render->__toString();
  }

  public static function getUntranslatedOperations(&$parent) {
    $links = $parent['operations']['data']['#links'];
    if (isset($links['edit'])) $parent['operations']['data']['#links']['edit']['title'] = 'Edit';
    if (isset($links['delete'])) $parent['operations']['data']['#links']['delete']['title'] = 'Delete';
  }
}
