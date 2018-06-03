<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
* English translation Update @ Solidjeuh <https://www.froddelpower.be>
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
	'NEED_ACCEPT_PRIVACY_HL'			=> 'Privacy Policy updated',
	'NEED_ACCEPT_PRIVACY'				=> 'Our <a href="%s">privacy policy</a> has changed. You must accept the new privacy policy to continue using the forum.',
	'PRIVACY_ACCEPT_SUCCESS'			=> 'You have accepted the new Privacy Policy and now have unrestricted access to the board again.',
	'ACCEPT_PRIVACY'					=> 'Accept Privacy Policy',
	'REJECT_PRIVACY'					=> 'Decline Privacy Policy',
	'NEED_TO_ACCEPT_PRIVACY_POLICY'		=> 'You have to confirm your acceptance of the privacy policy to be able to create content in this board.',
	'CONFIRM_ACCEPT_PRIVACY'			=> 'I accept the <a href="%s">Privacy policy</a>.',
));