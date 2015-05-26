<?php

function ws_price_format($nb)
{
	$res = "";
	$s = strval($nb*10);
	if (!$s[strlen($s)-1])
	{
		// int
		$res=number_format($nb, 2, ',', '.')."";
	} else {
		// float
		$res=number_format($nb, 2, ',', '.');
	}
	return($res);
}

function ws_comma_to_dot($price)
{
	return str_replace(",", ".", strval($price));
}

function ws_dot_to_comma($price)
{
	return str_replace(".", ",", strval($price));
}

?>