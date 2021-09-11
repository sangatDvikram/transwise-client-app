<?php
class Notification
{
	/*
	 * Variables*
	 */
	private $db;
	private $data;
	
	
	/*
	 * Functions  
	 */
	public function __construct()
	{
		global $dataBase;
		$this->db=$dataBase;
	}

	function getData($input)
	{
		$input = array_map( 'stripslashes', $input );
		$this->data=$input;
	}

	public function createNotification()
	{
		try 
		{
			$statement="Insert Into transwise_notifications (user_id,topic_id,details,type,created_date,targated_user) values(:user_id,:topic_id,:details,:type,:created_date,:targated_user)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				":user_id"=>$this->data['user_id'],
				":topic_id"=>$this->data['topic_id'],
				":details"=>$this->data['details'],
				":type"=>$this->data['type'],
				":created_date"=>time(),
				":targated_user"=>$this->data['targated_user']
			));
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	
	static function getNotifications()
	{

	}
	
	static function getNotificationCount($type)
	{
		try
		{
			global $dataBase;
			$statement="Select Count(*) as Counts from transwise_notifications where targated_user like '%$type%' and seen NOT LIKE '%$_SESSION[user_id]%' and created_date>':date' ";
			$query=$dataBase->prepare($statement);
			$query->execute(array(
				":date"=>User::userinfo('timestamp')
				));
			$row=$query->fetch(PDO::FETCH_NAMED);
			return $row['Counts'];
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	
}