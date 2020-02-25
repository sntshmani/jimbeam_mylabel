<?php

namespace Drupal\beam_order\Form;

use Drupal\beam_customer\Entity\Customer;
use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\ImageHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_order\Entity\Order;
use Drupal\beam_order\Helper\OrderAdminFormHelper;
use Drupal\beam_order\Save\OrderSave;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Image\Image;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class LabelAdminForm extends FormBase {

  public function getFormId() {
    return 'beam_order_label_admin_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    $country = OrderAdminFormHelper::getCountryEntity();
    $showPicture = CountryHelper::getEnabledImageLabelByCode($country->getCode());

    $form['code'] = [
      '#type' => 'textfield',
      '#title' => t('Coupon Code'),
      '#required' => TRUE,
    ];

    $form['bottle'] = [
      '#type' => 'select',
      '#title' => t('Bottle'),
      '#options' => OrderAdminFormHelper::getBottles($country),
      '#required' => TRUE,
    ];

    if ($showPicture) {
      $form['picture'] = [
        '#type' => 'managed_file',
        '#title' => t('Picture'),
        '#description' => t('Upload image, allowed extensions: jpg png'),
        '#upload_location' => 'public://import/',
        '#upload_validators'  => array(
          'file_validate_extensions' => array('jpeg jpg png'),
        ),
        '#default_value' => NULL,
        '#required' => TRUE,
      ];
    }

    $form['subhead'] = [
      '#type' => 'select',
      '#title' => t('Subhead'),
      '#options' => CountryHelper::getOptionsByCodeField($country->getCode()),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => t('Label'),
      '#required' => TRUE,
    ];

    $form['customer_name'] = [
      '#type' => 'textfield',
      '#title' => t('Customer Name'),
      '#required' => TRUE,
    ];

    $form['customer_surname'] = [
      '#type' => 'textfield',
      '#title' => t('Customer Surname'),
      '#required' => TRUE,
    ];

    $form['customer_email'] = [
      '#type' => 'email',
      '#title' => t('E-mail'),
      '#required' => TRUE,
    ];

    $form['customer_address'] = [
      '#type' => 'textfield',
      '#title' => t('Address'),
      '#required' => TRUE,
    ];

    $form['customer_phone'] = [
      '#type' => 'textfield',
      '#title' => t('Phone'),
      '#required' => TRUE,
    ];

    $form['customer_city'] = [
      '#type' => 'textfield',
      '#title' => t('City'),
      '#required' => TRUE,
    ];

    $form['customer_postal_code'] = [
      '#type' => 'textfield',
      '#title' => t('Postal Code'),
      '#required' => TRUE,
    ];

    $form['submit_button'] = [
      '#type' => 'submit',
      '#value' => t('Save label'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $country = OrderAdminFormHelper::getCountry();
    $label = $form_state->getValue('label');
    $coupon = $form_state->getValue('code');

    $isProhibited = OrderHelper::isProhibitedWord($label);
    $availableCoupon = CodeHelper::availableCoupon($coupon, $country);

    if ($isProhibited) $form_state->setErrorByName('label', t('Prohibited word'));
    if (!$availableCoupon) $form_state->setErrorByName('code', t('Unavailable coupon code'));
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $country = OrderAdminFormHelper::getCountry();
    $countryId = OrderAdminFormHelper::getIDCountry();
    $coupon = $form_state->getValue('code');
    $couponId = CodeHelper::getId($coupon, $countryId);
    $imagickID = OrderAdminFormHelper::getImageID($form_state, $country);

    // Save customer
    $customer = Customer::create([
      'name' => $form_state->getValue('customer_name'),
      'surname' => $form_state->getValue('customer_surname'),
      'email' => $form_state->getValue('customer_email'),
      'address1' => $form_state->getValue('customer_address'),
      'phone_code' => OrderAdminFormHelper::getPhoneCode($country),
      'phone' => $form_state->getValue('customer_phone'),
      'city' => $form_state->getValue('customer_city'),
      'postal_code' => $form_state->getValue('customer_postal_code'),
      'country_id' => $countryId,
    ]);
    $customer->save();

    // Save label
    $order = Order::create([
      'bottle' => $form_state->getValue('bottle'),
      'image_picture' => $imagickID,
      'image_subhead' => $form_state->getValue('subhead'),
      'image_label' => $form_state->getValue('label'),
      'code_id' => $couponId,
      'customer_id' => $customer->id(),
      'country_id' => $countryId,
      'terms' => 0,
      'privacy_policy' => 0,
      'offers_jimbeam' => 0,
      'offers_beamsuntory' => 0,

    ]);
    $current = \Drupal::currentUser();
    if ($current->id()) $order->setOwnerId($current->id());
    $order->setStatus(0);
    $order->save();

    // Update coupon code
    OrderSave::updateCouponCode($couponId);

    \Drupal::messenger()->addMessage(t('Saved label'));

    $form_state->setRedirect('beam_order.view');
  }
}
