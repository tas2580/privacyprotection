<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
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
// ’ » “ ” …
//
$lang = array_merge($lang, array(
	'PRIVACY_SETTINGS'				=> 'Datenschutz-Einstellungen',
	'ACP_PRIVACY_URL'				=> 'URL zu deiner Datenschutzerklärung',
	'ACP_PRIVACY_URL_EXPLAIN'		=> 'Gib eine URL zu deiner Datenschutzerklärung ein. Die URL überschreibt alle Links zur ursprünglichen Datenschutzerklärung von phpBB.',
	'ACP_REJECT_URL'				=> 'Gib hier eine URL ein, auf die der Nutzer umgeleitet wird, wenn er die aktualisierung deiner Datenschutzerklärung ablehnt',
	'ACP_REJECT_URL_EXPLAIN'		=> 'Wenn hier eine URL angegeben wird gibt die Aktualisierungsmeldung einen zusätzlichen Button zum ablehnen der Datenschutzerklärung aus, der auf die hier angegebene URL verweist.',
	'ACP_POST_DOWNLOAD'				=> 'Beiträge runterladen erlauben',
	'ACP_POST_DOWNLOAD_EXPLAIN'		=> 'Wenn aktiviert können Benutzer einige Details ihrer Beiträge im persönlichen Bereich des Profils herunterladen.',
	'ACP_DATA_DOWNLOAD'				=> 'Daten runterladen erlauben',
	'ACP_DATA_DOWNLOAD_EXPLAIN'		=> 'Wenn aktiviert können Benutzer ihre Profildaten im persönlichen Bereich herunterladen.',
	'ACP_REJECT_GROUP'				=> 'In Gruppe verschieben',
	'ACP_REJECT_GROUP_EXPLAIN'		=> 'Wähle eine Gruppe in die alle Benutzer verschoben werden, die der Datenschutzerklärung nicht zugestimmt haben.',
	'ACP_NO_REJECT_GROUP'			=> ' - Nicht verschieben -',
	'PRIVACY_OPTIONS'				=> 'Datenschutzerklärung',
	'ACP_ANONYMIZE'					=> 'IP Adressen anonymisieren',
	'ACP_ANONYMIZE_EXPLAIN'			=> 'Wähle aus ob und wie du IP Adressen anonymisieren möchtest.',
	'ANONYMIZE_IP_NONE'				=> 'Nicht anonymisieren',
	'ANONYMIZE_IP_FULL'				=> 'Komplett anonymisieren',
	'ANONYMIZE_IP_HASH'				=> 'Hash verwenden',
	'UPDATE_PRIVACY'				=> 'Datenschutzerklärung wurde aktualisiert',
	'UPDATE_PRIVACY_EXPLAIN'		=> 'Führe die Aktion aus nachdem du die Datenschutzerklärung aktualisiert hast. Alle Benutzer müssen dann der neuen Datenschutzerklärung zustimmen.',
	'PRIVACY_POLICE_UPDATED'		=> 'Die Datenschutzerklärung wurden auf das aktuelle Datum gesetzt. Alle Benutzer müssen nun der neuen Datenschutzerklärung zustimmen, bevor sie das Forum weiter nutzen können.',
	'DELETE_IP'						=> 'Alle vorhandenen IP Adressen anonymisieren',
	'DELETE_IP_EXPLAIN'				=> 'Führe die Aktion aus um alle bereits vorhandenen IP Adressen zu anonymisieren.<br><strong style="color:#AA0000">Die Aktion kann nicht rückgängig gemacht werden!</strong>',
	'IP_DELETE_SUCCESS'				=> 'Alle IP Adressen wurden anonymisiert.',
	'PRIVACY_LAST_ACCPEPT'			=> 'Datenschutzerklärung zuletzt akzeptiert',
));