<?php

namespace Drupal\beam_order\Helper;

use Drupal\beam_misc\Helper\CodeHelper;
use Drupal\beam_misc\Helper\CountryHelper;
use Drupal\beam_misc\Helper\CustomerHelper;
use Drupal\beam_misc\Helper\OrderHelper;
use Drupal\beam_order\Query\OrderFieldsQuery;
use Drupal\Core\Link;
use Drupal\Core\Url;

class OrderQueryHelper {

  public static function recordQueryToArray($record, $countries, $display) {
    $comments = self::comments($record);
    $countryCode = CountryHelper::getCountryCodeByID($record->country_id);
    $formatCreated = $display == 'view' ? 'm/d/Y H:i:s' : 'm-d-Y';
    $phone = CustomerHelper::getPhoneFull($record);

    $result = [
      'id' => $record->id,
      'code' => OrderFieldsQuery::code($record->code_id),
      'bottle' => $record->bottle ? OrderHelper::getBottle($record->bottle): '',
      'image_subhead' => $record->image_subhead ? $record->image_subhead : '',
      'image_label' => $record->image_label ? $record->image_label : '',
      'image_picture' => OrderFieldsQuery::imagePicture($record->image_picture__target_id, $display),
      'pdf_url' => OrderFieldsQuery::pdfUrl($record->pdf_url, $record->status, $display),
      'customer' => OrderFieldsQuery::customer($record->customer_id, $display),
      'first_name' => OrderFieldsQuery::customerFirstName($record->customer_id, $display),
      'address1' => $record->address1 ? $record->address1 : '',
      'address2' => $record->address2 ? $record->address2 : '',
      'address3' => $record->address3 ? $record->address3 : '',
      'postal_code' => $record->postal_code ? $record->postal_code : '',
      'city' => $record->city ? $record->city : '',
      'phone' => $phone ? $phone : '',
      'email' => $record->email ? $record->email : '',
      'country' => $countryCode ? $countries[$countryCode]->getUntranslatedString() : '',
      'terms' => CodeHelper::getBooleanValue($record->terms),
      'privacy_policy' => CodeHelper::getBooleanValue($record->privacy_policy),
      'offers_jimbeam' => CodeHelper::getBooleanValue($record->offers_jimbeam),
      'offers_beamsuntory' => CodeHelper::getBooleanValue($record->offers_beamsuntory),
      'status' => OrderHelper::getStatusLabel($record->status),
      'created' => date($formatCreated, $record->created),
      'comments_count' => Link::fromTextAndUrl(\Drupal::service('renderer')->render($comments['cell']), $comments['url'])->toString()
    ];

    if ($display == 'excel') {
      $result += [
        'bottle_size' => $record->bottle ? OrderHelper::getBottleSize($record->bottle) : '',
        'country_code' => $countryCode,
      ];
    }

    return $result;
  }

  private static function comments($record) {
    $comment_count = !empty($record->comment_count) ? $record->comment_count : 0;
    $comments_route = empty($comment_count) ? 'beam_order.add_comment' : 'beam_order.view_comments';
    $comments_url = Url::fromRoute($comments_route, ['beam_order' => $record->id]);
    $comments_url->setOptions([
      'attributes' => [
        'class' => ['use-ajax'],
        'data-dialog-type' => 'modal',
      ],
      'language' => \Drupal::languageManager()->getLanguage('en')
    ]);
    $image = [
      '#type' => 'html_tag',
      '#tag' => 'img',
      '#attributes' => [
        'src' => '/' . drupal_get_path('module', 'beam_order') . '/images/add-comment-icon.png',
        'style' => 'width: 20px; margin-left: 10px; position: absolute;'
      ],
    ];
    return [
      'cell' => [
        ['#markup' => $comment_count],
        $image
      ],
      'url' => $comments_url
    ];
  }
}
