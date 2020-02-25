<?php

namespace Drupal\beam_country\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface for defining Country entities.
 *
 * @ingroup beam_country
 */
interface CountryInterface extends ContentEntityInterface {

  public function getCode();
  public function getCountry();
  public function getCountryLanguages();
  public function getDefaultLanguage();
  public function getCodeLanguages();
  public function getProhibitedWords();
  public function getSubheadOptions();
  public function isEnabled();
  public function isEnabledBottleOption($key);

  public function setCode($code);
}
