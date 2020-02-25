<?php

namespace Drupal\beam_migrator\Migrator\Content\Block;

use Drupal\beam_migrator\Migrator\Processor\ImageProcessor;
use Drupal\block_content\Entity\BlockContent;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\beam_migrator\Migrator\ContentMigrator;

class BlockThanksMigrator extends ContentMigrator {

  public function createParagraph($title, $subtitle, $body, $uriLink, $titleLink, $image, $imageMobile) {
    $paragraph = Paragraph::create([
      'type' => 'block_thanks',
      'field_title' => $title,
      'field_subtitle' => $subtitle,
      'field_body' => [
        'value' => $body,
        'format' => 'full_html'
      ],
      'field_link' => [
        'uri' => $uriLink,
        'title' => $titleLink
      ],
      'field_image' => ImageProcessor::processInternal($image),
      'field_image_mobile' => ImageProcessor::processInternal($imageMobile),
    ]);
    $paragraph->save();

    return [
      'id' => $paragraph->id(),
      'revision_id' => $paragraph->getRevisionId(),
    ];
  }

  public function translate($id, $lang, $title, $subtitle, $body, $uriLink, $titleLink) {
    $paragraph = Paragraph::load($id);
    $paragraphLang = $paragraph->addTranslation($lang);

    $paragraphLang->field_title = $title;
    $paragraphLang->subtitle = $subtitle;
    $paragraphLang->field_body = [
      'value' => $body,
      'format' => 'full_html'
    ];
    $paragraphLang->field_link = [
      'uri' => $uriLink,
      'title' => $titleLink
    ];
    $paragraphLang->save();

    return [
      'id' => $paragraphLang->id(),
      'revision_id' => $paragraphLang->getRevisionId(),
    ];
  }


}
