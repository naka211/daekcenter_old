<?php
/**
 * @version		$Id: dfi_report.php 11400 2010-01-05 08:23:14 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_report
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
 * @subpackage	Dfi_reports
 */
class Dfi_reportHelper
{
	function year_dropdown($name, $value, $options=NULL, $autosubmit=TRUE)
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
		
		$y = date('Y');
		$years = range ($y-10, $y);
		rsort($years);
		foreach ($years as $value2)
		{
			$items[] 	= JHTML::_('select.option',  $value2, '- '. JText::_( $value2 ) .' -' );
		}
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="1"'.($autosubmit?' onchange="document.adminForm.submit( );"':''), 'value', 'text', $value );
	}
	
	function month_dropdown($name, $value, $options=NULL, $autosubmit=TRUE)
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
		
		$months = array ('January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December');
		foreach ($months as $value2)
		{
			$items[] 	= JHTML::_('select.option',  $value2, '- '. JText::_( $value2 ) .' -' );
		}
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="1"'.($autosubmit?' onchange="document.adminForm.submit( );"':''), 'value', 'text', $value );
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
		
		Dfi_reportHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_report_id value, a.dfi_report_id text' .
				' FROM #__dfi_reports a' .
				//' WHERE a.parent=' .$parent.
				' ORDER BY a.dfi_report_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_reportHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_reportHelper::full_paths($o->value, $items);
			}
		}
	}
	
	function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_reports a' .
				' WHERE a.dfi_report_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_report_id;
		if ($r->parent)
			return Dfi_reportHelper::full_path($r->parent).' > '.$name;
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
		$query = 'SELECT a.dfi_report_id' .
				' FROM #__dfi_reports a' .
				' WHERE a.dfi_report_id = '.intval($id);
		$db->setQuery($query);
		$items = $db->loadAssocList();
		foreach ($items as $item)
		{
			$item['selection_state'] = true;
			$json[$item['dfi_report_id']] = $item;
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
			$query = 'DELETE FROM #__dfi_reports' .
				' WHERE dfi_report_id = '.intval($id).' AND dfi_report_id NOT IN ('.implode(',', $cid).')';
			$db->setQuery($query);
			$db->query();
			
			require_once "components/com_dfi_report/tables/dfi_report.php";
			$o = new TableDfi_report($db);
			foreach ($cid as $_id)
			{
				$o->dfi_report_id = 0;
				//$o->dfi_report_id = $_id;
				//$o->dfi_report_id = $id;
				$o->check();
				$o->store();
			}
		} else {
			$query = 'DELETE FROM #__dfi_reports' .
				' WHERE dfi_report_id = '.intval($id);
			$db->setQuery($query);
			$db->query();
		}
	}*/
}