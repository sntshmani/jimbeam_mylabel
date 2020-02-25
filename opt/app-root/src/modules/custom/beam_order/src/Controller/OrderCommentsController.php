<?php

namespace Drupal\beam_order\Controller;

use Drupal\beam_order\Entity\OrderInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class OrderCommentsController extends ControllerBase {

  public function show(OrderInterface $beam_order) {
    $comment_storage = \Drupal::entityTypeManager()->getStorage('comment');
    $options = [
      'dialogClass' => 'popup-dialog-class',
      'width' => '70%',
    ];
    $content = [];
    $comments = $comment_storage->loadThread($beam_order, $beam_order->field_order_comments->getFieldDefinition()->getName(), \Drupal\comment\CommentManagerInterface::COMMENT_MODE_FLAT);
    foreach ($comments as $comment) {
      $content[] = [
        '#theme' => 'beam_order_comment',
        '#user' => $comment->getOwner()->toLink(),
        '#date' => \Drupal::service('date.formatter')->format($comment->getCreatedTime(), 'short'),
        '#body' => $comment->field_order_comment_body->value
      ];
    }
    $add_comment_url = Url::fromRoute('beam_order.add_comment', ['beam_order' => $beam_order->id()])->setOptions([
      'attributes' => [
        'class' => ['button', 'use-ajax'],
        'style' => 'margin-top: 20px',
        'data-dialog-type' => 'modal',
      ],
      'language' => \Drupal::languageManager()->getLanguage('en')
    ]);
    $content[] = Link::fromTextAndUrl('Add comment', $add_comment_url)->toRenderable();
    $response = new AjaxResponse();
    $response->addCommand(new OpenModalDialogCommand(t('Comments'), $content, $options));

    return $response;
  }

  public function add(OrderInterface $beam_order) {
    $options = [
      'dialogClass' => 'popup-dialog-class',
      'width' => '70%',
    ];
    $values = array(
      'entity_type' => 'beam_order',
      'entity_id' => $beam_order->id(),
      'field_name' => 'field_order_comments',
      'comment_type' => 'order_comment',
      'pid' => NULL,
    );
    $comment = \Drupal::entityTypeManager()->getStorage('comment')->create($values);
    $form = \Drupal::service('entity.form_builder')->getForm($comment);
    $form['#action'] .= '?destination=/admin/label';
    if (!empty($form['field_order_comment_body']['widget'][0]['value']['#title'])) {
      unset($form['field_order_comment_body']['widget'][0]['value']['#title']);
    }
    $response = new AjaxResponse();
    $response->addCommand(new OpenModalDialogCommand(t('Add comment'), $form, $options));

    return $response;
  }
}
