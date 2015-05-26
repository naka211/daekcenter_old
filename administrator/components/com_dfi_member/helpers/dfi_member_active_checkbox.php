<?php
/**
 * @version		$Id: dfi_member_active_checkbox.php 5370 2010-04-22 17:46:06 ngo.bieu@mwc.vn $
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
class Dfi_member_active_checkboxHelper
{
	function checkbox_key()
	{
		return 'user_id'; // editable
	}
	
	function checkbox_fkey()
	{
		return 'dfi_shop_id'; // editable
	}
	
	function load($checkbox_id)
	{
		$key = 'dfi_member_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		$query = 'SELECT b.*,a.role,a.dfi_shop_id,a.'.$key
				. ' FROM #__users b' 
				. ' LEFT JOIN #__dfi_members a ON a.'.$ckey.'=b.id'
				. ($checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $checkbox_id):'')
				. ' WHERE b.id NOT IN (SELECT cc.id FROM #__users cc JOIN #__dfi_members ccc ON ccc.user_id=cc.id AND ccc.dfi_shop_id != '.$checkbox_id.')';
		
		$db = &JFactory::getDBO();
		$db->setQuery($query);
		$data = $db->loadObjectList();
		
		$checkbox_values = array();
		$state = false;
		foreach ($data as $i=>$row)
		{
			if (!$state && !empty($row->id) && $checkbox_id)
			{
				$state = true;
			}
			
			$checkbox_values[$row->id] = array(
				'checkbox_state' => !empty($row->$key) && $checkbox_id,
				$key	=> $row->$key,
				$fkey	=> $row->$fkey,
				$ckey	=> $row->id,
				'role'	=> $row->role
											);
		}
		
		global $mainframe;
		$option = 'com_dfi_member';
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
		$option = 'com_dfi_member';
		
		$checkbox_id		= $mainframe->getUserState( $option.'checkbox_id', 0 );
		$checkbox_values	= $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array() );
		
		$cid = array();
		foreach ($checkbox_values as $k=>$x)
		{
			if ($x['checkbox_state']) 
				$cid[] = $k;
		}
		
		$key = 'dfi_member_id';
		$fkey = self::checkbox_fkey();
		$ckey = self::checkbox_key();
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_members' .
				' WHERE '.$fkey.' = '.intval($id).' AND '.$ckey.' NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_member/tables/dfi_member.php";
			$o = new TableDfi_member($db);
			$key = 'dfi_member_id';
			foreach ($cid as $_id)
			{
				$o->$key = 0; //$checkbox_values[$_id][$key];
				$o->$fkey = $id;
				$o->$ckey = $_id;
				$o->role = $checkbox_values[$_id]['role'];
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_members' .
				' WHERE '.$fkey.' = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}
}