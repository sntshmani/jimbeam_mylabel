<?php

namespace Drupal\beam_migrator\Migrator;

use Drupal\beam_migrator\Helper\ContentHelper;
use Drupal\beam_migrator\Migrator\Menu\MenuFooterBottomMigrator;
use Drupal\beam_migrator\Migrator\Menu\MenuFooterMigrator;
use Drupal\beam_migrator\Migrator\Menu\MenuMainMigrator;
use Drupal\beam_migrator\Migrator\Menu\MenuLinkMigrator;
use Drupal\beam_migrator\Migrator\Menu\MenuMainMobileMigrator;

class MenuMigrator {

  protected $menuLinkMigrator;

  public function __construct() {}

  private function init() {
    $this->menuLinkMigrator = new MenuLinkMigrator();
  }

  public function clean() {
    $this->cleanMenus();
    $this->resetEntities();
  }


  private function resetEntities() {
    $this->resetMenuId();
  }

  private function resetMenuId() {
    $database = \Drupal::database();
    $database->query('ALTER TABLE {menu_link_content} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {menu_link_content_data} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {menu_link_content_field_revision} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {menu_link_content_revision} AUTO_INCREMENT = 1')->execute();
  }

  public function cleanMenus() {
    print ('Cleaning menus') . PHP_EOL;
    $menus = ContentHelper::getMenus();
    $mids = \Drupal::entityQuery('menu_link_content')
      ->condition('menu_name', $menus, 'IN')
      ->sort('weight')
      ->execute();

    $controller = \Drupal::entityTypeManager()->getStorage('menu_link_content');
    $entities = $controller->loadMultiple($mids);
    $controller->delete($entities);

    $query = \Drupal::database()->delete('menu_tree');
    $query->condition('menu_name', $menus, 'IN');
    $query->execute();
  }


  public function migrate() {
    print ('------------------------------') . PHP_EOL;
    $this->clean();
    $this->init();

    $menuMainMigrator = new MenuMainMigrator();
    $menuMainMigrator->create($this);

    $menuMainMobileMigrator = new MenuMainMobileMigrator();
    $menuMainMobileMigrator->create($this);

    $menuFooterMigrator = new MenuFooterMigrator();
    $menuFooterMigrator->create($this);

    $menuFooterBottomMigrator = new MenuFooterBottomMigrator();
    $menuFooterBottomMigrator->create($this);
  }

}
