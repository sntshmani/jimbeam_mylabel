<?php

namespace Drupal\beam_misc\EventSubscriber;

use Drupal\beam_misc\Helper\CookieHelper;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MiscSubscriber implements EventSubscriberInterface {

  public function checkInitLanguage(GetResponseEvent $event) {
    $isFront = \Drupal::service('path.matcher')->isFrontPage();
    $currentLanguage = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $defaultLanguage = \Drupal::languageManager()->getDefaultLanguage()->getId();

    // Check for redirection in front if current language == 'EN'
    if ($isFront && ($currentLanguage == $defaultLanguage)) {
      $customerCountry = CookieHelper::getCustomerLanguage();

      if ($customerCountry && $customerCountry != $defaultLanguage) {
        $customerCountryObject = \Drupal::languageManager()->getLanguage($customerCountry);
        if (!$customerCountryObject) return;  // Do nothing

        $url = Url::fromRoute('<front>', [], ['language' => $customerCountryObject]);
        $response = new RedirectResponse($url->toString());
        $event->setResponse($response);
      }
    }
  }

  public function setCookie(GetResponseEvent $event) {
    $customerCountry = CookieHelper::getCustomerCountry();

    // Set cookie for logged user if doesn't exist cookie
    if (!\Drupal::currentUser()->isAnonymous() && !$customerCountry) {
      $redirect = new RedirectResponse(Url::fromRoute('<current>')->toString());

      $cookieValues = CookieHelper::setCustomerCountryValues();
      $domain = CookieHelper::getDomain();

      foreach ($cookieValues as $record) {
        // httpOnly = false to allow get cookie in front
        $cookie = new Cookie($record['name'], $record['value'], strtotime('now + 1 year'), '/', $domain, false, false);
        $redirect->headers->setCookie($cookie);
      }
      $event->setResponse($redirect);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['checkInitLanguage'];
    $events[KernelEvents::REQUEST][] = ['setCookie'];

    return $events;
  }

}
