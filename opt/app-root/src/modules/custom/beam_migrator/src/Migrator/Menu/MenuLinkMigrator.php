<?php

namespace Drupal\beam_migrator\Migrator\Menu;

use Drupal\beam_migrator\Migrator\ContentMigrator;
use Drupal\beam_migrator\Migrator\MenuMigrator;
use Drupal\menu_link_content\Entity\MenuLinkContent;

class MenuLinkMigrator extends MenuMigrator {

  public function createStructure($varThis, $links, $menuName) {
    foreach ($links as $title => $link) {
      $menuLink = $varThis->menuLinkMigrator->createMenuLink($title, $link['link'], $menuName, $link['expanded'], $link['langcode'], $link['weight'], NULL);
      if ($link['below']) {
        foreach ($link['below'] as $titleBelow => $below) {
          $menuBelow = $varThis->menuLinkMigrator->createMenuLink($titleBelow, $below['link'], $menuName, $below['expanded'], $below['langcode'], $below['weight'], $menuLink->uuid());
          if (isset($below['languages'])) {
            foreach ($below['languages'] as $langcodeBelow => $languageBelow) {
              $varThis->menuLinkMigrator->translateMenuLink($menuBelow, $langcodeBelow, $languageBelow['title'], $languageBelow['link']);
            }
          }
        }
      }
      if (isset($link['languages'])) {
        foreach ($link['languages'] as $langcode => $language) {
          $varThis->menuLinkMigrator->translateMenuLink($menuLink, $langcode, $language['title'], $language['link']);
        }
      }
    }
  }

  public function createMenuLink($title, $link, $menuName, $expanded, $langcode, $weight, $parent = NULL) {
    $parent = $parent ? 'menu_link_content:' . $parent : NULL;

    $menuLink = MenuLinkContent::create([
      'title' => $title,
      'link' => $link,
      'menu_name' => $menuName,
      'expanded' => $expanded,
      'langcode' => $langcode,
      'weight' => $weight,
      'parent' => $parent
    ]);
    $menuLink->save();

    return $menuLink;
  }

  public function translateMenuLink($menuLink, $langcode, $title, $link) {
    $menuLinkLang = $menuLink->addTranslation($langcode);
    $menuLinkLang->title = $title;
    $menuLinkLang->link_override = $link;
    $menuLinkLang->save();
  }
}
