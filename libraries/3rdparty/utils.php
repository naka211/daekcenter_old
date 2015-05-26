<?php

function date_dk($str)
{
	$search = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$replace = array("Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "Lørdag", "Søndag");
	
	$str = str_replace($search, $replace, $str);
	
	$search = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$replace = array("Januar", "Februar", "Marts", "April", "May", "juni", "Juli", "August", "September", "Oktober", "November", "December");
	
	$str = str_replace($search, $replace, $str);
	
	return $str;
}

function short_text($str, $len=200)
{
	$str2 = html_entity_decode($str);
	if (strlen($str2) <= $len)
		return $str;
	else
		return htmlentities(substr($str2, 0, $len-3)).'...';
}

?>