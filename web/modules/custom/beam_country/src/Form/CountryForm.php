<?php

namespace Drupal\beam_country\Form;

use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for Country edit forms.
 *
 * @ingroup beam_country
 */
class CountryForm extends ContentEntityForm {

  /**
   * The current user account.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    $instance = parent::create($container);
    $instance->account = $container->get('current_user');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $isAdmin = UserHelper::isAdmin();
    if (!$isAdmin) {
      $form['code']['#disabled'] = true;
      $form['enabled']['#access'] = false;
    }

    // Group bottle labels
    $form['group_bottles'] = array(
      '#type' => 'fieldset',
      '#title' => t('Show bottles in country'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#weight' => 3
    );
    $keys = OrderHelper::getBottlesKeys();
    foreach ($keys as $key) {
      $form['group_bottles'][$key] = $form[$key];
      unset($form[$key]);
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Country.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Country.', [
          '%label' => $entity->label(),
        ]));
    }
  }

}
