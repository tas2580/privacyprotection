<?php
/**
*
* @package phpBB Extension - tas2580 privacyprotection
* @copyright (c) 2018 tas2580 (https://tas2580.net)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tas2580\privacyprotection\acp;
class privacyprotection_module extends \tas2580\privacyprotection\privacyprotection
{
	public $u_action;
	protected $user;
	public function main($id, $mode)
	{
		global $config, $user, $template, $request, $phpbb_container, $db, $phpbb_dispatcher, $phpbb_root_path, $phpEx;
		$user->add_lang_ext('tas2580/privacyprotection', 'acp');

		$this->user = $user;
		$this->request = $request;
		$this->db = $db;
		$this->config = $config;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->php_ext = $phpEx;

		add_form_key('acp_privacyprotection');
		switch ($mode)
		{
			case 'settings':
				$this->tpl_name = 'acp_privacyprotection_settings';
				$this->page_title = $user->lang('ACP_PRIVACYPROTECTION_SETTINGS');

				// anonymize stored IPs
				$anonymize_ip = $this->request->variable('action_delete_ip', '');
				if ($anonymize_ip)
				{
					if (confirm_box(true))
					{
						$intervall = $this->config['tas2580_privacyprotection_anonymize_ip_time'] * 60 * 60 * 24;
						$time = time() - ($intervall * $this->config['tas2580_privacyprotection_anonymize_ip_time_type']);
						$this->anonymize_ip($time);

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
							'action_delete_ip'		=> $anonymize_ip))
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

					// Handle reject group
					$reject_group = $this->request->variable('reject_group', 0);
					if ($this->config['tas2580_privacyprotection_reject_group'] <> $reject_group)
					{
						// Move users if group has changed
						if ($this->request->is_set_post('move_group'))
						{
							if (!function_exists('group_memberships'))
							{
								include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
							}

							$user_array = group_memberships(array($this->config['tas2580_privacyprotection_reject_group']));
							if (is_array($user_array) && sizeof($user_array))
							{
								foreach ($user_array as $usr)
								{
									$users[] = $usr['user_id'];
								}

								group_user_del($this->config['tas2580_privacyprotection_reject_group'], $users);
								if ($reject_group <> 0)
								{
									group_user_add($reject_group, $users);
								}
							}
						}
						$this->config->set('tas2580_privacyprotection_reject_group', $this->request->variable('reject_group', 0));
					}

					// Set the new settings to config
					$this->config->set('tas2580_privacyprotection_privacy_url', $this->request->variable('privacy_url', '', true));
					$this->config->set('tas2580_privacyprotection_reject_url', $this->request->variable('reject_url', '', true));
					$this->config->set('tas2580_privacyprotection_anonymize_ip', $this->request->variable('anonymize_ip', 0));
					$this->config->set('tas2580_privacyprotection_anonymize_ip_time', $this->request->variable('anonymize_ip_time', 0));
					$this->config->set('tas2580_privacyprotection_anonymize_ip_time_type', $this->request->variable('anonymize_ip_time_type', 0));
					$this->config->set('tas2580_privacyprotection_footerlink', $this->request->variable('footerlink', 0));
					$this->config->set('tas2580_privacyprotection_post_format', $this->request->variable('post_format', 0));
					$this->config->set('tas2580_privacyprotection_post_read', $this->request->variable('post_read', 0));
					$this->config->set('tas2580_privacyprotection_post_unapproved', $this->request->variable('post_unapproved', 0));
					$this->config->set('tas2580_privacyprotection_post_deleted', $this->request->variable('post_deleted', 0));
					$this->config->set('tas2580_privacyprotection_reg_accept_mail', $this->request->variable('reg_accept_mail', 0));
					$this->config->set('tas2580_privacyprotection_reg_accept_privacy', $this->request->variable('reg_accept_privacy', 0));

					trigger_error($this->user->lang('ACP_SAVED') . adm_back_link($this->u_action));
				}


				// Send the curent settings to template
				$this->template->assign_vars(array(
					'U_ACTION'					=> $this->u_action,
					'PRIVACY_URL'				=> $this->config['tas2580_privacyprotection_privacy_url'],
					'REJECT_URL'				=> $this->config['tas2580_privacyprotection_reject_url'],
					'REJECT_GROUP'				=> $this->group_select_options($this->config['tas2580_privacyprotection_reject_group']),
					'ANONYMIZE_IP'				=> $this->anonymize_ip_options($this->config['tas2580_privacyprotection_anonymize_ip']),
					'ANONYMIZE_IP_TIME'			=> $this->config['tas2580_privacyprotection_anonymize_ip_time'],
					'ANONYMIZE_IP_TIME_TYPE'	=> $this->anonymize_time_type_options($this->config['tas2580_privacyprotection_anonymize_ip_time_type']),
					'FOOTERLINK'				=> $this->config['tas2580_privacyprotection_footerlink'],
					'POST_FORMAT'				=> $this->config['tas2580_privacyprotection_post_format'],
					'POST_READ'					=> $this->config['tas2580_privacyprotection_post_read'],
					'POST_UNAPPROVED'			=> $this->config['tas2580_privacyprotection_post_unapproved'],
					'POST_DELETED'				=> $this->config['tas2580_privacyprotection_post_deleted'],
					'REG_ACCEPT_MAIL'			=> $this->config['tas2580_privacyprotection_reg_accept_mail'],
					'REG_ACCEPT_PRIVACY'		=> $this->config['tas2580_privacyprotection_reg_accept_privacy'],
				));
				break;
			case 'privacy':
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
					'PLACEHOLDER'		=> htmlspecialchars('<p>' . str_replace("\t", '', sprintf($this->user->lang['PRIVACY_POLICY'], $this->config['sitename'], generate_board_url())) . '</p>'),
				));

				break;

			case 'list':
				$this->tpl_name = 'acp_privacyprotection_list';
				$this->page_title = $this->user->lang('ACP_PRIVACYPROTECTION_LIST');

				$start = $request->variable('start', 0);
				$display = $request->variable('display', 0);

				switch ($display)
				{
					case 0:
						$sql_where = 'tas2580_privacy_last_accepted > ' . (int) $this->config['tas2580_privacyprotection_last_update'];
						break;
					case 1:
						$sql_where = 'tas2580_privacy_last_accepted < ' . (int) $this->config['tas2580_privacyprotection_last_update'];
						break;
					case 2:
						$sql_where = 'tas2580_privacy_last_accepted < ' . (int) $this->config['tas2580_privacyprotection_last_update'] . '
							AND user_lastvisit > ' . (int) $this->config['tas2580_privacyprotection_last_update'];
						break;
				}

				$sql = 'SELECT COUNT(user_id) AS num_users
					FROM ' .  USERS_TABLE . '
					WHERE ' . $sql_where . '
						AND user_type <> 2';
				$result = $this->db->sql_query($sql);
				$count = (int) $db->sql_fetchfield('num_users');

				$sql = 'SELECT user_id, username, user_colour, user_email, user_regdate, user_lastvisit, tas2580_privacy_last_accepted
					FROM ' .  USERS_TABLE . '
						WHERE ' . $sql_where . '
						AND user_type <> 2
					LIMIT ' . (int) $start . ',' . (int) $config['topics_per_page'];
				$result = $this->db->sql_query($sql);
				while($row = $this->db->sql_fetchrow($result))
				{
					$template->assign_block_vars('list', array(
						'JOINED'			=> $user->format_date($row['user_regdate']),
						'LAST_VISIT'		=> (!$row['user_lastvisit']) ? ' - ' : $user->format_date($row['user_lastvisit']),
						'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], false, append_sid("{$this->phpbb_root_path}adm/index.{$this->php_ext}", 'i=users&amp;mode=overview')),
						'USERNAME'			=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
						'USER_COLOR'		=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour']),
						'USER_EMAIL'		=> $row['user_email'],
						'LAST_ACCEPTED'		=> (!$row['tas2580_privacy_last_accepted']) ? $this->user->lang['NEVER'] : $user->format_date($row['tas2580_privacy_last_accepted']),
					));
				}

				$base_url = $this->u_action . '&display=' . $display;
				$this->template->assign_vars(array(
					'DISPLAY_SELECT'		=> $this->display_select($display),
					'U_ACTION'				=> $base_url,
				));

				$pagination = $phpbb_container->get('pagination');
				$pagination->generate_template_pagination($base_url, 'pagination', 'start', $count, $config['topics_per_page'], $start);

				break;

		}
	}

	/**
	 * Generate HTML option list with user list options
	 *
	 * @param int $display
	 * @return string
	 */
	private function display_select($display)
	{
		$values = array('ACEPTED', 'NOT_ACEPTED', 'NOT_ACEPTED_ONLINE');
		$option = '';
		foreach($values as $id => $value)
		{
			$selected = ($id == $display) ? ' selected="selected"' : '';
			$option .= '<option' . $selected . ' value="' . $id . '">' . $this->user->lang['USER_LIST_' . $value] . '</option>';
		}
		return $option;
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

	private function anonymize_time_type_options($time_type)
	{

		$this->user->add_lang_ext('tas2580/privacyprotection', 'acp');
		$values = array(
			0	=> 'DISABLE',
			1	=> 'DAYS',
			7	=> 'WEEKS',
			30	=> 'MONTHS',
			365	=> 'YEARS',
		);

		$option = '';
		foreach($values as $id => $value)
		{
			$selected = ($id == $time_type) ? ' selected="selected"' : '';
			$option .= '<option' . $selected . ' value="' . $id . '">' . $this->user->lang[$value] . '</option>';
		}
		return $option;
	}
}