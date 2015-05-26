<?php
/**
 * @version		$Id: dfi_order_active_checkbox.php 26172 2010-05-21 17:30:33 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_order
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
 * @subpackage	Dfi_orders
 */
class Dfi_order_active_checkboxHelper
{
	function checkbox_key()
	{
		return 'dfi_order_id'; // editable
	}
	
	function checkbox_fkey()
	{
		return 'dfi_kobreak_id'; // editable
	}
	
	function load($checkbox_id)
	{
		$key = 'dfi_order_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		/*$query = 'SELECT b.*,a.'.$key
				. ' FROM #__ b' 
				. ' LEFT JOIN #__dfi_orders a ON a.'.$ckey.'=b.'.$ckey
				. ($checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $checkbox_id):'');
		
		$db = &JFactory::getDBO();
		$db->setQuery($query);
		$data = $db->loadObjectList();
		
		$checkbox_values = array();
		$state = false;
		foreach ($data as $i=>$row)
		{
			if (!$state && !empty($row->$key) && $checkbox_id)
			{
				$state = true;
			}
			
			$checkbox_values[$row->$ckey] = array(
				'checkbox_state' => !empty($row->$key) && $checkbox_id,
				$key	=> $row->$key,
				$fkey	=> $row->$fkey,
				$ckey	=> $row->$ckey
											);
		}*/
		
		global $mainframe;
		$option = 'com_dfi_order';
		$mainframe->setUserState( $option.'checkbox_id', $checkbox_id );
		/*$mainframe->setUserState( $option.$checkbox_id.'checkbox_values', $checkbox_values);		
		if ($state)
			$mainframe->setUserState( $option.'filter_state', 'P' );
		else
			$mainframe->setUserState( $option.'filter_state', '' );*/
	}
	
	function store($id)
	{
		$db = &JFactory::getDBO();
		
		global $mainframe;
		$option = 'com_dfi_order';
		
		$checkbox_id		= $mainframe->getUserState( $option.'checkbox_id', 0 );
		$checkbox_values	= $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array() );
		
		$cid = array();
		foreach ($checkbox_values as $k=>$x)
		{
			if ($x['checkbox_state']) 
				$cid[] = $k;
		}
		
		$key = 'dfi_order_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_orders' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_order/tables/dfi_order.php";
			$o = new TableDfi_order($db);
			$key = 'dfi_order_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_orders' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}
	
	
	function list_dropdown_tuyen($name, $value, $options=NULL, $autosubmit=TRUE, $size=1, $extra='')
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
	
}