<?php

namespace Drupal\beam_misc\Helper;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

class EntityHelper {

  public static function createFieldTextfield($label, $required) {
    return BaseFieldDefinition::create('string')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'max_length' => 254,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldTextarea($label, $description, $required) {
    return BaseFieldDefinition::create('string_long')
      ->setLabel(t($label))
      ->setDescription(t($description))
      ->setRequired($required)
      ->setSettings([
        'max_length' => 254,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string_long',
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_long',
        'text_processing' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldInteger($label, $required) {
    return BaseFieldDefinition::create('integer')
      ->setLabel($label)
      ->setRequired($required)
      ->setDefaultValue(0)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'settings' => [
          'display_label' => TRUE,
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldList($label, $required, $options, $multiple = FALSE) {
    $field = BaseFieldDefinition::create('list_string')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'allowed_values' => $options])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => $multiple ? 'options_buttons' : 'string_textfield',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    if ($multiple) $field->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);
    return $field;
  }

  public static function createFieldImage($label, $required) {
    return BaseFieldDefinition::create('image')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'alt_field' => FALSE,
        'alt_field_required' => FALSE,
        'title_field' => FALSE,
        'title_field_required' => FALSE,
        'file_extensions' => 'png jpg jpeg',
      ])
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'default',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'label' => 'hidden',
        'type' => 'image_image',
        'weight' => 0,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldEmail($label, $required) {
    return BaseFieldDefinition::create('email')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => 'email_default',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldBoolean($label) {
    return BaseFieldDefinition::create('boolean')
      ->setLabel($label)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'checked' => 'checked'
      ])
      ->setDisplayConfigurable('form', TRUE);
  }

  public static function createFieldEntityReference($label, $targetType, $required = FALSE) {
    return BaseFieldDefinition::create('entity_reference')
      ->setLabel($label)
      ->setRequired($required)
      ->setSetting('target_type', $targetType)
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

  }
}
