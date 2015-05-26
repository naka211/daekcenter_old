<?php
/**
 * @version		$Id: dfi_supplier.php 26210 2010-03-13 09:09:10 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_supplier
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
 * @subpackage	Dfi_suppliers
 */
class Dfi_supplierHelper
{	
	function first_supplier($id=0)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.payment_terms' .
				' FROM #__dfi_suppliers a' .
				($id?(' WHERE a.dfi_supplier_id='.$id):'') .
				' ORDER BY a.name LIMIT 0,1';
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	function getContact_name($id)
	{
		$db = &JFactory::getDBO();

		$sql = 'SELECT name FROM #__contact_details'
		. ' WHERE id IN ( '.$id.' )'
		;
		$db->setQuery( $sql );
		return $db->loadResult();
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
		
		Dfi_supplierHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_supplier_id value, a.name text' .
				' FROM #__dfi_suppliers a' .
				//' WHERE a.parent=' .$parent.
				' ORDER BY a.name';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_supplierHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_supplierHelper::full_paths($o->value, $items);
			}
		}
	}
	
	function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_suppliers a' .
				' WHERE a.dfi_supplier_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_supplier_id;
		if ($r->parent)
			return Dfi_supplierHelper::full_path($r->parent).' > '.$name;
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
		$query = 'SELECT a.dfi_supplier_id' .
				' FROM #__dfi_suppliers a' .
				' WHERE a.dfi_supplier_id = '.intval($id);
		$db->setQuery($query);
		$items = $db->loadAssocList();
		if ($items)
		foreach ($items as $item)
		{
			$item['selection_state'] = true;
			$json[$item['dfi_supplier_id']] = $item;
		}
		
		return json_encode(count($items)?$json:array(''=>''));
	}
	
	function storeSelection($option, $id)
	{
		$db = &JFactory::getDBO();
		
		global $mainframe;
		$json = $mainframe->getUserState( $option.'selection' );
		$selection = json_decode($json, true);
		
		$cid = array();
		foreach ($selection as $k=>$v)
			if ($v['selection_state']) $cid[] = $k;
		
		if (count($cid))
		{
			$query = 'DELETE FROM #__dfi_suppliers' .
				' WHERE dfi_supplier_id = '.intval($id).' AND dfi_supplier_id NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_supplier/tables/dfi_supplier.php";
			$o = new TableDfi_supplier($db);
			foreach ($cid as $_id)
			{
				$o->dfi_supplier_id = 0;
				//$o->dfi_supplier_id = $_id;
				//$o->dfi_supplier_id = $id;
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_suppliers' .
				' WHERE dfi_supplier_id = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}*/
}