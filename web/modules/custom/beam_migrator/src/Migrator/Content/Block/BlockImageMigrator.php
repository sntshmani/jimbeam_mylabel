<?php

namespace Drupal\beam_migrator\Migrator\Content\Block;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\beam_migrator\Migrator\Processor\ImageProcessor;
use Drupal\beam_migrator\Migrator\ContentMigrator;

class BlockImageMigrator extends ContentMigrator {

  public function createParagraph($image, $imageWithoutPhoto) {
    $paragraph = Paragraph::create([
      'type' => 'block_image',
      'field_image' => ImageProcessor::processInternal($image),
      'field_image_no_photo' => ImageProcessor::processInternal($imageWithoutPhoto),
    ]);
    $paragraph->save();

    return [
      'id' => $paragraph->id(),
      'revision_id' => $paragraph->getRevisionId(),
    ];
  }
}
