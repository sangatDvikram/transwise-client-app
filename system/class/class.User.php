<?php
class User
{
	static function userinfo($username)
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT $username FROM transwise_user WHERE email = :username");
			$stmt->execute(array('username' => $_SESSION['username']));
			$row = $stmt->fetch();
			return $row[$username];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
	static function info($username,$field)
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT $field FROM transwise_user WHERE user_id = :username");
			$stmt->execute(array('username' => $username));
			$row = $stmt->fetch();
			return $row[$field];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
	static function driverInfo($username,$field)
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT $field FROM transwise_user,transwise_drivers WHERE transwise_user.user_id = :username and transwise_drivers.user_id = :username ");
			$stmt->execute(array('username' => $username));
			$row = $stmt->fetch();
			return $row[$field];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
	static function getAllDrivers()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT * FROM transwise_user,transwise_drivers WHERE transwise_user.user_id = transwise_drivers.user_id  ");
			$stmt->execute();
			$row = $stmt->fetchAll(PDO::FETCH_NAMED);
			return $row;
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
        static function get_drivers()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT * FROM transwise_drivers ");
			$stmt->execute();
			$row = $stmt->fetchAll(PDO::FETCH_NAMED);
			return $row;
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
	static function avilble_driversCount()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT * FROM transwise_user,transwise_drivers WHERE transwise_user.user_id = transwise_drivers.user_id ");
			$stmt->execute();
			$row=$stmt->fetchAll(PDO::FETCH_NAMED);
			$return= array();
			foreach ($row as $value) {
				if($value['Status']==0)
				{
					$drivers['id']=$value['id'];
					$drivers['name']=$value['name'];
					$return[]=$drivers;
				}
				elseif ($value['bookedtill']<time())
				{
					$drivers['id']=$value['id'];
					$drivers['name']=$value['name'];
					$return[]=$drivers;
				}
			}
			return count($return);
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	static function getFreeDrivers()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT * FROM transwise_user,transwise_drivers WHERE transwise_user.user_id = transwise_drivers.user_id ");
			$stmt->execute();
			$row=$stmt->fetchAll(PDO::FETCH_NAMED);
			$return= array();
			foreach ($row as $value) {
				if($value['Status']==0)
				{
					$drivers['id']=$value['id'];
					$drivers['name']=$value['name'];
					$return[]=$drivers;
				}
				elseif ($value['bookedtill']<time())
				{
					$drivers['id']=$value['id'];
					$drivers['name']=$value['name'];
					$return[]=$drivers;
				}
			}
			return $row;
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
	static function getDriverStatus($username)
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT Status,bookedtill FROM transwise_user,transwise_drivers WHERE transwise_user.user_id = :username and transwise_drivers.user_id = :username ");
			$stmt->execute(array('username' => $username));
			$row = $stmt->fetch();
			switch ($row['Status']) {
				case 0:
					$status="<a class='btn btn-success' href='#' role='button'>Available</a>";
					break;
				case 1:
					$status="<a class='btn btn-denger' href='#' role='button'>Booked till ".date('d/m/Y',$row['bookedtill'])."</a>";
					break; 
					$status="<a class='btn btn-default' href='#' role='button'>No Status</a>";
					break;
			}
			return $status;
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

}