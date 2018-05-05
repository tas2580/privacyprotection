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
	'NEED_ACCEPT_PRIVACY_HL'			=> 'Aktualisierte Datenschutzerklärung',
	'NEED_ACCEPT_PRIVACY'				=> 'Unsere <a href="%s">Datenschutzerklärung</a> hat sich geändert. Du musst die neue Datenschutzerklärung akzeptieren, um das Forum weiterhin nutzen zu können.',
	'ACCEPT_PRIVACY'					=> 'Datenschutzerklärung akzeptieren',
	'REJECT_PRIVACY'					=> 'Datenschutzerklärung ablehnen',
	'NEED_TO_ACCEPT_PRIVACY_POLICY'		=> 'Du musst die Datenschutzerklärung akzeptieren, bevor du in diesem Forum Inhalte erzeugen kannst.',
	'CONFIRM_ACCEPT_PRIVACY'			=> 'Ich habe die <a href="%s">Datenschutzerklärung</a> gelesen und bin damit einverstanden.'
));