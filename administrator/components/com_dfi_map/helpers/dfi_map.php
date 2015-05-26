<?php
/**
 * @version		$Id: dfi_map.php 10970 2009-12-31 16:31:24 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_map
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */


/**
 * @package		Joomla
 * @subpackage	Dfi_maps
 */
class Dfi_mapHelper
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
		
		Dfi_mapHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_map_id value, a.dfi_map_id text' .
				' FROM #__dfi_maps a' .
				//' WHERE a.parent=' .$parent.
				' ORDER BY a.dfi_map_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_mapHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_mapHelper::full_paths($o->value, $items);
			}
		}
	}
	
	function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_maps a' .
				' WHERE a.dfi_map_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_map_id;
		if ($r->parent)
			return Dfi_mapHelper::full_path($r->parent).' > '.$name;
		else
			return $name;
	}
	
	/*function selection_dropdown($name, $value)
	{
		$_items = array();
		$_items[] 	= JHTML::_('select.option',  '', '- '. JText::_( strtoupper('Select Selection') ) .' -' );
		$_items[] 	= JHTML::_('select.option',  'S', JText::_( strtoupper('Selected') ) );
		$_items[] 	= JHTML::_('select.option',  'U', JText::_( strtoupper('Unselected') ) );

		return JHTML::_('select.genericlist',   $_items, $name, 'class="inputbox" size="1" onchange="submitform();"', 'value', 'text', $value );
	}
	
	function selection($id)
	{
		$db = &JFactory::getDBO();
		
		$json = array();
		$query = 'SELECT a.dfi_map_id' .
				' FROM #__dfi_maps a' .
				' WHERE a.dfi_map_id = '.intval($id);
		$db->setQuery($query);
		$items = $db->loadObjectList();
		foreach ($items as $item)
		{
			$json[] = '"'.$item->dfi_map_id.'":true';
		}
		
		return "{".implode(",", $json)."}";
	}
	
	function storeSelection($option, $id)
	{
		$db = &JFactory::getDBO();
		
		global $mainframe;
		$json = $mainframe->getUserState( $option.'selection' );
		$selection = json_decode($json);
		
		$cid = array();
		foreach ($selection as $k=>$v)
		{
			if ($v) $cid[] = $k;
		}
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_maps' .
				' WHERE dfi_map_id = '.intval($id).' AND dfi_map_id NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_map/tables/dfi_map.php";
			$o = new TableDfi_map($db);
			foreach ($cid as $_id)
			{
				$o->dfi_map_id = 0;
				//$o->dfi_map_id = $_id;
				//$o->dfi_map_id = $id;
				if ($o->check())
					$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_maps' .
				' WHERE dfi_map_id = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}*/
}