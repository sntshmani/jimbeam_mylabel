<?php

namespace Drupal\beam_migrator\Migrator\Content;

use Drupal\beam_migrator\Migrator\ContentMigrator;

class PageThanksMigrator extends ContentMigrator {

  protected function create($varThis) {

    $block = $varThis->blockThanks->createParagraph('Your label customization was completed successfully', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'Home', 'thanks.png', 'thanks-mobile.png');
    $blocks[] = $block;

    $blocksDe[] = $varThis->blockThanks->translate($block['id'], 'de', 'DEINE PERSONALISIERUNG WURDE ERFOLGREICH ABGESCHLOSSEN', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'Home');

    $blocksHu[] = $varThis->blockThanks->translate($block['id'], 'hu', 'Az egyedi cimkéd sikeresen elkészült', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'Kezdőlap');

    $blocksLv[] = $varThis->blockThanks->translate($block['id'], 'lv', 'TAVA PERSONALIZĒTĀS ETIĶETES IZVEIDE VEIKSMĪGI PABEIGTA!', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'UZ SĀKUMU');

    $blocksBg[] = $varThis->blockThanks->translate($block['id'], 'bg', 'ЕТИКЕТЪТ БЕШЕ ПЕРСОНАЛИЗИРАН УСПЕШНО', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'НАЧАЛО');

    $blocksCs[] = $varThis->blockThanks->translate($block['id'], 'cs', 'ÚPRAVA TVOJÍ ETIKETY JE ÚSPĚŠNĚ DOKONČENA', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'NA HLAVNÍ STRANU');

    $blocksSk[] = $varThis->blockThanks->translate($block['id'], 'sk', 'VAŠA ÚPRAVA ETIKETY BOLA ÚSPEŠNE UKONČENÁ', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'Domov');

    $blocksUk[] = $varThis->blockThanks->translate($block['id'], 'uk', 'Персоналізація вашої етикетки успішно завершена', 'Certe, inquam, pertinax non possim accommodare torquatos.',
      'In oculis quidem se oratio, tua praesertim, qui ratione intellegi posse et aperta iudicari etenim quoniam detractis de commodis suis cogitarent? at id omnia referri oporteat, ipsum per se ipsam causam non ero tibique, si ob rem voluptas nulla pariatur? at magnum periculum adiit in.',
      'internal:/node/1', 'Головна');




    $block = $varThis->blockFooter->createParagraph('Need help? Contact with <a href="mailto:info@mybeamlabel.com" class="red">My Label support</a>');
    $blocks[] = $block;

    $blocksDe[] = $varThis->blockFooter->translate($block['id'], 'de', 'Du brauchst Hilfe? Kontaktiere <a href="mailto:jimbeam@promotionservice.de" class="red">My Label support</a>');

    $blocksHu[] = $varThis->blockFooter->translate($block['id'], 'hu', 'Segítsére van szükséged? Lépj kapcsolatba a <a href="mailto:kis.daniel@heinemann.hu" class="red">My Label (Saját Cimkém) asszisztenssel</a>');

    $blocksLv[] = $varThis->blockFooter->translate($block['id'], 'lv', 'Nepieciešama palīdzība? Sazinies ar <a href="mailto:kristaps.liepa@amberbev.com" class="red">My Label atbalsta personu</a>');

    $blocksBg[] = $varThis->blockFooter->translate($block['id'], 'bg', '<a href="mailto:mailto:info@mybeamlabel.com" class="red">Нужда от помощ? Свържи се с нас</a>'); // @TODO MAIL

    $blocksCs[] = $varThis->blockFooter->translate($block['id'], 'cs', '<a href="mailto:jiri.prochazka@stock.cz" class="red">Potřebuješ pomoc? Kontaktuj podporu</a>');

    $blocksSk[] = $varThis->blockFooter->translate($block['id'], 'sk', '<a href="mailto:lucia.lunakova@stock.sk" class="red">Potrebujete pomoc? Kontaktujte podporu</a>');

    $blocksUk[] = $varThis->blockFooter->translate($block['id'], 'uk', '<a href="mailto:gnatkovskij_a@dds.dp.ua" class="red">Потрібна допомога? Зв\'яжіться зі службою підтримки My Label</a>');


    $node = $varThis->nodePage->createNode('Thank you', $blocks, '1col', '/thank-you');
    $nodeDe = $varThis->nodePage->translateNode($node, 'de', 'Vielen Dank', $blocksDe, '1col', '/thank-you');
    $nodeHu = $varThis->nodePage->translateNode($node, 'hu', 'Köszönöm', $blocksHu, '1col', '/thank-you');
    $nodeLv = $varThis->nodePage->translateNode($node, 'lv', 'Paldies', $blocksLv, '1col', '/thank-you');
    $nodeBg = $varThis->nodePage->translateNode($node, 'bg', 'Благодаря ти', $blocksBg, '1col', '/thank-you');
    $nodeCs = $varThis->nodePage->translateNode($node, 'cs', 'Děkuji', $blocksCs, '1col', '/thank-you');
    $nodeSk = $varThis->nodePage->translateNode($node, 'sk', 'Ďakujem', $blocksSk, '1col', '/thank-you');
    $nodeUk = $varThis->nodePage->translateNode($node, 'uk', 'Дякую', $blocksUk, '1col', '/thank-you');
  }
}
