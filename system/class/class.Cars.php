<?php
class Cars 
{
	private $db;
	private $data;
	function __construct()
	{
		global $dataBase;
		$this->db=$dataBase;
	}
	function getData($input)
	{
		$input = array_map( 'stripslashes', $input );
		$this->data=$input;
	}
	private function  generate_soft_link($input)
	{
		return strtolower(str_replace(" ",'-',trim($input)));
	}
	public function generate_id($table)
	{
		
			$string=md5(time());
			$length=4;
			$hex='';
			$id='';
		for ($i=0; $i < strlen($string); $i++)
		{
		$hex .= dechex(ord($string[$i]));
		}
		$string=substr($hex,0,$length);

			if (strpos($table,'groups') !== false)
			{
				$id="grp-".$string;
			}
			else
			{
				$id="car-".$string;
			}
			return $id;
			
		
		
	}

	public function insert_car_group()
	{
		try 
		{
			$statement="Insert Into transwise_car_groups (id,name,details,count) values(:id,:name,:details,:count)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				":id"=>ProcessForm::generate_id('transwise_car_groups','car-groups-'),
				":name"=>$this->data['group'],
				":details"=>$this->data['desc'],
				":count"=>0
			));
			return "<div class='alert alert-success'> Car Group has been successfully created.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> Car Group Alredy exists.</div>";
		}
	}
	
	public function get_cargroups_details($id)
	{
		try
		{
			$statement="Select * from transwise_car_groups where id=:link Limit 1";
			$query=$this->db->prepare($statement);
			$query->execute(array(":link"=>$id));
			return $query->fetch(PDO::FETCH_NAMED);
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function cargroups_details($info,$strr1,$strr2)
	{
		try
		{
			$statement="Select $info from transwise_car_groups where $strr1=:link Limit 1";
			$query=$this->db->prepare($statement);
			$query->execute(array(":link"=>$strr2));
			$row=$query->fetch(PDO::FETCH_NAMED);
			return $row[$info];
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function cargroups()
	{
		try
		{
			global $dataBase;
			$statement="Select * from transwise_car_groups ";
			$query=$dataBase->prepare($statement);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_NAMED);
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function updateCargroup($pageid)
	{
		try
		{
			$statement="UPDATE transwise_car_groups SET name = :static_pages_name, details = :static_pages_title WHERE  id = :pageid ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":static_pages_name"=>$this->data['group'],
					":static_pages_title"=>$this->data['desc'],
					":pageid"=>$pageid
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Car Group has been successfully updated.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> Not able to update Car Group Details.</div>";
		}
		
	}
	public function deletecargroup($pageid)
	{
		try
		{
			$statement="DELETE FROM transwise_car_groups WHERE  id = :pageid ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					
					":pageid"=>$pageid
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Car Group has been successfully Deleted.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> Not able to delete Car Group.</div>";
		}
		
	}
	
		/*
		---------------------------------------------------------------------------------------------------------------------------------------------
		---------------------------------------------------------------------------------------------------------------------------------------------
		----------------------------------------------------------Car thing starts here--------------------------------------------------------------
		---------------------------------------------------------------------------------------------------------------------------------------------
		---------------------------------------------------------------------------------------------------------------------------------------------
		*/

	public function insert_car()
	{
		try 
		{
			$statement="Insert Into transwise_car_details (id,group_id,name,owner,pfrom,Dop,Engine_number,Chesis_number,RTO_from,RTO_to,INC_from,INC_to,Per_from,Per_to,Auth_from,Auth_to,INC_numb,Per_numb,Auth_numb,PUC_from,PUC_to,color,type,Reg_num,persons,timestamp,user,amount,quantity,details,status) values(:id,:group_id,:name,:owner,:pfrom,:Dop,:Engine_number,:Chesis_number,:RTO_from,:RTO_to,:INC_from,:INC_to,:Per_from,:Per_to,:Auth_from,:Auth_to,:INC_numb,:Per_numb,:Auth_numb,:PUC_from,:PUC_to,:color,:type,:Reg_num,:persons,:timestamp,:user,:amount,:quantity,:details,:status)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				":id"=>ProcessForm::generate_id('transwise_car_details','car-'),
				":group_id"=>$this->cargroups_details('id','name',$this->data['group']),
				":name"=>$this->data['name'],
				":owner"=>$this->data['owner'],
				":pfrom"=>$this->data['pfrom'],
				":Dop"=>$this->data['Dop'],
				":Engine_number"=>$this->data['Engine_number'],
				":Chesis_number"=>$this->data['Chesis_number'],
				":RTO_from"=>$this->data['RTO_from'],
				":RTO_to"=>$this->data['RTO_to'],
				":INC_from"=>$this->data['INC_from'],
				":INC_to"=>$this->data['INC_to'],
				":Per_from"=>$this->data['Per_from'],
				":Per_to"=>$this->data['Per_to'],
				":Auth_from"=>$this->data['Auth_from'],
				":Auth_to"=>$this->data['Auth_to'],
				":INC_numb"=>$this->data['INC_numb'],
				":Per_numb"=>$this->data['Per_numb'],
				":Auth_numb"=>$this->data['Auth_numb'],
				":PUC_from"=>$this->data['PUC_from'],
				":PUC_to"=>$this->data['PUC_to'],
				":color"=>$this->data['color'],
				":type"=>$this->data['type'],
				":Reg_num"=>$this->data['Reg_num'],
				":persons"=>$this->data['persons'],
				":timestamp"=>time(),
				":user"=>$_SESSION['user_id'],
				":amount"=>$this->data['amount'],
				":quantity"=>0,
				":details"=>$this->data['details'],
				":status"=>0
				
				
			));
			return "<div class='alert alert-success'> Car has been successfully added to the stock.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	
	public function get_car_details($id)
	{
		try
		{
			$statement="Select * from transwise_car_details where id=:link Limit 1";
			$query=$this->db->prepare($statement);
			$query->execute(array(":link"=>$id));
			return $query->fetch(PDO::FETCH_NAMED);
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function car()
	{
		try
		{
			global $dataBase;
			$statement="Select * from transwise_car_details ";
			$query=$dataBase->prepare($statement);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_NAMED);
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function updateCar($pageid)
	{
		try
		{
			$statement="UPDATE transwise_car_details SET
		    group_id=:static_group_id,
 			name=:static_name,
 			owner=:static_owner,
 			pfrom=:static_pfrom,
 			Dop=:static_Dop,
 			Engine_number=:static_Engine_number,
 			Chesis_number=:static_Chesis_number,
 			RTO_from=:static_RTO_from,
 			RTO_to=:static_RTO_to,
 			INC_from=:static_INC_from,
 			INC_to=:static_INC_to,
 			Per_from=:static_Per_from,
 			Per_to=:static_Per_to,
 			Auth_from=:static_Auth_from,
 			Auth_to=:static_Auth_to,
 			INC_numb=:static_INC_numb,
 			Per_numb=:static_Per_numb,
 			Auth_numb=:static_Auth_numb,
 			PUC_from=:static_PUC_from,
 			PUC_to=:static_PUC_to,
 			color=:static_color,
 			type=:static_type,
 			Reg_num=:static_Reg_num,
 			persons=:static_persons,
 			timestamp=:static_timestamp,
 			user=:static_user,
 			amount=:static_amount,
 			quantity=:static_quantity,
 			details=:static_details,
 			status=:static_status
			WHERE
			id = :static_id ";

            $query=$this->db->prepare($statement);
            $query->execute(array(
                ":group_id"=>$this->cargroups_details('id','name',$this->data['group']),
                ":name"=>$this->data['name'],
                ":owner"=>$this->data['owner'],
                ":pfrom"=>$this->data['pfrom'],
                ":Dop"=>$this->data['Dop'],
                ":Engine_number"=>$this->data['Engine_number'],
                ":Chesis_number"=>$this->data['Chesis_number'],
                ":RTO_from"=>$this->data['RTO_from'],
                ":RTO_to"=>$this->data['RTO_to'],
                ":INC_from"=>$this->data['INC_from'],
                ":INC_to"=>$this->data['INC_to'],
                ":Per_from"=>$this->data['Per_from'],
                ":Per_to"=>$this->data['Per_to'],
                ":Auth_from"=>$this->data['Auth_from'],
                ":Auth_to"=>$this->data['Auth_to'],
                ":INC_numb"=>$this->data['INC_numb'],
                ":Per_numb"=>$this->data['Per_numb'],
                ":Auth_numb"=>$this->data['Auth_numb'],
                ":PUC_from"=>$this->data['PUC_from'],
                ":PUC_to"=>$this->data['PUC_to'],
                ":color"=>$this->data['color'],
                ":type"=>$this->data['type'],
                ":Reg_num"=>$this->data['Reg_num'],
                ":persons"=>$this->data['persons'],
                ":timestamp"=>time(),
                ":user"=>$_SESSION['user_id'],
                ":amount"=>$this->data['amount'],
                ":quantity"=>0,
                ":details"=>$this->data['details'],
                ":status"=>0,
                ":static_id"=>$pageid
            ));

			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Car Details has been successfully updated.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> Not able to update Car Details.</div>";
		}
		
	}
	public function car_details($info,$strr1,$strr2)
	{
		try
		{
			$statement="Select $info from transwise_car_details where $strr1=:link";
			$query=$this->db->prepare($statement);
			$query->execute(array(":link"=>$strr2));
			//$row=$query->fetchAll(PDO::FETCH_NAMED);
			return $query->fetchAll(PDO::FETCH_NAMED);
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	static function getcarcount()
	{
		try
		{
			global $dataBase;
			$statement="Select Count(*) as TCars from transwise_car_details ";
			$query=$dataBase->prepare($statement);
			$query->execute();
			$row=$query->fetch(PDO::FETCH_NAMED);
			return $row['TCars'];
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function deletecar($pageid)
	{
		try
		{
			$statement="DELETE FROM transwise_car_details WHERE  id = :pageid ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					
					":pageid"=>$pageid
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Car has been successfully Deleted.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> Not able to delete Car .</div>";
		}
		
	}
	






















}