<?php

namespace Drupal\beam_misc\StackMiddleware;

use Drupal\page_cache\StackMiddleware\PageCache;
use Symfony\Component\HttpFoundation\Request;

/**
 * Extends PageCache to include cookie value in the Cache ID.
 */
class CookieCustomerCountry extends PageCache {

  /**
   * @inheritdoc
   */
  protected function getCacheId(Request $request) {

    if (!isset($this->cid)) {
      $cid_parts = [
        $request->getSchemeAndHttpHost() . $request->getRequestUri(),
      ];
      $cookie = $request->cookies->get('customer-country');
      if ($cookie) $cid_parts[] = $cookie;

      $this->cid = implode(':', $cid_parts);
    }

    return $this->cid;
  }

}
