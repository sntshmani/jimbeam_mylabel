<?php

namespace Drupal\beam_migrator\Command;

use Drupal\beam_migrator\Migrator\BeamCodeMigrator;
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
class BeamCodeCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('beam_migrator:beam_code')
      ->setDescription($this->trans('commands.beam_migrator.beam_code.description'))
      ->addOption('filename', NULL, InputOption::VALUE_REQUIRED, '')
      ->addOption('country', NULL, InputOption::VALUE_REQUIRED, '');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $filename = $input->getOption('filename');
    $countryCode = $input->getOption('country');

    $pathfile = drupal_get_path('module', 'beam_migrator') . '/resources/codes/' . $filename;
    $migrator = new BeamCodeMigrator($pathfile, $countryCode);
    $migrator->migrate();
    $this->getIo()->info('Created codes');
  }

}
