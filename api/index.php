<?php 
//Gzip or compress the out put that will be sent to the client..
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
session_start();


$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
/*
 *---------------------------------------------------------------
 * Some Project related Variables.
 *---------------------------------------------------------------
 */
$linklocation=($_SERVER['SERVER_PORT']==8888)?'/gaurav':'/transwise-client-app';

define('PROJECT', 'Transwise');
define('CSS','

	 <!-- Le styles -->
      <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="'.$linklocation.'/assets/css/font-awesome.min.css">
      <!--[if IE 7]>
      <link rel="stylesheet" href="'.$linklocation.'/assets/css/font-awesome-ie7.min.css">
      <![endif]-->

      <link href="'.$linklocation.'/assets/css/bootplus.css" rel="stylesheet">
      <link href="'.$linklocation.'/assets/css/bootplus-responsive.css" rel="stylesheet">

      <link href="'.$linklocation.'/assets/css/docs.css" rel="stylesheet">
      <link href="'.$linklocation.'/assets/js/google-code-prettify/prettify_css.css" rel="stylesheet">
       <link rel="shortcut icon" href="'.$linklocation.'/favicon.ico">
       
');
define('FOOTER','
	 
	 <footer class="footer">
	<div class="container">
	<p class="pull-right">
	<a href="#">Back to top</a></p>
    <p>&copy; 2014 Vikram. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </div>
    </footer>
    ');

/*
 *---------------------------------------------------------------
* APPLICATION ENVIRONMENT
*---------------------------------------------------------------
* This can be set to anything, but default usage is:
*
*     development
*     testing
*     production
*
* NOTE: If you change these, also change the error_reporting() code below
*
*/
define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
* ERROR REPORTING
*---------------------------------------------------------------
*
* Different environments will require different levels of error reporting.
* By default development will show errors but testing and live will hide them.
*/

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			@ini_set( 'error_reporting', E_ALL);
			break;

		case 'testing':
		case 'production':
			@ini_set( 'error_reporting', 0);
			break;

		default:
			exit('The application environment is not set correctly.');
	}
}



/*
*---------------------------------------------------------------
* SYSTEM FOLDER SETUP
*---------------------------------------------------------------
*/
$system_path= 'system';
// Set the current directory correctly for CLI requests
if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).'/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';

// Is the system path correct?
if ( ! is_dir($system_path))
{
	exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}
// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));
// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

/*
*---------------------------------------------------------------
* APPLICATION FOLDER SETUP
*---------------------------------------------------------------
*/
$application_folder= 'application';
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
// The path to the "application" folder
define('FILE',dirname(__FILE__).'/');
if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.'/');
}
else
{
	if ( ! is_dir(BASEPATH.$application_folder.'/'))
	{
		exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}

	define('APPPATH', BASEPATH.$application_folder.'/');
}

// this global constant is deprecated.
define('EXT', '.php');

/*
 * ----------------------------------------
 * PROCESSING STARTS HERE
 * ----------------------------------------
 * 
 */
 // Set the Error log directory so that we can keep track of errors of our website.
@ini_set('log_errors', 1);
@ini_set('error_log', BASEPATH.'errorlogs/php-errors.txt'); /* path to server-writable log file */
//Call the Page Processor
require_once BASEPATH.'core/processor.php';
//echo APPPATH.'carousel.html' ;
//require_once APPPATH.'carousel.html';
/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo '<div class="hidden-print" style="font-size:10px">Page generated in '.$total_time.' seconds.</div>';
?>