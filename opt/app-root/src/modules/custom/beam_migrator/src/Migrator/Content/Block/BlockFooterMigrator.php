<?php

namespace Drupal\beam_migrator\Migrator\Content\Block;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\beam_migrator\Migrator\ContentMigrator;

class BlockFooterMigrator extends ContentMigrator {

  public function createParagraph($body) {
    $paragraph = Paragraph::create([
      'type' => 'block_footer',
      'field_body' => [
        'value' => $body,
        'format' => 'full_html'
      ],
    ]);
    $paragraph->save();

    return [
      'id' => $paragraph->id(),
      'revision_id' => $paragraph->getRevisionId(),
    ];
  }

  public static function translate($id, $lang, $body) {
    $paragraph = Paragraph::load($id);
    $paragraphLang = $paragraph->addTranslation($lang);

    $paragraphLang->field_body = [
      'value' => $body,
      'format' => 'full_html'
    ];
    $paragraphLang->save();

    return [
      'id' => $paragraphLang->id(),
      'revision_id' => $paragraphLang->getRevisionId(),
    ];
  }
}
