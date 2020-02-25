<?php

namespace Drupal\beam_migrator\Migrator\Content;

use Drupal\beam_migrator\Migrator\ContentMigrator;

class PageTermsMigrator extends ContentMigrator {

  protected function create($varThis) {
    $blocks = [];
    $blocksDe = [];
// <br />
    // ''AS IS'' -> "

    $block = $varThis->blockBody->createParagraph(NULL, NULL,
      '
      <section class="faq-title"><h1>JIM BEAM PROMOTION MY BEAM LABEL</h1></section>
      <section class="faq-title"><h2>TERMS & CONDITIONS</h2></section>
<section class="basic-page">
<p>By participating in the promotion, the participant accepts the Terms & Conditions:</p>
<p>Beam Suntory Inc., 222 W Merchandise Mart Plaza, Chicago, IL 60654 (hereinafter referred to as <strong>"Promoter"</strong>) is organizing a promotional campaign (hereinafter referred to as "<strong>Campaign</strong>) under the JIM BEAM trade mark under the title My Beam Label in the period from [●] to [●], in which personalized stick-on bottle labels are sent (hereinafter referred to as "<strong>Prize</strong>").</p>
<p>Only natural persons aged 18 and over residing in United Kingdom can participate. Employees of the Promoter and their relatives as well as employees and relatives of companies and cooperation partners associated with the Promoter are not eligible to participate.</p>
<p>Participation must take place within the Promotion Period from [●] to [●] (hereinafter referred to as the "<strong>Promotion Period</strong>"). Late participation, for whatever reason, cannot be considered.</p>

<h3>And that\'s how it works</h3>
<p>The participant buys a Jim Beam promotional bottle with a promotional tag during the Promotion Period (while stocks last). The [●] is the closing date for the promotion/participation. After this date, all promotion codes that remain unredeemed will lose their validity. The sale and distribution of the promotion codes is prohibited.</p>
<p><u>Participation via the campaign website</u></p>
<p>On the inside of the promotional tag, there is an individually printed promotional code. In order to participate, the participant enters the promotion code in the field provided on the website <a href="https://mylabel.jimbeam.com" target="_blank">https://mylabel.jimbeam.com</a>. After the system validation of the promotion code, the participant immediately gets the opportunity to enter his or her desired name or message of his or her choice or to upload a picture of his or her choice. Once the desired label has been ordered, the promotion code loses its validity and cannot be used again.</p>
<p>For further Prize processing, the participant must also provide personal data (first name, surname), address (street, postcode, city), date of birth and a valid e-mail address.</p>
<p>The participant will then receive an e-mail informing him of how he can claim the Prize.</p>
<p><u>Participation via stores</u></p>
<p>Alternatively, it is also possible to have your personalized label printed in selected stores, provided you have a valid promotion code.</p>
<p>The Promoter reserves the right to use a filter that prohibits brand names and terms with negative connotations.</p>

<h3>Responsibility of the participant</h3>
<p>The participant is solely responsible for his Prize. The participant undertakes not to use texts and/or pictures that</p>
<ol>
<li>are unlawful, illegal, harmful, confrontational, defamatory, abusive, violent, glorifying violence, national socialist and/or racist, pornographic, vulgar, harmful to minors or obscene, that may violate religious or ethical sentiments, that contain political statements that reflect a threat, shocking or derogatory content or that may otherwise violate the dignity or integrity of any human being,</li>
<li>infringe the rights of third parties, in particular copyright, trademark or patent rights,</li>
<li>contains personal data of third parties (e.g. biometric data, date of birth, address, telephone number, etc.) and the third party has not consented to publication,</li>
<li>encourage or glorify excessive or irresponsible consumption of alcohol,</li>
<li>endorse the consumption of alcohol by minors or encourage minors to drink alcohol,</li>
<li>appear to make the consumption of alcohol attractive, strong, popular or sexually successful,</li>
<li>represent restrained alcohol consumption or abstinence in a negative way,</li>
<li>trivialise or encourage the consumption of alcohol in road traffic or when operating machinery requiring increased attention,</li>
<li>give the impression that alcohol prevents or cures diseases,</li>
<li>pretend to support alcohol during sporting or potentially dangerous activities,</li>
<li>positively appreciate the alcohol content (whether high or low),</li>
<li>advertise sales shops or the sale of products of any kind,</li>
<li>disseminate misleading or false information or compare the product with another brand or another product, in particular pretend that it is another product / another brand,</li>
<li>use a trade mark, a sign indicating goods or an indication of origin.</li>
</ol>
<p>The Promoter reserves the right to refuse personalization with texts and/or pictures that violate these requirements. In this case, the Promoter will inform the participant.</p>
<p>The Promoter reserves the right to take legal action against participants who culpably violate these requirements and to claim any damages arising therefrom.</p>
<p>In the event that a third party asserts rights to the Promoter which affect the Promoter in the contractual use of the files provided by the participant for the personalization of the Prize, the participant will assist the Promoter in defending such claims and, upon first request, indemnify the Promoter against all related claims of the third party and hold the Promoter harmless from and against any damages incurred by the Promoter as a result of the third party\'s rights, including any court and attorneys\' fees incurred by the Promoter for legal defense, unless the Promoter is solely responsible for the infringement. Should the participant subsequently recognize that he has provided content to which he is not entitled the exclusive right, in particular copyright, trademark, patent and name rights, he is obliged to inform the Promoter of this immediately <a href="mailto:info@mybeamlabel.com">info@mybeamlabel.com</a>. The Promoter is not obliged to check the contents transmitted by the Participants for potential infringements of third party rights.</p>
<p>The Promoter is not responsible for spelling mistakes within names and messages resulting from incorrect entries by participants or otherwise. The claim to a new corrected Prize expires.</p>
<p>In addition, the use of special characters of any form (e.g. [*$€) as well as umlauts (Ää Üü Öö) is not possible for technical printing reasons in some areas of this Promotion. If you need more information, please contact the Promoter. For technical reasons, the text used by the participant may not exceed a maximum length of 13 characters.</p>

<h3>Shipping / Multiple participation</h3>
<p>The claim to the Prize expires if the Prize cannot be delivered to the delivery address provided. The participant is responsible for the accuracy of the email address and shipping address provided.</p>
<p>The Prize will only be shipped within United Kingdom. The delivery of the Prize can take up to 3 weeks. The dispatch of the Prize will take place immediately after production, whereby delays may occur in individual cases. With the delivery of the Prize to the transport service provider, the risk of accidental deterioration and accidental loss lies with the participant.</p>
<p>Multiple participation is possible, i.e. each participant can also participate several times in the Promotion - with new promotion codes - regardless of whether they have already participated.</p>


<h3>Prize</h3>
<p>The Prize is a personalized bottle label for self-sticking.</p>
<p>The participation or the Prize cannot be combined with other promotions of the Promoter.</p>
<p>A cash-out of the Prize is not possible.</p>

<h3>Data protection</h3>
<p><u>Data processing in connection with participation in the promotion</u></p>
<p>Detailed information on the <strong>processing of personal data</strong> in the context of the Promotion can be found in the information on the processing of <a href="/node/4" target="_blank">personal data</a> under the Promotion.</p>
<p><u>Data processing in connection with the use of our website</u></p>
<p>The way in which personal data collected in connection with the use of our website is processed is described in the <strong><a href="https://www.jimbeam.com/privacy" target="_blank">privacy policy for the use of the website</a></strong>.</p>

<h3>Copyright regulations</h3>
<p>The participant expressly affirms that he/she holds the exclusive copyright to the content uploaded as part of the Promotion and that it is free from other third-party rights. The Promoter is not obliged to check the content provided by the participants for potential infringements of third party rights; the use and uploading of content that violates civil and/or criminal law, is likely to disparage other persons, groups of persons or companies, injure the religious feelings of third parties and/or that is harmful to minors, pornographic, racist, glorifies violence, incites hatred, offends against public morals or in a comparable manner and/or violates the code of conduct of the Promoter is expressly prohibited by the Promoter . The Promoter is entitled to refuse and delete such contributions without giving reasons.</p>
<p>Should the participant, contrary to the above provision, nevertheless upload content to which he does not hold the exclusive copyright and for which the Promoter suffers a legal disadvantage (e.g. claim for subsequent payment of licence fees and/or damages, etc.), the Promoter rejects any liability towards the actual holder of the rights and reserves the right to take legal action against the participant. In this respect, the participant indemnifies the Promoter against all third-party claims arising from the content provided by him.</p>
<p>If the participant subsequently realizes that he has uploaded content to which he does not hold the exclusive copyright, he must inform the Promoter immediately. For this purpose, an e-mail must be sent to <a href="mailto:info@mybeamlabel.com">info@mybeamlabel.com</a>.</p>
<p>With his participation, the participant transfers the rights to use the content for the purpose of publication for advertising purposes to the Promoter without time, space or content restrictions.</p>

<h3>Liablility</h3>
<p>The Promoter shall be liable in accordance with the statutory provisions for its own intent and gross negligence or that of its legal representatives, executives or other vicarious agents. The same applies to the assumption of guarantees or other liability regardless of fault as well as to claims under culpable injury to life, limb or health. The Promoter shall be liable on the merits for any breach of material contractual obligations caused by simple negligence on the part of the Promoter or its representatives, executives and vicarious agents, i.e. such obligations on the fulfilment of which the Participants may regularly rely for the proper execution of the Promotion; in this case, the amount of liability shall be limited to the typically foreseeable damage. Any further liability of the Promoter is excluded.</p>

<h3>Termination of the Promotion</h3>
<p>The Promotion may be modified, extended, suspended for a limited period of time, or terminated prematurely at any time without notice and for any reason.</p>
<p>This does not give rise to any claims against the Promoter.</p>

<h3>Exclusion of participants</h3>
<p>The Promoter reserves the right to exclude from the Promotion participants who provide false information in the context of the Promotion, who violate the Terms & Conditions and/or who manipulate and/or have manipulated the Promotion. The Promoter also reserves the right to exclude persons from participation who are suspected of using unauthorized aids to participate in the Promotion or who otherwise attempt to gain advantages for themselves or third parties by manipulation. If an attempt is made to gain an advantage by accidentally entering imaginary codes via the promotion page, the participant may also be excluded from the Promotion. In these cases, the refusal of an already promised bonus and also a reclaiming of the bonus come into consideration.</p>

<h3>Miscellaneous</h3>
<p>Should individual provisions of these Terms & Conditions be invalid or should there be a loophole, this shall not affect the validity of the remaining provisions. The invalid or incomplete provision shall be replaced or supplemented by a provision that comes as close as possible to the interests of the parties, subject to other individual agreements between the parties.</p>
<p>Legal recourse is excluded; this does not apply to data protection issues.</p>
<p>Any questions, comments or complaints concerning the Promotion should be sent by e-mail to <a href="mailto:info@mybeamlabel.com">info@mybeamlabel.com</a>.</p>

</section>
',
      NULL, NULL, NULL, NULL, 'white');
    $blocks[] = $block;

    $blocksDe[] = $varThis->blockBody->translate($block['id'], 'de', NULL, NULL,
      '
      <section class="faq-title"><h1>JIM BEAM PROMOTION MY BEAM LABEL</h1></section>
      <section class="faq-title"><h2>Teilnahmebedingungen</h2></section>
<section class="basic-page">
<p>Mit der Teilnahme an der Aktion akzeptiert der Teilnehmer die Teilnahmebedingungen:</p>
<p>Beam Suntory Inc., 222 W Merchandise Mart Plaza, Chicago, IL 60654 (im Folgenden "<strong>Veranstalter</strong>" genannt) veranstaltet zusammen mit dem Kooperationspartner REINBOLDROST GmbH & Co. KG, Joseph-Beuys-Alle 6, 53113 Bonn (im Folgenden "<strong>Kooperationspartner</strong>" genannt) unter der Marke „JIM BEAM“ unter dem Motto "My Beam Label" eine Promotion-Aktion (im Folgenden "<strong>Aktion</strong> genannt) im Zeitraum vom 03.02.2020 bis 31.08.2020, bei der personalisierte Flaschenetiketten zum Selbstbekleben verschickt werden (im Folgenden "<strong>Prämie</strong> genannt).</p>
<p>Teilnehmen können nur natürliche Personen ab 18 Jahren mit Wohnsitz in Deutschland. Mitarbeiter des Veranstalters und deren Angehörige sowie Mitarbeiter und Angehörige der mit dem Veranstalter verbundenen Unternehmen und Kooperationspartner sind nicht teilnahmeberechtigt.</p>
<p>Die Teilnahme hat in dem Aktionszeitraum vom 03.02.2020 bis zum 31.08.2020 zu erfolgen (im Folgenden "<strong>Aktionszeitraum</strong>"). Verspätete Teilnahmen, gleich aus welchem Grund, können leider nicht berücksichtigt werden.</p>

<h3>Und so funktioniert es</h3>
<p>Der Teilnehmer kauft in dem Aktionszeitraum eine Jim Beam Aktionsflasche mit Aktionsanhänger (jeweils solange der Vorrat reicht). Aktionsende/Teilnahmeschluss ist der 31.08.2020. Danach verlieren alle noch nicht eingelösten Aktionscodes ihre Gültigkeit. Der Verkauf und die Weitergabe der Aktionscodes sind untersagt.</p>
<p><u>Teilnahme über die Aktionswebseite</u></p>
<p>Auf den Aktionsanhängern befindet sich auf der Innenseite ein individuell eingedruckter Aktionscode. Um teilnehmen zu können, gibt der Teilnehmer auf der Internetseite www.jimbeam.de/jubiläum den Aktionscode in dem vorgesehenen Feld ein. Nach der System-Gültigkeitsprüfung des Aktionscodes erhält der Teilnehmer sofort die Möglichkeit, seinen Wunschnamen oder Botschaft einzugeben. Nach Bestellung des Wunschetiketts verliert der Aktionscode seine Gültigkeit und kann nicht noch einmal verwendet werden.</p>
<p>Für die weitere Prämienabwicklung muss der Teilnehmer zudem noch Angaben zu seiner Person (Vorname, Name), Anschrift (Straße, PLZ, Ort), Geburtsdatum sowie eine gültige E-Mail Adresse angeben.</p>
<p><u>Teilnahme über teilnehmende Geschäfte</u></p>
<p>Alternativ haben Teilnehmer die Möglichkeit ihren Preis in ausgewählten Geschäften ausdrucken zu lassen. Hierfür ist ebenfalls ein gültiger Aktionscode erforderlich.</p>
<p>Der Veranstalter behält sich das Recht vor, einen Begriff-Filter einzusetzen, der markenrechtliche Bezeichnungen und Begriffe mit negativer Konnotation verbietet.</p>

<h3>Verantwortlichkeit des Teilnehmers</h3>
<p>Der Teilnehmer ist für seine personalisierte Prämie allein verantwortlich. Er verpflichtet sich, keine Texte zu verwenden, die</p>
<ol>
<li>gegen Gesetze verstoßen, widerrechtlich, schädlich, konfrontativ, diffamierend, beleidigend, gewalttätig, gewaltverherrlichend, nationalsozialistisch und/oder rassistisch, pornografisch, vulgär, jugendgefährdend oder obszön sind, die religiöse oder ethische Gefühle verletzen können, die politische Äußerungen enthalten, die eine Drohung, schockierende oder herabsetzende Inhalte wiedergeben oder in sonstiger Weise die Würde oder Integrität eines Menschen verletzen können</li>
<li>die Rechte Dritter, insbesondere Urheber-, Marken- oder Patentrechte verletzen können</li>
<li>persönliche Daten Dritter enthalten (z.B. Biometrische Daten, Geburtsdatum, Adresse, Telefonnummer, etc.), und der / die Dritte einer Veröffentlichung nicht zugestimmt hat</li>
<li>zum übermäßigen oder verantwortungslosen Konsum von Alkohol aufrufen oder diesen verherrlichen</li>
<li>den Alkoholkonsum Minderjähriger gutheißen oder Minderjährige zum Alkoholkonsum anspornen</li>
<li>den Anschein vermitteln, dass der Konsum von Alkohol attraktiv, stark, beliebt oder sexuell erfolgreich mache</li>
<li>zurückhaltenden Alkoholkonsum oder Abstinenz in negativer Weise darstellen</li>
<li>den Alkoholkonsum im Straßenverkehr oder bei der Bedienung von Maschinen, die eine erhöhte Aufmerksamkeit erfordern, verharmlosen oder unterstützen</li>
<li>den Eindruck erwecken, Alkohol beuge Krankheiten vor oder heile sie</li>
<li>vorgeben, Alkohol unterstütze bei sportlichen oder bei möglicherweise gefährlichen Aktivitäten</li>
<li>den Alkoholgehalt (sei er nun hoch oder niedrig) positiv würdigen</li>
<li>Verkaufsläden oder den Verkauf von Produkten jeglicher Art bewerben</li>
<li>missverständliche oder falsche Informationen verbreiten oder das Produkt mit einer anderen Marke oder einem anderen Produkt vergleichen, insbesondere vorgeben, dass es sich um ein anderes Produkt / eine andere Marke handelt</li>
<li>eine Marke, ein Waren- oder Herkunftszeichen verwenden</li>
</ol>
<p>Der Veranstalter behält sich vor, die Personalisierung mit Texten, die gegen diese Vorgaben verstoßen, abzulehnen. In diesem Fall wird der Veranstalter den Teilnehmer hiervon informieren.</p>
<p>Der Veranstalter behält sich vor, gegen Teilnehmer, die gegen diese Vorgaben schuldhaft verstoßen, rechtlich vorzugehen und jeglichen dadurch entstehenden Schaden geltend zu machen.</p>
<p>Für den Fall, dass ein Dritter dem Veranstalter gegenüber Rechte behauptet, die den Veranstalter in der vertragsgemäßen Nutzung der Dateien, die der Teilnehmer für die Personalisierung der Prämie überlassen hat, beeinträchtigen, wird der Teilnehmer den Veranstalter bei der Abwehr solcher Ansprüche unterstützen und auf erste Anforderung von allen damit in Zusammenhang stehenden Ansprüchen des Dritten freistellen und jeglichen Schaden, der dem Veranstalter wegen des Rechts des Dritten entsteht, einschließlich etwaiger für die Rechtsverteidigung anfallenden Gerichts- und Anwaltskosten ersetzen, es sei denn, der Veranstalter hat den Verstoß ausschließlich zu verantworten. Sollte der Teilnehmer nachträglich erkennen, dass er Inhalte, an denen ihm nicht das ausschließliche Recht, insbesondere Urheber-, Marken-, Patent und Namensrecht zusteht, überlassen hat, ist er verpflichtet, den Veranstalter hierrüber unverzüglich in Kenntnis zu setzen <a href="mailto:jimbeam@promotionservice.de">jimbeam@promotionservice.de</a>. Der Veranstalter ist nicht verpflichtet, die von den Teilnehmern übermittelten Inhalte auf potentielle Verletzung Rechte Dritter zu überprüfen.</p>
<p>Der Veranstalter ist nicht verantwortlich für Rechtschreibfehler innerhalb der Namen und Botschaften, die aus einer fehlerhaften Eingabe des Teilnehmers resultieren oder auf sonstige Weise. Der Anspruch auf eine neue korrigierte Prämie verfällt.</p>
<p>Zudem ist die Verwendung von Sonderzeichen jeglicher Form (z.B. [*$€)  aus drucktechnischen Gründen in manchen Aktionsgebieten nicht möglich. Bei Fragen wenden Sie sich bitte an den Veranstalter. Aus technischen Gründen darf der vom Teilnehmer verwendete Text die Länge von maximal 13 Buchstaben nicht übersteigen.</p>


<h3>Versand / Mehrfachteilnahme</h3>
<p>Der Anspruch auf die Prämien verfällt, wenn die Prämien unter der mitgeteilten Versandanschrift nicht zugestellt werden können. Für die Richtigkeit der angegebenen E-Mail-Adresse und der Versandanschrift ist der Teilnehmer verantwortlich. </p>
<p>Die Prämien werden nur innerhalb Deutschlands versandt. Die Zustellung der Prämien kann bis zu 4 Wochen dauern. Der Versand der Prämien erfolgt umgehend nach Produktion, wobei es im Einzelfall zu Verzögerungen kommen kann. Mit der Übergabe der Prämie an den Transportdienstleister liegt die Gefahr der zufälligen Verschlechterung und des zufälligen Untergangs beim Teilnehmer.</p>
<p>Eine Mehrfachteilnahme ist möglich, d.h. jeder Teilnehmer kann – mit neuen Aktionscodes – auch mehrmals an der Aktion teilnehmen, unabhängig davon, ob er bereits teilgenommen hat. </p>

<h3>Prämie</h3>
<p>Bei der Prämie handelt es sich um personalisierte Flaschenetiketten zum Selbstbekleben. </p>
<p>Die Teilnahme bzw. die Treueprämie ist nicht mit anderen Promotion-Aktionen des Veranstalters kombinierbar.</p>
<p>Eine Barauszahlung der Prämie ist nicht möglich.</p>

<h3>Datenschutz</h3>
<p><u>Datenverarbeitung im Zusammenhang mit der Teilnahme an der Aktion</u></p>
<p>Ausführliche Informationen zur Verarbeitung personenbezogener Daten im Zusammenhang mit der Aktion sind in den <strong><a href="/de/node/4" target="_blank">Informationen zur Verarbeitung personenbezogener Daten</a></strong> im Rahmen der Aktion enthalten.</p>
<p><u>Datenverarbeitung im Zusammenhang mit der Nutzung unserer Website</u></p>
<p>Auf welche Weise personenbezogene Daten verarbeitet werden, die im Zusammenhang mit der Nutzung unserer Website anfallen, ist in der <strong><a href="https://www.jimbeam.com/de/datenschutzerklarung" target="_blank">Datenschutzrichtlinie für die Nutzung der Website</a></strong> beschrieben.</p>


<h3>Urheberrechtliche Bestimmungen</h3>
<p>Der Teilnehmer versichert ausdrücklich, dass ihm an dem im Rahmen des Gewinnspiels hochgeladenen Inhalt das ausschließliche Urheberrecht iSd § 7 UrhG zusteht, und dass es frei von sonstigen Rechten Dritter ist. Der Veranstalter ist nicht verpflichtet, die von den Teilnehmern bereit gestellten Inhalte auf potentielle Verletzungen Rechte Dritter zu überprüfen; das Verwenden und Hochladen von Inhalt, der gegen zivil- und/oder strafrechtliche Vorschriften im Geltungsbereich des BGB, StGB oder sonstiger Schutzgesetze verstößt, geeignet ist, andere Personen, Personengruppen oder Unternehmen zu verunglimpfen, religiöse Gefühle Dritter zu verletzen, und/oder das jugendgefährdend, pornografisch, rassistisch, gewaltverherrlichend, volksverhetzend, beleidigend oder in vergleichbarer Weise gegen die guten Sitten verstößt und/oder gegen den Verhaltenskodex  des Veranstalters verstößt, wird von dem Veranstalter ausdrücklich untersagt. Der Veranstalter ist berechtigt, derartige Beiträge ohne Begründung abzulehnen und zu löschen.</p>
<p>Sollte der Teilnehmer entgegen vorstehender Bestimmung dennoch Inhalte hochladen, an denen ihm nicht das ausschließliche Urheberrecht zusteht und der Veranstalter aus diesem Grund einen rechtlichen Nachteil erleidet (Beispiel: Forderung nach nachträglicher Zahlung von Lizenzgebühren und/oder Schadensersatz etc.), weist der Veranstalter jegliche Haftung gegenüber dem tatsächlichen Rechteinhaber zurück und behält sich vor, gegen den Teilnehmer rechtlich vorzugehen. Der Teilnehmer stellt den Veranstalter insoweit von allen Ansprüchen Dritter frei, die aufgrund der von ihm bereitgestellten Inhalte entstanden sind.</p>
<p>Erkennt der Teilnehmer nachträglich, dass er Inhalte, an denen ihm nicht das ausschließliche Urheberrecht zusteht, hochgeladen hat, hat er den Veranstalter unverzüglich hierüber zu informieren. Hierzu ist eine E-Mail an <a href="mailto:jimbeam@promotionservice.de">jimbeam@promotionservice.de</a> zu richten.</p>
<p>Mit seiner Teilnahme überträgt der Teilnehmer die Rechte zur Nutzung des Inhalts zum Zwecke der Veröffentlichung zu Werbezwecken an den Veranstalter ohne zeitliche, räumliche oder inhaltliche Einschränkung. Dies umfasst insbesondere das Recht, den User-Content auf der Facebook und oder Instagram-Seite des Veranstalters bzw. in der APP öffentlich zugänglich zu machen und hierfür zu bearbeiten. </p>

<h3>Haftung</h3>
<p>Der Veranstalter haftet nach den gesetzlichen Vorschriften für eigenen Vorsatz und grobe Fahrlässigkeit bzw. seiner gesetzlichen Vertreter, leitenden Angestellten oder sonstigen Erfüllungsgehilfen. Gleiches gilt bei der Übernahme von Garantien oder einer sonstigen verschuldensunabhängigen Haftung sowie bei Ansprüchen nach dem Produkthaftungsgesetz oder bei einer schuldhaften Verletzung des Lebens, des Körpers oder der Gesundheit. Der Veranstalter haftet dem Grunde nach für eigene bzw. seiner Vertreter, leitenden Angestellten und einfachen Erfüllungsgehilfen verursachte einfach fahrlässige Verletzung wesentlicher Vertragspflichten, d.h. solcher Pflichten, auf deren Erfüllung die Teilnehmer zur ordnungsgemäßen Durchführung der Aktion regelmäßig vertrauen dürfen; in diesem Fall ist die Haftung der Höhe nach auf den typischerweise entstehenden, vorhersehbaren Schaden begrenzt. Eine darüberhinausgehende Haftung des Veranstalters ist ausgeschlossen.</p>

<h3>Beendigung der Aktion</h3>
<p>Die Aktion kann jederzeit ohne Vorankündigung und ohne Angabe von Gründen geändert, verlängert, für einen vorübergehenden Zeitraum ausgesetzt oder vorzeitig beendet werden.</p>
<p>Hieraus entstehen keine Ansprüche gegen den Veranstalter.</p>

<h3>Ausschluss von Teilnehmern</h3>
<p>Der Veranstalter behält sich das Recht vor, Teilnehmer, die falsche Angaben im Rahmen der Aktion machen, gegen die Teilnahmebedingungen verstoßen und/oder Manipulationen vornehmen und/oder vornehmen lassen, von der Aktion auszuschließen. Der Veranstalter behält sich auch das Recht vor, Personen, bei denen der Verdacht besteht, dass sie sich bei der Teilnahme an der Aktion unerlaubter Hilfsmittel bedienen oder in sonstiger Weise versuchen, sich oder Dritten durch Manipulation Vorteile zu verschaffen, von der Teilnahme auszuschließen. Bei einem Versuch, sich durch zufällige Eingabe ausgedachter Codes über die Aktionsseite einen Vorteil zu verschaffen, kann der Teilnehmer ebenfalls von der Aktion ausgeschlossen werden. In diesen Fällen kommen die Verweigerung einer bereits zugesagten Prämie und auch eine Rückforderung der Prämie in Betracht.</p>

<h3>Sonstiges</h3>
<p>Sollten einzelne Bestimmungen dieser Teilnahmebedingungen unwirksam sein oder sollte eine Regelungslücke bestehen, berührt dieses die Wirksamkeit der übrigen Bestimmungen nicht. Die unwirksame oder lückenhafte Regelung wird durch eine solche ersetzt bzw. ergänzt, die den Interessen des Veranstalters und der Parteien am nächsten kommt, vorbehaltlich anderweitiger individueller Vereinbarungen der Parteien.</p>
<p>Der Rechtsweg ist ausgeschlossen; dies gilt nicht für datenschutzrechtliche Fragen.</p>
<p>Sämtliche Fragen, Kommentare oder Anmerkungen zur Aktion zur Aktion sind per E-Mail an die Adresse <a href="mailto:jimbeam@promotionservice.de">jimbeam@promotionservice.de</a> zu richten.</p>
</section>',

      NULL, NULL, NULL, NULL, 'white');

    $node = $varThis->nodePage->createNode('Terms and Conditions', $blocks, 'full', '/terms');
    $nodeDe = $varThis->nodePage->translateNode($node, 'de', 'Teilnahmebedingungen', $blocksDe, 'full', '/teilnahmebedingungen');
  }
}
