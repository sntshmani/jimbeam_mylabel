<?php

namespace Drupal\beam_administration\Command;

use Drupal\beam_administration\Migrator\VarsMigrator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\ContainerAwareCommand;

/**
 * Class ExportCommand.
 *
 * Drupal\Console\Annotations\DrupalCommand (
 *     extension="beam_administration",
 *     extensionType="module"
 * )
 */
class ExportCommand extends ContainerAwareCommand {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('beam_administration:export')
      ->setDescription($this->trans('commands.beam_administration.export.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $export = new VarsMigrator();
    $result = $export->export();
    $export->write($result);

    $this->getIo()->info(t('Exported variables'));
  }

}
