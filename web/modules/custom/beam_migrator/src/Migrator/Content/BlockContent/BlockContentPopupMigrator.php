<?php

namespace Drupal\beam_migrator\Migrator\Content\BlockContent;

use Drupal\beam_migrator\Migrator\Processor\ImageProcessor;
use Drupal\block_content\Entity\BlockContent;
use Drupal\beam_migrator\Migrator\ContentMigrator;

class BlockContentPopupMigrator extends ContentMigrator {

  public function createBlock($title, $body, $label, $image) {
    $block = BlockContent::create([
      'info' => 'Popup',
      'type' => 'block_popup',
      'field_title' => $title,
      'field_body' => [
        'value' => $body,
        'format' => 'full_html'
      ],
      'field_label' => $label,
      'field_image' => ImageProcessor::processInternal($image),
    ]);
    $block->save();

    return $block->id();
  }

  public function translate($id, $lang, $title, $body, $label) {
    $block = BlockContent::load($id);
    $blockLang = $block->addTranslation($lang);

    $blockLang->field_title = $title;
    $blockLang->field_body = [
      'value' => $body,
      'format' => 'full_html'
    ];
    $blockLang->field_label = $label;
    $blockLang->save();

    return $blockLang;
  }
}
