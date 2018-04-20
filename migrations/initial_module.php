<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tas2580\privacyprotection\migrations;

class initial_module extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('tas2580_privacyprotection_privacy_url', '')),
			array('config.add', array('tas2580_privacyprotection_reject_url', '')),
			array('config.add', array('tas2580_privacyprotection_last_update', '0')),
			array('config.add', array('tas2580_privacyprotection_post_dl', '1')),
			array('config.add', array('tas2580_privacyprotection_data_dl', '1')),
		);
	}
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'tas2580_privacy_last_accepted'				=> array('TIMESTAMP', '0'),
				),
			),
		);
	}
	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'users'	=> array(
					'tas2580_privacy_last_accepted',
				),
			),
		);
	}
}
