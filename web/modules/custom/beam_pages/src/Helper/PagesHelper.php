<?php

namespace Drupal\beam_pages\Helper;

use Drupal\beam_country\Entity\Country;
use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\MiscHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_order\Entity\Order;
use Drupal\Core\Locale\CountryManager;

class PagesHelper {

  public static function getDisplayOptions($showPhone = TRUE) {
    $countryValues = self::getCountryValues();

    $result = [
      '#subhead_options' => $countryValues['subhead'],
      '#bottles' => $countryValues['bottles'],
      '#enabled' => $countryValues['enabled'],
      '#fixed_images' => OrderHelper::getFixedImagesBottles(),
      '#step_label' => self::getStepLabelValues(),
      '#default_country' => $countryValues['code'],
      '#country_name' => $countryValues['name'],
      '#show_picture_label' => $countryValues['image_label'],
    ];

    if ($showPhone) {
      $phoneCodes = OrderHelper::getPhoneCodes();
      $defaultPhoneCode = $countryValues['code'] ? $phoneCodes[$countryValues['code']] : NULL;

      $result['#phone_codes'] = $phoneCodes;
      $result['#default_phone_code'] = $defaultPhoneCode;
    }

    return $result;
  }

  private static function getCountryValues() {
    $country = CookieHelper::getCustomerCountryEntity();
    if ($country) {
      $subheadOptions = $country->getSubheadOptions();
      $bottles = OrderHelper::getEnabledBottles($country);
      $imageLabel = $country->isEnabledBottleOption('label_image');

      return [
        'subhead' => MiscHelper::textareaKeysToArray($subheadOptions),
        'enabled' => count($bottles),
        'image_label' => $imageLabel ? true : false,
        'bottles' => $bottles,
        'code' => $country->getCode(),
        'name' => $country->getCountry()
      ];
    }

    return [
      'subhead' => [],
      'enabled' => 0,
      'image_label' => false,
      'bottles' => [],
      'code' => NULL,
    ];
  }

  private static function getStepLabelValues() {
    $vars = array_keys(self::getStepLabel());
    $result = [];

    foreach ($vars as $var) {
      $value = \Drupal::state()->get($var);
      $result[$var] = $value ? t($value) : NULL;
    }

    return $result;
  }

  public static function getStepLabel() {
    return [
      'step_1_title' => [
        'type' => 'textfield',
        'label' => t('Step 1 title')
      ],
      'step_1_text' => [
        'type' => 'textfield',
        'label' => t('Step 1 Text')
      ],
      'step_1_error' => [
        'type' => 'textfield',
        'label' => t('Step 1 Error Message')
      ],
      'step_2_title' => [
        'type' => 'textfield',
        'label' => t('Step 2 Title')
      ],
      'step_2_legal' => [
        'type' => 'textarea',
        'label' => t('Step 2 Legal Text')
      ],
      'step_2_legal_without_picture' => [
        'type' => 'textarea',
        'label' => t('Step 2 Legal Text without picture')
      ],
      'step_2_error' => [
        'type' => 'textfield',
        'label' => t('Step 2 Error Message')
      ],
      'step_2_file' => [
        'type' => 'textfield',
        'label' => t('Step 2 Error Max Filesize')
      ],
      'step_2_prohibited' => [
        'type' => 'textfield',
        'label' => t('Step 2 Prohibited Word')
      ],
      'step_2_info' => [
        'type' => 'textfield',
        'label' => t('Step 2 Info Image')
      ],
      'step_3_title' => [
        'type' => 'textfield',
        'label' => t('Step 3 Title')
      ],
      'step_3_code_title' => [
        'type' => 'textfield',
        'label' => t('Step 3 Code Title')
      ],
      'step_3_code_text' => [
        'type' => 'text_format',
        'label' => t('Step 3 Code Text')
      ],
      'step_3_code_unique' => [
        'type' => 'textfield',
        'label' => t('Step 3 Code Unique')
      ],
      'step_3_personal_title' => [
        'type' => 'textfield',
        'label' => t('Step 3 Personal Title')
      ],
      'step_3_personal_text' => [
        'type' => 'text_format',
        'label' => t('Step 3 Personal Text')
      ],
      'step_3_permission_title' => [
        'type' => 'textfield',
        'label' => t('Step 3 Permission Title')
      ],
      'step_3_permission_text' => [
        'type' => 'text_format',
        'label' => t('Step 3 Permission Text')
      ],
      'step_help' => [
        'type' => 'text_format',
        'label' => t('Help text')
      ],
    ];
  }
}
