<?php
/**
* @version		$Id: article.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JElementArticleimage extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Articleimage';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$doc =& JFactory::getDocument();
		$all_params = $this->_parent;
		$fieldName	= $control_name.'['.$name.']';
		
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
		
		$img = '<img width="50" height="50" id="'.$name.'_src" name="'.$name.'_src" src="../'.$value.'" />';
		$js = "if (this.value!='') {
							document.getElementById('{$name}_src').src='../'+this.value;
						}";
		return $img.'<input onchange="'.$js.'" type="hidden" id="'.$name.'" name="'.$fieldName.'" value="'.$value.'">';	
	}
}
