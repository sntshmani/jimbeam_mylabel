<?php

namespace Drupal\beam_migrator\Migrator\Content;

use Drupal\beam_migrator\Migrator\ContentMigrator;

class PagePersonaliseMigrator extends ContentMigrator {

  protected function create($varThis) {
    $blocks = [];
    $blocksDe = [];

    $block = $varThis->blockImage->createParagraph('J2682_JB225_KV_PERSONAL_BOTTLE_WITH_FACE_AW03.png', 'J2682_JB225_KV_PERSONAL_BOTTLE_NO_FACE_AW03.png');
    $blocks[] = $block;
    $blocksDe[] = $block;
    $blocksHu[] = $block;
    $blocksLv[] = $block;
    $blocksBg[] = $block;
    $blocksCs[] = $block;
    $blocksSk[] = $block;
    $blocksUk[] = $block;

    $block = $varThis->blockBody->createParagraph('Celebrating Anniversaries Big or Small', 'PERSONALISE YOUR JIM BEAM BOTTLE!',
      '<p>Jim Beam is a welcoming bourbon that embraces you like family - no matter who you are or where you’re from.</p>
<p>Our story starts in 1795 in Kentucky and continues for over 7 generations of the Jim Beam family. And today we are celebrating our 225th anniversary. If there’s one thing we’ve learnt over these years - it’s how to make a whiskey and how to treat a person.</p>
<p>This activation idea is about showing appreciation to the people in our lives who make us who we are and take the opportunity to celebrate and say thank you to friends, family, colleagues or even reward yourselves.</p>
<p>So have a seat, personalize your label and enjoy your bourbon any way you like.</p>',
      'internal:/custom-bottle', 'Personalise now', NULL, NULL, 'white');
    $blocks[] = $block;



    $blocksDe[] = $varThis->blockBody->translate($block['id'], 'de', 'FÜR KLEINE UND GROßE MOMENTE', 'JETZT DEIN PERSÖNLICHES JIM BEAM ETIKETT GESTALTEN!',
      '<p>Unsere Jim Beam Geschichte beginnt 1795 in Kentucky. Heute feiern wir unseren 225. Geburtstag in siebter Generation. Und wenn es eine Sache gibt, die wir über die Jahre gelernt haben ist es, wie man einen Whiskey macht und wie man Menschen zusammen bringt.</p>
<p>Feiert zusammen mit uns und Eurer persönlichen Jim Beam Flasche Euren ganz persönlichen Moment mit Familie, Freunden und Kollegen.</p>',

      'internal:/custom-bottle', 'Jetzt dein persönliches Etikett gestalten!', NULL, NULL, 'white');
    $blocksHu[] = $varThis->blockBody->translate($block['id'], 'hu', 'Ünnepeljünk minden alkalmat, kicsit vagy nagyot!', 'Lepd meg szeretteid egyedi palackkal! / Ünnepelj egy egyedi palackkal!',
      '<p>A Jim Beam bársonyos bourbon ízével a család szeretetét viszi hozzád - függetlenül attól ki vagy és honnan jöttél. A történetünk 1795-re nyúlik vissza és mára a 7.  Jim Beam generáción keresztül ível. Napjainkban ünnepelhetjük alapításunk 225. évfordulóját. A legfontosabb,amit tanultunk a hosszú évek alatt : az embereknek az élvezet nyújtás egy kiváló whiskeyn kersztül a mi küldetésünk.   Ezért is találtuk ki ezt a promóciót,hogy hálánkat  fejezzük ki azok iránt,akik végig mellettünk voltak és akik miatt azok lehetünk,akik ma vagyunk. Nekik szeretnénk ajánlani ezt a lehetőséget,hogy ők is köszönetet mondhassanak barátaiknak,családjuknak, kollégáiknak vagy megjutalmazzák magukat egy testreszabott palackkal. Szóval dölj hátra és kezdj neki megtervezni egyedi címkéd,hogy élvezhesd a bourbont ahogy Te szereted.</p>',
      'internal:/custom-bottle', 'Testreszabás MOST', NULL, NULL, 'white');

    $blocksLv[] = $varThis->blockBody->translate($block['id'], 'lv', 'Svinam svētkus - lielus un mazus!', 'Nosvini savus svētkus ar personalizētu JIM BEAM pudeli!',
      '<p>Jim Beam ar lielāko prieku pieņems Tevi savā ģimenē, neatkarīgi no tā, kas Tu esi un kur atrodies!</p>
<p>Mūsu stāsts aizsākās 1795. gadā Kentuki pilsētā, un turpinās nu jau vairāk kā septiņās Jim Beam ģimenes paaudzēs. Šodien mēs svinam savu 225. gadadienu. Ja ir viena lieta, ko šo gadu laikā esam iemācījušies, tad tā noteikti ir laba viskija gatavošana, lai gandarītu mūsu pircējus.</p>
<p>Šīs aktivizācijas galvenā iecere ir izrādīt cieņu tiem cilvēkiem mūsu dzīvē, kuri palīdzējuši mums kļūt par to, kas mēs šobrīd esam. Izmanto šo īpašo iespēju svinēt un pateikties saviem draugiem, ģimenei, kolēģiem, vai pat  apbalvot pašam sevi!</p>
<p>Tādēļ iekārtojies ērtāk, personalizē savu etiķeti un izbaudi savu burbonu savā iecienītākajā veidā!</p>',
      'internal:/custom-bottle', 'Personalizēt tagad', NULL, NULL, 'white');

    $blocksBg[] = $varThis->blockBody->translate($block['id'], 'bg', 'Празнуваме годишнини, малки и големи', 'ПЕРСОНАЛИЗИРАЙ СВОЯТА БУТИЛКА JIM BEAM!',
      '<p>С Jim Beam се чувстваш като част от семейството - независимо кой си и откъде идваш.</p>
<p>Историята ни започва през 1795 година в Кентъки и наследството се предава на над 7 поколения от семейството на Jim Beam. Днес празнуваме 225-ата си годишнина. Ако сме научили нещо през всичките тези години, то е как да правим уиски и как да се отнасяме с хората.</p>
<p>Идеята на тази активация е да покажем признателността си на хората в живота ни, които ни правят такива, каквито сме. Това е възможност да празнуваме и да кажем ""благодаря"" на приятели, роднини, колеги или дори да възнаградим себе си.</p>
<p>Затова се настани удобно, персонализирай етикета си и се наслади на бърбъна, както пожелаеш.</p>',
      'internal:/custom-bottle', 'Персонализирай сега', NULL, NULL, 'white');

    $blocksCs[] = $varThis->blockBody->translate($block['id'], 'cs', 'Na oslavu malých i velkých výročí', '', // @TODO Subtitle
      '<p>Jim Beam je bourbon, který tě uvítá jako člena rodiny – ať jsi, kdo jsi.</p>
<p>Příběh sedmi generací rodiny Jim Beam začíná v roce 1795 v Kentucky. Teď slavíme 225. výročí a pokud jsme se za ta léta něco naučili, tak je to, jak dělat whiskey a jak se chovat k lidem.</p>
<p>Láhev na míru je skvělý způsob, jak ukázat svým blízkým, jak moc pro nás znamenají, ale taky super možnost udělat radost, svým přátelům, rodině, kolegům nebo i sami sobě.</p>
<p>Tak si sedni, vytvoř svoji etiketu a vychutnej si bourbon, tak jak ho máš rád.</p>',
      'internal:/custom-bottle', 'Vytvořit láhev na míru', NULL, NULL, 'white');

    $blocksSk[] = $varThis->blockBody->translate($block['id'], 'sk', 'Oslavujeme výročia - veľké aj malé', 'Oslávte svoje výročie personifikovanou fľašou Jim Beam!',
      '<p>Jim Beam je bourbon, ktorý Vás uvíta, ako by ste boli členom rodiny – nech ste ktokoľvek a odkiaľkoľvek.</p>
<p>Náš príbeh sa začína v roku 1795 v Kentucky a je to príbeh siedmich generácií rodiny Jim Beam. Dnes oslavujeme naše 225. výročie. A ak sme sa za tie roky niečo naučili, tak teda ako robiť whiskey a ako sa správať k ľuďom.</p>
<p>Tento nápad personifikovať fľaše je o tom, aby sme ukázali svojim blízkym, ako veľmi si ich ceníme, a taktiež je to príležitosť, aby sme poďakovali priateľom, rodine, kolegom, či aby sme odmenili sami seba.</p>
<p>Tak sa posaďte, vytvorte si svoju etiketu a vychutnajte si bourbon tak, ako ho máte radi.</p>',
      'internal:/custom-bottle', 'Vytvoriť vlastnú originálnu fľašu', NULL, NULL, 'white');

    $blocksUk[] = $varThis->blockBody->translate($block['id'], 'uk', 'Celebrating Anniversaries Big or Small', 'Зроби свою персональну пляжку Jim Beam!',
      '<p>Наша історія почалася в 1795 році в штаті Кентуккі і триває вже понад 7 поколінь родини Джима Біма. І сьогодні ми святкуємо наше 225-річчя. Якщо є щось, що ми дізналися за ці роки – то це, як зробити віскі і як потрібно ставитися до людини.</p>
<p>Ідея  цього проекту - це можливість подякувати людям з нашого життя, які роблять нас такими, якими ми є, і користуємось нагодою відзначитись і сказати подяку друзям, родині, колегам або навіть нагородити себе.</p>
<p>Тож влаштовуйтесь якомога зручніше, зробіть свою персональну етикетку та насолоджуйтесь своїм бурбоном у будь-який спосіб.</p>',
      'internal:/custom-bottle', 'Почати прямо зараз', NULL, NULL, 'white');




    $block = $varThis->blockBody->createParagraph('How can I get my code?', NULL,
       NULL,
      'route:<nolink>', 'Where can I find it?', 'internal:/node/3', 'Terms & Conditions of service', 'grey');
    $blocks[] = $block;



    $blocksDe[] = $varThis->blockBody->translate($block['id'], 'de', 'Wie erhalte ich einen Code?', NULL, NULL,
      'route:<nolink>', 'Wo finde ich den Code?', 'internal:/node/3', 'Allgemeine Geschäftsbedingungen', 'grey');

    $blocksHu[] = $varThis->blockBody->translate($block['id'], 'hu', 'Hogy kapom meg a kódom?', NULL, NULL,
      'route:<nolink>', 'Hol találom?', 'internal:/node/3', 'Szolgáltatási feltételek', 'grey');

    $blocksLv[] = $varThis->blockBody->translate($block['id'], 'lv', 'Kā saņemt savu kodu?', NULL, NULL,
      'route:<nolink>', 'Kur to atrast?', 'internal:/node/3', 'Pakalpojuma noteikumi', 'grey');

    $blocksBg[] = $varThis->blockBody->translate($block['id'], 'bg', 'Как да получа своя код?', NULL, NULL,
      'route:<nolink>', 'Къде мога да го намеря?', 'internal:/node/3', 'Условия за ползване', 'grey');

    $blocksCs[] = $varThis->blockBody->translate($block['id'], 'cs', 'Jak získám kód?', NULL, NULL,
      'route:<nolink>', 'Kde ho najdu?', 'internal:/node/3', 'Podmínky služby', 'grey');

    $blocksSk[] = $varThis->blockBody->translate($block['id'], 'sk', 'Ako môžem získať kód?', NULL, NULL,
      'route:<nolink>', 'Kde ho môžem nájsť?', 'internal:/node/3', 'Podmienky služby', 'grey');

    $blocksUk[] = $varThis->blockBody->translate($block['id'], 'uk', 'Як я можу отримати свій код?', NULL, NULL,
      'route:<nolink>', 'Де я можу його знайти?', 'internal:/node/3', 'Умови надання послуг', 'grey');




    $node = $varThis->nodePage->createNode('Personalise', $blocks, '2cols', '/personalise');
    $nodeDe = $varThis->nodePage->translateNode($node, 'de', 'Persönliches', $blocksDe, '2cols', '/personalise');
    $nodeHu = $varThis->nodePage->translateNode($node, 'hu', 'Személyre szabás', $blocksHu, '2cols', '/personalise');
    $nodeLv = $varThis->nodePage->translateNode($node, 'lv', 'Personalizēt', $blocksLv, '2cols', '/personalise');
    $nodeBg = $varThis->nodePage->translateNode($node, 'bg', 'Персонализиране', $blocksBg, '2cols', '/personalise');
    $nodeCs = $varThis->nodePage->translateNode($node, 'cs', 'Přizpůsobte si', $blocksCs, '2cols', '/personalise');
    $nodeSk = $varThis->nodePage->translateNode($node, 'sk', 'Prispôsobiť', $blocksSk, '2cols', '/personalise');
    $nodeUk = $varThis->nodePage->translateNode($node, 'uk', 'Персоналізуйте', $blocksUk, '2cols', '/personalise');
  }
}
