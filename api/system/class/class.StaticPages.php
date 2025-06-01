<?php
class StaticPages 
{
	private $db;
	private $data;
	function __construct($db)
	{
		$this->db=$db;
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
	public function create_page()
	{
		try 
		{
			$statement="Insert Into ".TBL_PREFIX."static_pages (static_pages_name,static_pages_title,static_pages_soft_link,static_pages_description,static_pages_upload_time,static_pages_uploaded_by,static_pages_allowed_footer,static_pages_allow_menu) values(:static_pages_name,:static_pages_title,:static_pages_soft_link,:static_pages_description,:static_pages_upload_time,:static_pages_uploaded_by,:static_pages_allowed_footer,:static_pages_allow_menu)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
				":static_pages_name"=>$this->data['name'],
				":static_pages_title"=>$this->data['title'],
				":static_pages_soft_link"=>$this->generate_soft_link($this->data['name']),
				":static_pages_description"=>$this->data['desc'],
				":static_pages_upload_time"=>time(),
				":static_pages_uploaded_by"=>htmlentities($_SESSION['username']),
				":static_pages_allowed_footer"=>$this->data['footer'],
				":static_pages_allow_menu"=>$this->data['menu']
			));
			return $this->generate_soft_link($this->data['name']);
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	
	public function getPageDetails($id)
	{
		try
		{
			$statement="Select * from ".TBL_PREFIX."static_pages where static_pages_soft_link=:link Limit 1";
			$query=$this->db->prepare($statement);
			$query->execute(array(":link"=>$id));
			return $query->fetch(PDO::FETCH_NAMED);
			
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function generateMainMenu($page=NULL)
	{
		try
		{
			$statement="Select static_pages_name,static_pages_soft_link from ".TBL_PREFIX."static_pages where static_pages_allow_menu=1";
			$query=$this->db->prepare($statement);
			$query->execute();
			$rows= $query->fetchAll(PDO::FETCH_NAMED);
			$mainMenu="";
			foreach ($rows as $data)
			{
				$mainMenu.=($page==$data['static_pages_soft_link']) ? "<li class='active'>": "<li>";
				$mainMenu.="<a href='http://$_SERVER[HTTP_HOST]/kalpit/page/$data[static_pages_soft_link]'>$data[static_pages_name]</a></li>";
			}
			$mainMenu.="";
			return $mainMenu;
		}
		catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function generateFooterMenu()
	{
		try
		{
			$statement="Select static_pages_name,static_pages_soft_link from ".TBL_PREFIX."static_pages where static_pages_allowed_footer=1";
			$query=$this->db->prepare($statement);
			$query->execute();
			$rows= $query->fetchAll(PDO::FETCH_NAMED);
			$footerMenu="<ul class='list-inline'>";
  			foreach ($rows as $data)
			{
			$footerMenu.="<li><a href='http://$_SERVER[HTTP_HOST]/kalpit/page/$data[static_pages_soft_link]'>$data[static_pages_name]</a></li>";
			}
			$footerMenu.="</ul>";
			return $footerMenu;
		}
		catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	public function updatePage($pageid)
	{
		try
		{
			$statement="UPDATE ".TBL_PREFIX."static_pages SET static_pages_name = :static_pages_name, static_pages_title = :static_pages_title , static_pages_soft_link = :static_pages_soft_link, static_pages_description = :static_pages_description, static_pages_allowed_footer = :static_pages_allowed_footer, static_pages_allow_menu = :static_pages_allow_menu  WHERE  static_pages_soft_link = :pageid ";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":static_pages_name"=>$this->data['name'],
					":static_pages_title"=>$this->data['title'],
					":static_pages_soft_link"=>$this->generate_soft_link($this->data['name']),
					":static_pages_description"=>$this->data['desc'],
					":static_pages_allowed_footer"=>$this->data['footer'],
					":static_pages_allow_menu"=>$this->data['menu'],
					":pageid"=>$pageid
			));
			$this->updateEditLog($this->generate_soft_link($this->data['name']));
			return $pageid;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		
	}
	private function updateEditLog($pageid)
	{
		try
		{
			$statement="INSERT INTO ".TBL_PREFIX."static_pages_log (static_pages_log_page_id,static_pages_log_user,	static_pages_log_time) VALUES (:static_pages_log_page_id,:static_pages_log_user,:static_pages_log_time)";
			$query=$this->db->prepare($statement);
			$query->execute(array(
					":static_pages_log_page_id"=>$pageid,
					":static_pages_log_user"=>htmlentities($_SESSION['username']),
					":static_pages_log_time"=>time()
					));
			return true;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
}