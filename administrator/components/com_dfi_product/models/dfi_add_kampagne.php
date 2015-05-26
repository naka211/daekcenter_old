<?php
/**
 * @version		$Id: dfi_product.php 9110 2009-12-31 09:09:04 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_product
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
 * Dfi_products Component Dfi_product Model
 *
 * @package		Joomla
 * @subpackage	Dfi_products
 * @since 1.5
 */
class Dfi_productsModelDfi_add_kampagne extends JModel
{
	/**
	 * Dfi_product id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Dfi_product data
	 *
	 * @var array
	 */
	var $_data = null;
	
	/**
	 * Dfi_product data
	 *
	 * @var string
	 */
	var $_prefix = 'dfi_product_';

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
	 * Method to set the dfi_product identifier
	 *
	 * @access	public
	 * @param	int Dfi_product identifier
	 */
	function setId($id)
	{
		// Set dfi_product id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a dfi_product
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		// Load the dfi_product data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initData();

		return $this->_data;
	}

	/**
	 * Method to store the dfi_product
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		$row =& $this->getTable();

		// Bind the form fields to the dfi_product table
		if (!$row->bind($data, '', $this->_prefix)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		// if new item, order last in appropriate group
		if (!$row->dfi_product_id) {
			$where = '' ;
			//$row->ordering = $row->getNextOrder( $where );
		}

		// Make sure the web link table is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the dfi_product table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		$this->_id = $row->dfi_product_id;

		return true;
	}
	
	/**
	 * Method to (un)publish a dfi_product
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	/*function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__dfi_products'
				. ' SET published = '.(int) $publish
				. ' WHERE dfi_product_id IN ( '.$cids.' )'
			;
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}*/
	
	/**
	 * Method to move a dfi_product
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	/*function saveorder($cid = array(), $order)
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
	}*/
	
	/**
	 * Method to remove a dfi_product
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
	 * Method to move a dfi_product
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	/*function move($direction)
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
	}*/

	/**
	 * Method to load content dfi_product data
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
					 ' FROM #__dfi_products AS w'.
					 ' WHERE w.dfi_product_id = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to initialise the dfi_product data
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
			$dfi_product = new stdClass();
			$dfi_product->dfi_product_id = 0;
			$dfi_product->dfi_supplier_id = null;
			$dfi_product->ean_kode = null;
			$dfi_product->serial_number = null;
			$dfi_product->product_name = null;
			$dfi_product->forced_distribution= 0;
			$dfi_product->package_quantity = null;
			$dfi_product->wee=0;
			$dfi_product->hvidpris = 0;
			$dfi_product->rodpris = 0;
            $dfi_product->sortimentsnetto = 0;
			$dfi_product->nettopris = 0;
			$dfi_product->nupris = 0;
			$dfi_product->range = 0;
			$dfi_product->quantity = 0;
			$this->_data = $dfi_product;
			return (boolean) $this->_data;
		}
		return true;
	}
}