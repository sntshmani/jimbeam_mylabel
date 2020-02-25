<?php

namespace Drupal\beam_migrator\Migrator;

use Drupal\beam_migrator\Helper\ContentHelper;
use Drupal\beam_migrator\Migrator\Content\Block\BlockBodyMigrator;
use Drupal\beam_migrator\Migrator\Content\Block\BlockFooterMigrator;
use Drupal\beam_migrator\Migrator\Content\Block\BlockImageMigrator;
use Drupal\beam_migrator\Migrator\Content\Block\BlockThanksMigrator;
use Drupal\beam_migrator\Migrator\Content\BlockContent\BlockContentPopupMigrator;
use Drupal\beam_migrator\Migrator\Content\Node\NodePageMigrator;
use Drupal\beam_migrator\Migrator\Content\PagePersonalDataMigrator;
use Drupal\beam_migrator\Migrator\Content\PagePersonaliseMigrator;
use Drupal\beam_migrator\Migrator\Content\PageTermsMigrator;
use Drupal\beam_migrator\Migrator\Content\PageThanksMigrator;

class ContentMigrator {

  protected $nodePage;

  protected $blockBody;
  protected $blockImage;
  protected $blockThanks;
  protected $blockFooter;

  protected $blockContentPopup;

  public function __construct() {}

  private function init() {
    $this->nodePage = new NodePageMigrator();

    $this->blockBody = new BlockBodyMigrator();
    $this->blockImage = new BlockImageMigrator();
    $this->blockThanks = new BlockThanksMigrator();
    $this->blockFooter = new BlockFooterMigrator();
    $this->blockContentPopup = new BlockContentPopupMigrator();
  }

  public function clean() {
    $entitiesType = ContentHelper::getEntities();
    foreach ($entitiesType as $entityType) {
      print ('Cleaning ' . $entityType) . PHP_EOL;
      $ids = \Drupal::entityQuery($entityType)
        ->execute();
      $storage_handler = \Drupal::entityTypeManager()->getStorage($entityType);
      $entities = $storage_handler->loadMultiple($ids);
      $storage_handler->delete($entities);
    }
    $this->cleanBlocks();
    $this->resetEntities();
  }

  public function cleanBlocks() {
    print ('Cleaning block content') . PHP_EOL;
    $ids = \Drupal::entityQuery('block_content')
      ->execute();
    $storage_handler = \Drupal::entityTypeManager()->getStorage('block_content');
    $entities = $storage_handler->loadMultiple($ids);
    $storage_handler->delete($entities);
  }

  private function resetEntities() {
    $this->resetNodeId();
    $this->resetParagraphId();
    $this->resetBlockContentId();
  }

  private function resetBlockContentId() {
    $database = \Drupal::database();
    $database->query('ALTER TABLE {block_content} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {block_content_field_data} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {block_content_field_revision} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {block_content_revision} AUTO_INCREMENT = 1')->execute();
  }

  private function resetNodeId() {
    $database = \Drupal::database();
    $database->query('ALTER TABLE {node} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {node_revision} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {node_field_data} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {node_field_revision} AUTO_INCREMENT = 1')->execute();
  }

  private function resetParagraphId() {
    $database = \Drupal::database();
    $database->query('ALTER TABLE {paragraphs_item} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {paragraphs_item_field_data} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {paragraphs_item_revision} AUTO_INCREMENT = 1')->execute();
    $database->query('ALTER TABLE {paragraphs_item_revision_field_data} AUTO_INCREMENT = 1')->execute();
  }

