<?php
/**
 *
 * @package phpBB Extension - tas2580 privacyprotection
 * @copyright (c) 2018 tas2580 (https://tas2580.net)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace tas2580\privacyprotection\cron\task;

use Symfony\Component\DependencyInjection\Container;

class anonymize_ip extends \phpbb\cron\task\base
{

	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\log\log_interface */
	protected $log;

	/**
	* Constructor
	*
	* @param string									$root_path
	* @param string									$php_ext
	* @param Container 								$phpbb_container
	* @param \phpbb\extension\manager				$phpbb_extension_manager
	* @param \phpbb\path_helper						$phpbb_path_helper
	* @param \phpbb\db\driver\driver_interfacer		$db
	* @param \phpbb\config\config					$config
	* @param \phpbb\log\log_interface 				$log
	* @param \phpbb\user							$user
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\log\log_interface $log)
	{
		$this->config 					= $config;
		$this->db						= $db;
		$this->phpbb_log 				= $log;
	}

	/**
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
	{
		// is disabled?
		if (($this->config['tas2580_privacyprotection_anonymize_ip_time_type'] == 0))
		{
			return;
		}

		$now = time();
		$this->config->set('tas2580_privacyprotection_anonymize_last_gc', $now);
		$this->phpbb_log->add('user', ANONYMOUS, '', 'LOG_ANONYMIZE_IP_CRON');
		$intervall = $this->config['tas2580_privacyprotection_anonymize_ip_time'] * 60 * 60 * 24;
		$time = $now - ($intervall * $this->config['tas2580_privacyprotection_anonymize_ip_time_type']);
		$privacyprotection = new \tas2580\privacyprotection\privacyprotection;
		$privacyprotection->anonymize_ip($time, $this->db);
	}


	/**
	* Returns whether this cron task can run, given current board configuration.
	*
	* @return bool
	*/
	public function is_runnable()
	{
		return ($this->config['tas2580_privacyprotection_anonymize_ip_time_type'] <> 0);
	}

	/**
	* Returns whether this cron task should run now, because enough time
	* has passed since it was last run.
	*
	* @return bool
	*/
	public function should_run()
	{
		return (int) $this->config['tas2580_privacyprotection_anonymize_last_gc'] < time() - (int) $this->config['tas2580_privacyprotection_anonymize_gc'];
	}
}
