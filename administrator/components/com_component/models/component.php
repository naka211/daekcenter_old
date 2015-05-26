<?php
/**
 * @version		$Id: component.php 12717 2010-03-28 11:24:25 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Component
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
 * Components Component Component Model
 *
 * @package		Joomla
 * @subpackage	Components
 * @since 1.5
 */
class ComponentsModelComponent extends JModel
{
	/**
	 * Component id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Component data
	 *
	 * @var array
	 */
	var $_data = null;
	
	/**
	 * Component data
	 *
	 * @var string
	 */
	var $_prefix = 'component_';

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
	 * Method to set the component identifier
	 *
	 * @access	public
	 * @param	int Component identifier
	 */
	function setId($id)
	{
		// Set component id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a component
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		// Load the component data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initData();

		return $this->_data;
	}

	/**
	 * Method to store the component
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		$row =& $this->getTable();

		// Bind the form fields to the component table
		if (!$row->bind($data, '', $this->_prefix)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		// if new item, order last in appropriate group
		if (!$row->id) {
			$where = 'parent = ' . (int) $row->parent ;
			$row->ordering = $row->getNextOrder( $where );
		}

		// Make sure the component table is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the component table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		$this->_id = $row->id;

		return true;
	}
	
	/**
	 * Method to duplicate the component
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
				
				$row->id = 0;
				$row->name = 'Copy of '.$row->name;
				
				// if new item, order last in appropriate group
				$where = 'parent = ' . (int) $row->parent ;
				$row->ordering = $row->getNextOrder( $where );
		
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
	 * Method to (un)publish a component
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

			$query = 'UPDATE #__components'
				. ' SET enabled = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )'
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
	 * Method to move a component
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function saveorder($cid = array(), $order)
	{
		$row =& $this->getTable();
		$groupings = array();

		// update ordering values
		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );
			// track categories
			$groupings[] = $row->parent;

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
		$groupings = array_unique( $groupings );
		foreach ($groupings as $group){
			$row->reorder('parent = '.(int) $group);
		}

		return true;
	}
	
	/**
	 * Method to remove a component
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
	 * Method to move a component
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
	 * Method to load content component data
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
					 ' FROM #__components AS w'.
					 ' WHERE w.id = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to initialise the component data
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
			$component = new stdClass();
			$component->id = 0;
			$component->name = null;
			$component->link = null;
			$component->menuid = 0;
			$component->parent = 0;
			$component->admin_menu_link = null;
			$component->admin_menu_alt = null;
			$component->option = null;
			$component->ordering = 0;
			$component->admin_menu_img = null;
			$component->iscore = 0;
			$component->params = null;
			$component->enabled = null;
			$this->_data = $component;
			return (boolean) $this->_data;
		}
		return true;
	}
}