<?php

namespace Drupal\beam_migrator\Migrator\Content;

use Drupal\beam_migrator\Migrator\ContentMigrator;

class PagePersonalDataMigrator extends ContentMigrator {

  protected function create($varThis) {
    $blocks = [];
    $blocksDe = [];

// <br />
    // ''AS IS'' -> "

    $block = $varThis->blockBody->createParagraph(NULL, NULL,
      '
      <section class="faq-title"><h1>Information on the processing of personal data in the context of the Jim Beam Promotion My Beam Label</h1></section>
<section class="basic-page">
<p>The following describes how Beam Suntory processes your personal data as part of the Promotion. The Promotion is carried out in cooperation with our cooperation partner [●](hereinafter referred to as "<strong>Cooperation Partner</strong>"). For the further processing of your personal data by Cooperation Partners, the data protection information provided by the Cooperation Partners shall apply exclusively. Beam Suntory is not responsible for data processing by Cooperation Partners. Please contact <a href="mailto:info@mybeamlabel.com">info@mybeamlabel.com</a>.</p>
<p>Beam Suntory will point this out to you and by giving your consent, you declare that you have taken note of the fact that information on the Internet is accessible worldwide and can be linked to other information, from which personality profiles can possibly be created. You understand that information posted on the Internet, including photographs, can be easily copied and redistributed. You understand that such sharing is especially possible and likely if you upload your photo to the so-called social network. This can lead to information published on the Internet still being found elsewhere even after it has been deleted. </p>
<p>You have noted that information that is accessible worldwide on the Internet can be retrieved by search engines and that there are special archiving services that aim to permanently document the state of certain websites on certain dates. This can lead to information published on the Internet still being found elsewhere on the original page even after it has been deleted.</p>
<p>Data processing by Beam Suntory: </p>

<h3>Controller</h3>
<p>Beam Suntory Inc., 222 W Merchandise Mart Plaza, Chicago, IL 60654 ("Beam Suntory" or "Promoter") is responsible for the processing of your personal data within the scope of the Promotion. Beam Suntory has appointed a data protection officer, who you can reach under <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a>, Calle Mahonia, 2, 28043, Madrid, Spain.</p>

<h3>Data categories</h3>
<p>The following data categories will be processed by Beam Suntory during the Promotion:</p>
<p>Your <u>first</u> and <u>last name</u>, <u>e-mail address</u>, <u>date of birth</u> and <u>address</u>.</p>
<p>If you upload a <strong>photo</strong> as part of the Promotion, biometric data may be collected from you that allows clear identification based on your facial shape and includes references to your ethical origin, religion or health (e.g. skin colour, headgear or glasses). Your consent relates to this information and in particular to the processing of your biometric data.</p>
<p>Beam Suntory itself does not use your data for biometric identification and does not perform such analysis.</p>

<h3>Purpose of processing</h3>
<p>Beam Suntory needs your personal data for the execution and handling of the Promotion, in particular to identify you as a recipient of a personalized label or to sweep out the label. In the event that you have ordered a label and there are difficulties in making your label available, Beam Suntory will need your address or email address to contact you.</p>
<p>Beam Suntory needs your photo according to the above information to provide you with the desired label you have selected. </p>
<p>To ensure that you are of legal age and therefore eligible to participate, Beam Suntory requires confirmation of your date of birth. </p>
<p>You have the option to opt out of providing your personal information or to provide Beam Suntory with incomplete information. However, this may prevent you from participating in the Promotion or from receiving a promotional label. </p>

<h3>Legal basis of the processing</h3>
<p>The legal basis for the processing of your personal data is the participation relationship in the campaign (Art. 6 para. 1 lit. b) GDPR.</p>

<h3>Recipient</h3>
<p>Only employees of Beam Suntory, its subsidiaries and/or cooperation partner who is responsible for the implementation of the Promotion within the scope of their duties have access to your personal data. In order to protect your personal data, Beam Suntory has also concluded data protection agreements with all of its cooperation partners who have access to your personal data</p>
<p>Your personal data will be collected from cooperation partners who operate the "My Beam Label" campaign website. The cooperation partner is responsible for sending the desired labels on behalf of Beam Suntory.</p>
<p>In addition, Beam Suntory, its subsidiaries and/or its cooperation partners may use third party IT maintenance or service companies to provide you with access to your personal information.</p>
<p>Beam Suntory will not disclose your personal information to any government agency or court unless Beam Suntory is required to do so by applicable law or court order. Beam Suntory assures you that it will</p>
<ul>
<li>will treat your personal data in accordance with the aforementioned provisions, guidelines and applicable laws and with contractual obligations</li>
<li>will use your personal data only for the legitimate business purposes for which it was collected</li>
<li>will act transparently with respect to the purpose for which your personal data was collected</li>
<li>has limited access to sensitive personal data so that access is granted only to those who have a professional or contractual obligation to maintain confidentiality.</li>
</ul>
<p> As Beam Suntory is an international enterprise, there may be instances where it may be necessary for us to transfer your information outside the European Union, e.g. to our headquarters and various subsidiaries, or if we use third party service providers from another country. In these circumstances, we will put in place suitable safeguards, for example an intra-group data transfer agreement or standard contractual clauses approved by the European Commission, to ensure that your information is processed securely and in accordance with this Privacy Notice and applicable regulations. If you require further information about the safeguards we put in place, you can request such information by contacting us by email at <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a>.</p>

<h3>Automated decision making and profile building</h3>
<p>Your personal data will not be used by Beam Suntory for automated decision-making processes.</p>

<h3>How long are your personal data stored?</h3>
<p>Your personal data will only be stored for the duration of the Promotion and will then be deleted immediately or in accordance with the following description as soon as you have withdrawn your consent. Photos will be removed by Beam Suntory within a maximum of two weeks and will not be used again. </p>

<h3>Your rights</h3>
<p>You may contact Beam Suntroy in writing or by e-mail <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a> to exercise the following rights under applicable law:</p>
<ul>
<li>You may request access to your data in order to verify it</li>
<li>You can request a copy of your personal data</li>
<li>You may request the completion, correction or deletion of your personal data or request that the collection, processing, use or disclosure of your personal data be discontinued or restricted; the right of rectification includes the right to have incomplete personal data completed, including by sending an additional notice</li>
<li>You may object to the processing of your personal data</li>
<li>You may request your personal data in a structured, common and machine-readable format and have it transferred to another data controller, provided that it is processed with your consent or to fulfill a contractual relationship or a pre-contractual relationship with you</li>
<li>You can lodge a complaint with a supervisory authority regarding the processing of your personal data</li>
</ul>
<p>If you have any questions, please contact: <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a></p>

</section>
',
      NULL, NULL, NULL, NULL, 'white');
    $blocks[] = $block;






    $blocksDe[] = $varThis->blockBody->translate($block['id'], 'de', NULL, NULL,
      '
      <section class="faq-title"><h1>Informationen zur Verarbeitung personenbezogener Daten im Rahmen der Aktion "My Beam Label"</h1></section>
<section class="basic-page">
<p>Nachfolgend ist beschrieben, wie Beam Suntory Ihre personenbezogenen Daten im Rahmen der Aktion verarbeitet. Die Aktion wird in Zusammenarbeit mit unserem Kooperationspartner REINBOLDROST GmbH & Co. KG, Joseph-Beuys-Allee 6, 53113 Bonn (nachfolgend "<strong>Kooperationspartner</strong>) durchgeführt. Für die weitere Verarbeitung Ihrer personenbezogenen Daten durch Kooperationspartner gilt ausschließlich die bereitgestellte Datenschutzinformation der Kooperationspartner. Bitte wenden Sie sich insoweit an <strong><a href="mailto:jimbeam@promotionservice.de">jimbeam@promotionservice.de</a></strong></p>
<p>Sie bestätigen, dass Sie zur Kenntnis genommen haben, dass Informationen im Internet weltweit zugänglich sind und mit anderen Informationen verknüpft werden können, woraus sich unter Umständen Persönlichkeitsprofile erstellen lassen. Dies kann dazu führen, dass im Internet veröffentlichte Informationen auch nach ihrer Löschung weiterhin andernorts aufzufinden sind. </p>
<p>Sie haben zur Kenntnis genommen, dass Informationen, die im Internet weltweit zugänglich sind, mit Suchmaschinen abgerufen werden können und dass es spezielle Archivierungsdienste gibt, deren Ziel es ist, den Zustand bestimmter Websites zu bestimmten Terminen dauerhaft zu dokumentieren. Dies kann dazu führen, dass im Internet veröffentlichte Informationen auch nach ihrer Löschung auf der Ursprungsseite weiterhin andernorts aufzufinden sind.</p>
<p>Datenverarbeitung durch Beam Suntory: </p>

<h3>Verantwortlicher</h3>
<p>Beam Suntory Inc., 222 W Merchandise Mart Plaza, Chicago, IL 60654, USA ("Beam Suntory" oder "Veranstalter") ist für die Verarbeitung Ihrer personenbezogenen Daten im Rahmen der Aktion verantwortlich. Beam Suntory hat einen Datenschutzbeauftragten bestellt, den Sie unter <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a>, Calle Mahonia, 2, 28043, Madrid, Spanien erreichen können.</p>

<h3>Datenkategorien</h3>
<p>Die folgenden Datenkategorien werden von Beam Suntory anlässlich der Aktion verarbeitet:</p>
<p>Ihr <u>Vor- und Nachname</u>, <u>E-Mail-Adresse</u>, <u>Geburtsdatum</u> sowie <u>Anschrift (Straße, Hausnummer, PLZ, Ort)</u>.</p>

<h3>Zweck der Verarbeitung</h3>
<p>Beam Suntory benötigt Ihre personenbezogenen Daten zur Durchführung und Abwicklung der Gewinnspielaktion, namentlich um Sie als möglichen Gewinner zu ermitteln bzw. die Gewinne an die jeweiligen Gewinner auszukehren. Für den Fall, dass Sie gewonnen haben und es Schwierigkeiten bei der Gewinnbereitstellung gibt, benötigt Beam Suntory Ihre Anschrift oder E-Mail-Adresse, um mit Ihnen in Kontakt zu treten.</p>
<p>Um sicherzustellen, dass Sie volljährig und damit teilnahmeberechtigt sind, benötigt Beam Suntory eine entsprechende Bestätigung in Form der Angabe Ihres Geburtsdatums. </p>
<p>Sie haben die Möglichkeit, von der Bereitstellung Ihrer personenbezogenen Daten abzusehen oder Beam Suntory unvollständige Informationen zu überlassen. Dies kann jedoch dazu führen, dass Sie an der Aktion nicht teilnehmen bzw. ein Wunschetikett nicht erhalten können.</p>

<h3>Rechtsgrundlage der Verarbeitung</h3>
<p>Rechtsgrundlage für die Verarbeitung Ihrer personenbezogenen Daten ist das Teilnahmeverhältnis an der Aktion (Art. 6 Abs. 1 lit. b) DS-GVO.</p>

<h3>Empfänger</h3>
<p>Zu Ihren personenbezogenen Daten haben ausschließlich Mitarbeiter von Beam Suntory, deren Tochterunternehmen sowie Mitarbeiter des Kooperationspartners Zugang, der im Rahmen seines Aufgabenbereichs für die Durchführung der Aktion zuständig ist. Um Ihre personenbezogenen Daten zu schützen, hat Beam Suntory zudem mit all seinen Kooperationspartnern, die Zugang zu Ihren persönlichen Daten haben, jeweils eine Datenschutzvereinbarung geschlossen.</p>
<p>Ihre personenbezogenen Daten werden bei Kooperationspartner, der die Aktionsseite www.jimbeam.de/jubiläum betreibt, gesammelt. Kooperationspartner übernimmt für Beam Suntory die Versendung der Wunschetiketten.  </p>
<p>Darüber hinaus kann es sein, dass sich Beam Suntory bzw. Kooperationspartner für IT-Wartungs- bzw. Serviceleistungen dritter Unternehmen bedienen, die im Rahmen dieser Tätigkeit Zugriff auf Ihre personenbezogenen Daten erhalten können. </p>
<p>Beam Suntory wird Ihre persönlichen Daten nicht an Behörden oder Gerichte weitergeben, es sei denn Beam Suntory ist dazu durch anwendbares Recht bzw. eine gerichtliche Anordnung oder einen Gerichtsbeschluss gezwungen. Beam Suntory versichert Ihnen, dass sie</p>
<ul>
<li>Ihre persönlichen Daten im Einklang mit den vorgenannten Bestimmungen, Richtlinien und anwendbaren Gesetzen und mit vertraglichen Verpflichtungen behandeln wird</li>
<li>Ihre persönlichen Daten nur zu denjenigen legitimen Geschäftszwecken nutzen wird, zu dem diese Daten erhoben wurden</li>
<li>hinsichtlich des Zwecks, für den Ihre persönlichen Daten erhoben wurden, transparent handeln wird</li>
<li>den Zugang zu sensitiven persönlichen Daten beschränkt hat, sodass nur denjenigen Zugang gewährt wird, die beruflich bzw. vertraglich zur Vertraulichkeit verpflichtet sind.</li>
</ul>
<p>Da Beam Suntory ein internationales Unternehmen ist, kann es vorkommen, dass wir Ihre Daten außerhalb der Europäischen Union übertragen müssen, z.B. an unseren Hauptsitz und verschiedene Tochtergesellschaften, oder wenn wir Drittanbieter aus einem anderen Land beauftragen. In diesen Fällen werden wir geeignete Sicherheitsvorkehrungen treffen, z. B. einen konzerninternen Datentransfervertrag oder von der Europäischen Kommission genehmigte Standardvertragsklauseln, um sicherzustellen, dass Ihre Daten sicher und in Übereinstimmung mit dieser Datenschutzerklärung und den geltenden Vorschriften verarbeitet werden. Wenn Sie weitere Informationen über die von uns eingeführten Sicherheitsvorkehrungen benötigen, können Sie diese Informationen anfordern, indem Sie uns per E-Mail unter dpo@beamsuntory.com kontaktieren.</p>

<h3>Automatisierte Entscheidungsfindung und Profilbildung</h3>
<p>Ihre persönlichen Daten werden bei Beam Suntory nicht für automatisierte Entscheidungsprozesse genutzt. </p>

<h3>Wie lange werden Ihre personenbezogenen Daten gespeichert?</h3>
<p>Ihre persönlichen Daten werden nur für die Dauer der Aktion gespeichert und anschließend unverzüglich bzw. entsprechend der nachfolgenden Beschreibung gelöscht, sobald Sie Ihre Einwilligung widerrufen haben. </p>

<h3>Ihre Rechte</h3>
<p>Sie können sich schriftlich oder per E-Mail <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a> an Beam Suntory wenden, um die folgenden Ihnen unter anwendbarem Recht zustehenden jeweiligen Rechte auszuüben:</p>
<ul>
<li>Sie können Zugriff auf Ihre Daten verlangen, um sie zu überprüfen</li>
<li>Sie können eine Kopie Ihrer personenbezogenen Daten anfordern</li>
<li>Sie können die Ergänzung, Korrektur oder Löschung Ihrer personenbezogenen Daten verlangen oder können verlangen, dass das Erfassen, die Verarbeitung, Verwendung oder Offenlegung Ihrer personenbezogenen Daten eingestellt bzw. eingeschränkt wird; das Berichtigungsrecht umfasst das Recht, unvollständige personenbezogene Daten vervollständigen zu lassen, auch durch Übersendung einer zusätzlichen Mitteilung</li>
<li>Sie können der Verarbeitung Ihrer personenbezogenen Daten widersprechen</li>
<li>Sie können Ihre personenbezogenen Daten in einem strukturierten, gängigen und maschinenlesbaren Format anfordern und sie an einen anderen Datenverantwortlichen übermitteln lassen, vorausgesetzt, die Verarbeitung erfolgt mit Ihrer jeweiligen Zustimmung oder zur Erfüllung einer vertraglichen Beziehung oder einer mit Ihnen bestehenden vorvertraglichen Beziehung</li>
<li>Sie können eine Beschwerde bei einer Aufsichtsbehörde bezüglich der Verarbeitung Ihrer persönlichen Daten einreichen</li>
</ul>
<p>Sollten Sie Fragen haben, wenden Sie sich bitte an: <a href="mailto:dpo@beamsuntory.com">dpo@beamsuntory.com</a></p>
</section>',

      NULL, NULL, NULL, NULL, 'white');

    $node = $varThis->nodePage->createNode('Personal Data Statement', $blocks, 'full', '/personal-data');
    $nodeDe = $varThis->nodePage->translateNode($node, 'de', 'Personenbezogener', $blocksDe, 'full', '/personenbezogener');

  }
}
