<?php
/**
 * @version $Id$
 * @package Dfi_catalog
 * @subpackage	Dfi_catalog
 * @copyright Copyright (C) 2009 Dfi_catalog. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a file list from a directory in the current templates directory
 */

class JElementCustomDfi_catalogParams extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'CustomDfi_catalogParams';
	
	function fetchElement($name, $value, &$node, $control_name)
	{
		$doc =& JFactory::getDocument();
		$all_params = $this->_parent;
		
		$namevalues = array(); 
		//get all current values
		while (true) { 
			$count++;
			$current_name = $all_params->get($name.'_name_'.$count, '');
			if ($current_name=='') {
				break;
			}
			$current_value = $all_params->get($name.'_value_'.$count, '');
			$namevalues[$count]=array('name'=>$current_name,'value'=>$current_value);
		}
		
		return "";
	}
}
