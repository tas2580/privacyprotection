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
	'NEED_ACCEPT_PRIVACY_HL'            => 'Privacybeleid bijgewerkt',
	'NEED_ACCEPT_PRIVACY'				=> 'Ons <a href="%s">Privacybeleid</a> is gewijzigd. U moet akkoord gaan met het nieuwe privacybeleid om het forum te blijven gebruiken.',
	'PRIVACY_ACCEPT_SUCCESS'			=> 'U hebt het privacybeleid met succes geaccepteerd en kunt het forum zonder beperkingen opnieuw gebruiken.',
	'ACCEPT_PRIVACY'					=> 'Privacybeleid accepteren',
	'REJECT_PRIVACY'					=> 'Privacybeleid weigeren',
	'NEED_TO_ACCEPT_PRIVACY_POLICY'		=> 'U moet bevestigen dat u het privacybeleid accepteert om gebruik te maken van dit forum.',
	'CONFIRM_ACCEPT_PRIVACY'			=> 'Ik accepteer het <a href="%s">Privacybeleid</a>.',
));
