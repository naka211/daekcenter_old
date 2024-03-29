<?php
/**
 * @version		$Id: dfi_member.php 5370 2010-04-22 17:46:06 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_member
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

jimport( '3rdparty.json.helper' );

/**
 * @package		Joomla
 * @subpackage	Dfi_members
 */
class Dfi_memberHelper
{
	function dropdown($name, $value, $options=NULL, $autosubmit=TRUE, $size=1, $extra='')
	{
		$db = &JFactory::getDBO();
		
		$items = array();
		if ($options)
		{
			foreach ($options as $option)
			{				
				$items[] 	= JHTML::_('select.option',  $option['value'], '- '. JText::_( $option['text'] ) .' -' );
			}
		}
		
		Dfi_memberHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_member_id value, a.dfi_member_id text' .
				' FROM #__dfi_members a' .
				//' WHERE a.parent=' .$parent.
				' ORDER BY a.dfi_member_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_memberHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_memberHelper::full_paths($o->value, $items);
			}
		}
	}
	
	/*function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_members a' .
				' WHERE a.dfi_member_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_member_id;
		if ($r->parent)
			return Dfi_memberHelper::full_path($r->parent).' > '.$name;
		else
			return $name;
	}*/
	
	function print_params($object, $params)
	{
		foreach ($object->toArray() as $k=>$v)
		{
			$object->set($k, '');
		}
		$object->loadINI($params);
		foreach ($object->toArray() as $k=>$v)
		{
			//$groups = $object->getGroups();
			//foreach ($groups as $group=>$n)
			//{
			//	$arr = $object->getParams($k, $group);
			//}
			if ($v)
				echo '<b>'.JText::_(strtoupper($k)).'</b>: '.$v."<br />";	
		}
	}
	
	/*function active_button($state, $cb)
	{
		if ($state)
			return '<a href="javascript:void(0);" onclick="return listItemTask(\''.$cb.'\',\'unpublish\')" title="Unpublish Item">
		<img src="images/tick.png" border="0" alt="Published" /></a>';
		else
			return '<a href="javascript:void(0);" onclick="return listItemTask(\''.$cb.'\',\'publish\')" title="Publish Item">
		<img src="images/publish_x.png" border="0" alt="Unpublished" /></a>';
	}*/
}