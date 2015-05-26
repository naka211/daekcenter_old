<?php

class ProjectHelper
{	
	function getUserID()
	{
		$user =& JFactory::getUser();
		return $user->get('id');
	}
	
	function isFrontPage()
	{
		$menu = & JSite::getMenu();
		/*if ($menu->getActive() == $menu->getDefault()) 
		{
			return true;
		}*/
		return self::uri_string()==$menu->getDefault()->link;
	}
	
	function base_url()
	{
		$uri =& JFactory::getURI();
		return $uri->base(true).'/';
	}
	
	function index_php()
	{
		$uri =& JFactory::getURI();
		$x = str_replace(self::base_url(), '', $uri->getPath());
		if (!$x) return 'index.php';
		return $x;
	}
	
	function uri_string()
	{
		$uri =& JFactory::getURI();
		$x = $uri->getQuery();
		if ($x)
			return self::index_php().'?'.$x;
		return self::defaultURI();
	}
	
	function site_url($query)
	{
		return self::base_url().self::index_php().'?'.$query;
	}	
	
	function defaultURI()
	{
		$menu = & JSite::getMenu();
		$o = $menu->getDefault();
		return $o->link;
	}
	
	function linkToArray($uri)
	{
		$uri_a = array();
		$uri_x = split('&amp;', $uri);
		foreach ($uri_x as $x)
		{
			$b = split('&', $x);
			$uri_a = array_merge($uri_a, $b);
		}
		$result = array();
		foreach ($uri_a as $v)
		{
			$k = split('=', $v);
			$result[@$k[0]] = @$k[1];
		}
		ksort($result);
		return $result;
	}
	
	function isActiveLink($link, $ignored=array())
	{
		$uri = self::uri_string();			
		$uri_a = self::linkToArray($uri);			
		$link_a = self::linkToArray($link);						
		foreach ($ignored as $k)
		{
			if (isset($link_a[$k]))
			{
				unset($link_a[$k]);
			}	
			
			if (isset($uri_a[$k]))
			{
				unset($uri_a[$k]);
			}				
		}			
		return $uri_a == $link_a;
	}	
}

?>