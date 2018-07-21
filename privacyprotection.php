<?php
/**
 *
 * @package phpBB Extension - tas2580 privacyprotection
 * @copyright (c) 2018 tas2580 (https://tas2580.net)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace tas2580\privacyprotection;


/**
 * Event listener
 */
class privacyprotection
{
	public function anonymize_ip($time)
	{
		$sql = 'UPDATE ' . POSTS_TABLE . "
			SET poster_ip = '127.0.0.1'
			WHERE post_time < " . (int) $time;
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . LOG_TABLE . "
			SET log_ip = '127.0.0.1'
			WHERE log_time < " . (int) $time;
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . POLL_VOTES_TABLE . "
			SET vote_user_ip = '127.0.0.1'";
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . PRIVMSGS_TABLE . "
			SET author_ip = '127.0.0.1'
			WHERE message_time < " . (int) $time;
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . SESSIONS_TABLE . "
			SET session_ip = '127.0.0.1'
			WHERE session_time < " . (int) $time;
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . SESSIONS_KEYS_TABLE . "
			SET last_ip = '127.0.0.1'";
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_ip = '127.0.0.1'
			WHERE user_regdate < " . (int) $time;
		$this->db->sql_query($sql);
	}
}
