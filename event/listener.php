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
	/** @var \phpbb\config\config */
	protected $config;

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
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\event\dispatcher_interface $phpbb_dispatcher, \phpbb\user $user, \phpbb\template\template $template, \phpbb\request\request $request, $phpbb_root_path, $php_ext)
	{
		$this->config = $config;
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
			'core.ucp_register_user_row_after'					=> 'ucp_register_user_row_after',
			'core.ucp_display_module_before'					=> 'ucp_display_module_before',
			'core.ucp_register_data_before'						=> 'ucp_register_data_before',
			'core.ucp_register_data_after'						=> 'ucp_register_data_after',
			'core.acp_board_config_edit_add'					=> 'acp_board_config_edit_add',
			'core.modify_posting_parameters'					=> 'modify_posting_parameters',
			'core.page_header_after'							=> 'page_header_after',
			'core.acp_main_notice'								=> 'acp_main_notice',
		);
	}

	public function acp_main_notice()
	{
		$this->user->add_lang_ext('tas2580/privacyprotection', 'acp');

		$update_privacy = $this->request->variable('action_update_privacy', '');
		if ($update_privacy)
		{
			if (confirm_box(true))
			{

				$this->config->set('tas2580_privacyprotection_last_update', time());
				trigger_error($this->user->lang['PRIVACY_POLICE_UPDATED'] . adm_back_link($this->u_action));
			}
			else
			{
				confirm_box(false, $this->user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
					'action_update_privacy'		=> $update_privacy))
				);
			}
		}
	}


	/**
	 * Add field for privacy in ACP settings
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function acp_board_config_edit_add($event)
	{
		if ($event['mode'] == 'settings')
		{
			$this->user->add_lang_ext('tas2580/privacyprotection', 'acp');
			$display_vars = $event['display_vars'];
			$insert = array('tas2580_privacyprotection_privacy_url' => array(
				'lang'		=> 'ACP_PRIVACY_URL',
				'validate'	=> 'string',
				'type'		=> 'url:40:255',
				'explain'	=> true
			));
			$display_vars['vars'] = $this->array_insert($display_vars['vars'], 'legend2', $insert);
			$event['display_vars'] = $display_vars;
		}
	}

	/**
	 * Check if the user has accepted the privacy policy
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function modify_posting_parameters()
	{
		if ($this->user->data['tas2580_privacy_last_accepted'] < $this->config['tas2580_privacyprotection_last_update'])
		{
			$this->user->add_lang_ext('tas2580/privacyprotection', 'common');
			trigger_error('NEED_TO_ACCEPT_PRIVACY_POLICY');
		}
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
				redirect(append_sid("{$this->phpbb_root_path}index.{$this->php_ext}"));
			}

			$this->user->add_lang_ext('tas2580/privacyprotection', 'common');
			$privacy_link = empty($this->config['tas2580_privacyprotection_privacy_url']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'mode=privacy') : $this->config['tas2580_privacyprotection_privacy_url'];
			$this->template->assign_vars(array(
				'S_NEED_ACCPEPT_PRIVACY'		=> true,
				'NEED_ACCPEPT_PRIVACY'			=> sprintf($this->user->lang['NEED_ACCPEPT_PRIVACY'], $privacy_link),
				'U_ACCPEPT_PRIVACY'				=> append_sid("{$this->phpbb_root_path}index.{$this->php_ext}", 'mode=accept_privacy'),
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
					'U_DOWNLOAD_MY_DATA'		=> append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=profile_download'),
					'U_DOWNLOAD_MY_POSTS'		=> append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=post_download'),
				));
				break;

			case 'profile_download':
				// Select data from user table
				$sql = 'SELECT user_id, user_ip, user_regdate, username, user_email, user_lastvisit, user_posts, user_lang, user_timezone, user_dateformat,
						user_avatar, user_sig, user_jabber
					FROM ' .  USERS_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$user_row = $this->db->sql_fetchrow($result);

				// Select data from profile fields table
				$sql = 'SELECT *
					FROM ' .  PROFILE_FIELDS_DATA_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$profile_fields_row = $this->db->sql_fetchrow($result);

				// Select data from session table
				$sql = 'SELECT session_id, session_last_visit, session_ip, session_browser
					FROM ' .  SESSIONS_TABLE . '
					WHERE session_user_id = ' . (int) $this->user->data['user_id'];
				$result = $this->db->sql_query($sql);
				$session_row = $this->db->sql_fetchrow($result);

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
					echo implode(', ', $row) . "\n";
				}
				exit;
		}
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

	private function array_insert(&$array, $position, $insert)
	{
		if (is_int($position))
		{
			array_splice($array, $position, 0, $insert);
		}
		else
		{
			$pos   = array_search($position, array_keys($array));
			$array = array_merge(
				array_slice($array, 0, $pos),
				$insert,
				array_slice($array, $pos)
			);
		}
		return $array;
	}
}
