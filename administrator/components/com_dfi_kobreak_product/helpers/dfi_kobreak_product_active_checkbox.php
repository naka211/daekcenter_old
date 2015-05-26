<?php
/**
 * @version		$Id: dfi_kobreak_product_active_checkbox.php 11282 2010-04-19 10:27:58 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_kobreak_product
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
 * @subpackage	Dfi_kobreak_products
 */
class Dfi_kobreak_product_active_checkboxHelper
{
	function checkbox_key()
	{
		return 'dfi_product_id'; // editable
	}
	
	function checkbox_fkey()
	{
		return 'dfi_kobreak_id'; // editable
	}
	
	function add($id, $array)
	{
		global $mainframe;		
		$option = 'com_dfi_kobreak_product';
		
		$dfi_campaign_id		= $mainframe->getUserState( $option.'dfi_campaign_id', 0);
		if (!@in_array($dfi_campaign_id, $array))
		{
			return;
		}
				
		$checkbox_id = $mainframe->getUserStateFromRequest( $option.'checkbox_id',		'checkbox_id',		0,				'int' );		
		$checkbox_values = $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array());
		
		$db = &JFactory::getDBO();
		require_once "components/com_dfi_product/tables/dfi_product.php";
		$o = new TableDfi_product($db);
		$o->load($id);
				
		$checkbox_values[$id]['checkbox_state'] = TRUE;
		$checkbox_values[$id]['quantity'] = intval($o->quantity);
		$checkbox_values[$id]['hvidpris'] = $o->hvidpris;
		$checkbox_values[$id]['nettopris'] = $o->nettopris;
		$checkbox_values[$id]['rodpris'] = $o->rodpris;
		$checkbox_values[$id]['nupris'] = $o->nupris;
		
		$mainframe->setUserState( $option.$checkbox_id.'checkbox_values', $checkbox_values);
	}
	
	function load($checkbox_id)
	{
		global $mainframe;
		$option = 'com_dfi_kobreak_product';
		
		$key = 'dfi_kobreak_product_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		$query = 'SELECT b.*,a.dfi_kobreak_id,a.hvidpris price_hvidpris,a.quantity k_quantity,a.nupris price_nupris,a.rodpris price_rodpris,a.nettopris price_nettopris,a.'.$key
				. ' FROM #__dfi_products b' 
				. ' LEFT JOIN #__dfi_kobreak_products a ON a.'.$ckey.'=b.'.$ckey
				. ($checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $checkbox_id):'');
							
		$dfi_campaign_id		= $mainframe->getUserState( $option.'dfi_campaign_id', 0);
		if ($dfi_campaign_id > 0) {
			$query .= ' WHERE b.dfi_product_id IN (SELECT dfi_product_id FROM #__dfi_campaign_to_products WHERE dfi_campaign_id='.((int) $dfi_campaign_id).')';
		}
		
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
				$ckey	=> $row->$ckey,
				'quantity' => $row->k_quantity?$row->k_quantity:$row->quantity,
				'nettopris' => $row->price_nettopris?$row->price_nettopris:$row->nettopris,
				'hvidpris' => $row->price_hvidpris?$row->price_hvidpris:$row->hvidpris,
				'rodpris' => $row->price_rodpris?$row->price_rodpris:$row->rodpris,
				'nupris' => $row->price_nupris?$row->price_rodpris:$row->rodpris
											);
		}
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
		$option = 'com_dfi_kobreak_product';
		
		$checkbox_id		= $mainframe->getUserState( $option.'checkbox_id', 0 );
		$checkbox_values	= $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array() );
		
		$cid = array();
		foreach ($checkbox_values as $k=>$x)
		{
			if ($x['checkbox_state']) 
				$cid[] = $k;
		}
		
		$key = 'dfi_kobreak_product_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_kobreak_products' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_kobreak_product/tables/dfi_kobreak_product.php";
			$o = new TableDfi_kobreak_product($db);
			$key = 'dfi_kobreak_product_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->quantity = $checkbox_values[$_id]['quantity'];
				$o->nettopris = $checkbox_values[$_id]['nettopris'];
				$o->hvidpris = $checkbox_values[$_id]['hvidpris'];
				$o->rodpris = $checkbox_values[$_id]['rodpris'];
				$o->nupris = $checkbox_values[$_id]['nupris'];
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_kobreak_products' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}
}