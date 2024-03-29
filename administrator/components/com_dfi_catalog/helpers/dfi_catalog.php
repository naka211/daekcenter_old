<?php
/**
 * @version		$Id: dfi_catalog.php 11397 2009-12-31 15:29:10 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_catalog
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
 * @subpackage	Dfi_catalogs
 */
class Dfi_catalogHelper
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
		
		Dfi_catalogHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_catalog_id value, a.dfi_catalog_id text' .
				' FROM #__dfi_catalogs a' .
				//' WHERE a.parent=' .$parent.
				' ORDER BY a.dfi_catalog_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_catalogHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_catalogHelper::full_paths($o->value, $items);
			}
		}
	}
	
	function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_catalogs a' .
				' WHERE a.dfi_catalog_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_catalog_id;
		if ($r->parent)
			return Dfi_catalogHelper::full_path($r->parent).' > '.$name;
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
		$query = 'SELECT a.dfi_catalog_id' .
				' FROM #__dfi_catalogs a' .
				' WHERE a.dfi_catalog_id = '.intval($id);
		$db->setQuery($query);
		$items = $db->loadObjectList();
		foreach ($items as $item)
		{
			$json[] = '"'.$item->dfi_catalog_id.'":true';
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
			$query = 'DELETE FROM #__dfi_catalogs' .
				' WHERE dfi_catalog_id = '.intval($id).' AND dfi_catalog_id NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_catalog/tables/dfi_catalog.php";
			$o = new TableDfi_catalog($db);
			foreach ($cid as $_id)
			{
				$o->dfi_catalog_id = 0;
				//$o->dfi_catalog_id = $_id;
				//$o->dfi_catalog_id = $id;
				if ($o->check())
					$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_catalogs' .
				' WHERE dfi_catalog_id = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}*/
}