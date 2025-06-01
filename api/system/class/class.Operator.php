<?php 
class Operator
{

	private $data;
	private $id;
	private $db;
	function __construct()
	{
		global $dataBase;
		$this->db=$dataBase;
	}
	function getData($input)
	{
		//$input = array_map( 'stripslashes', $input );
		$this->data=$input;
	}

	public function RegisterDriver()
	{

		try 
		{
			global $dataBase;
			$this->user_id();
			$statement="Insert Into transwise_drivers (user_id,id,Dob,Doj,licence,pan,lissueD,lvalidD,pAdd,referance,timestamp,Status) values(:uid,:id,:dob,:doj,:lic,:pan,:issue,:vaid,:add,:ref,:time,:status)";
			$query=$dataBase->prepare($statement);
			$query->execute(array(
				":uid"=>$this->id,
				":id"=>$this->id,
				":dob"=>$this->data['dob'],
				":doj"=>$this->data['doj'],
				":lic"=>$this->data['licence'],
				":pan"=>$this->data['pan'],
				":issue"=>ProcessForm::gettimestamp($this->data['Ldate']),
				":vaid"=>ProcessForm::gettimestamp($this->data['Vdate']),
				":add"=>$this->data['perAdd'],
				":ref"=>'',
				":time"=>time(),
				":status"=>0
			));

			return " <div class='bs-callout bs-callout-warning'>
    			<h4><span class='glyphicon glyphicon-ok-sign text-success'></span>Driver Has been added to the Staff.</h4>
 				 </div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'>".$e->getMessage()." -> " .$this->user_id()."</div>";
		}

	}
	public function updateDriver()
	{
		try
		{
			$statement="UPDATE transwise_users SET name = :name, contact = :contact, email=:email ,address=:address  WHERE  user_id = :id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				":name"=>$this->data['name'],
				":contact"=>$this->data['contact'],
				":email"=>$this->data['email'],
				":address"=>$this->data['address'],
				":id"=>$this->data['id']
			));

