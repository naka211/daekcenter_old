<?php
/**
* @version		$Id: dfi_order.php 30037 2010-04-20 17:32:38 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_order
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
* Dfi_order Table class
*
* @package		Joomla
* @subpackage	Dfi_order
* @since 1.0
*/
class TableDfi_order extends JTable
{
	var $dfi_order_id;

	var $dfi_shop_id;
	var $dfi_kobreak_id;
	var $note;
	var $created;
	var $modified;
	var $sent;
	var $dfi_order_status_id;
	var $received;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__dfi_orders', 'dfi_order_id', $db);
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
		*/
			
		$config =& JFactory::getConfig();
		$tzoffset = $config->getValue('config.offset');

		if (@$array['created'] && strlen(trim( $array['created'] )) <= 10) {
			$array['created'] 	.= ' 00:00:00';
			$date =& JFactory::getDate($array['created'], $tzoffset);
			$array['created'] = $date->toMySQL();
		}	
		
		if (@$array['modified'] && strlen(trim( $array['modified'] )) <= 10) {
			$array['modified'] 	.= ' 00:00:00';
			$date =& JFactory::getDate($array['modified'], $tzoffset);
			$array['modified'] = $date->toMySQL();
		}	

		if (@$array['sent'] && strlen(trim( $array['sent'] )) <= 10) {
			$array['sent'] 	.= ' 00:00:00';
			$date =& JFactory::getDate($array['sent'], $tzoffset);
			$array['sent'] = $date->toMySQL();
		}
		
		if (@$array['received'] && strlen(trim( $array['received'] )) <= 10) {
			$array['received'] 	.= ' 00:00:00';
			$date =& JFactory::getDate($array['received'], $tzoffset);
			$array['received'] = $date->toMySQL();
		}	

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
		if (!$this->dfi_order_id)
		{
			// check insert
			//$query = 'SELECT a.dfi_order_id FROM #__dfi_orders a' .
			//	' WHERE a.dfi_order_id = '.$this->dfi_order_id;
			//$this->_db->setQuery($query);
			//$xid = intval($this->_db->loadResult());
			//if ($xid)
			//{
			//	$this->dfi_order_id = $xid;
			//}
			//return !$xid;
		} else {
			// check update
		}
		
		return true;
	}
	
	/**
	 * Method to store the dfi_order
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
