<?php

namespace Drupal\beam_order\Query\Header;

use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_misc\Helper\UserHelper;
use Drupal\beam_order\Helper\OrderQueryHelper;

class OrderHeader {

  public static function headerView() {
    return [
      // Not ID in labels view
      'code' => [
        'data' => 'Customer Code',
        'field' => 'code_id',
        'specifier' => 'code_id',
      ],
      'bottle' => [
        'data' => 'Bottle',
      ],
      'image_subhead' => [
        'data' => 'Subhead',
        'field' => 'image_subhead',
        'specifier' => 'image_subhead',
      ],
      'image_label' => [
        'data' => 'Label',
        'field' => 'image_label',
        'specifier' => 'image_label',
      ],
      'image_picture' => [
        'data' => 'Image Picture'
      ],
      'pdf_url' => [
        'data' => 'PDF Url'
      ],
      'customer' => [
        'data' => 'Customer Name',
        'field' => 'customer_id',
        'specifier' => 'customer_id',
      ],
      'email' => [
        'data' => 'Email',
        'field' => 'email',
        'specifier' => 'email',
      ],
      'phone' => [
        'data' => 'Phone'
      ],
      'address1' => [
        'data' => 'Address 1',
        'field' => 'address1',
        'specifier' => 'address1',
      ],
      'address2' => [
        'data' => 'Address 2',
        'field' => 'address2',
        'specifier' => 'address2',
      ],
      'address3' => [
        'data' => 'Address 3',
        'field' => 'address3',
        'specifier' => 'address3',
      ],
      'city' => [
        'data' => 'City',
        'field' => 'city',
        'specifier' => 'city',
      ],
      'country' => [
        'data' => 'Country',
        'field' => 'country_id',
        'specifier' => 'country_id',
      ],
      'postal_code' => [
        'data' => 'Postal Code',
        'field' => 'postal_code',
        'specifier' => 'postal_code',
      ],
      'terms' => [
        'data' => 'Terms & Conditions',
        'field' => 'terms',
        'specifier' => 'terms',
      ],
      'privacy_policy' => [
        'data' => 'Privacy Policy',
        'field' => 'privacy_policy',
        'specifier' => 'privacy_policy',
      ],
      'offers_jimbeam' => [
        'data' => 'Offers Jimbeam',
        'field' => 'offers_jimbeam',
        'specifier' => 'offers_jimbeam',
      ],
      'offers_beamsuntory' => [
        'data' => 'Offers Beam Suntory',
        'field' => 'offers_beamsuntory',
        'specifier' => 'offers_beamsuntory',
      ],
      'status' => [
        'data' => 'Status',
        'field' => 'status',
        'specifier' => 'status',
      ],
      'created' => [
        'data' => 'Created',
        'field' => 'created',
        'specifier' => 'created',
      ],
      'comments_count' => [
        'data' => 'Comments'
      ],
    ];
  }

  public static function headerExport() {
    return [
      'customer' => 'Shipping Name',
      'address1' => 'Shipping address',
      'postal_code' => 'Post Code',
      'city' => 'City',
      'country' => 'Country',
      'phone' => 'Phone Number',
      'email' => 'Shipping Email',
      'image_subhead' => 'Personalized text from the drop down list',
      'image_label' => 'Personalised Name',
      'empty' => 'Empty',
      'font' => 'Font',
      'first_name' => 'First name',
      'bottle_size' => 'Bottle/label size',
      'created' => 'Entry Created On',
    ];
  }
}
