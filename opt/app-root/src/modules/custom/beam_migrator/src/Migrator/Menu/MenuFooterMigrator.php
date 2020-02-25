<?php

namespace Drupal\beam_migrator\Migrator\Menu;

use Drupal\beam_migrator\Migrator\MenuMigrator;

class MenuFooterMigrator extends MenuMigrator {

  public function create($varThis) {
    $links = [
      'Contact Us' => [
        'link' => 'https://www.jimbeam.com/contact',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 0,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Kontakt', 'link' => 'https://www.jimbeam.com/de/kontakt'],
          'hu' => ['title' => 'Lépjen kapcsolatba velünk', 'link' => 'https://www.jimbeam.com/contact'],
          'bg' => ['title' => 'Свържете се с нас', 'link' => 'https://www.jimbeam.com/contact'],
          'lv' => ['title' => 'Sazinies ar mums', 'link' => 'https://www.jimbeam.com/contact'],
          'uk' => ['title' => 'Зв\'яжіться з нами', 'link' => 'https://www.jimbeam.com/contact'],
        ],
      ],
      'FAQ' => [
        'link' => 'https://www.jimbeam.com/faq',
        'expanded' => 'en',
        'langcode' => 'en',
        'weight' => 1,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'FAQ', 'link' => 'https://www.jimbeam.com/de/faq'],
          'hu' => ['title' => 'GYIK', 'link' => 'https://www.jimbeam.com/faq'],
          'bg' => ['title' => 'ЧЗВ', 'link' => 'https://www.jimbeam.com/faq'],
          'lv' => ['title' => 'BUJ', 'link' => 'https://www.jimbeam.com/faq'],
          'uk' => ['title' => 'FAQ', 'link' => 'https://www.jimbeam.com/faq'],
        ],
      ],
      'Privacy Policy' => [
        'link' => 'https://www.jimbeam.com/privacy',
        'expanded' => FALSE,
        'langcode' => 'en',
        'weight' => 2,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Datenschutzerklärung', 'link' => 'https://www.jimbeam.com/de/datenschutzerklarung'],
          'hu' => ['title' => 'Adatvédelmi irányelvek', 'link' => 'https://www.jimbeam.com/privacy'],
          'bg' => ['title' => 'Политика за поверителност', 'link' => 'https://www.jimbeam.com/privacy'],
          'lv' => ['title' => 'Privātuma politika', 'link' => 'https://www.jimbeam.com/privacy'],
          'uk' => ['title' => 'Політика конфіденційності', 'link' => 'https://www.jimbeam.com/privacy'],
        ],
      ],
      'Cookie Policy' => [
        'link' => 'https://www.jimbeam.com/cookie-policy',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 3,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Cookie Policy', 'link' => 'https://www.jimbeam.com/de/cookie-policy'],
          'hu' => ['title' => 'Cookie Policylicy', 'link' => 'https://www.jimbeam.com/cookie-policy'],
          'bg' => ['title' => 'Политика за бисквитки', 'link' => 'https://www.jimbeam.com/cookie-policy'],
          'lv' => ['title' => 'Sīkdatņu politika', 'link' => 'https://www.jimbeam.com/cookie-policy'],
          'uk' => ['title' => 'Політика щодо файлів cookie', 'link' => 'https://www.jimbeam.com/cookie-policy'],
        ],
      ],
    ];

    $varThis->menuLinkMigrator->createStructure($varThis, $links, 'footer');
  }
}
