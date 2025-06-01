<?php
class Session 
{
	private $db;
	
	
	public function __construct($db) {
		// set our custom session functions.
		session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this, 'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));
	
		// This line prevents unexpected effects when using objects as save handlers.
		register_shutdown_function('session_write_close');
		$this->db=$db;
	}
	public function start_session($session_name, $secure) {
		// Make sure the session cookie is not accessable via javascript.
		$httponly = true;
	
		// Hash algorithm to use for the sessionid. (use hash_algos() to get a list of available hashes.)
		$session_hash = 'sha512';
	
		// Check if hash is available
		if (in_array($session_hash, hash_algos())) {
			// Set the has function.
			ini_set('session.hash_function', $session_hash);
		}
		// How many bits per character of the hash.
		// The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
		ini_set('session.hash_bits_per_character', 5);
	
		// Force the session to only use cookies, not URL variables.
		ini_set('session.use_only_cookies', 1);
	
		// Get session cookie parameters
		$cookieParams = session_get_cookie_params();
		// Set the parameters
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		// Change the session name
		session_name($session_name);
		// Now we cat start the session
		session_start();
		// This line regenerates the session and delete the old one.
		// It also generates a new encryption key in the database.
		session_regenerate_id(true);
	}
	function open() {
		return true;
	}
	function close()
	{
		return true;
	}
	function read($id) {
		try
		{
			if(!isset($this->read_stmt)) {
				$this->read_stmt = $this->db->prepare("SELECT sessions_data FROM ".TBL_PREFIX."sessions WHERE sessions_id = ? LIMIT 1");
			}
			
			$this->read_stmt->execute(array($id));
			$row=$this->read_stmt->fetch(PDO::FETCH_NAMED);
			$key = $this->getkey($id);
			$data = $this->decrypt($row['sessions_data'], $key);
			return $data;
		}
		catch (PDOException $e)
		{
		 die('read:'.$e->getMessage());
		}
	}
	function write($id, $data) {
		try
		{
			// Get unique key
			$key = $this->getkey($id);
			// Encrypt the data
			$data = $this->encrypt($data, $key);
		
			$time = time();
			if(!isset($this->w_stmt)) {
				$this->w_stmt = $this->db->prepare("INSERT INTO ".TBL_PREFIX."sessions (sessions_id, sessions_set_time, sessions_data, sessions_session_key) VALUES (?, ?, ?, ?)");
			}
			$this->w_stmt->execute(array($id, $time, $data, $key));
			return true;
		}
		catch (PDOException $e)
		{
		die('write:'.$e->getMessage());
		}
		
	}
	function destroy($id) {
		try
		{
			if(!isset($this->delete_stmt)) {
				$this->delete_stmt = $this->db->prepare("DELETE FROM ".TBL_PREFIX."sessions WHERE sessions_id = ?");
			}
			$this->delete_stmt->execute(array($id));
			return true;
		}
		catch (PDOException $e)
		{
		die('destory:'.$e->getMessage());
		}
	}
	function gc($max) {
		try
		{
			if(!isset($this->gc_stmt)) {
				$this->gc_stmt = $this->db->prepare("DELETE FROM ".TBL_PREFIX."sessions WHERE sessions_set_time < ?");
			}
			$old = time() - $max;
			$this->gc_stmt->execute(array($old));
			return true;
		}
		catch (PDOException $e)
		{
		die('gc:'.$e->getMessage());
		}
	}
	private function getkey($id) {
		try
		{
			if(!isset($this->key_stmt)) {
				$this->key_stmt = $this->db->prepare("SELECT sessions_session_key FROM ".TBL_PREFIX."sessions WHERE sessions_id = ? LIMIT 1");
			}
			$this->key_stmt->execute(array($id));
			$row=$this->read_stmt->fetch(PDO::FETCH_NAMED);
			if($row['sessions_session_key']!='') {
				$key=$row['sessions_session_key'];
				return $key;
			} else {
				$random_key = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
				return $random_key;
			}
		}
		catch (PDOException $e)
		{
		die('getkey:'.$e->getMessage());
		}
	}
	private function encrypt($data, $key) {
		$salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
		$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
		return $encrypted;
	}
	private function decrypt($data, $key) {
		$salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
		$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
		return $decrypted;
	}
}