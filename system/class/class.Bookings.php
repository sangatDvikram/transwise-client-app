<?php 
class Bookings
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
	public function bookit()
	{
		try 
		{
			global $dataBase;
			$user_id=$this->user_id();
			$bookindid=ProcessForm::generate_id('transwise_booking','booking-');
			$statement="Insert Into transwise_booking (booking_id,user,persons,from_date,to_date,car,status,date,package_id) values(:id,:user,:persons,:fromdate,:todate,:car,:status,:date,:package_id)";
			$query=$dataBase->prepare($statement);
			$query->execute(array(
				":id"=>$bookindid,
				":user"=>$user_id,
				":persons"=>$this->data['persons'],
				":fromdate"=>$this->gettimestamp($this->data['fromdate']),
				":todate"=>$this->gettimestamp($this->data['todate']),
				":car"=>$this->data['car'],
                                ":package_id"=>$this->data['package_id'],
				":status"=>0,
				":date"=>time()
			));
			
			$notification = new Notification;
			$car=new Cars;
			$cars=$car->get_car_details($this->data['car']);
			$details= User::info($user_id,'name')." has requested for the " .$cars['name']." from ".$this->data['fromdate']." to ".$this->data['todate']."" ;
			$nott= array('user_id' => $user_id,'topic_id'=>$bookindid,'details'=>$details,'type'=>'Booking','targated_user'=>'4');
			$notification->getData($nott);
			$notification->createNotification();
			return " <div class='bs-callout bs-callout-warning'>
    <h4>Cab booking request has been submited successfully.</h4>
    <p>You can check your email id <kbd>".$this->data['email']."</kbd> for more information about booking.<br>
     Make sure your contact no. <code>".$this->data['contact']."</code> is reachable.<br>
      Within 24 hours our operator will call you for confirmation of your booking.</p>
  </div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'>".$e->getMessage()."</div>";
		}
	}
	public function booking($id=null)
	{
		try
		{
			global $dataBase;
			if(isset($id))
			{
			$statement="Select * from transwise_booking where booking_id=:id order by date desc";
			$query=$dataBase->prepare($statement);
			$query->execute(array(":id"=>$id));
			return $query->fetch(PDO::FETCH_NAMED);
			}
			else
			{	
			$statement="Select * from transwise_booking order by date desc";
			$query=$dataBase->prepare($statement);
			$query->execute();

			return $query->fetchAll(PDO::FETCH_NAMED);
			}
			
			
		} catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	public function generate_id()
	{
		
			$string=md5(time());
			$length=8;
			$hex='';
			$id='';
		for ($i=0; $i < strlen($string); $i++)
		{
		$hex .= dechex(ord($string[$i]));
		}
		$string=substr($hex,0,$length);

			return $id=''.$string;
		
	}
	public function confirm_booking()
	{
		try
		{
			$pick_up_time=$this->data['time_to_hrs'].":".$this->data['time_to_min']." ".$this->data['time_to_type'];
			$statement="UPDATE transwise_booking SET driver_id = :driver_id, status = 1,confirmed_by=:confirmed_by,confirm_date=:confirm_date,pick_up_time=:pick_up_time,package_id=:package_id WHERE  booking_id = :id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":driver_id"=>$this->data['driver'],
					":package_id"=>$this->data['package_id'],
					":confirmed_by"=>$_SESSION['user_id'],
					":confirm_date"=>time(),
					":id"=>$this->data['id'],
					":pick_up_time"=>$pick_up_time
			));
			$email=new Email;
			$info=$this->booking($this->data['id']);
			$email->SendMail($this->data['id'],User::info($info['user'],'email'));
			$statement="UPDATE transwise_drivers SET Status = 1 , bookedtill=:bookedtill WHERE  id = :id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":bookedtill"=>$this->data['to'],
					":id"=>$this->data['driver']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Booking has been confirmed.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function user_id()
	{
		if(Login::is_logged_in())
			return $_SESSION['user_id'];
		else
		{
			$register=new Register;
			$user= array('name' =>$this->data['name'],'email'=>$this->data['email'],'contact' =>$this->data['contact'],'address'=>$this->data['address'] ,'password' =>'aaaaa','cfmpassword'=>'aaaaa','required'=>'on');
			$ips=$register->check_input($user);
			$error=0;
			if ($register->error_exist())
			{
					if ($register->register_user(6))
					{
						return $register->_get_user_id();
					}
			}
			else 
				{
					$error=1;
					$errs=$register->get_errors();
					$data= "<div class='alert alert-danger'>";
					foreach ($errs as $err)
					{
						$data.= "$err <br>";
					}
					$data.= "</div>";
					echo "$data";
					exit(0);
				}
		}

	}
	public function gettimestamp($time)
	{
		list($day, $month, $year) = explode('/', $time);
		return mktime(0, 0, 0, $month, $day, $year);
	}
	public function getStatus($bookinId)
	{
		try
		{
			global $dataBase;
			
				$statement="Select * from transwise_booking where booking_id=:id ";
				$query=$dataBase->prepare($statement);
				$query->execute(array(":id"=>$bookinId));
				$result= $query->fetch(PDO::FETCH_NAMED);
				if ($result['status']==0)
				{
					$return= array('Status'=>'Pending','Button'=>'<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-question-sign"></span> Pending</button>');
				}
				if ($result['status']==1)
				{
					$return= array('Status'=>'Confirmed','Button'=>'<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-info-sign
"></span> Confirmed</button>');
				}
				if ($result['status']==2)
				{
					$return= array('Status'=>'Cancled','Button'=>'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Cancled</button>');
				}
				if ($result['status']==9)
				{
					$return= array('Status'=>'Completed','Button'=>'<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Completed</button>');
				}
				if (date('d/m/Y',$result['from_date'])<date('d/m/Y',time())&&$return['Status']=='Pending')
				{
					$return= array('Status'=>'Expired','Button'=>'<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-warning-sign "></span> Expired</button>');
				}
				return $return;
		} catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	static function getPendingCount()
	{
		try
		{
			global $dataBase;
			
				$statement="Select Count(*) as pending from transwise_booking where status=0 ";
				$query=$dataBase->prepare($statement);
				$query->execute();
				$result= $query->fetch(PDO::FETCH_NAMED);
				return $result['pending'];
				
		} catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	public function getPending()
	{
		try
		{
			global $dataBase;
			
				$statement="Select * from transwise_booking where status=0 order by date desc  ";
				$query=$dataBase->prepare($statement);
				$query->execute();
				return $query->fetchAll(PDO::FETCH_NAMED);
				
		} catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	public function getConfirmed()
	{
		try
		{
			global $dataBase;
			
				$statement="Select * from transwise_booking where status=1 order by date asc  ";
				$query=$dataBase->prepare($statement);
				$query->execute();
				return $query->fetchAll(PDO::FETCH_NAMED);
				
		} catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	
}