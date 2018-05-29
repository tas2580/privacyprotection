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
	'DOWNLOAD_MY_DATA'				=> 'Meine Daten herunterladen',
	'DOWNLOAD_MY_DATA_EXPLAIN'		=> 'Hier können Sie Ihre persönlichen Profildaten als CSV-Datei runterladen.',
	'DOWNLOAD_MY_POSTS_EXPLAIN'		=> 'Hier können Sie die von Ihnen geschriebenen Beiträge als CSV-Datei runterladen.',
	'DOWNLOAD_BTN'					=> 'Download',
	'NEED_ACCEPT_PRIVACY'			=> 'Sie müssen die Datenschutzerklärung lesen und akzeptieren.',
	'PRIVACY_ACCEPTED'				=> 'Datenschutzerklärung gelesen und akzeptiert',
	'PRIVACY_ACCEPTED_EXPLAIN'		=> 'Ich bestätige mit dem Auswählen dieses Feldes, das ich die <a href="%s">Datenschutzerklärung</a> gelesen habe und akzeptiere diese.',
	'PRIVACY_LAST_ACCEPTED'			=> 'Datenschutzerklärung zuletzt akzeptiert',
	'REVOKE_PRIVACY'				=> 'Widerrufen',
	'REVOKE_PRIVACY_CONFIRM'		=> 'Sind Sie sich sicher, dass Sie Ihre Zustimmung zur Datenschutzerklärung wiederufen möchten?',
	'REVOKE_PRIVACY_SUCCESS'		=> 'Sie haben Ihre Zustimmung zur Datenschutzerklärung erfolgreich wiederufen.',
));
