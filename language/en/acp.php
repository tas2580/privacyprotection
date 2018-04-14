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
	'PRIVACY_SETTINGS'				=> 'Privacy Policy - Settings',
	'ACP_PRIVACY_URL'				=> 'URL of your privacy policy statement',
	'ACP_PRIVACY_URL_EXPLAIN'		=> 'Please insert a valid link to your privacy policy statement. This will override the link to the original privacy policy statement.',
	'ACP_ANONYMIZE'					=> 'Anonymize IP addresses',
	'ACP_ANONYMIZE_EXPLAIN'			=> 'When activated phpBB will no longer store a user\'s original IP address.',
	'UPDATE_PRIVACY'				=> 'Update privacy policy statement',
	'UPDATE_PRIVACY_EXPLAIN'		=> 'Run this option after udpdating your privacy policy statement. All users will be forced to re-confirm their acceptance of the privacy policy.',
	'PRIVACY_POLICE_UPDATED'		=> 'The version date of the privacy policy statement has been updated to the current date. All users must first re-confirm their acceptance in order to continue using the board.',
	'DELETE_IP'						=> 'Anonymize all stored IP´s.',
	'DELETE_IP_EXPLAIN'				=> 'Run this option to anonymize all IP´s stored in phpBB.<br><strong>Please note that this cannot be undone!</strong>',
	'IP_DELETE_SUCCESS'				=> 'All IP addresses have been anonymized.',
));
