<?php
/**
 * @version		$Id: dfi_kobreak.php 3997 2010-04-19 10:27:45 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_kobreak
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
 * @subpackage	Dfi_kobreaks
 */
class Dfi_kobreakHelper
{
	function first_kobeark()
	{
		$db = &JFactory::getDBO();
		
		$sql = "SELECT dfi_kobreak_id FROM #__dfi_kobreaks ORDER BY dfi_kobreak_id DESC LIMIT 0,1";
		$db->setQuery( $sql );
		return $db->loadResult();
	}
	
	function status_dropdown($name, $value, $options=NULL, $autosubmit=TRUE, $size=1, $extra='')
	{
		$db = &JFactory::getDBO();
		
        $sql = "SELECT * FROM #__dfi_order_statuses ORDER BY dfi_order_status_id ASC";
		$db->setQuery( $sql );
        $temp = $db->loadObjectList();
        
		$items = array();

        #$items[] 	= JHTML::_('select.option', '', '- Select Status -' );
        if($temp){
            foreach ($temp as $row){
                $items[] 	= JHTML::_('select.option',  $row->dfi_order_status_id, '- '.$row->name.' -' );
            }
        }
        
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
		
		Dfi_kobreakHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_kobreak_id value, CONCAT(b.name,\' > \',a.name) text' .
				' FROM #__dfi_kobreaks a' .
				' LEFT JOIN #__dfi_campaigns b ON b.dfi_campaign_id=a.dfi_campaign_id' .
				//' WHERE a.parent=' .$parent.
                ' WHERE a.published=1 ' .
				' ORDER BY b.dfi_campaign_id,a.dfi_kobreak_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_kobreakHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_kobreakHelper::full_paths($o->value, $items);
			}
		}
	}
	
	/*function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_kobreaks a' .
				' WHERE a.dfi_kobreak_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_kobreak_id;
		if ($r->parent)
			return Dfi_kobreakHelper::full_path($r->parent).' > '.$name;
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