  public function migrate() {
    print ('------------------------------') . PHP_EOL;
    $this->clean();
    $this->init();

    print ('Creating page: Personalise') . PHP_EOL;
    $pagePersonalise = new PagePersonaliseMigrator();
    $pagePersonalise->create($this);

    print ('Creating page: Thanks') . PHP_EOL;
    $pageThanks = new PageThanksMigrator();
    $pageThanks->create($this);

    print ('Creating page: Terms') . PHP_EOL;
    $pageTerms = new PageTermsMigrator();
    $pageTerms->create($this);

    print ('Creating page: Personal Data Statement') . PHP_EOL;
    $pagePersonal = new PagePersonalDataMigrator();
    $pagePersonal->create($this);

    print ('Creating popup') . PHP_EOL;
    $block = $this->blockContentPopup->createBlock('Where can I get my code',
      'To apply for a free personalized label you need to have a unique code which can be found on the Jim Beam bottle you have purchase - only the bottle containing any specific communication about the label personalization promotion (<i>usually, it can be found on a neck hanger</i>).',
      'Got it!', 'popup-bottle.png');

   $blockDe = $this->blockContentPopup->translate($block, 'de', 'WIE BEKOMME ICH MEINEN CODE?',
      'Um dein persönliches Etikett erstellen zu lassen benötigst du einen individuellen Teilnahmecode, den du auf der Innenseite des Aktionsanhängers auf deiner gekauften Jim Beam Aktionsflasche findest - nur auf den Flaschen, die auf dem Anhänger am Flaschenhals speziell die Etikett Personalisierung bewerben gibt es einen Code.',
     'VERSTANDEN!');

   $blockHu = $this->blockContentPopup->translate($block, 'hu', 'Hogy kapom meg a kódom?',
      'Az egyedi címke igényléséhez szükséged lesz egy kódra,ami a megvásárolt Jim Beam palackon található - csak a palackon találsz tájékoztatás erről a promócióról (általában a termék nyakfüggőjén) -de országonként változhat hol találja a fogyasztó',
     'Értem!');

   $blockLv = $this->blockContentPopup->translate($block, 'lv', 'KUR IEGŪT SAVU KODU?',
      'Lai pieteiktos bezmaksas personalizētai etiķetei, tev ir jāizmanto unikāls kods. Tas atrodams uz iegādātas pudeles, ja tai ir īpaša personalizētās etiķetes aktivizācijas kakla uzlika (NB! Mechanics to be confirmed)',
      'SAPRATU!');

   $blockBg = $this->blockContentPopup->translate($block, 'bg', 'КЪДЕ МОГА ДА ПОЛУЧА СВОЯ КОД?',
      'За да получиш безплатен персонализиран етикет, трябва да разполагаш с уникален код, който се намира на бутилката Jim Beam, която си закупил. Такива кодове има само на бутилките с комуникация относно промоцията за персонализиране на етикети. (обикновено информацията е на некхенгър - да се уточни точно къде се намира кодът)',
      'РАЗБРАХ');

   $blockCs = $this->blockContentPopup->translate($block, 'cs', '72. JAK ZÍSKÁM KÓD?',
      'Aby sis mohl zdarma vytvořit osobní etiketu, musíš mít unikátní kód. Najdeš ho pouze na lahvích Jima Beama, které jsou označené informačním letáčkem o této akci zavěšeném na hrdle.',
      'ROZUMÍM!');

   $blockSk = $this->blockContentPopup->translate($block, 'sk', 'Kde získam kód?',
      'Aby ste získali zadarmo personifikovanú etiketu, musíte mať  kód, ktorý nájdete na fľaši Jim Beam, ktorú ste si zakúpili – iba na fľašiach,  kde sú uvedené konkrétne informácie o personifikácii fľiaš (na informačnom letáku na hrdle fľaše)',
       'Rozumiem');

   $blockUk = $this->blockContentPopup->translate($block, 'uk', 'Де я можу отримати свій код?',
      'Щоб подати заявку на безкоштовну персоналізовану етикетку, вам потрібно мати унікальний код, який можна знайти на придбаній Вами пляшці Jim Beam - лише для пляшок, які містять якесь конкретне повідомлення про програму персоналізованої етикетки (зазвичай її можна знайти на некхенгері).',
       'Зрозуміло!');
  }
}
