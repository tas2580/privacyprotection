<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tas2580\privacyprotection\acp;
class privacyprotection_module
{
	public $u_action;
	protected $user;
	public function main($id, $mode)
	{
		global $config, $user, $template, $request, $phpbb_container, $db, $phpbb_root_path, $phpEx;
		$user->add_lang_ext('tas2580/privacyprotection', 'acp');

		$this->user = $user;
		$this->request = $request;
		$this->db = $db;
		$this->config = $config;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		add_form_key('acp_privacyprotection');
		switch ($mode)
		{
			case 'settings':
				$this->tpl_name = 'acp_privacyprotection_settings';
				$this->page_title = $user->lang('ACP_PRIVACYPROTECTION_SETTINGS');

				// update privacy policy
				$update_privacy = $this->request->variable('action_update_privacy', '');
				if ($update_privacy)
				{
					if (confirm_box(true))
					{
						$this->config->set('tas2580_privacyprotection_last_update', time());
						trigger_error($user->lang('PRIVACY_POLICE_UPDATED') . adm_back_link($this->u_action));
					}
					else
					{
						confirm_box(false, $this->user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
							'action_update_privacy'		=> $update_privacy))
						);
					}
				}

				// anonymize stored IPs
				$delete_ip = $this->request->variable('action_delete_ip', '');
				if ($delete_ip)
				{
					if (confirm_box(true))
					{
						$sql = 'UPDATE ' . POSTS_TABLE . "
							SET poster_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						$sql = 'UPDATE ' . LOG_TABLE . "
							SET log_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						$sql = 'UPDATE ' . POLL_VOTES_TABLE . "
							SET vote_user_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						$sql = 'UPDATE ' . PRIVMSGS_TABLE . "
							SET author_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						$sql = 'UPDATE ' . SESSIONS_TABLE . "
							SET session_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						$sql = 'UPDATE ' . SESSIONS_KEYS_TABLE . "
							SET last_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						$sql = 'UPDATE ' . USERS_TABLE . "
							SET user_ip = '127.0.0.1'";
						$this->db->sql_query($sql);

						/**
						 * Delete additional IP addresses
						 *
						 * @event tas2580.privacyprotection_delete_ip_after
						 */
						$vars = array();
						extract($this->phpbb_dispatcher->trigger_event('tas2580.privacyprotection_delete_ip_after', compact($vars)));

						trigger_error($user->lang('IP_DELETE_SUCCESS') . adm_back_link($this->u_action));
					}
					else
					{
						confirm_box(false, $this->user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
							'action_delete_ip'		=> $delete_ip))
						);
					}
				}

				// update settings
				if ($this->request->is_set_post('submit'))
				{
					if (!check_form_key('acp_privacyprotection'))
					{
						trigger_error($user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
					}

					// Move users if group has changed
					$reject_group = $this->request->variable('reject_group', 0);
					if ($this->config['tas2580_privacyprotection_reject_group'] <> $reject_group)
					{
						if (!function_exists('group_memberships'))
						{
							include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
						}

						$user_array = group_memberships(array($this->config['tas2580_privacyprotection_reject_group']));
						if (sizeof($user_array))
						{
							foreach ($user_array as $usr)
							{
								$users[] = $usr['user_id'];
							}

							group_user_del($this->config['tas2580_privacyprotection_reject_group'], $users);
							group_user_add($reject_group, $users);
						}

						$this->config->set('tas2580_privacyprotection_reject_group', $this->request->variable('reject_group', 0));
					}

					// Set the new settings to config
					$this->config->set('tas2580_privacyprotection_privacy_url', $this->request->variable('privacy_url', '', true));
					$this->config->set('tas2580_privacyprotection_reject_url', $this->request->variable('reject_url', '', true));
					$this->config->set('tas2580_privacyprotection_anonymize_ip', $this->request->variable('anonymize_ip', 0));
					$this->config->set('tas2580_privacyprotection_footerlink', $this->request->variable('footerlink', 0));

					trigger_error($this->user->lang('ACP_SAVED') . adm_back_link($this->u_action));
				}
				// Send the curent settings to template
				$this->template->assign_vars(array(
					'U_ACTION'					=> $this->u_action,
					'PRIVACY_URL'				=> $this->config['tas2580_privacyprotection_privacy_url'],
					'REJECT_URL'				=> $this->config['tas2580_privacyprotection_reject_url'],
					'REJECT_GROUP'				=> $this->group_select_options($this->config['tas2580_privacyprotection_reject_group']),
					'ANONYMIZE_IP'				=> $this->anonymize_ip_options($this->config['tas2580_privacyprotection_anonymize_ip']),
					'FOOTERLINK'				=> $this->config['tas2580_privacyprotection_footerlink'],
				));
				break;
			case 'privacy':
				$this->tpl_name = 'acp_privacyprotection_privacy';
				$this->page_title = $this->user->lang('ACP_PRIVACYPROTECTION_PRIVACY');

				$config_text = $phpbb_container->get('config_text');
				$this->user->add_lang('ucp');

				if ($this->request->is_set_post('submit'))
				{
					if (!check_form_key('acp_privacyprotection'))
					{
						trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
					}

					$config_text->set('privacy_text', $this->request->variable('privacy_text', '', true));
					trigger_error($this->user->lang['ACP_SAVED'] . adm_back_link($this->u_action));
				}

				$this->template->assign_vars(array(
					'PRIVACY_URL'		=> empty($this->config['tas2580_privacyprotection_privacy_url']) ? '' : sprintf($this->user->lang['PRIVACY_URL_WARNING'], $this->config['tas2580_privacyprotection_privacy_url']),
					'PRIVACY_TEXT'		=> $config_text->get('privacy_text'),
					'PLACEHOLDER'		=> htmlspecialchars($this->user->lang['PRIVACY_POLICY']),
				));

				break;

		}
	}

	/**
	 * Add option 0 to phpBB group select function
	 *
	 * @param int $group_id
	 * @return string
	 */
	private function group_select_options($group_id)
	{
		$return = '<option class="sep" value="0">' . $this->user->lang['ACP_NO_REJECT_GROUP'] . '</option>';

		if (!function_exists('group_select_options'))
		{
			include($this->phpbb_root_path . 'includes/functions_admin.' . $this->php_ext);
		}
		$return .= group_select_options($group_id);

		return $return;
	}

	/**
	 * Generate HTML option list with anonymize ip options
	 *
	 * @param int $anonymize
	 * @return string
	 */
	private function anonymize_ip_options($anonymize)
	{
		$this->user->add_lang_ext('tas2580/privacyprotection', 'acp');
		$values = array('NONE', 'FULL', 'HASH');
		$option = '';
		foreach($values as $id => $value)
		{
			$selected = ($id == $anonymize) ? ' selected="selected"' : '';
			$option .= '<option' . $selected . ' value="' . $id . '">' . $this->user->lang['ANONYMIZE_IP_' . $value] . '</option>';
		}
		return $option;
	}
}