<?php
class Manager
{
	private  $db;
	function __construct($db)
	{
			$this->db=$db;
	}
	function getRegistred_users($limit=30)
	{
		try 
		{
			$query= $this->db->prepare("Select usr.user_id,usr.user_username,loc.location_country,loc.location_region,loc.location_city,usr.user_registration_date,usr.user_ip from ".TBL_PREFIX."user usr,".TBL_PREFIX."location loc Where usr.user_location_id=loc.location_id  order by usr.user_registration_date Desc Limit 0,$limit");
			$query->execute();
			$row= $query->fetchAll(PDO::FETCH_ASSOC);
			$table='<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Country</th>
                  <th>Region</th>
                  <th>City</th>
					<th>Date</th>
					<th>IP</th>
                </tr>
              </thead>
              <tbody>';
			foreach ($row as $data)
			{
				$table.='<tr>';
				foreach ($data as $value) 
				$table.="<td> $value</td>";
				$table.='</tr>';
			}
			$table.='</tbody>
            </table>
          </div>';
			return $table;
		}
		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
	function getStaticPagesDetails()
	{
		try
		{
			$query= $this->db->prepare("Select * from ".TBL_PREFIX."static_pages");
			$query->execute();
			$row= $query->fetchAll(PDO::FETCH_ASSOC);
			$table='<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Page Name</th>
                  <th>Title</th>
                  <th>Link</th>
                  <th>Uploaded By</th>
				  <th>Allowed at Menu</th>
				  <th>Allowed at Footer</th>
				  <th>Date</th>
				  <th>Options</th>
                </tr>
              </thead>
              <tbody>';
			foreach ($row as $data)
			{
				$table.='<tr>';
				$table.="<td> $data[static_pages_id]</td>";
				$table.="<td> $data[static_pages_name]</td>";
				$table.="<td> $data[static_pages_title]</td>";
				$table.="<td> <a href='http://$_SERVER[HTTP_HOST]/kalpit/page/$data[static_pages_soft_link]'>$data[static_pages_name]</a></td>";
				$table.="<td> $data[static_pages_uploaded_by]</td>";
				$table.="<td> $data[static_pages_allow_menu]</td>";
				$table.="<td> $data[static_pages_allowed_footer]</td>";
				$table.="<td> ".date("d-m-Y h:i:s",$data['static_pages_upload_time'])."</td>";
				$table.="<td> <a href='edit_static_page.php?page=$data[static_pages_soft_link]'>Edit</a> | Delete</td>";				
				$table.='</tr>';
			}
			$table.='</tbody>
            </table>
          </div>';
			return $table;
		}
		catch (PDOException $e)
		{
			return $e->getMessage();
		}
	}
}