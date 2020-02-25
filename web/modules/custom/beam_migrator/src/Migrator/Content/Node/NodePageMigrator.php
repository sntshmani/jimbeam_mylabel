<?php

namespace Drupal\beam_migrator\Migrator\Content\Node;

use Drupal\node\Entity\Node;
use Drupal\beam_migrator\Migrator\ContentMigrator;

class NodePageMigrator extends ContentMigrator {

  public function createNode($title, $blocks, $display, $alias) {
    $node = Node::create([
      'type' => 'page',
      'langcode' => 'en',
      'created' => \Drupal::time()->getRequestTime(),
      'changed' => \Drupal::time()->getRequestTime(),
      'uid' => 1,
      'title' => $title,
      'field_display' => $display,
      'path' => [
        'alias' => $alias
      ]
    ]);
    if ($blocks) {
      foreach ($blocks as $block) {
        $node->field_blocks[] = [
          'target_id' => $block['id'],
          'target_revision_id' => $block['revision_id'],
        ];

      }
    }
    $node->save();

    return $node;
  }

  public function translateNode($node, $lang, $title, $blocks, $display, $alias) {

    $nodeLang = $node->addTranslation($lang);
    $nodeLang->title = $title;
    $nodeLang->field_display = $display;
    if ($blocks) {
      foreach ($blocks as $block) {
        $nodeLang->field_blocks[] = [
          'target_id' => $block['id'],
          'target_revision_id' => $block['revision_id'],
        ];
      }
    }
    $nodeLang->path = [
      'alias' => $alias,
    ];
    $nodeLang->save();

    return $nodeLang;
  }
}
