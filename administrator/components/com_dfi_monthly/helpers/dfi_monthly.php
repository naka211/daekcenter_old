<?php
/**
 * @version		$Id: dfi_shop.php 13121 2009-12-30 15:43:55 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_shop
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
 * @subpackage	Dfi_shops
 */
class Dfi_monthlyHelper
{
	function butiksnr_dropdown($name, $value)
	{
		$db = &JFactory::getDBO();
		
		$items = array();
		$items[] 	= JHTML::_('select.option',  '', '- '. JText::_( 'Select a butiksnr state' ) .' -' );
		$items[] 	= JHTML::_('select.option',  '1', '- '. JText::_( 'Old' ) .' -' );
		$items[] 	= JHTML::_('select.option',  '2', '- '. JText::_( 'New' ) .' -' );
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="1"  onchange="document.adminForm.submit( );"', 'value', 'text', $value );
	}
	
	
	function butiksnr_dropdown_tuyen($name, $value, $options=NULL, $autosubmit=TRUE, $size=1, $extra='')
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
		
		#Dfi_shopHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
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
		
		Dfi_shopHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_shop_id value, CONCAT(a.company_name, ", Butiksnr. ", a.butiksnr) text' .
				' FROM #__dfi_shops a' .
				//' WHERE a.parent=' .$parent.
				' ORDER BY a.company_name';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_shopHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_shopHelper::full_paths($o->value, $items);
			}
		}
	}
	
	function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_shops a' .
				' WHERE a.dfi_shop_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_shop_id;
		if ($r->parent)
			return Dfi_shopHelper::full_path($r->parent).' > '.$name;
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
		$query = 'SELECT a.dfi_shop_id' .
				' FROM #__dfi_shops a' .
				' WHERE a.dfi_shop_id = '.intval($id);
		$db->setQuery($query);
		$items = $db->loadObjectList();
		foreach ($items as $item)
		{
			$json[] = '"'.$item->dfi_shop_id.'":true';
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
			$query = 'DELETE FROM #__dfi_shops' .
				' WHERE dfi_shop_id = '.intval($id).' AND dfi_shop_id NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_shop/tables/dfi_shop.php";
			$o = new TableDfi_shop($db);
			foreach ($cid as $_id)
			{
				$o->dfi_shop_id = 0;
				//$o->dfi_shop_id = $_id;
				//$o->dfi_shop_id = $id;
				if ($o->check())
					$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_shops' .
				' WHERE dfi_shop_id = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}*/
}