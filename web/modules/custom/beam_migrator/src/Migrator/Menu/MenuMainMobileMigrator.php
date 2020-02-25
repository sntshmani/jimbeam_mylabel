<?php

namespace Drupal\beam_migrator\Migrator\Menu;

use Drupal\beam_migrator\Migrator\MenuMigrator;

class MenuMainMobileMigrator extends MenuMigrator {

  public function create($varThis) {
    $links = [
      'Our Bourbon' => [
        'link' => 'route:<nolink>',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 0,
        'below' => [
          'Go To Our Bourbon' => [
            'link' => 'https://www.jimbeam.com/bourbons',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 0, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Gehen Unser Bourbon', 'link' => 'https://www.jimbeam.com/de/unser-bourbon'],
              'hu' => ['title' => 'Menj a Bourbonunk', 'link' => 'https://www.jimbeam.com/bourbons'],
              'bg' => ['title' => 'Отидете до нашия Бурбон', 'link' => 'https://www.jimbeam.com/bourbons'],
              'lv' => ['title' => 'Dodieties uz mūsu burbonu', 'link' => 'https://www.jimbeam.com/bourbons'],
              'uk' => ['title' => 'Ідіть до нашого Бурбона', 'link' => 'https://www.jimbeam.com/bourbons'],
            ],
          ],
          'Jim Beam' => [
            'link' => 'https://www.jimbeam.com/bourbons/jim-beam',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 1, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Jim Beam', 'link' => 'https://www.jimbeam.com/de/unser-bourbon/jim-beam'],
              'hu' => ['title' => 'Jim Beam', 'link' => 'https://www.jimbeam.com/bourbons/jim-beam'],
              'bg' => ['title' => 'Jim Beam', 'link' => 'https://www.jimbeam.com/bourbons/jim-beam'],
              'lv' => ['title' => 'Jim Beam', 'link' => 'https://www.jimbeam.com/bourbons/jim-beam'],
              'uk' => ['title' => 'Jim Beam', 'link' => 'https://www.jimbeam.com/bourbons/jim-beam'],
            ],
          ],
          'The Flavorful Side' => [
            'link' => 'https://www.jimbeam.com/bourbons#slider-2',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 2, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Flavors', 'link' => 'https://www.jimbeam.com/de/unser-bourbon#slider-2'],
              'hu' => ['title' => 'Az ízléses oldal', 'link' => 'https://www.jimbeam.com/bourbons#slider-2'],
              'bg' => ['title' => 'Ароматната страна', 'link' => 'https://www.jimbeam.com/bourbons#slider-2'],
              'lv' => ['title' => 'Aromatizējošā puse', 'link' => 'https://www.jimbeam.com/bourbons#slider-2'],
              'uk' => ['title' => 'Смачна сторона', 'link' => 'https://www.jimbeam.com/bourbons#slider-2'],
            ],
          ],
          'More Refined Members' => [
            'link' => 'https://www.jimbeam.com/bourbons#slider-1',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 3, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Premium', 'link' => 'https://www.jimbeam.com/de/unser-bourbon#slider-1'],
              'hu' => ['title' => 'Finomabb tagok', 'link' => 'https://www.jimbeam.com/bourbons#slider-1'],
              'bg' => ['title' => 'По-рафинирани членове', 'link' => 'https://www.jimbeam.com/bourbons#slider-1'],
              'lv' => ['title' => 'Precīzāki locekļi', 'link' => 'https://www.jimbeam.com/bourbons#slider-1'],
              'uk' => ['title' => 'Більш вдосконалені члени', 'link' => 'https://www.jimbeam.com/bourbons#slider-1'],
            ],
          ],
          'Limited Time Members' => [
            'link' => 'https://www.jimbeam.com/bourbons#slider-3',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 4, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Ready to Drink', 'link' => 'https://www.jimbeam.com/de/unser-bourbon#slider-3'],
              'hu' => ['title' => 'Korlátozott időtartamú tagok', 'link' => 'https://www.jimbeam.com/bourbons#slider-3'],
              'bg' => ['title' => 'Ограничени членове', 'link' => 'https://www.jimbeam.com/bourbons#slider-3'],
              'lv' => ['title' => 'Biedri ar ierobežotu laiku', 'link' => 'https://www.jimbeam.com/bourbons#slider-3'],
              'uk' => ['title' => 'Члени з обмеженим часом', 'link' => 'https://www.jimbeam.com/bourbons#slider-3'],
            ],
          ]
        ],
        'languages' => [
          'de' => ['title' => 'Unser Bourbon', 'link' => 'route:<nolink>'],
          'hu' => ['title' => 'Bourbonunk', 'link' => 'route:<nolink>'],
          'bg' => ['title' => 'Нашият Бурбон', 'link' => 'https://www.jimbeam.com/bourbons'],
          'lv' => ['title' => 'Mūsu Bourbon', 'link' => 'https://www.jimbeam.com/bourbons'],
          'uk' => ['title' => 'Наш Бурбон', 'link' => 'https://www.jimbeam.com/bourbons'],
        ],
      ],
      'Behind the bourbon' => [
        'link' => 'route:<nolink>',
        'expanded' => 'en',
        'langcode' => 'en',
        'weight' => 1,
        'below' => [
          'Go To Behind the bourbon' => [
            'link' => 'https://www.jimbeam.com/behind-the-bourbon',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 0, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Gehe Wissenswertes', 'link' => 'https://www.jimbeam.com/de/werdegang-des-bourbon'],
              'hu' => ['title' => 'Menj a A burbon mögött', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
              'bg' => ['title' => 'Отиди зад бърбън', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
              'lv' => ['title' => 'Iet uz Aiz burbonu', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
              'uk' => ['title' => 'Ідіть до за бурбоном', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
            ],
          ],
          'Beam History' => [
            'link' => 'https://www.jimbeam.com/behind-the-bourbon/our-story',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 1, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Unsere Geschichte', 'link' => 'https://www.jimbeam.com/de/behind-the-bourbon/our-story'],
              'hu' => ['title' => 'Sugárzás története', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/our-story'],
              'bg' => ['title' => 'История на лъча', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/our-story'],
              'lv' => ['title' => 'Staru vēsture', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/our-story'],
              'uk' => ['title' => 'Історія променя', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/our-story'],
            ],
          ],
          'Bourbon vs Whiskey' => [
            'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-vs-whiskey',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 2, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Bourbon oder Whiskey', 'link' => 'https://www.jimbeam.com/de/werdegang-des-bourbon/bourbon-oder-whiskey'],
              'hu' => ['title' => 'Bourbon vs Whisky', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-vs-whiskey'],
              'bg' => ['title' => 'Бурбон срещу Уиски', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-vs-whiskey'],
              'lv' => ['title' => 'Burbonis vs viskijs', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-vs-whiskey'],
              'uk' => ['title' => 'Бурбон проти Віскі', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-vs-whiskey'],
            ],
          ],
          'Bourbon Process' => [
            'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-process',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 3, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Der Bourbon-Herstellungsprozess', 'link' => 'https://www.jimbeam.com/de/werdegang-des-bourbon/der-bourbon-herstellungsprozess'],
              'hu' => ['title' => 'Bourbon folyamat', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-process'],
              'bg' => ['title' => 'Бурбонов процес', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-process'],
              'lv' => ['title' => 'Burbonu process', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-process'],
              'uk' => ['title' => 'Бурбонський процес', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/bourbon-process'],
            ],
          ],
          'Mixology 101' => [
            'link' => 'https://www.jimbeam.com/behind-the-bourbon/mixology-101',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 4, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Mixologie 101', 'link' => 'https://www.jimbeam.com/de/werdegang-des-bourbon/mixologie-101'],
              'hu' => ['title' => 'Mixológia 101', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/mixology-101'],
              'bg' => ['title' => 'Миксология 101', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/mixology-101'],
              'lv' => ['title' => 'Mixoloģija 101', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/mixology-101'],
              'uk' => ['title' => 'Міксологія 101', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/mixology-101'],
            ],
          ],
          'Raised Right' => [
            'link' => 'https://www.jimbeam.com/behind-the-bourbon/raised-right',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 5, 'below' => [],
            'languages' => [
              'hu' => ['title' => 'Emelt jobbra', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/raised-right'],
              'bg' => ['title' => 'Издигнат вдясно', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/raised-right'],
              'lv' => ['title' => 'Pacelts pa labi', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/raised-right'],
              'uk' => ['title' => 'Піднята справа', 'link' => 'https://www.jimbeam.com/behind-the-bourbon/raised-right'],
            ],
          ],
        ],
        'languages' => [
          'de' => ['title' => 'Wissenswertes', 'link' => 'route:<nolink>'],
          'hu' => ['title' => 'A burbon mögött', 'link' => 'route:<nolink>'],
          'bg' => ['title' => 'Зад бърбън', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
          'lv' => ['title' => 'Aiz burbona', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
          'uk' => ['title' => 'За бурбоном', 'link' => 'https://www.jimbeam.com/behind-the-bourbon'],
        ],
      ],
      'Cocktails' => [
        'link' => 'https://www.jimbeam.com/cocktails',
        'expanded' => FALSE,
        'langcode' => 'en',
        'weight' => 2,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Drinks', 'link' => 'https://www.jimbeam.com/de/cocktails'],
          'hu' => ['title' => 'Koktélok', 'link' => 'https://www.jimbeam.com/cocktails'],
          'bg' => ['title' => 'Коктейли', 'link' => 'https://www.jimbeam.com/cocktails'],
          'lv' => ['title' => 'Kokteiļi', 'link' => 'https://www.jimbeam.com/cocktails'],
          'uk' => ['title' => 'Коктейлі', 'link' => 'https://www.jimbeam.com/cocktails'],
        ],
      ],
      'Visit us' => [
        'link' => 'https://www.jimbeam.com/visit-us',
        'expanded' => TRUE,
        'langcode' => 'en',
        'weight' => 3,
        'below' => [
          'Go To Visit Us' => [
            'link' => 'https://www.jimbeam.com/visit-us',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 0, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Gehe Besuche uns', 'link' => 'https://www.jimbeam.com/de/besuchen-sie-uns'],
              'hu' => ['title' => 'Menj a Látogass meg minket', 'link' => 'https://www.jimbeam.com/visit-us'],
              'bg' => ['title' => 'Отидете да ни посетите', 'link' => 'https://www.jimbeam.com/visit-us'],
              'lv' => ['title' => 'Dodieties pie mums ciemos', 'link' => 'https://www.jimbeam.com/visit-us'],
              'uk' => ['title' => 'Ідіть до нас у гості', 'link' => 'https://www.jimbeam.com/visit-us'],
            ],
          ],
          'American Stillhouse' => [
            'link' => 'https://www.jimbeam.com/visit-us/american-stillhouse',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 1, 'below' => [],
            'languages' => [
              'de' => ['title' => 'American Stillhouse', 'link' => 'https://www.jimbeam.com/de/besuchen-sie-uns/american-stillhouse'],
              'hu' => ['title' => 'American Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/american-stillhouse'],
              'bg' => ['title' => 'American Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/american-stillhouse'],
              'lv' => ['title' => 'American Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/american-stillhouse'],
              'uk' => ['title' => 'American Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/american-stillhouse'],
            ],

          ],
          'Urban Stillhouse' => [
            'link' => 'https://www.jimbeam.com/visit-us/urban-stillhouse',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 2, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Urban Stillhouse', 'link' => 'https://www.jimbeam.com/de/besuchen-sie-uns/urban-stillhouse'],
              'hu' => ['title' => 'Urban Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/urban-stillhouse'],
              'bg' => ['title' => 'Urban Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/urban-stillhouse'],
              'lv' => ['title' => 'Urban Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/urban-stillhouse'],
              'uk' => ['title' => 'Urban Stillhouse', 'link' => 'https://www.jimbeam.com/visit-us/urban-stillhouse'],
            ],
          ],
          'Events' => [
            'link' => 'https://www.jimbeam.com/visit-us/events',  'expanded' => FALSE, 'langcode' => 'en', 'weight' => 3, 'below' => [],
            'languages' => [
              'de' => ['title' => 'Veranstaltungen', 'link' => 'https://www.jimbeam.com/de/besuchen-sie-uns/veranstaltungen'],
              'hu' => ['title' => 'Események', 'link' => 'https://www.jimbeam.com/visit-us/events'],
              'bg' => ['title' => 'Събития', 'link' => 'https://www.jimbeam.com/visit-us/events'],
              'lv' => ['title' => 'Notikumi', 'link' => 'https://www.jimbeam.com/visit-us/events'],
              'uk' => ['title' => 'Події', 'link' => 'https://www.jimbeam.com/visit-us/events'],
            ],
          ],
        ],
        'languages' => [
          'de' => ['title' => 'Besuche uns', 'link' => 'route:<nolink>'],
          'hu' => ['title' => 'Látogass meg minket', 'link' => 'route:<nolink>'],
          'bg' => ['title' => 'Посетете ни', 'link' => 'https://www.jimbeam.com/visit-us'],
          'lv' => ['title' => 'Apciemo mūs', 'link' => 'https://www.jimbeam.com/visit-us'],
          'uk' => ['title' => 'Відвідайте нас', 'link' => 'https://www.jimbeam.com/visit-us'],
        ],
      ],
      /*'Swag' => [
        'link' => 'https://merch.jimbeam.com/',
        'expanded' => FALSE,
        'langcode' => 'en',
        'weight' => 4,
        'below' => [],
      ],*/
      'Buy' => [
        'link' => 'https://www.jimbeam.com/buy/',
        'expanded' => FALSE,
        'langcode' => 'en',
        'weight' => 5,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'Kaufen', 'link' => 'https://www.jimbeam.com/de/buy/'],
          'hu' => ['title' => 'Megvesz', 'link' => 'https://www.jimbeam.com/buy/'],
          'bg' => ['title' => 'Купува', 'link' => 'https://www.jimbeam.com/buy/'],
          'lv' => ['title' => 'Pērciet', 'link' => 'https://www.jimbeam.com/buy/'],
          'uk' => ['title' => 'Купуйте', 'link' => 'https://www.jimbeam.com/buy/'],
        ],
      ],
      'My Label' => [
        'link' => 'internal:/node/' . 1,
        'expanded' => FALSE,
        'langcode' => 'en',
        'weight' => 6,
        'below' => [],
        'languages' => [
          'de' => ['title' => 'My Label', 'link' => 'internal:/node/' . 1],
          'hu' => ['title' => 'Saját címkém', 'link' => 'internal:/node/' . 1],
          'bg' => ['title' => 'Моят етикет', 'link' => 'internal:/node/' . 1],
          'lv' => ['title' => 'Mana etiķete', 'link' => 'internal:/node/' . 1],
          'uk' => ['title' => 'Мій ярлик', 'link' => 'internal:/node/' . 1],
        ],
      ],
    ];


    $varThis->menuLinkMigrator->createStructure($varThis, $links, 'main-mobile');
  }
}
