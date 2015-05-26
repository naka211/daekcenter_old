<?php
/**
 * @version		$Id: components.php 31201 2009-11-02 22:14:59 ngo.bieu@mwc.vn $
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
 * @subpackage	Component
 * @since 1.5
 */
class ComponentsModelCPanel extends JModel
{
	var $_data = null;
	
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	function &getData()
	{
		$sql = "SELECT id FROM #__components WHERE name='System'";
		$this->_db->setQuery($sql);
		$xid = intval($this->_db->loadResult());
		
		$sql = "SELECT * FROM #__components WHERE parent=".$xid." ORDER BY ordering";
		$this->_db->setQuery($sql);
		$this->_data = $this->_db->loadObjectList();
		
		return $this->_data;
	}
}

?>