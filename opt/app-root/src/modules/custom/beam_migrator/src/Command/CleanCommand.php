<?php

namespace Drupal\beam_migrator\Command;

use Drupal\beam_migrator\Migrator\ContentMigrator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;

/**
 * Class CleanCommand.
 *
 * Drupal\Console\Annotations\DrupalCommand (
 *     extension="beam_migrator",
 *     extensionType="module"
 * )
 */
class CleanCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('beam_migrator_clean:clean')
      ->setDescription($this->trans('commands.beam_migrator_clean.clean.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $migrator = new ContentMigrator();
    $migrator->clean();
    $this->getIo()->info('Cleaned entities');
  }

}
