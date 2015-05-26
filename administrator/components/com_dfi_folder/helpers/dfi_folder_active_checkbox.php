<?php
/**
 * @version		$Id: dfi_folder_active_checkbox.php 28643 2010-04-19 10:37:17 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_folder
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
 * @subpackage	Dfi_folders
 */
class Dfi_folder_active_checkboxHelper
{
	function checkbox_key()
	{
		return 'dfi_order_product_id'; // editable
	}
	
	function checkbox_fkey()
	{
		return 'dfi_campaign_id'; // editable
	}
	
	function load($checkbox_id)
	{
		$key = 'dfi_order_product_folder_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		$query = 'SELECT b.'.$ckey.',d.*,ccc.dfi_campaign_id,cc.company_name,c.sent order_date,ccc.name kobreak_name,a.'.$key
				. ' FROM #__dfi_order_products b' 
				. ' JOIN #__dfi_orders c ON c.dfi_order_id=b.dfi_order_id'
				. ' JOIN #__dfi_shops cc ON cc.dfi_shop_id=c.dfi_shop_id'
				. ' JOIN #__dfi_kobreaks ccc ON ccc.dfi_kobreak_id=c.dfi_kobreak_id'
				. ' JOIN #__dfi_campaigns cccc ON cccc.dfi_campaign_id=ccc.dfi_campaign_id'
				. ' JOIN #__dfi_products d ON d.dfi_product_id=b.dfi_product_id'
				. ' LEFT JOIN #__dfi_order_product_folders a ON a.'.$ckey.'=b.'.$ckey
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
		}
		
		global $mainframe;
		$option = 'com_dfi_folder';
		$mainframe->setUserState( $option.'checkbox_id', $checkbox_id);
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
		$option = 'com_dfi_folder';
		
		$checkbox_id		= $mainframe->getUserState( $option.'checkbox_id', 0 );
		$checkbox_values	= $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array() );
		
		$cid = array();
		foreach ($checkbox_values as $k=>$x)
		{
			if ($x['checkbox_state']) 
				$cid[] = $k;
		}
		
		$key = 'dfi_order_product_folder_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_order_product_folders' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_folder/tables/dfi_folder.php";
			$o = new TableDfi_folder($db);
			$key = 'dfi_order_product_folder_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_order_product_folders' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}
}