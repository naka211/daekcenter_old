<?php
/**
* @version		$Id: component.php 12717 2010-03-28 11:24:25 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Component
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Component Table class
*
* @package		Joomla
* @subpackage	Component
* @since 1.0
*/
class TableComponent extends JTable
{
	var $id;
	var $name;
	var $link;
	var $menuid;
	var $parent;
	var $admin_menu_link;
	var $admin_menu_alt;
	var $option;
	var $ordering;
	var $admin_menu_img;
	var $iscore;
	var $params;
	var $enabled;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__components', 'id', $db);
	}

	/**
	* Overloaded bind function
	*
	* @acces public
	* @param array $hash named array
	* @return null|string	null is operation was satisfactory, otherwise returns an error
	* @see JTable:bind
	* @since 1.5
	*/
	function bind($array, $ignore = '', $prefix = '')
	{
		// trim prefix
		if ($prefix)
		{
			foreach ($array as $k=>$v)
			{
				if (substr($k, 0, strlen($prefix)) == $prefix)
				{
					$array[substr($k, strlen($prefix))] = $v;
				}
			}
		}
		
		//Remove all HTML tags from the description
		//$filter = new JFilterInput(array(), array(), 0, 0);
		//$array['description'] = $filter->clean($array['description']);
		
		/*$datenow =& JFactory::getDate();
		$array['modified'] = $datenow->toMySQL();
			
		if ($array['created'] && strlen(trim( $array['created'] )) <= 10) {
			$array['created'] 	.= ' 00:00:00';
		}	
		$config =& JFactory::getConfig();
		$tzoffset = $config->getValue('config.offset');
		$date =& JFactory::getDate($array['created'], $tzoffset);
		$array['created'] = $date->toMySQL();
		*/
		
		if (key_exists( 'params', $array ) && is_array( $array['params'] ))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	function check()
	{
		if (!$this->id)
		{
			// check insert
			//$query = 'SELECT a.id FROM #__components a' .
			//	' WHERE a.id = '.$this->id;
			//$this->_db->setQuery($query);
			//$xid = intval($this->_db->loadResult());
			//if ($xid)
			//{
			//	$this->id = $xid;
			//}
			//return !$xid;
		} else {
			// check update
		}
		
		return true;
	}
	
	/**
	 * Method to store the component
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($updateNulls=false)
	{
		return parent::store($updateNulls);
	}
	
	function canDelete($oid=null, $joins=null)
	{
		return parent::canDelete($oid, $joins);
	}
	
	/**
	 * Default delete method
	 *
	 * can be overloaded/supplemented by the child class
	 *
	 * @access public
	 * @return true if successful otherwise returns and error message
	 */
	function delete($oid=null)
	{
		parent::delete( $oid );
	}
}