			$statement="UPDATE transwise_drivers SET licence = :licence, pan = :pan, Dob=:Dob ,Doj=:Doj ,lissueD=:lissueD,lvalidD=:lvalidD,pAdd=:pAdd,referance=:referance WHERE  user_id = :id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					
				":licence"=>$this->data['licence'],
				":pan"=>$this->data['pan'],
				":Dob"=>$this->data['dob'],
				":Doj"=>$this->data['doj'],
				":lissueD"=>$this->data['lissueD'],
				":lvalidD"=>$this->data['lvalidD'],
				":pAdd"=>$this->data['pAdd'],
				":referance"=>$this->data['referance'],
				":id"=>$this->data['id']

			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Driver Details has been successfully updated.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> ".$e->getMessage()."</div>";
		}
	}
	public function deleteDriver()
	{
		try
		{
			$statement="DELETE FROM transwise_users WHERE  user_id = :pageid ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					
					":pageid"=>$this->data['id']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Driver has been successfully Deleted.</div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'> ".$e->getMessage()."</div>";
		}
		
	}
	public function user_id()
	{
		
			$register=new Register;
			$user= array('name' =>$this->data['name'],'email'=>$this->data['email'],'contact' =>$this->data['contact'],'address'=>$this->data['address'] ,'password' =>'aaaaa','cfmpassword'=>'aaaaa','required'=>'on');
			$ips=$register->check_input($user);
			$error=0;
			if ($register->error_exist())
			{
					if ($register->register_user(5))
					{
						$this->id= $register->_get_user_id();
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


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//					Duty Slip

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 public function GetDutySlipList()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT * FROM transwise_duty_slip ");
			$stmt->execute();
			
			return  $stmt->fetchAll(PDO::FETCH_NAMED);
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	 public function getDutySlipDetails($id)
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT * FROM transwise_duty_slip where Dslip_no= '$id' ");
			$stmt->execute();
			return  $stmt->fetch(PDO::FETCH_NAMED);
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	
	 public function getDutySlipCount()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT Count(*) as Dnum FROM transwise_duty_slip ");
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_NAMED);
			return  $row['Dnum']+1;
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	public function InsertDutySlip()
	{
		try 
		{
			global $dataBase;
			$time_to=$this->data['time_to_hrs'].":".$this->data['time_to_min']." ".$this->data['time_to_type'];
			$statement="Insert Into transwise_duty_slip (Dslip_no,Mslip_no,duty_slip_date,booking_id,open_km,close_km,date_from,date_to,time_from,time_to,min_charge_km,extra_charge_km,min_charge_hrs,extra_charge_hrs,toll,other_allow,pick_from,drop_to,vehicle_type,bill_type,timestamp,bill_no,used_by,teriff,totalkm,totalhrs,exact_totalhrs,booked_by) values(:Dslip_no,:Mslip_no,:duty_slip_date,:booking_id,:open_km,:close_km,:date_from,:date_to,:time_from,:time_to,:min_charge_km,:extra_charge_km,:min_charge_hrs,:extra_charge_hrs,:toll,:other_allow,:pick_from,:drop_to,:vehicle_type,:bill_type,:timestamp,:bill_no,:used_by,:teriff,:totalkm,:totalhrs,:exact_totalhrs,:booked_by)";
			$query=$dataBase->prepare($statement);
			$query->execute(array(
				
				":Dslip_no"=>$this->data['Dslip_no'],
				":Mslip_no"=>$this->data['Mslip_no'],
				":duty_slip_date"=>ProcessForm::gettimestamp($this->data['duty_slip_date']),
				":booking_id"=>$this->data['booking_id'],
				":open_km"=>$this->data['open_km'],
				":close_km"=>$this->data['close_km'],
				":date_from"=>ProcessForm::gettimestamp($this->data['date_from']),
				":date_to"=>ProcessForm::gettimestamp($this->data['date_to']),
				":time_from"=>$this->data['time_from'],
				":time_to"=>$time_to,
				":min_charge_km"=>$this->data['min_charge_km'],
				":extra_charge_km"=>$this->data['extra_charge_km'],
				":min_charge_hrs"=>$this->data['min_charge_hrs'],
				":extra_charge_hrs"=>$this->data['extra_charge_hrs'],
				":toll"=>$this->data['toll'],
				":other_allow"=>$this->data['other_allow'],
				
				":pick_from"=>$this->data['pick_from'],
				":drop_to"=>$this->data['drop_to'],
				":vehicle_type"=>$this->data['vehicle_type'],
				":bill_type"=>$this->data['bill_type'],
                                
				":timestamp"=>time(),
				":bill_no"=>$this->data['bill_no'],
				":used_by"=>$this->data['used_by'],
				":teriff"=>$this->data['teriff'],
				":totalkm"=>$this->data['totalkm'],
				":totalhrs"=>$this->data['totalhrs'],
                                ":exact_totalhrs"=>$this->data['exact_totalhrs'],
				":booked_by"=>$this->data['booked_by']
				
			));
			$stmt = $dataBase->prepare("UPDATE transwise_booking set status='9' , duty_slip='".$this->data['Dslip_no']."' where booking_id='".$this->data['booking_id']."' ");
			$stmt->execute();
                        $this->insert_invoice();
			return " <div class='bs-callout bs-callout-warning'>
    			<h4><span class='glyphicon glyphicon-ok-sign text-success'></span>Duty Slip Details have been added .</h4>
 				 </div>";
		} catch (PDOException $e) {
			return "<div class='alert alert-danger'>".$e->getMessage()."</div>";
		}
	}


        public function insert_invoice()
        {
    
		try 
		{
			$statement="Insert Into transwise_invoice (invoice_id,booking_id,duty_slip_id,timestamp) values(:invoice_id,:booking_id,:duty_slip_id,:timestamp)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				
				":invoice_id"=>$this->data['bill_no'],
				":booking_id"=>$this->data['booking_id'],
				":duty_slip_id"=>$this->data['Dslip_no'],
				":timestamp"=>time()
			));
			return "<div class='alert alert-success'> Service has been successfully created.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}

        }
public function get_invoice_details($id=null,$field=null)
	{
		try {
			global $dataBase;
			if($id==null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_invoice ");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_invoice where duty_slip_id=:Dslip_no ");
				$stmt->execute( array(':Dslip_no' => $id ));
				return $stmt->fetch(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field!=null) 
			{
				$stmt = $dataBase->prepare("SELECT $field FROM transwise_invoice where duty_slip_id=:Dslip_no ");
				$stmt->execute( array(':Dslip_no' => $id ));
				$row=$stmt->fetch(PDO::FETCH_NAMED);
				return $row[$field];
			}
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//					Package  Group

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 public function getpackagegroupcount()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT Count(*) as Dnum FROM transwise_package_group ");
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_NAMED);
			return  $row['Dnum'];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	public function getpackagegroupdetails($id=null,$field=null)
	{
		try {
			global $dataBase;
			if($id==null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_package_group ");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_package_group where cat_id=:cat_id ");
				$stmt->execute( array(':cat_id' => $id ));
				return $stmt->fetch(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field!=null) 
			{
				$stmt = $dataBase->prepare("SELECT $field FROM transwise_package_group where cat_id=:cat_id ");
				$stmt->execute( array(':cat_id' => $id ));
				$row=$stmt->fetch(PDO::FETCH_NAMED);
				return $row[$field];
			}
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
        public function package_details($info,$strr1,$strr2)
	{
		try
		{
			$statement="Select $info from transwise_package where $strr1=:link ";
			$query=$this->db->prepare($statement);
			$query->execute(array(":link"=>$strr2));
			$row=$query->fetchAll(PDO::FETCH_NAMED);
			return $row;
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function insert_package_group()
	{
		try 
		{
			$statement="Insert Into transwise_package_group (name,details,cat_id) values(:pgroup,:desc,:cat_id)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				
				":pgroup"=>$this->data['pgroup'],
				":desc"=>$this->data['desc'],
				":cat_id"=>$this->data['cat_id']
			));
			return "<div class='alert alert-success'> Package Group has been successfully created.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function update_package_group()
	{
		try
		{
			$statement="UPDATE transwise_package_group SET name = :pgroup, details = :descs WHERE  cat_id = :cat_id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":pgroup"=>$this->data['pgroup'],
					":descs"=>$this->data['desc'],
					":cat_id"=>$this->data['cat_id']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Package Group has been successfully updated.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		
	}
	public function delete_package_group()
	{
		try
		{
			$statement="DELETE FROM transwise_package_group WHERE  cat_id = :cat_id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					
						":cat_id"=>$this->data['cat_id']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Package Group has been successfully Deleted.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//					Package  

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 public function getpackagecount()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT Count(*) as Dnum FROM transwise_package ");
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_NAMED);
			return  $row['Dnum'];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	public function getpackagedetails($id=null,$field=null)
	{
		try {
			global $dataBase;
			if($id==null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_package ");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_package where package_id=:package_id ");
				$stmt->execute( array(':package_id' => $id ));
				return $stmt->fetch(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field!=null) 
			{
				$stmt = $dataBase->prepare("SELECT $field FROM transwise_package where package_id=:package_id ");
				$stmt->execute( array(':package_id' => $id ));
				$row=$stmt->fetch(PDO::FETCH_NAMED);
				return $row[$field];
			}
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
        public function get_package_service_details($id)
        {    try 
		{
                    global $dataBase;
                    $stmt = $dataBase->prepare("SELECT * FROM transwise_package_services where package_id=:package_id order by sr asc ");
                    $stmt->execute( array(':package_id' => $id ));
                    return $stmt->fetchAll(PDO::FETCH_NAMED);
                } catch(PDOException $e) {
			return $e->getMessage();
		}
        }
	public function insert_package()
	{
		
		try 
		{
                        $applicable_to='';
                        if(isset($this->data['Individual'])){ $applicable_to='01';}
                        if(isset($this->data['Company'])){$applicable_to='99';}
                        if(isset($this->data['Individual'])&&isset($this->data['Company'])){$applicable_to='00';}
                        $enable_upto=isset($this->data['enable_upto']) ? "1" : "0";
                        $enable_upto_hr=isset($this->data['enable_upto_hr']) ? "1" : "0";
			$statement="Insert Into transwise_package (name,details,cat_id,package_id,applicable_to,car_group_id,car_id,rate,rate_type,enable_upto,upto,upto_type,rate_hr,upto_hr,enable_upto_hr,extra_km,extra_hr,services_count) values(:package,:desc,:cat_id,:package_id,:applicable_to,:car_group_id,:car_id,:rate,:rate_type,:enable_upto,:upto,:upto_type,:rate_hr,:upto_hr,:enable_upto_hr,:extra_km,:extra_hr,:services_count)";
			$query=$this->db->prepare($statement);
			$caridlist='';
			
			foreach ($this->data['car_id'] as $carid)
			{
				
				$caridlist.=$carid."|";
				
			}
			$caridlist=substr($caridlist, 0, -1);
			//die($caridlist);
			$query->execute(array(
				
				":package"=>$this->data['package'],
				":desc"=>$this->data['desc'],
				":cat_id"=>$this->data['cat_id'],
				":package_id"=>$this->data['package_id'],
				":applicable_to"=>$applicable_to,
				":car_group_id"=>$this->data['car_group_id'],
				//":car_id"=>$this->data['car_id'],
					":car_id"=>$caridlist,
				":rate"=>$this->data['rate'],
				":rate_type"=>$this->data['rate_type'],
				":enable_upto"=>$enable_upto,
				":upto"=>$this->data['upto'],
				":upto_type"=>$this->data['upto_type'],
				":extra_hr"=>$this->data['extra_hr'],
                            ":rate_hr"=>$this->data['rate_hr'],
                            ":upto_hr"=>$this->data['upto_hr'],
                            ":enable_upto_hr"=>$enable_upto_hr,
                            ":extra_km"=>$this->data['extra_km'],
                                ":services_count"=>$this->data['servicecount']
			));
			
			
                        if($this->data['servicecount']>0)
                        {
                            for ($i=1;$i<=$this->data['servicecount'];$i++)
                            {
                        $statement="Insert Into transwise_package_services (package_id,service_id,rate,type) values(:package_id,:service_id,:rate,:type)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				
				":package_id"=>$this->data['package_id'],
				":service_id"=>$this->data['service_id'.$i],
				":rate"=>$this->data['rate'.$i],
				":type"=>$this->data['type'.$i]
			));
                            }
                        }
			return "<div class='alert alert-success'> Package has been successfully created.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function update_package()
	{
		try
		{ 
                        $applicable_to='';
                        if(isset($this->data['Individual'])){ $applicable_to='01';}
                        if(isset($this->data['Company'])){$applicable_to='99';}
                        if(isset($this->data['Individual'])&&isset($this->data['Company'])){$applicable_to='00';}
                        $enable_upto=isset($this->data['enable_upto']) ? "1" : "0";
                        $enable_upto_hr=isset($this->data['enable_upto_hr']) ? "1" : "0";
			$statement="UPDATE transwise_package SET name = :package, details = :desc , cat_id=:cat_id,applicable_to=:applicable_to,car_group_id=:car_group_id,car_id=:car_id,rate=:rate,rate_type=:rate_type,enable_upto=:enable_upto,upto=:upto,upto_type=:upto_type,rate_hr=:rate_hr,upto_hr=:upto_hr,enable_upto_hr=:enable_upto_hr,extra_hr=:extra_hr,extra_km=:extra_km,services_count=:services_count WHERE  package_id = :package_id ";
			$query=$this->db->prepare($statement);
			$caridlist='';
				
			foreach ($this->data['car_id'] as $carid)
			{
			
				$caridlist.=$carid."|";
			
			}
			$caridlist=substr($caridlist, 0, -1);
			//die($caridlist);
			$query->execute(array(
				":package"=>$this->data['package'],
				":desc"=>$this->data['desc'],
				":cat_id"=>$this->data['cat_id'],
				":package_id"=>$this->data['package_id'],
				":applicable_to"=>$applicable_to,
				":car_group_id"=>$this->data['car_group_id'],
				":car_id"=>$caridlist,
				":rate"=>$this->data['rate'],
				":rate_type"=>$this->data['rate_type'],
				":enable_upto"=>$enable_upto,
                                ":enable_upto_hr"=>$enable_upto_hr,
				":upto"=>$this->data['upto'],
				":upto_type"=>$this->data['upto_type'],
				":rate_hr"=>$this->data['rate_hr'],
				":upto_hr"=>$this->data['upto_hr'],
                                ":extra_hr"=>$this->data['extra_hr'],
				":extra_km"=>$this->data['extra_km'],
                                ":services_count"=>$this->data['servicecount']
			));
			$service_details=  $this->getpackagedetails($this->data['package_id']);
                        if($this->data['servicecount']>$service_details['services_count'])
                        {
                            for ($i=($service_details['services_count']+1);$i<=$this->data['servicecount'];$i++)
                            {
                        $statement="Insert Into transwise_package_services (package_id,service_id,rate,type) values(:package_id,:service_id,:rate,:type)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				
				":package_id"=>$this->data['package_id'],
				":service_id"=>$this->data['service_id'.$i],
				":rate"=>$this->data['rate'.$i],
				":type"=>$this->data['type'.$i]
			));
                            }
                        }
                        else {
                            for ($i=1;$i<=$this->data['servicecount'];$i++)
                            {
                        $statement="Update transwise_package_services Set rate=:rate,type=:type where package_id=:package_id and service_id=:service_id";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				
				":package_id"=>$this->data['package_id'],
				":service_id"=>$this->data['service_id'.$i],
				":rate"=>$this->data['rate'.$i],
				":type"=>$this->data['type'.$i]
			));
                            }
                        }
			return "<div class='alert alert-success'> Package has been successfully updated.</div>";
		} catch (PDOException $e) {
			return "error @ line".$e->getLine()." -> ".$e->getMessage();
		}
		
	}
	public function delete_package()
	{
		try
		{
			$statement="DELETE FROM transwise_package WHERE  package_id = :package_id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
						":package_id"=>$this->data['package_id']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Package has been successfully Deleted.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//				Services

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 public function getservicecount()
	{
		try {
			global $dataBase;
			$stmt = $dataBase->prepare("SELECT Count(*) as Dnum FROM transwise_extra_services ");
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_NAMED);
			return  $row['Dnum'];
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
	public function getservicedetails($id=null,$field=null)
	{
		try {
			global $dataBase;
			if($id==null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_extra_services ");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field==null) 
			{
				$stmt = $dataBase->prepare("SELECT * FROM transwise_extra_services where service_id=:service_id ");
				$stmt->execute( array(':service_id' => $id ));
				return $stmt->fetch(PDO::FETCH_NAMED);
			} 
			if($id!=null&&$field!=null) 
			{
				$stmt = $dataBase->prepare("SELECT $field FROM transwise_extra_services where service_id=:service_id ");
				$stmt->execute( array(':service_id' => $id ));
				$row=$stmt->fetch(PDO::FETCH_NAMED);
				return $row[$field];
			}
		
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
        
	public function insert_service()
	{
		try 
		{
			$statement="Insert Into transwise_extra_services (name,details,service_id,default_rate) values(:service,:desc,:service_id,:default_rate)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				
				":service"=>$this->data['service'],
				":desc"=>$this->data['desc'],
				":service_id"=>$this->data['service_id'],
				":default_rate"=>$this->data['default_rate']
			));
			return "<div class='alert alert-success'> Service has been successfully created.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function update_service()
	{
		try
		{
			$statement="UPDATE transwise_extra_services SET name = :service, details = :descs , default_rate=:default_rate WHERE  service_id = :service_id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":service"=>$this->data['service'],
					":descs"=>$this->data['desc'],
					":default_rate"=>$this->data['default_rate'],
					":service_id"=>$this->data['service_id']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Service has been successfully updated.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		
	}
	public function delete_service()
	{
		try
		{
			$statement="DELETE FROM transwise_extra_services WHERE  service_id = :service_id ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
						":service_id"=>$this->data['service_id']
			));
			//$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return "<div class='alert alert-success'> Service has been successfully Deleted.</div>";
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		
	}


}