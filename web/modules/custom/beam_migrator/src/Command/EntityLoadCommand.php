<?php

namespace Drupal\beam_migrator\Command;

use Drupal\beam_migrator\Migrator\EntityLoadMigrator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
class EntityLoadCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('beam_migrator:entity_load')
      ->setDescription($this->trans('commands.beam_migrator.entity_load.description'))
      ->addOption('type', NULL, InputOption::VALUE_REQUIRED, '');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $type = $input->getOption('type');
    $migrator = new EntityLoadMigrator($type);
    $migrator->load();
    $this->getIo()->info('Load ' . $type);
  }

}
