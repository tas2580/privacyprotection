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
	'NEED_ACCPEPT_PRIVACY_HL'			=> 'Privacy policy updated',
	'NEED_ACCEPT_PRIVACY'				=> 'There has been an update to the <a href="%s">Privacy Policy Statement</a>. You have to re-confirm your acceptance in order to continue using this board.',
	'ACCEPT_PRIVACY'					=> 'Privacy Policy accepted',
	'REJECT_PRIVACY'					=> 'Privacy Policy declined',
	'NEED_TO_ACCEPT_PRIVACY_POLICY'		=> 'You have to confirm your acceptance of the privacy policy to be able to create content in this board.',
));
