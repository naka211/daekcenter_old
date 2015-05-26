<?php
/**
 * @version		$Id: dfi_campaigns.php 2848 2010-04-19 10:07:14 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_campaign
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
 * Dfi_campaigns Component Dfi_campaign Model
 *
 * @package		Joomla
 * @subpackage	Dfi_campaign
 * @since 1.5
 */
class Dfi_campaignsModelDfi_campaigns extends JModel
{
	/**
	 * Dfi_campaign data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Dfi_campaign total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe, $option;

		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );
		// OR, $limitstart	= JRequest::getVar('limitstart', '0', '', 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get dfi_campaigns item data
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			
			/*foreach ($this->_data as $i=>$row)
			{
				$query = 'SELECT a.value,cc.name option_name'
					. ' FROM #__'
					. ' WHERE b.dfi_campaign_id='.$row->dfi_campaign_id;
				$this->_db->setQuery($query);
				$data = $this->_db->loadObjectList();
				$this->_data[$i]->active_checkbox = $data;
			}*/
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of dfi_campaign items
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object for the dfi_campaigns
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$query = ' SELECT a.*'//,cc.title AS category'
			. ' FROM #__dfi_campaigns AS a '
			//. ' LEFT JOIN #__categories AS cc ON cc.id = a.catid '
			. $where
			. $orderby
		;

		return $query;
	}

	function _buildContentOrderBy()
	{
		global $mainframe, $option;

		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		
		$orderby = '';
		
		if ($filter_order && $filter_order_Dir)
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;

		return $orderby;
	}

	function _buildContentWhere()
	{
		global $mainframe, $option;
		$db					=& JFactory::getDBO();
		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );

		$where = $_where = array();
		
		if ($filter_catid > 0) {
			//$where[] = 'a.catid = '.(int) $filter_catid;
		}
		
		if ($search) {
			$_where[] = 'LOWER(a.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.published_date) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.unpublished_date) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			
			$where[] = '('. implode( ' OR ', $_where ) .')';
		}
		
		if ($filter_state)
		{
			$state = array('P'=>1, 'U'=>0);
			$where[] = "a.published='".$state[$filter_state]."'";
		}

		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}
}
