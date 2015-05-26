<?php
/**
 * @version		$Id: dfi_shop.php 13121 2009-12-30 15:43:55 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_shop
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
 * Dfi_shops Component Dfi_shop Model
 *
 * @package		Joomla
 * @subpackage	Dfi_shops
 * @since 1.5
 */
class Dfi_shopsModelDfi_shop extends JModel
{
	/**
	 * Dfi_shop id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Dfi_shop data
	 *
	 * @var array
	 */
	var $_data = null;
	
	/**
	 * Dfi_shop data
	 *
	 * @var string
	 */
	var $_prefix = 'dfi_shop_';

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid', array(0), '', 'array');
		$edit	= JRequest::getVar('edit',true);
		if($edit)
			$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the dfi_shop identifier
	 *
	 * @access	public
	 * @param	int Dfi_shop identifier
	 */
	function setId($id)
	{
		// Set dfi_shop id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a dfi_shop
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		// Load the dfi_shop data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initData();

		return $this->_data;
	}

	/**
	 * Method to store the dfi_shop
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		$row =& $this->getTable();
	
		// Bind the form fields to the dfi_shop table
		if (!$row->bind($data, '', $this->_prefix)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		/*$row->dfi_shops_id = &JRequest::getVar('dfi_shop_id');
		$row->company_name = &JRequest::getVar('company_name');		
		$row->street = &JRequest::getVar('street');
		$row->telephone = &JRequest::getVar('telephone');
		$row->website = &JRequest::getVar('website');
		$row->email = &JRequest::getVar('email');
		$row->butiksnr = &JRequest::getVar('butiksnr'); 	
		$row->published = &JRequest::getVar('published'); 	
		$row->filename = &JRequest::getVar('filename'); 	
		$row->ordering = &JRequest::getVar('ordering'); 	
		$row->open_hour = &JRequest::getVar('open_hour'); 	*/
		$row->dfi_shops_catid = &JRequest::getVar('type');
		
		// if new item, order last in appropriate group
		if (!$row->dfi_shop_id) {
			$where = '' ;
			$row->ordering = $row->getNextOrder( $where );
		}

		// Make sure the web link table is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	//print_r($row);die;
		// Store the dfi_shop table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	
		$this->_id = $row->dfi_shop_id;

		return true;
	}
	
	/**
	 * Method to (un)publish a dfi_shop
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__dfi_shops'
				. ' SET published = '.(int) $publish
				. ' WHERE dfi_shop_id IN ( '.$cids.' )'
			;
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	
	/**
	 * Method to move a dfi_shop
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function saveorder($cid = array(), $order)
	{
		$row =& $this->getTable();
		//$groupings = array();

		// update ordering values
		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );
			// track categories
			//$groupings[] = $row->catid;

			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}

		// execute updateOrder for each parent group
		//$groupings = array_unique( $groupings );
//		foreach ($groupings as $group){
//			$row->reorder('catid = '.(int) $group);
//		}

		return true;
	}
	
	/**
	 * Method to remove a dfi_shop
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function delete($cid = array())
	{
		$result = false;

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			
			$row =& $this->getTable();
			foreach ($cid as $id)
			{
				$row->load( $id );
				if ($row->canDelete())
					$row->delete();
				else {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}

		return true;
	}
	
	/**
	 * Method to move a dfi_shop
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function move($direction)
	{
		$row =& $this->getTable();
		if (!$row->load($this->_id)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$row->move( $direction, ' published >= 0 ' )) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Method to load content dfi_shop data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = 'SELECT w.*'.
					 ' FROM #__dfi_shops AS w'
					// ' WHERE w.dfi_shop_id = '.(int) $this->_id;
					//. ' LEFT JOIN #__dfi_catalogs AS cc ON cc.dfi_catalog_id = w.dfi_shops_catid '
					. ' WHERE w.dfi_shop_id = '.(int) $this->_id;
			$this->_db->setQuery($query);
			//print_r($query);die;
			$this->_data = $this->_db->loadObject();
			//print_r($this->_data);die;
			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to initialise the dfi_shop data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function _initData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$dfi_shop = new stdClass();
			$dfi_shop->dfi_shop_id = 0;
			$dfi_shop->company_name = null;
			$dfi_shop->zipcode = null;
			$dfi_shop->city = null;
			$dfi_shop->street = null;
			$dfi_shop->telephone = null;
			$dfi_shop->fax = null;
			$dfi_shop->website = null;
			$dfi_shop->email = null;
			$dfi_shop->butiksnr = null;
			$dfi_shop->published = null;
			$dfi_shop->filename = null;
			$dfi_shop->ordering = null;
			$dfi_shop->description = null;
			$dfi_shop->open_hour = null;
			$dfi_shop->rate = null;
			$dfi_shop->dfi_shops_catid = null;
			$this->_data = $dfi_shop;
			return (boolean) $this->_data;
		}
		return true;
	}
}