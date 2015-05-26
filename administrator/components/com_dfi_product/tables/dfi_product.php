<?php
/**
* @version		$Id: dfi_product.php 9110 2009-12-31 09:09:04 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_product
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
* Dfi_product Table class
*
* @package		Joomla
* @subpackage	Dfi_product
* @since 1.0
*/
class TableDfi_product extends JTable
{
	var $dfi_product_id;
	var $dfi_supplier_id;
	var $ean_kode;
	var $serial_number;
	var $product_name;
	var $package_quantity;
	var $hvidpris;
	var $rodpris;
	var $wee;
    var $sortimentsnetto;
	var $nettopris;
	var $nupris;
	var $range;
	var $quantity;
	var $forced_distribution;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__dfi_products', 'dfi_product_id', $db);
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
		
		$array['wee']=ws_comma_to_dot($array['wee']);
		$array['hvidpris'] = ws_comma_to_dot($array['hvidpris']);
		$array['rodpris'] = ws_comma_to_dot($array['rodpris']);
		$array['nettopris'] = ws_comma_to_dot($array['nettopris']);
		$array['nupris'] = ws_comma_to_dot($array['nupris']);
		
		//Remove all HTML tags from the description
		//$filter = new JFilterInput(array(), array(), 0, 0);
		//$array['description'] = $filter->clean($array['description']);
		
		/*$datenow =& JFactory::getDate();
		$array['modified'] = $datenow->toMySQL();
			
		if ($array['created'] && strlen(trim( $array['created'] )) <= 10) {
			$array['created'] 	.= ' 00:00:00';
		} else if(!$array['created']) {		
			$config =& JFactory::getConfig();
			$tzoffset = $config->getValue('config.offset');
			$date =& JFactory::getDate($array['created'], $tzoffset);
			$array['created'] = $date->toMySQL();
		}*/
		
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
		if (!$this->dfi_product_id)
		{
			// check insert
			//$query = 'SELECT a.dfi_product_id FROM #__dfi_products a' .
			//	' WHERE a.dfi_product_id = '.$this->dfi_product_id;
			//$this->_db->setQuery($query);
			//$xid = intval($this->_db->loadResult());
			//return !$xid;
		} else {
			// check update
		}
		
		return true;
	}
	
	/**
	 * Method to store the dfi_product
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
