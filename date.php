<?php 
	
	
class Date{

	var $days 	= array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'saturday', 'Sunday');
	var $months = array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December' );

	function getAll($year){
		$r = array();
		$date = strtotime($year. '-01-01');
		
		while(date('Y', $date) <= $year){
			$y = date('Y', $date);
			$m = date('n', $date);
			$d = date('j', $date);
			$w = str_replace('0', '7', date('w', $date));
			$r[$y][$m][$d] = $w;
			$date = strtotime(date('Y-m-d',$date) . ' +1 DAY');
		}
		return $r;

	}

	function getEvents($year){
		
	}
}