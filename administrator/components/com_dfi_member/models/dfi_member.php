<?php
/**
 * @version		$Id: dfi_member.php 5370 2010-04-22 17:46:06 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_member
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
 * Dfi_members Component Dfi_member Model
 *
 * @package		Joomla
 * @subpackage	Dfi_members
 * @since 1.5
 */
class Dfi_membersModelDfi_member extends JModel
{
	/**
	 * Dfi_member id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Dfi_member data
	 *
	 * @var array
	 */
	var $_data = null;
	
	/**
	 * Dfi_member data
	 *
	 * @var string
	 */
	var $_prefix = 'dfi_member_';

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
	 * Method to set the dfi_member identifier
	 *
	 * @access	public
	 * @param	int Dfi_member identifier
	 */
	function setId($id)
	{
		// Set dfi_member id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a dfi_member
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		// Load the dfi_member data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initData();

		return $this->_data;
	}
 
	/**
	 * Method to store the dfi_member
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
	  
		$row =& $this->getTable();

		// Bind the form fields to the dfi_member table
		if (!$row->bind($data, '', $this->_prefix)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		// if new item, order last in appropriate group
		if (!$row->dfi_member_id) {
			//$where = 'catid = ' . (int) $row->catid ;
			//$row->ordering = $row->getNextOrder( $where );
		}

		// Make sure the dfi_member table is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the dfi_member table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		$this->_id = $row->dfi_member_id;

		return true;
	}
	/**
	 * Method to duplicate the dfi_member
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function duplicate($cid = array())
	{
		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			
			$row =& $this->getTable();
			
			foreach($cid as $id)
			{
				$row->load($id);
				
				$row->dfi_member_id = 0;
				//$row->name = 'Copy of '.$row->name;
				
				// if new item, order last in appropriate group
				//$where = 'catid = ' . (int) $row->catid ;
				//$row->ordering = $row->getNextOrder( $where );
		
				// Make sure the item table is valid
				if (!$row->check()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
		
				// Store the cms_item table to the database
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}			
			}
		}

		return true;
	}
	
	/**
	 * Method to (un)publish a dfi_member
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

			$query = 'UPDATE #__dfi_members'
				. ' SET published = '.(int) $publish
				. ' WHERE dfi_member_id IN ( '.$cids.' )'
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
	 * Method to move a dfi_member
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
	 * Method to remove a dfi_member
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
	 * Method to move a dfi_member
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
	 * Method to load content dfi_member data
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
					 ' FROM #__dfi_members AS w'.
					 ' WHERE w.dfi_member_id = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to initialise the dfi_member data
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
			$dfi_member = new stdClass();
			$dfi_member->dfi_member_id = 0;
			$dfi_member->user_id = null;
			$dfi_member->dfi_shop_id = null;
			$dfi_member->role = null;
			$this->_data = $dfi_member;
			return (boolean) $this->_data;
		}
		return true;
	}
}