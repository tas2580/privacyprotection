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
// ‚ ‘ ’ « » „ “ ” …
//
$lang = array_merge($lang, array(
	'ACP_PRIVACY_SETTINGS'					=> 'Datenschutz-Einstellungen',
	'ACP_PRIVACY_URL'						=> 'URL zu Ihrer Datenschutzerklärung',
	'ACP_PRIVACY_URL_EXPLAIN'				=> 'Geben Sie eine URL zu Ihrer Datenschutzerklärung ein. Die URL überschreibt alle Links zur ursprünglichen Datenschutzerklärung von phpBB.',
	'ACP_REJECT_URL'						=> 'URL für die Ablehnung',
	'ACP_REJECT_URL_EXPLAIN'				=> 'Wenn hier eine URL angegeben wird, gibt die Aktualisierungsmeldung einen zusätzlichen Button zum Ablehnen der Datenschutzerklärung aus, der auf die hier angegebene URL verweist. Verwenden Sie <code>{SID}</code> für die Session ID des Users.',
	'ACP_REJECT_GROUP'						=> 'In Gruppe verschieben',
	'ACP_REJECT_GROUP_EXPLAIN'				=> 'Wählen Sie eine Gruppe, in die alle Benutzer verschoben werden, die der Datenschutzerklärung nicht zugestimmt haben.',
	'ACP_NO_REJECT_GROUP'					=> ' - Nicht verschieben -',
	'ACP_ANONYMIZE_IP'						=> 'IP Adressen anonymisieren',
	'ACP_ANONYMIZE_IP_EXPLAIN'				=> 'Wählen Sie aus, ob und wie IP Adressen anonymisiert werden sollen.',
	'ANONYMIZE_IP_NONE'						=> 'Nicht anonymisieren',
	'ANONYMIZE_IP_FULL'						=> 'Komplett anonymisieren',
	'ANONYMIZE_IP_HASH'						=> 'Hash verwenden',
	'ACP_FOOTERLINK'						=> 'Link in Footer',
	'ACP_FOOTERLINK_EXPLAIN'				=> 'Soll ein Link zur Datenschutzerklärung im Footer angezeigt werden?',
	'ACP_DATA_DOWNLOAD_OPTIONS'				=> 'Daten Download',
	'ACP_POST_FORMAT'						=> 'Beiträge',
	'ACP_POST_FORMAT_EXPLAIN'				=> 'Wählen Sie aus, was beim Download von Beiträgen enthalten sein soll.',
	'INCLUDE_TEXT'							=> 'Text und Meta-Daten',
	'ONLY_META'								=> 'Nur Meta-Daten',
	'ACP_POST_READ'							=> 'Nur lesbare Beiträge',
	'ACP_POST_READ_EXPLAIN'					=> 'Soll der Download der Beiträge auf Foren beschränkt werden, die der Benutzer lesen kann?',
	'ONLY_READ'								=> 'Nur Beiträge mit Leserecht',
	'ACP_POST_UNAPPROVED'					=> 'Ungeprüfte Beiträge',
	'ACP_POST_UNAPPROVED_EXPLAIN'			=> 'Sollen ungeprüfte Beiträge enthalten sein?',
	'ACP_POST_DELETED'						=> 'Gelöschte Beiträge',
	'ACP_POST_DELETED_EXPLAIN'				=> 'Sollen gelöschte Beiträge enthalten sein?',
	'ACP_PRIVACYPROTECTION_PRIVACY_EXPLAIN'	=> 'Hier können Sie eine eigene Datenschutzerklärung eingeben und so die Datenschutzerklärung aus der Sprachdatei überschreiben. Sie können hier HTML verwenden. Verwenden Sie <code>{SITE_NAME}</code> für den Namen des Forums und <code>{SITE_URL}</code> für die URL zum Forum. Lassen Sie das Feld leer, um die Datenschutzerklärung aus der Sprachdatei zu verwenden.',
	'PRIVACY_URL_WARNING'					=> 'Sie haben <a href="%1$s">%1$s</a> als URL für die Datenschutzerklärung angegeben. Die oben angezeigte Datenschutzerklärung wird nur erscheinen, wenn Sie die URL in den Einstellungen wieder entfernen.',
	'ACP_PRIVACY_OPTIONS'					=> 'Datenschutz-Optionen',
	'UPDATE_PRIVACY'						=> 'Datenschutzerklärung wurde aktualisiert',
	'UPDATE_PRIVACY_EXPLAIN'				=> 'Führen Sie die Aktion aus, nachdem Sie die Datenschutzerklärung aktualisiert haben. Alle Benutzer müssen dann der neuen Datenschutzerklärung zustimmen.',
	'PRIVACY_POLICE_UPDATED'				=> 'Die Datenschutzerklärung wurden auf das aktuelle Datum gesetzt. Alle Benutzer müssen nun der neuen Datenschutzerklärung erneut zustimmen, bevor sie das Forum weiter nutzen können.',
	'DELETE_IP'								=> 'Alle vorhandenen IP Adressen anonymisieren',
	'DELETE_IP_EXPLAIN'						=> 'Führen Sie die Aktion aus, um alle bereits vorhandenen IP Adressen zu anonymisieren.<br><strong style="color:#AA0000">Diese Aktion kann nicht rückgängig gemacht werden!</strong>',
	'IP_DELETE_SUCCESS'						=> 'Alle IP Adressen wurden anonymisiert.',
	'PRIVACY_LAST_ACCPEPT'					=> 'Datenschutzerklärung zuletzt akzeptiert',
	'LAST_ACCPEPT'							=> 'Zuletzt akzeptiert',
	'ACP_SUBMIT'							=> 'Einstellungen speichern',
	'ACP_SAVED'								=> 'Die Einstellungen wurden gespeichert.',
	'USER_LIST_ACEPTED'						=> 'Akzeptiert',
	'USER_LIST_NOT_ACEPTED'					=> 'Nicht akzeptiert',
	'USER_LIST_NOT_ACEPTED_ONLINE'			=> 'Nicht akzeptiert, war online',
));
