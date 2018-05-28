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
	'DOWNLOAD_MY_DATA'				=> 'Download mijn persoonlijke gegevens',
	'DOWNLOAD_MY_DATA_EXPLAIN'		=> 'Hier kunt u uw persoonlijke profiel gegevens downloaden als een CSV bestand.',
	'DOWNLOAD_MY_POSTS_EXPLAIN'		=> 'Hier kun je de berichten die je hebt geschreven als een CSV bestand downloaden.',
	'DOWNLOAD_BTN'					=> 'Download',
	'NEED_ACCEPT_PRIVACY'			=> 'U moet eerst de privacy beleidsverklaring lezen en accepteren.',
	'PRIVACY_ACCEPTED'				=> 'Privacybeleid gelezen en geaccepteerd',
	'PRIVACY_ACCEPTED_EXPLAIN'		=> 'Door dit veld te markeren, bevestig ik dat ik de <a href="%s">Privacybeleid verklaring</a> heb gelezen en geaccepteerd.',
	'PRIVACY_LAST_ACCEPTED'			=> 'Privacybeleid laatst geaccepteerd',
));
