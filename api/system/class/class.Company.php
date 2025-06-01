<?php 
class Company
{
	static function getdetails($field)
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT $field FROM transwise_company_details");
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[$field];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
		
	}
}