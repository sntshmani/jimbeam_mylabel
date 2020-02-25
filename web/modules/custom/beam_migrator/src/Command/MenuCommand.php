<?php

namespace Drupal\beam_migrator\Command;

use Drupal\beam_migrator\Migrator\MenuMigrator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\ContainerAwareCommand;

/**
 * Class MigrateCommand.
 *
 * Drupal\Console\Annotations\DrupalCommand (
 *     extension="beam_migrator",
 *     extensionType="module"
 * )
 */
class MenuCommand extends ContainerAwareCommand {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('beam_migrator:menu')
      ->setDescription($this->trans('commands.beam_migrator.menu.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $migrator = new MenuMigrator();
    $migrator->migrate();

    $this->getIo()->info('Created menus');
  }

}
