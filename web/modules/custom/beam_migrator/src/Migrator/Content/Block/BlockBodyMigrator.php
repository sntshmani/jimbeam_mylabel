<?php

namespace Drupal\beam_migrator\Migrator\Content\Block;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\beam_migrator\Migrator\ContentMigrator;

class BlockBodyMigrator extends ContentMigrator {

  public function createParagraph($title, $subtitle, $body, $uriLinkButton, $titleLinkButton, $uriLink, $titleLink, $color) {
    $paragraph = Paragraph::create([
      'type' => 'block_body',
      'field_title' => $title,
      'field_subtitle' => $subtitle,
      'field_body' => [
        'value' => $body,
        'format' => 'full_html'
      ],
      'field_link_button' => [
        'uri' => $uriLinkButton,
        'title' => $titleLinkButton
      ],
      'field_link' => [
        'uri' => $uriLink,
        'title' => $titleLink
      ],
      'field_background_color' => $color
    ]);
    $paragraph->save();

    return [
      'id' => $paragraph->id(),
      'revision_id' => $paragraph->getRevisionId(),
    ];
  }

  public static function translate($id, $lang, $title, $subtitle, $body, $uriLinkButton, $titleLinkButton, $uriLink, $titleLink, $color) {
    $paragraph = Paragraph::load($id);
    $paragraphLang = $paragraph->addTranslation($lang);

    $paragraphLang->field_title = $title;
    $paragraphLang->field_subtitle = $subtitle;
    $paragraphLang->field_body = [
      'value' => $body,
      'format' => 'full_html'
    ];
    $paragraphLang->field_link_button = [
      'uri' => $uriLinkButton,
      'title' => $titleLinkButton
    ];
    $paragraphLang->field_link = [
      'uri' => $uriLink,
      'title' => $titleLink
    ];
    $paragraphLang->field_background_color = $color;

    $paragraphLang->save();

    return [
      'id' => $paragraphLang->id(),
      'revision_id' => $paragraphLang->getRevisionId(),
    ];
  }
}
