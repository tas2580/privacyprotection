<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tas2580\privacyprotection\acp;

class privacyprotection_info
{
	function module()
	{
		return array(
			'filename'		=> 'tas2580\privacyprotection\privacyprotection_module',
			'title'			=> 'ACP_PRIVACYPROTECTION_TITLE',
			'version'		=> '0.2.0',
			'modes'		=> array(
				'settings'    => array(
					'title'		=> 'ACP_PRIVACYPROTECTION_SETTINGS',
					'auth'		=> 'ext_tas2580/privacyprotection&& acl_a_board',
					'cat'		=> array('ACP_PRIVACYPROTECTION_TITLE')
				),
				'privacy'    => array(
					'title'		=> 'ACP_PRIVACYPROTECTION_PRIVACY',
					'auth'		=> 'ext_tas2580/privacyprotection&& acl_a_board',
					'cat'		=> array('ACP_PRIVACYPROTECTION_TITLE')
				),
				'list'    => array(
					'title'		=> 'ACP_PRIVACYPROTECTION_LIST',
					'auth'		=> 'ext_tas2580/privacyprotection&& acl_a_board',
					'cat'		=> array('ACP_PRIVACYPROTECTION_TITLE')
				),
			),
		);
	}
}
