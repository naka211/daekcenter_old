<?php
/**
 * @version		$Id: dfi_review_product.php 25002 2010-09-18 07:07:43 ngo.bieu@mwc.vn $
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
class Dfi_review_productHelper
{
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
		
		Dfi_review_productHelper::full_paths(0, $items);
		
		return JHTML::_('select.genericlist',  $items, $name, 'class="inputbox" size="'.$size.'"'.($autosubmit?' onchange="document.adminForm.submit( );"':'').($extra?' '.$extra:''), 'value', 'text', $value );
	}
	
	function full_paths($parent, &$items)
	{
		$db = &JFactory::getDBO();
		
		$query = 'SELECT a.dfi_review_product_id value, a.dfi_review_product_id text' .
				' FROM #__dfi_review_products a' .
				//' WHERE a.dfi_review_product_id!=a.parent AND a.parent=' .$parent.
				' ORDER BY a.dfi_review_product_id';
		$db->setQuery($query);
		$res = $db->loadObjectList();
		if ($res)
		{
			foreach ($res as $o)
			{
				//$o->text = Dfi_review_productHelper::full_path($o->value);
				$items[] = $o;
				//Dfi_review_productHelper::full_paths($o->value, $items);
			}
		}
	}
	
	/*function full_path($id)
	{
		$db = &JFactory::getDBO();
				
		$query = 'SELECT a.*' .
				' FROM #__dfi_review_products a' .
				' WHERE a.dfi_review_product_id='.$id;
		$db->setQuery($query);				
		$r = $db->loadObject();
		
		if (!$r) return '?';		
		$name = $r->dfi_review_product_id;
		if ($r->parent)
			return Dfi_review_productHelper::full_path($r->parent).' > '.$name;
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