<?php
/**
 * @version		$Id: dfi_review_product_active_checkbox.php 25002 2010-09-18 07:07:43 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_review_product
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
 * @subpackage	Dfi_review_products
 */
class Dfi_review_product_active_checkboxHelper
{
	function checkbox_key()
	{
		return 'dfi_product_id'; // editable
	}
	
	function checkbox_fkey()
	{
		return 'dfi_campaign_id'; // editable
	}
	
	function load($checkbox_id)
	{
		$key = 'dfi_review_product_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		$query = 'SELECT b.*,a.'.$key.',a.'.$fkey
				. ' FROM #__dfi_products b' 
				. ' LEFT JOIN #__dfi_review_products a ON a.'.$ckey.'=b.'.$ckey
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
		$option = 'com_dfi_review_product';
		$mainframe->setUserState( $option.'checkbox_id', $checkbox_id );
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
		$option = 'com_dfi_review_product';
		
		$checkbox_id		= $mainframe->getUserState( $option.'checkbox_id', 0 );
		$checkbox_values	= $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array() );
		
		$cid = array();
		foreach ($checkbox_values as $k=>$x)
		{
			if ($x['checkbox_state']) 
				$cid[] = $k;
		}
		
		$key = 'dfi_review_product_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_review_products' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_review_product/tables/dfi_review_product.php";
			$o = new TableDfi_review_product($db);
			$key = 'dfi_review_product_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_review_products' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}
}