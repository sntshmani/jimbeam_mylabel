<?php

namespace Drupal\beam_migrator\Command;

use Drupal\beam_migrator\Migrator\ContentMigrator;
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
class ContentCommand extends ContainerAwareCommand {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('beam_migrator:content')
      ->setDescription($this->trans('commands.beam_migrator.content.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $migrator = new ContentMigrator();
    $migrator->migrate();

    $this->getIo()->info('Created nodes');
  }

}
