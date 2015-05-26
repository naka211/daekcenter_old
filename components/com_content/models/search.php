<?php
/**
 * @version		$Id: archive.php 11681 2009-03-08 20:52:50Z willebil $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

/**
 * Content Component Archive Model
 *
 * @package 	Joomla
 * @subpackage	Content
 * @since		1.5
 */
class ContentModelSearch extends JModel
{
	
	function getData($keyword)
	{
		$db = JFactory::getdbo();
		$query="SELECT * FROM #__dfi_shops AS shops WHERE shops.company_name LIKE '%$keyword%'";
		$db->setQuery($query);
		$total = $db->loadObject();
		//$total1 = $total->dfi_shop_id;die;
		//print_r($total);die;
		return $total;
	}

}
