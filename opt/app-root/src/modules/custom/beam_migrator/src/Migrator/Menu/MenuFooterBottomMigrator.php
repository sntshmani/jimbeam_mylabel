<?php

namespace Drupal\beam_migrator\Migrator\Menu;

use Drupal\beam_migrator\Migrator\MenuMigrator;

class MenuFooterBottomMigrator extends MenuMigrator {

  public function create($varThis) {
    $links = [
      'Beam Suntory' => [
        'link' => 'https://www.beamsuntory.com/',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 0,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Beam Suntory', 'link' => 'https://www.beamsuntory.de/'],
          'hu' => ['title' => 'Beam Suntory', 'link' => 'https://www.beamsuntory.com/'],
          'bg' => ['title' => 'Beam Suntory', 'link' => 'https://www.beamsuntory.com/'],
          'lv' => ['title' => 'Beam Suntory', 'link' => 'https://www.beamsuntory.com/'],
          'uk' => ['title' => 'Beam Suntory', 'link' => 'https://www.beamsuntory.com/'],
        ],
      ],
      'Marketing Code' => [
        'link' => 'https://www.beamsuntory.com/docs/BeamSuntoryMarketingCode_2015.pdf',
        'expanded' => 'en',
        'langcode' => 'en',
        'weight' => 1,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Marketing-Kodex', 'link' => 'https://www.beamsuntory.com/docs/BeamSuntoryMarketingCode_2015.pdf'],
          'hu' => ['title' => 'Marketing kód', 'link' => 'https://www.beamsuntory.com/docs/BeamSuntoryMarketingCode_2015.pdf'],
          'bg' => ['title' => 'Маркетингов код', 'link' => 'https://www.beamsuntory.com/docs/BeamSuntoryMarketingCode_2015.pdf'],
          'lv' => ['title' => 'Mārketinga kods', 'link' => 'https://www.beamsuntory.com/docs/BeamSuntoryMarketingCode_2015.pdf'],
          'uk' => ['title' => 'Маркетинговий кодекс', 'link' => 'https://www.beamsuntory.com/docs/BeamSuntoryMarketingCode_2015.pdf'],
        ],
      ],
      'Terms & Conditions' => [
        'link' => 'internal:/node/3',
        'expanded' => FALSE,
        'langcode' => 'en',
        'weight' => 2,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Nutzungsbedingungen', 'link' => 'https://www.jimbeam.com/de/nutzungsbedingungen'],
          'hu' => ['title' => 'Felhasználási feltételek', 'link' => 'internal:/node/3'],
          'bg' => ['title' => 'Правила и условия', 'link' => 'internal:/node/3'],
          'lv' => ['title' => 'Noteikumi', 'link' => 'internal:/node/3'],
          'uk' => ['title' => 'Правила та умови', 'link' => 'internal:/node/3'],
        ],
      ],
      'Supply Chain Transparency' => [
        'link' => 'https://www.beamsuntory.com/en/supply-chain-transparency',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 3,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Impressum', 'link' => 'https://www.jimbeam.com/de/impressum'],
          'hu' => ['title' => 'Az ellátási lánc átláthatósága', 'link' => 'https://www.beamsuntory.com/en/supply-chain-transparency'],
          'bg' => ['title' => 'Прозрачност на веригата за доставки', 'link' => 'https://www.beamsuntory.com/en/supply-chain-transparency'],
          'lv' => ['title' => 'Piegādes ķēdes caurspīdīgums', 'link' => 'https://www.beamsuntory.com/en/supply-chain-transparency'],
          'uk' => ['title' => 'Прозорість ланцюга поставок', 'link' => 'https://www.beamsuntory.com/en/supply-chain-transparency'],
        ],
      ],
      'About Our Ads' => [
        'link' => 'https://www.jimbeam.com/about-our-ads',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 4,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Über unsere Anzeigen', 'link' => 'https://www.jimbeam.com/de/uber-unsere-anzeigen'],
          'hu' => ['title' => 'A hirdetéseinkről', 'link' => 'https://www.jimbeam.com/about-our-ads'],
          'bg' => ['title' => 'За нашите реклами', 'link' => 'https://www.jimbeam.com/about-our-ads'],
          'lv' => ['title' => 'Par mūsu', 'link' => 'https://www.jimbeam.com/about-our-ads'],
          'uk' => ['title' => 'Про наші оголошення', 'link' => 'https://www.jimbeam.com/about-our-ads'],
        ],
      ],
      'Sitemap' => [
        'link' => 'https://www.jimbeam.com/sitemap',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 5,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Sitemap', 'link' => 'https://www.jimbeam.com/de/sitemap'],
          'hu' => ['title' => 'Oldaltérkép', 'link' => 'https://www.jimbeam.com/sitemap'],
          'bg' => ['title' => 'Карта на сайта', 'link' => 'https://www.jimbeam.com/sitemap'],
          'lv' => ['title' => 'Vietnes karte', 'link' => 'https://www.jimbeam.com/sitemap'],
          'uk' => ['title' => 'Карта сайту', 'link' => 'https://www.jimbeam.com/sitemap'],
        ],
      ],
    ];

    $varThis->menuLinkMigrator->createStructure($varThis, $links, 'footer-bottom');
  }
}
