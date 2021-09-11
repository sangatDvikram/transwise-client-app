<?php
//require_once ('../include/system/config.php');
class Login{

    private $db;
	
	public function __construct($db){
		$this->db = $db; 
	}


	static function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}
	static function is_admin()
	{
		if(isset($_SESSION['type']) && $_SESSION['type'] == 2){
			return true;
		}
	}
	static function is_operator()
	{
		if(isset($_SESSION['type']) && $_SESSION['type'] == 4){
			return true;
		}
	}
	static function is_moderator()
	{
		if(isset($_SESSION['type']) && $_SESSION['type'] == 3){
			return true;
		}
	}
	private function filter_username($username)
	{
		return strip_tags(addslashes(preg_replace('/[^A-Za-z ]$/', '', $username)));
	}

	private function verify_hash($password,$hash)
	{
	    return $hash == crypt($password, $hash);
	}

	private function get_user_hash($username){	

		try {

			$stmt = $this->db->prepare('SELECT password FROM transwise_user WHERE email = :username');
			$stmt->execute(array('username' => $username));
			$row = $stmt->fetch();
			return $row['password'];

		} catch(PDOException $e) {
		    return $e->getMessage();
		}
	}

	private function get_user_type($username){
	
		try 
		{
	
			$stmt = $this->db->prepare('SELECT type FROM transwise_user WHERE email = :username');
			$stmt->execute(array('username' => $username));
			$row = $stmt->fetch();
			return $row['type'];
	
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	
	public function login_user($username,$password)
	{	
		$username=$this->filter_username($username);
		
		$hashed = $this->get_user_hash($username);
		
		if($this->verify_hash($password,$hashed) == 1)
		{
		    $type=$this->get_user_type($username);
		    $_SESSION['loggedin'] = true;
		    $_SESSION['type']=$type;
		    $_SESSION['username']=$username;
		    $_SESSION['user_id']=User::userinfo('user_id');

		    return true;
		}
		//return $username ."-". $hashed ;	
	}
	public function set_cookies($remember)
	{
		$time =time() + (isset($remember)) ?  31536000: 3600 ;
		setcookie('user_key',md5(time()), $time);
		setcookie('username',md5($_SESSION['username']), $time);
		setcookie('type',md5($_SESSION['type']), $time);
	}
	static function redirect()
	{
		//logged in return to index page
		if(isset($_SESSION['type'])){
		switch ($_SESSION['type']) {
			case '1':
				header('Location: user');
				break;
			case '2':
				header('Location: admin');
				break;
				case '3':
				header('Location: moderator');
				break;
				case '4':
				header('Location: operator');
				break;
		}
		}
		else
		{
			header('Location: /');
		}
		
	}	
	static function logout(){
		session_destroy();
	}
	
}


?>