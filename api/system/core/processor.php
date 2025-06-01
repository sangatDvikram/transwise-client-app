<?php
/**
* Database Setup
*/

require_once SYSDIR.'/database/db.php';


//load classes as needed
function __autoload($class)
{
	 
	$class = $class;

	//if call from within assets adjust the path
	$classpath = SYSDIR.'/class/class.'.$class . '.php';
	if ( file_exists($classpath)) {
		require_once $classpath;
	}

}

/*
 * ------------------------------
 * PROCESS THE REQEUT URI's
 * ------------------------------
 */
	$_request=array();

	
		$split=explode('?', urldecode($_SERVER["REQUEST_URI"]));
		if (count($split)>1)
		 {
			$paterns=explode('&',$split[1]);
			foreach ($paterns as $value) {
				$value=explode('=', $value);
				$_request["$value[0]"]=(count($value)==2)? $value[1] : '';
			}
		}

/*
 * ------------------------------
 * Page Processing
 * ------------------------------
 * When no request is sent we simple show the index.php in Application folder.
 */
if(isset($_REQUEST['parameters']))
{

	

/*PROCESING THE URL*/

	$parameters = $_REQUEST['parameters'];
	$parameters = explode('/', $parameters);
	$parametersCount=count($parameters);
/*
Count = 1

1. param count 1 meacs it can be some folder or some file name 
so if its folder open index.php in that folder or its only file name then open the file name . 

Count = 2

1. Check if its folder thn if it is thn chk send param that if it has filename with that 2nd param if it is thn open it .



*/
	
/* IF The first parameter is directory then go and one the directory  */ 
if (is_dir(APPPATH.$parameters[0]))
{
	if ($parametersCount>1)
	{
			if (file_exists(APPPATH.$parameters[0].'/'.$parameters[1].EXT))
			{
				if ($parametersCount>2)
				{
					for ($i=2; $i<$parametersCount ; $i++) { 
						$_request["parameter".($i-1).""]=$parameters[$i];
					}
				}
			require_once APPPATH.$parameters[0].'/'.$parameters[1].EXT;
			}
			else
			{
			require_once APPPATH.'errors/404.php';
			}
	}
	
	else
	{
		if (file_exists(APPPATH.$parameters[0].'/index'.EXT))
		{
			require_once APPPATH.$parameters[0].'/index'.EXT;
		}
		else
		{
			require_once APPPATH.'errors/404.php';
		}
	}
}
else{
	$path=APPPATH.$parameters[0].EXT;

	if (file_exists($path))
	{	if ($parametersCount>1)
		{
			for ($i=1; $i<$parametersCount ; $i++) { 
				$_request["parameter".$i.""]=$parameters[$i];
			}
		}
		require_once $path;
	}
	else
	{
		require_once APPPATH.'errors/404.php';
	}
 }
}
else
{
	$file='index'.EXT;
	if (file_exists(APPPATH.$file))
	{
		require_once APPPATH.$file;
	}
	else
	{
		require_once APPPATH.'errors/404.php';
	}
	
}

?>