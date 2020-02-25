<?php

namespace Drupal\beam_code\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface for defining Coupon entities.
 *
 * @ingroup beam_code
 */
interface CodeInterface extends ContentEntityInterface {

  public function getLabel();
  public function getRemaining();
  public function getCurrent();
  public function getUnlimited();
  public function getUnlimitedLabel();
  public function getCountryID();
  public function getCountry();
  public function getProvider();

  public function setLabel($label);
  public function setCountryId($countryId);
  public function setRemaining($remaining);
  public function setCurrent($current);
  public function setProvider($provider);
}
