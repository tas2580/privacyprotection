<?php
/**
 *
 * @package phpBB Extension - tas2580 privacyprotection
 * @copyright (c) 2018 tas2580 (https://tas2580.net)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace tas2580\privacyprotection\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\event\dispatcher_interface */
	protected $phpbb_dispatcher;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string php_ext */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config
	 * @param \phpbb\db\driver\driver_interface		$db						Database object
	 * @param \phpbb\event\dispatcher_interface		$phpbb_dispatcher
	 * @param \phpbb\user							$user					User Object
	 * @param \phpbb\template\template				$template				Template object
	 * @param \phpbb\request\request				$request				Request object
	 * @param string								$phpbb_root_path		phpbb_root_path
	 * @param string								$php_ext				php_ext
	 * @access public
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\db\driver\driver_interface $db, \phpbb\event\dispatcher_interface $phpbb_dispatcher, \phpbb\user $user, \phpbb\template\template $template, \phpbb\request\request $request, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->db = $db;
		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->user = $user;
		$this->template = $template;
		$this->request = $request;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.common'										=> 'common',
			'core.permissions'									=> 'permissions',
			'core.page_header_after'							=> 'page_header_after',
			'core.page_footer'									=> 'page_footer',
			'core.acp_users_display_overview'					=> 'acp_users_display_overview',
			'core.ucp_display_module_before'					=> 'ucp_display_module_before',
			'core.ucp_register_data_before'						=> 'ucp_register_data_before',
			'core.ucp_register_data_after'						=> 'ucp_register_data_after',
			'core.ucp_register_user_row_after'					=> 'ucp_register_user_row_after',
			'core.mcp_post_template_data'						=> 'mcp_post_template_data',
			'core.user_add_modify_data'							=> 'user_add_modify_data',
			'core.modify_posting_auth'							=> 'modify_posting_auth',
			'core.posting_modify_message_text'					=> 'posting_modify_message_text',
			'core.viewtopic_modify_page_title'					=> 'viewtopic_modify_page_title',
			'core.viewforum_modify_topics_data'					=> 'viewforum_modify_topics_data',
		);
	}

	/**
	 * Unset IP
	 *
	 * @return null
	 * @access public
	 */
	public function common()
	{
		switch ($this->config['tas2580_privacyprotection_anonymize_ip'])
		{
			// Do not anonymize
			case 0:
				break;

			// Set all IPs to 127.0.0.1
			case 1:
				$this->request->overwrite('REMOTE_ADDR', '127.0.0.1', \phpbb\request\request_interface::SERVER);
				break;

			// Use fake IPv6
			case 2:
				$fake_ip = $this->generate_fake_ip();
				$this->request->overwrite('REMOTE_ADDR', $fake_ip, \phpbb\request\request_interface::SERVER);
		}
	}

	/**
	* Add permissions
	*
	* @param	object	$event	The event object
	* @return	null
	* @access	public
	*/
	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions += array(
			'u_privacyprotection_dl_data'	=> array(
				'lang'		=> 'ACL_U_PRIVACYPROTECTION_DL_DATA',
				'cat'		=> 'profile'
			),
			'u_privacyprotection_dl_posts'	=> array(
				'lang'		=> 'ACL_U_PRIVACYPROTECTION_DL_POSTS',
				'cat'		=> 'profile'
			),
		);

		$event['permissions'] = $permissions;
	}

	/**
	 * Modify link to privacy
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function page_header_after()
	{
		if ($this->user->data['is_registered'] && $this->user->data['tas2580_privacy_last_accepted'] < $this->config['tas2580_privacyprotection_last_update'])
		{
			// User has accepted the new privacy policy
			$mode = $this->request->variable('mode', '');
			if ($mode == 'accept_privacy')
			{
				$data = array(
					'tas2580_privacy_last_accepted'		=> time(),
				);
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $data) . '
					WHERE user_id = ' . (int) $this->user->data['user_id'] ;
				$this->db->sql_query($sql);

				// Remove user from group
				if ($this->config['tas2580_privacyprotection_reject_group'] <> 0)
				{
					if (!function_exists('group_user_del'))
					{
						include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
					}
					group_user_del($this->config['tas2580_privacyprotection_reject_group'], array($this->user->data['user_id']));
				}

				redirect(append_sid("{$this->phpbb_root_path}index.{$this->php_ext}"));
			}

			// Move user to group
			if ($this->config['tas2580_privacyprotection_reject_group'] <> 0)
			{
				if (!function_exists('group_user_add'))
				{
					include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
				}

				group_user_add($this->config['tas2580_privacyprotection_reject_group'], array($this->user->data['user_id']));
			}

			$this->user->add_lang_ext('tas2580/privacyprotection', 'common');
			$privacy_link = empty($this->config['tas2580_privacyprotection_privacy_url']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'mode=privacy') : $this->config['tas2580_privacyprotection_privacy_url'];
			$this->template->assign_vars(array(
				'S_NEED_ACCEPT_PRIVACY'		=> true,
				'NEED_ACCEPT_PRIVACY'			=> sprintf($this->user->lang['NEED_ACCEPT_PRIVACY'], $privacy_link),
				'U_ACCPEPT_PRIVACY'				=> append_sid("{$this->phpbb_root_path}index.{$this->php_ext}", 'mode=accept_privacy'),
				'U_REJECT_PRIVACY'				=> str_replace('{SID}', $this->user->data['session_id'], $this->config['tas2580_privacyprotection_reject_url']),
				'S_IS_BOT'						=> true,	// Handle users as bot until they accept the privacy policy
			));
		}

		// Modify privacy policy URL
		if ($this->config['tas2580_privacyprotection_privacy_url'])
		{
			$this->template->assign_vars(array(
				'U_PRIVACY'		=> $this->config['tas2580_privacyprotection_privacy_url'],
			));
		}
	}

	/**
	 * Overwrite AGREEMENT_TEXT for privacy policy
	 *
	 * @return null
	 * @access public
	 */
	public function page_footer()
	{
		$mode = $this->request->variable('mode', '');
		if ($mode == 'privacy')
		{
			$privacy_text = $this->config_text->get('privacy_text');
			$privacy_text = empty($privacy_text) ? sprintf($this->user->lang['PRIVACY_POLICY'], $this->config['sitename'], generate_board_url()) : html_entity_decode(str_replace(array('{SITE_NAME}', '{SITE_URL}'), array($this->config['sitename'], generate_board_url()), $privacy_text));
			$this->template->assign_vars(array(
				'AGREEMENT_TEXT'		=> sprintf($privacy_text, $this->config['sitename'], generate_board_url()),
			));
		}

		// Display link in footer
		$this->template->assign_vars(array(
			'S_PRIVACY_FOOTER_LINK'		=> $this->config['tas2580_privacyprotection_footerlink'],
		));

	}

	/**
	 * Display last accepted time in ACP
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function acp_users_display_overview($event)
	{
		$this->user->add_lang_ext('tas2580/privacyprotection', 'acp');

		$this->template->assign_vars(array(
			'PRIVACY_LAST_ACCPEPT'		=> ($event['user_row']['tas2580_privacy_last_accepted'] <> 0) ? $this->user->format_date($event['user_row']['tas2580_privacy_last_accepted']) : $this->user->lang('NEVER'),
		));
	}

	/**
	 * Handle download of private data in UCP
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function ucp_display_module_before($event)
	{
		switch ($event['mode'])
		{
			case 'front':
			case '': // The dirty code of phpBB can also use empty mode for the front page
				$this->user->add_lang_ext('tas2580/privacyprotection', 'ucp');
				$this->template->assign_vars(array(
					'U_DOWNLOAD_MY_DATA'		=> $this->auth->acl_get('u_privacyprotection_dl_data') ? append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=profile_download') : '',
					'U_DOWNLOAD_MY_POSTS'		=> $this->auth->acl_get('u_privacyprotection_dl_posts') ? append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=post_download') : '',
					'PRIVACY_LAST_ACCEPTED'		=> $this->user->format_date($this->user->data['tas2580_privacy_last_accepted']),
				));
				break;

			case 'profile_download':
				if (!$this->auth->acl_get('u_privacyprotection_dl_data'))
				{
					trigger_error('NOT_AUTHORISED');
				}

				// Select data from user table
				$sql = 'SELECT user_id, user_ip, user_regdate, username, user_email, user_lastvisit, user_posts, user_lang, user_timezone, user_dateformat,
						user_avatar, user_sig, user_jabber
					FROM ' .  USERS_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$user_row = $this->db->sql_fetchrow($result);

				// Format date
				$user_row['user_regdate'] = $this->user->format_date($user_row['user_regdate']);
				$user_row['user_lastvisit'] = $this->user->format_date($user_row['user_lastvisit']);

				// Select data from profile fields table
				$sql = 'SELECT *
					FROM ' .  PROFILE_FIELDS_DATA_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$profile_fields_row = $this->db->sql_fetchrow($result);
				$profile_fields_row = is_array($profile_fields_row) ? $profile_fields_row : array();

				// Select data from session table
				$sql = 'SELECT session_id, session_last_visit, session_ip, session_browser
					FROM ' .  SESSIONS_TABLE . '
					WHERE session_user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$session_row = $this->db->sql_fetchrow($result);

				// Format date
				$session_row['session_last_visit'] = $this->user->format_date($session_row['session_last_visit']);

				// Merge all data
				$data = array_merge($user_row, $session_row, $profile_fields_row);

				/**
				 * Add or modify user data in tas2580 privacyprotection extension
				 *
				 * @event tas2580.privacyprotection_collect_data_after
				 * @var    array	data		The user data row
				 */
				$vars = array('data');
				extract($this->phpbb_dispatcher->trigger_event('tas2580.privacyprotection_collect_data_after', compact($vars)));

				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename=my_user_data.csv");
				header("Pragma: no-cache");
				header("Expires: 0");

				foreach ($data as $name => $value)
				{
					if (!empty($value))
					{
						$header[] = $name;
						$content[] = $this->escape($value);
					}
				}

				echo implode(', ', $header) . "\n";
				echo implode(', ', $content);
				exit;

			case 'post_download':
				if (!$this->auth->acl_get('u_privacyprotection_dl_posts'))
				{
					trigger_error('NOT_AUTHORISED');
				}

				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename=my_post_data.csv");
				header("Pragma: no-cache");
				header("Expires: 0");

				$fields = 'post_id, topic_id, forum_id, poster_ip, post_time, post_subject, post_text';
				echo $fields . "\n";
				$sql = 'SELECT ' . $fields . '
					FROM ' .  POSTS_TABLE . '
					WHERE poster_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				while($row = $this->db->sql_fetchrow($result))
				{
					$row['post_text'] = $this->escape($row['post_text']);
					$row['post_subject'] = $this->escape($row['post_subject']);
					$row['post_time'] = '"' . $this->user->format_date($row['post_time']) . '"';
					echo implode(', ', $row) . "\n";
				}
				exit;
		}
	}

	/**
	 * Check if the user has accepted the privacy policy
	 *
	 * @return null
	 * @access public
	 */
	public function ucp_register_data_before()
	{
		$this->user->add_lang_ext('tas2580/privacyprotection', 'ucp');
		$privacy_link = empty($this->config['tas2580_privacyprotection_privacy_url']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'mode=privacy') : $this->config['tas2580_privacyprotection_privacy_url'];
		$this->template->assign_vars(array(
			'PRIVACY_ACCEPTED_EXPLAIN'			=> sprintf($this->user->lang['PRIVACY_ACCEPTED_EXPLAIN'], $privacy_link),
		));
	}

	/**
	 * Check if the user accepted the privacy policy
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function ucp_register_data_after($event)
	{
		$error = $event['error'];
		$privacy = $this->request->variable('privacy', 0);
		if ($privacy <> 1)
		{
			$this->user->add_lang_ext('tas2580/privacyprotection', 'ucp');
			$error[] = $this->user->lang['NEED_ACCEPT_PRIVACY'];
			$event['error'] = $error;
		}
	}

	/**
	 * Display option to allow massemail on register
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function ucp_register_user_row_after($event)
	{
		$user_row = $event['user_row'];
		$user_row['user_allow_massemail'] = $this->request->variable('massemail', 0);
		$event['user_row'] = $user_row;
	}

	/**
	 * Do not display IP in MCP
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function mcp_post_template_data($event)
	{
		// Do not display IP in MCP
		if ($this->config['tas2580_privacyprotection_anonymize_ip'] == 1)
		{
			$mcp_post_template_data = $event['mcp_post_template_data'];
			$mcp_post_template_data['S_CAN_VIEWIP'] = false;
			$event['mcp_post_template_data'] = $mcp_post_template_data;
		}
	}

	/**
	 * Set time for last accepted to now for new users
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function user_add_modify_data($event)
	{
		$sql_ary = $event['sql_ary'];
		$sql_ary['tas2580_privacy_last_accepted'] = time();
		$event['sql_ary'] = $sql_ary;
	}

	/**
	 * Do not allow posting if the user has not accepted the privacy policy
	 *
	 * @return null
	 * @access public
	 */
	public function modify_posting_auth()
	{
		if ($this->user->data['is_registered'] && $this->user->data['tas2580_privacy_last_accepted'] < $this->config['tas2580_privacyprotection_last_update'])
		{
			$this->user->add_lang_ext('tas2580/privacyprotection', 'common');
			trigger_error('NEED_TO_ACCEPT_PRIVACY_POLICY');
		}
		else if(!$this->user->data['is_registered'])
		{
			$this->user->add_lang_ext('tas2580/privacyprotection', 'common');
			$privacy_link = empty($this->config['tas2580_privacyprotection_privacy_url']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'mode=privacy') : $this->config['tas2580_privacyprotection_privacy_url'];
			$this->template->assign_vars(array(
				'ACCEPT_PRIVACY'			=> sprintf($this->user->lang['CONFIRM_ACCEPT_PRIVACY'], $privacy_link),
			));
		}
	}

	/**
	 * Check if guest has accepted the privacy
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function posting_modify_message_text($event)
	{
		if(!$this->user->data['is_registered'])
		{
			$accept_privacy = $this->request->variable('accept_privacy', 0);
			if($accept_privacy == 0)
			{
				$error = $event['error'];
				$this->user->add_lang_ext('tas2580/privacyprotection', 'common');
				$error[] = $this->user->lang['NEED_TO_ACCEPT_PRIVACY_POLICY'];
				$event['error'] = $error;
			}
		}
	}

	/**
	 * Disable quick replay if privacy is not accepted
	 *
	 * @return null
	 * @access public
	 */
	public function viewtopic_modify_page_title()
	{
		if ($this->user->data['is_registered'] && $this->user->data['tas2580_privacy_last_accepted'] < $this->config['tas2580_privacyprotection_last_update'])
		{
			$this->template->assign_vars(array(
				'S_QUICK_REPLY'		=> false,
			));
		}
	}

	/**
	 * Disable post info if privacy is not accepted
	 *
	 * @return null
	 * @access public
	 */
	public function viewforum_modify_topics_data()
	{
		if ($this->user->data['is_registered'] && $this->user->data['tas2580_privacy_last_accepted'] < $this->config['tas2580_privacyprotection_last_update'])
		{
			$this->template->assign_vars(array(
				'S_DISPLAY_POST_INFO'	=> false,
			));
		}
	}

	/**
	 * Generate fake IPv6 from real IP and other browser data
	 *
	 * @return string
	 */
	private function generate_fake_ip()
	{
		$lang = $this->request->variable('HTTP_ACCEPT_LANGUAGE', '', false, \phpbb\request\request_interface::SERVER);
		$ua = $this->request->variable('HTTP_USER_AGENT', '', false, \phpbb\request\request_interface::SERVER);
		$ip = $this->request->variable('REMOTE_ADDR', '', false, \phpbb\request\request_interface::SERVER);
		return implode(':', str_split(md5($lang . $ua . $ip), 4));
	}

	/**
	 * If there is a quotation mark in the string we need to replace it with double quotation marks (RFC 4180)
	 *
	 * @param string $data
	 * @return string
	 */
	private function escape($data)
	{
		if (substr_count($data, '"'))
		{
			$data = str_replace('"', '""', $data);
		}
		return '"' . $data . '"';
	}
}
