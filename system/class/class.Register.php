<?php

//require_once ('../include/system/config.php');
class Register
{
	private $_error= array();
	private $_ip= array();
	private $_user_ip;
	private $_location_id;
	private $_dataBase;
	private $_user;
	private $_user_id;
	
	public function __construct()
	{
		global $dataBase;
		$this->_dataBase=$dataBase;
		$this->_user_ip = ($_SERVER["REMOTE_ADDR"]=='::1') ? '127.0.0.1' : $_SERVER["REMOTE_ADDR"];
	}
	public function check_input($regirster)
	{
		$this->_validate_input($regirster);
		$this->_get_ip_details($this->_user_ip);
		//return $this->_check_user_exist($this->_user['email']);
	}
	public function register_user($type=1)
	{
		try
		{
					//$this->_getLocID();
				
					$statement="INSERT INTO transwise_user (user_id,name,password,email,contact,address,type,timestamp)values(:user_id,:user_username,:user_password	,:user_email,:user_contact,:user_address,:user_type,:user_registration_timestamp)";
					$qury=$this->_dataBase->prepare($statement);
					$qury->execute(array(":user_id"=>$this->_generate_id(md5(time()),10),
							":user_username"=>rtrim($this->_user['name']),
							":user_password"=>$this->_generate_password_hash($this->_user['password']),
							":user_email"=>$this->_user['email'],
							":user_contact"=>$this->_user['contact'],
							":user_address"=>$this->_user['address'],
							":user_type"=>$type,
							":user_registration_timestamp"=>time()
					));
					return true;
				
		}
		catch (PDOException $e)
		{
		}
	}
	private function _check_user_exist($username)
	{
		try
		{
		
			$statement="Select count(*) as userC from transwise_user where email=:username ";
			$qury=$this->_dataBase->prepare($statement);
			$qury->execute(array(':username' =>$username));
			$loc=$qury->fetch(PDO::FETCH_NAMED);
			if ($loc['userC']>0)
			{
				$this->_error[]="Email is alredy in use!!";
				
			}
			
		}
		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	
	
	private function _validate_input($input)
	{
		$this->_user=$input;
		$this->_validate_agry($input['required']);
		$this->_validate_username($input['name']);
		$this->_validate_email($input['email']);
		$this->_validate_contact($input['contact']);
		$this->_validate_address($input['address']);
		$this->_validate_pass($input['password'], $input['cfmpassword']);
		//$this->_validate_captcha($input['recaptcha_response_field'],$input['recaptcha_challenge_field']);
				
	}
	public function _get_user_id()
	{
		return $this->_user_id;
	}
	private function _get_ip_details($ip)
	{
		$ipResponce = file_get_contents("http://freegeoip.net/json/".$ip);
		$json = json_decode($ipResponce);
		$this->_ip=array("ip"=>$json->{"ip"},
						 "city"=>$json->{"city"},
						 "region_name"=>$json->{"region_name"},
						 "region_code"=>$json->{"region_code"},
						 "country_name"=>$json->{"country_name"},
						 "country_code"=>$json->{"country_code"}
						);
	}
	private function _getLocID()
	{
		try
		{
		
			$statement="Select count(*) as locCount , location_id from ". TBL_PREFIX."location where location_country=:country and location_region=:region and	location_city=:city";
			$qury=$this->_dataBase->prepare($statement);
			$qury->execute(array(':country' =>$this->_ip['country_name'],':region' => $this->_ip['region_name'],':city' => $this->_ip['city']));
			$loc=$qury->fetch(PDO::FETCH_NAMED);
			if ($loc['locCount']==0)
			{
				try
				{
					$this->_location_id=$this->_generate_loc_id(md5(time()), 6);
					$statement="Insert into transwise_location values(:locid,:location_city	,:location_region,:location_region_id,:location_country,:location_country_code,'')";
					$qury=$this->_dataBase->prepare($statement);
					$qury->execute(array(":locid"=>$this->_location_id,
										 ":location_city"=>$this->_ip['city'],
										 ":location_region"=>$this->_ip['region_name'],
										 ":location_region_id"=>$this->_ip['region_code'],
										 ":location_country"=>$this->_ip['country_name'],
										 ":location_country_code"=>$this->_ip['country_code']
					));
					return $this->_location_id;
				}
				catch (PDOException $e)
				{
				return $e->getMessage();
				}
			}
			else 
			{
				$this->_location_id=$loc['location_id'];
				return $this->_location_id;
			}
		}
		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	private function _generate_loc_id($string,$length)
	{
		$hex='';
		for ($i=0; $i < strlen($string); $i++)
		{
		$hex .= dechex(ord($string[$i]));
		}
		return 'Loc-'.substr($hex,0,$length);
		
	}
	private function _generate_id($string,$length)
	{
		$hex='';
		for ($i=0; $i < strlen($string); $i++)
		{
		$hex .= dechex(ord($string[$i]));
		}
		$this->_user_id='user-'.substr($hex,0,$length);
		return $this->_user_id;
		
	}
	private function _validate_agry($arrg)
	{
		if (!isset($arrg)) {
			$this->_error[]="Plase accept our terms and condition";
		}
		
	}
	private function _validate_username($username)
	{
		if (!preg_match('/^[A-Za-z][A-Za-z\\s]{4,19}$/',$username))
		{
			$this->_error[]= "Please enter proper name !!";
		}
		if (strlen($username)<5) {
			$this->_error[]=" Name Must be more than 5 letter!! ";
		}
	}
	private function _validate_pass($password,$cfmpassword)
	{
		if (strcmp($password,$cfmpassword) == 0)
		{
				
		}
		else
		{
			$this->_error[]="Password dont match!!";
		}
		if (strlen($password)<5) {
			$this->_error[]=" Password Must be more than 5 letter!! ";
		}
		if ($password==''||$cfmpassword=='') {
			$this->_error[]=" Password Cannot be kept blank ";
		}
	}
	private function _validate_email($email)
	{
		
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$this->_error[]="Provide Proper Email ID!!";
			}
		
	}
	private function _validate_address($email)
	{
		if ($email!='')
		{
			$address=filter_var($email, FILTER_SANITIZE_STRING);
			if ($address!=$email) {
				$this->_error[]="Provide proper Address!!";
			}
		}
		
	}
	private function _validate_contact($contact)
	{
		if (strlen($contact)!=10)
		{
			
				$this->_error[]="Provide Proper contact number !!";
		}

	}
	private function _validate_captcha($captcha_text,$capptcha_challenge)
	{
		require_once '../include/tools/recaptchalib.php';
		$response = recaptcha_check_answer ("6LelGe4SAAAAAPAkpY3-kvWpzY8K3PqnTCHN1ClD",	$_SERVER["REMOTE_ADDR"],$capptcha_challenge,$captcha_text);
		if (!$response->is_valid) {
				
			$this->_error[] = " Captcha is incorrenct. Try again.";
			//$error = $resp->error;
		}
	}
	private function _generate_password_hash($password)
	{
		return crypt($password, '$2a$12$'.substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22));
	}
	public function get_errors()
	{
		return $this->_error;
	}
	public function error_exist()
	{
		if (empty($this->_error)) {
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	
	
}