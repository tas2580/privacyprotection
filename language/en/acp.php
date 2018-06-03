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
	'ACP_PRIVACY_SETTINGS'						=> 'Privacy Policy - Settings',
	'ACP_PRIVACY_URL'							=> 'URL of your privacy policy statement',
	'ACP_PRIVACY_URL_EXPLAIN'					=> 'Please insert a valid link to your privacy policy statement. This will override the link to the original privacy policy statement.',
	'ACP_REJECT_URL'							=> 'URL for rejection',
	'ACP_REJECT_URL_EXPLAIN'					=> 'If a URL is specified here, the update message will issue an additional button for disapproving the privacy policy that points to the URL provided here. Use <code>{SID}</code> to represent a user\'s session ID.',
	'ACP_REJECT_GROUP'							=> 'Move to group',
	'ACP_REJECT_GROUP_EXPLAIN'					=> 'Select a group to which all users will be added who did not agree to the privacy policy.',
	'ACP_NO_REJECT_GROUP'						=> ' - Don\'t move -',
	'ACP_MOVE_GROUP'						    => 'Move from old group',
	'ACP_MOVE_GROUP_EXPLAIN'				    => 'Activate to move all members from the previously selected group to the newly selected group.',
	'ACP_REG_ACCEPT_PRIVACY'				    => 'Privacy policy when registering',
	'ACP_REG_ACCEPT_PRIVACY_EXPLAIN'		    => 'Do users have to accept the privacy policy when registering?',
	'ACP_REG_ACCEPT_MAIL'					    => 'Mass email when registering',
	'ACP_REG_ACCEPT_MAIL_EXPLAIN'			    => 'Do users need to agree to receive mass email when registering?',
	'ACP_IP_SETTINGS'						    => 'IP Addresses',
	'ACP_ANONYMIZE_IP'							=> 'Anonymize IP addresses',
	'ACP_ANONYMIZE_IP_EXPLAIN'					=> 'Choose whether IP\'s shall be anonymized and, if yes, which method to use.',
	'ANONYMIZE_IP_NONE'							=> 'Don\'t anonymize',
	'ANONYMIZE_IP_FULL'							=> 'Anonymize completely',
	'ANONYMIZE_IP_HASH'							=> 'Use hash',
	'ANONYMIZE_IP_LAST'							=> 'Anonymize last part',
	'ACP_ANONYMIZE_IP_TIME'					    => 'Anonymize automatically',
	'ACP_ANONYMIZE_IP_TIME_EXPLAIN'			    => 'Choose from after which time stored IP addresses should be automatically anonymized. The IP addresses are completely anonymized.',
	'WEEKS'									    => 'weeks',
	'MONTHS'								    => 'Months',
	'YEARS'									    => 'Years',
	'ACP_FOOTERLINK'							=> 'Add link to footer',
	'ACP_FOOTERLINK_EXPLAIN'					=> 'If activated a link to your privacy olicy statement will be shown in the footer.',
	'ACP_DATA_DOWNLOAD_OPTIONS'					=> 'Data Download',
	'ACP_POST_FORMAT'							=> 'Messages',
	'ACP_POST_FORMAT_EXPLAIN'					=> 'Define the range of data included when downloading messages.',
	'INCLUDE_TEXT'								=> 'Text and meta-data',
	'ONLY_META'									=> 'Meta-data only',
	'ACP_POST_READ'								=> 'Visible messages only',
	'ACP_POST_READ_EXPLAIN'						=> 'Shall the download of messages be restricted to those a user has read access to?',
	'ONLY_READ'									=> 'Restrict to messages with read access',
	'ACP_POST_UNAPPROVED'						=> 'Messages pending approval',
	'ACP_POST_UNAPPROVED_EXPLAIN'				=> 'Shall messages still pending approval be included in the download?',
	'ACP_POST_DELETED'							=> 'Deleted messages',
	'ACP_POST_DELETED_EXPLAIN'					=> 'Shall deleted messages be included in the download?',
	'ACP_PRIVACYPROTECTION_PRIVACY_EXPLAIN'		=> 'Here you can enter your own privacy policy statement, overriding the one pre-defined the language file. You can use HTML here. Use <code>{SITE_NAME}</code> for the name and <code>{SITE_URL}</code> for the URL of your forum. Leave the field blank to use the privacy policy statement as defined the language file.',
	'PRIVACY_URL_WARNING'						=> 'You have specified <a href="%1$s">%1$s</a> as the URL to the privacy policy statement. The privacy policy statement as shown above will only be displayed if you remove this URL in the settings.',
	'ACP_PRIVACY_OPTIONS'						=> 'Privacy options',
	'UPDATE_PRIVACY'							=> 'Privacy Policy has been updated',
	'UPDATE_PRIVACY_EXPLAIN'					=> 'Perform this action after updating the privacy policy. All users must then accept the new privacy policy.',
	'PRIVACY_POLICE_UPDATED'					=> 'The privacy policy has been set to the current date. All users must first re-confirm their acceptance in order to continue using the board.',
	'ACP_DELETE_IP'						        => 'Anonymize all stored IP´s.',
	'ACP_DELETE_IP_EXPLAIN'						=> 'Perform this option to anonymize all IP´s stored in phpBB.<br><strong>Please note that this cannot be undone!</strong>',
	'IP_DELETE_SUCCESS'							=> 'All IP addresses have been anonymized.',
	'PRIVACY_LAST_ACCPEPT'						=> 'Privacy policy last accepted',
	'LAST_ACCPEPT'								=> 'Last accepted',
	'ACP_SUBMIT'								=> 'Save settings',
	'ACP_SAVED'									=> 'Settings saved.',
	'USER_LIST_ACEPTED'							=> 'Accepted',
	'USER_LIST_NOT_ACEPTED'						=> 'Not accepted',
	'USER_LIST_NOT_ACEPTED_ONLINE'				=> 'Not accepted, was online',
	'USER_ADMIN_REVOKE_PRIVACY'					=> 'Revoke consent to the privacy policy',
));
