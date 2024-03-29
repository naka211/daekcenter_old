<?php
/**
 * @version		$Id: dfi_campaign_to_product.php 13431 2010-06-22 15:50:50 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_campaign_to_product
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
 * @subpackage	Dfi_campaign_to_products
 */
class Dfi_campaign_to_productHelper
{
	function save_campaigns($id, $cid)
	{
		$db = &JFactory::getDBO();
		$fkey = 'dfi_product_id';
		$ckey = 'dfi_campaign_id';
		
		if ($cid && count($cid))
		{
			$query = 'DELETE FROM #__dfi_campaign_to_products' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_campaign_to_product/tables/dfi_campaign_to_product.php";
			$o = new TableDfi_campaign_to_product($db);
			$key = 'dfi_campaign_to_product_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_campaign_to_products' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}	
	}
	
	function campaigns_dropdown($name, $pid, $size=10, $extra='multiple')
	{
		$db = &JFactory::getDBO();
		
		$items = array();		
		$sql = "SELECT dfi_campaign_id value,`name` text FROM #__dfi_campaigns ORDER BY ordering";
		$db->setQuery($sql);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				$items[] = $o;
			}
		}
		
		$values = array();
		$sql = "SELECT dfi_campaign_id FROM #__dfi_campaign_to_products WHERE dfi_product_id=".$pid;
		$db->setQuery($sql);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				$values[] = $o->dfi_campaign_id;
			}
		}
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($extra?' '.$extra:''), 'value', 'text', $values );
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
		
		Dfi_campaign_to_productHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_campaign_to_product_id value, a.dfi_campaign_to_product_id text' .
				' FROM #__dfi_campaign_to_products a' .
				//' WHERE a.dfi_campaign_to_product_id!=a.parent AND a.parent=' .$parent.
				' ORDER BY a.dfi_campaign_to_product_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_campaign_to_productHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_campaign_to_productHelper::full_paths($o->value, $items);
			}
		}
	}
	
	/*function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_campaign_to_products a' .
				' WHERE a.dfi_campaign_to_product_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_campaign_to_product_id;
		if ($r->parent)
			return Dfi_campaign_to_productHelper::full_path($r->parent).' > '.$name;
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