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
	'ACP_PRIVACY_SETTINGS'						=> 'Privacy Policy - Settings',
	'ACP_PRIVACY_URL'							=> 'URL of your privacy policy statement',
	'ACP_PRIVACY_URL_EXPLAIN'					=> 'Please insert a valid link to your privacy policy statement. This will override the link to the original privacy policy statement.',
	'ACP_REJECT_URL'							=> 'URL for rejection',
	'ACP_REJECT_URL_EXPLAIN'					=> 'If a URL is specified here, the update message will issue an additional button for disapproving the privacy policy, that points to the URL provided here',
	'ACP_REJECT_GROUP'							=> 'Move to group',
	'ACP_REJECT_GROUP_EXPLAIN'					=> 'Select a group to which all users will be moved who did not agree to the privacy policy.',
	'ACP_NO_REJECT_GROUP'						=> ' - Not move -',	
	'ACP_ANONYMIZE'								=> 'Anonymize IP addresses',
	'ACP_ANONYMIZE_EXPLAIN'						=> 'When activated phpBB will no longer store a user\'s original IP address.',
	'ANONYMIZE_IP_NONE'							=> 'Not anonymize',
	'ANONYMIZE_IP_FULL'							=> 'Anonymize completely',
	'ANONYMIZE_IP_HASH'							=> 'Use hash',
	'ACP_PRIVACYPROTECTION_PRIVACY_EXPLAIN'		=> 'Here you can enter your own privacy policy, overriding the privacy policy from the language file. You can use HTML here. Use <code>%1$s</code> for the name and <code>%2$s</code> for the URL of your forum. Leave the field blank to use the privacy policy from the language file.',
	'PRIVACY_URL_WARNING'						=> 'You have specified <a href="%1$s">%1$s</a> as the URL for the privacy policy. The privacy policy shown above will only be displayed if you remove this URL in the settings.',
	'ACP_PRIVACY_OPTIONS'						=> 'Privacy options',	
	'UPDATE_PRIVACY'							=> 'Privacy Policy has been updated',
	'UPDATE_PRIVACY_EXPLAIN'					=> 'Perform this action after updating the privacy policy. All users must then accept the new privacy policy.',
	'PRIVACY_POLICE_UPDATED'					=> 'The privacy policy has been set to the current date. All users must first re-confirm their acceptance in order to continue using the board.',
	'DELETE_IP'									=> 'Anonymize all stored IP´s.',
	'DELETE_IP_EXPLAIN'							=> 'Perform this option to anonymize all IP´s stored in phpBB.<br><strong>Please note that this cannot be undone!</strong>',
	'IP_DELETE_SUCCESS'							=> 'All IP addresses have been anonymized.',
	'PRIVACY_LAST_ACCPEPT'						=> 'Privacy policy last accepted',
	'ACP_SUBMIT'								=> 'Save settings',
	'ACP_SAVED'									=> 'Settings saved.',	
));
