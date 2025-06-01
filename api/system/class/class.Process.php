<?php 
class ProcessForm
{
	static function gettimestamp($time)
	{
		list($day, $month, $year) = explode('/', $time);
		return mktime(0, 0, 0, $month, $day, $year);
	}
}