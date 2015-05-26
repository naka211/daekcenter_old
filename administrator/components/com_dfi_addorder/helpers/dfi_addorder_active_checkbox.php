<?php
/**
 * @version		$Id: dfi_distribution_rate_active_checkbox.php 31085 2010-06-15 17:00:45 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_distribution_rate
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
 * @subpackage	Dfi_distribution_rates
 */
class Dfi_addorder_active_checkboxHelper
{
	function checkbox_key()
	{
		return 'dfi_kobeark_product_id'; // editable
	}	
	
	function checkbox_fkey()
	{
		return 'dfi_shop_id'; // editable
	}
	
	function load($checkbox_id)
	{
		$key = 'dfi_distribution_rate_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		$query = 'SELECT b.*,c.dfi_kobreak_product_id '.$ckey.',a.dfi_shop_id,a.rate,a.'.$key
				. ' FROM #__dfi_products b'
				. ' LEFT JOIN #__dfi_kobreak_products c ON c.dfi_product_id=b.dfi_product_id' 
				. ' LEFT JOIN #__dfi_distribution_rates a ON a.'.$ckey.'=c.dfi_kobreak_product_id'
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
				'rate'	=> $row->rate,
				$fkey	=> $row->$fkey,
				$ckey	=> $row->$ckey
											);
		}
		
		global $mainframe;
		$option = 'com_dfi_distribution_rate';
		$mainframe->setUserState( $option.$checkbox_id.'checkbox_values', $checkbox_values);		
		if ($state)
			$mainframe->setUserState( $option.'filter_state', 'P' );
		else
			$mainframe->setUserState( $option.'filter_state', '' );
	}
	
	function store($id)
	{
		$db = &JFactory::getDBO();
		
		global $mainframe;
		$option = 'com_dfi_distribution_rate';
		
		$checkbox_id		= $mainframe->getUserState( $option.'checkbox_id', 0 );
		$checkbox_values	= $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array() );

		$cid = array();
		foreach ($checkbox_values as $k=>$x)
		{
			if ($x['checkbox_state']) 
				$cid[] = $k;
		}
		
		$key = 'dfi_distribution_rate_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_distribution_rates' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_distribution_rate/tables/dfi_distribution_rate.php";
			$o = new TableDfi_distribution_rate($db);
			$key = 'dfi_distribution_rate_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->rate = $checkbox_values[$_id]['rate'];
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_distribution_rates' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}
}