<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
* Nederlandse vertaling @ Solidjeuh <https://www.froddelpower.be>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ‚ ‘ ’ « » „ “ ” …
//
$lang = array_merge($lang, array(
	'ACP_PRIVACY_SETTINGS'					=> 'Privacybeleid - Instellingen',
	'ACP_PRIVACY_URL'						=> 'URL van uw verklaring over het privacybeleid',
	'ACP_PRIVACY_URL_EXPLAIN'				=> 'Voer een geldige link in naar uw privacy beleidsverklaring. Dit overschrijft de koppeling naar de originele privacy beleidsverklaring.',
	'ACP_REJECT_URL'						=> 'URL voor afwijzing',
	'ACP_REJECT_URL_EXPLAIN'				=> 'Als hier een URL wordt opgegeven, geeft het update bericht een extra knop voor het afkeuren van het privacybeleid, dat verwijst naar de URL die hier wordt vermeld',
	'ACP_REJECT_GROUP'						=> 'Verplaats naar groep',
	'ACP_REJECT_GROUP_EXPLAIN'				=> 'Selecteer een groep waarnaar alle gebruikers worden verplaatst die niet akkoord gingen met het privacybeleid.',
	'ACP_NO_REJECT_GROUP'					=> ' - Niet verplaatsen -',
	'ACP_MOVE_GROUP'						=> 'Verplaats van de oude groep',
	'ACP_MOVE_GROUP_EXPLAIN'				=> 'Activeer om alle leden van de eerder geselecteerde groep naar de nieuw geselecteerde groep te verplaatsen.',
	'ACP_REG_ACCEPT_PRIVACY'				=> 'Privacybeleid bij registratie',
	'ACP_REG_ACCEPT_PRIVACY_EXPLAIN'		=> 'Moeten gebruikers het privacybeleid accepteren bij het registreren?',
	'ACP_REG_ACCEPT_MAIL'					=> 'Massa e-mail bij het registreren',
	'ACP_REG_ACCEPT_MAIL_EXPLAIN'		    => 'Moeten gebruikers akkoord gaan met massa e-mail wanneer ze zich registreren?',
	'ACP_IP_SETTINGS'						=> 'IP-adressen',
	'ACP_ANONYMIZE_IP'						=> 'IP-adressen anonimiseren',
	'ACP_ANONYMIZE_IP_EXPLAIN'				=> 'Wanneer geactiveerd, zal phpBB niet langer het oorspronkelijke IP-adres van een gebruiker opslaan.',
	'ANONYMIZE_IP_NONE'						=> 'Niet anoniem maken',
	'ANONYMIZE_IP_FULL'						=> 'Volledig anonimiseren',
	'ANONYMIZE_IP_HASH'						=> 'Gebruik hash',
	'ACP_ANONYMIZE_IP_TIME'					=> 'Anonimiseer automatisch',
	'ACP_ANONYMIZE_IP_TIME_EXPLAIN'			=> 'Kies na welk tijdstip de opgeslagen IP-adressen automatisch moeten worden geanonimiseerd. De IP-adressen zijn volledig geanonimiseerd.',
	'WEEKS'									=> 'weken',
	'MONTHS'								=> 'Maanden',
	'YEARS'									=> 'Jaren',
	'ACP_FOOTERLINK'						=> 'Link in voettekst',
	'ACP_FOOTERLINK_EXPLAIN'				=> 'Moet een link naar het privacybeleid worden weergegeven in de voettekst?',
	'ACP_DATA_DOWNLOAD_OPTIONS'				=> 'Gegevens downloaden',
	'ACP_POST_FORMAT'						=> 'Berichten',
	'ACP_POST_FORMAT_EXPLAIN'				=> 'Kies wat moet worden toegevoegd bij het downloaden van berichten.',
	'INCLUDE_TEXT'							=> 'Tekst en metadata',
	'ONLY_META'								=> 'Alleen metadata',
	'ACP_POST_READ'							=> 'Alleen leesbare berichten',
	'ACP_POST_READ_EXPLAIN'					=> 'Moet het downloaden van berichten worden beperkt tot forums die de gebruiker kan lezen?',
	'ONLY_READ'								=> 'Alleen berichten met leesrechten',
	'ACP_POST_UNAPPROVED'					=> 'Niet gecontroleerde berichten',
	'ACP_POST_UNAPPROVED_EXPLAIN'			=> 'Moeten niet gecontroleerde berichten worden opgenomen?',
	'ACP_POST_DELETED'						=> 'Verwijderde berichten',
	'ACP_POST_DELETED_EXPLAIN'				=> 'Moet verwijderde berichten bevatten?',
	'ACP_PRIVACYPROTECTION_PRIVACY_EXPLAIN'	=> 'Hier kunt u uw eigen privacybeleid invoeren, waarbij het privacybeleid wordt overschreven het taalbestand. Je kunt hier HTML gebruiken. Gebruik <code>{SITE_NAME}</code> voor de naam en <code>{SITE_URL}</code> voor de URL van uw forum. Laat het veld leeg om het privacybeleid te gebruiken in het taalbestand.',
	'PRIVACY_URL_WARNING'					=> 'U hebt <a href="%1$s">%1$s</a> opgegeven als URL voor het privacybeleid. Het privacybeleid hierboven wordt alleen weergegeven als u deze URL verwijdert in de instellingen.',
	'ACP_PRIVACY_OPTIONS'					=> 'Privacy opties',
	'UPDATE_PRIVACY'						=> 'Privacybeleid is bijgewerkt',
	'UPDATE_PRIVACY_EXPLAIN'				=> 'Voer deze actie uit na het updaten van het privacybeleid. Alle gebruikers moeten vervolgens het nieuwe privacybeleid accepteren.',
	'PRIVACY_POLICE_UPDATED'				=> 'Het privacybeleid is ingesteld op de huidige datum. Alle gebruikers moeten eerst hun acceptatie opnieuw bevestigen om door te gaan met het gebruik van het forum.',
	'ACP_DELETE_IP'							=> 'Anonimiseer alle opgeslagen IP’s.',
	'ACP_DELETE_IP_EXPLAIN'					=> 'Voer deze optie uit om alle IP’s die zijn opgeslagen in phpBB te anonimiseren.<br><strong>Houd er rekening mee dat dit niet ongedaan kan worden gemaakt!</strong>',
	'IP_DELETE_SUCCESS'						=> 'Alle IP-adressen zijn geanonimiseerd.',
	'PRIVACY_LAST_ACCPEPT'					=> 'Privacybeleid laatst geaccepteerd',
	'LAST_ACCPEPT'							=> 'Laatst geaccepteerd',
	'ACP_SUBMIT'							=> 'Instellingen opslaan',
	'ACP_SAVED'								=> 'Instellingen opgeslagen.',
	'USER_LIST_ACEPTED'						=> 'Geaccepteerd',
	'USER_LIST_NOT_ACEPTED'					=> 'Niet geaccepteerd',
	'USER_LIST_NOT_ACEPTED_ONLINE'			=> 'Niet geaccepteerd, was online',
	'USER_ADMIN_REVOKE_PRIVACY'				=> '',
));
