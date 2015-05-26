<?php
/**
 * @version		$Id: dfi_reports.php 11400 2010-01-05 08:23:14 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_report
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
 * Dfi_reports Component Dfi_report Model
 *
 * @package		Joomla
 * @subpackage	Dfi_report
 * @since 1.5
 */
class Dfi_reportsModelDfi_reports extends JModel
{
	/**
	 * Category ata array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Category total
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

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get dfi_reports item data
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
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of dfi_report items
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
	 * Method to get a pagination object for the dfi_reports
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

		$query = ' SELECT a.*,cc.product_name,bb.company_name,bb.butiksnr'
			. ' FROM #__dfi_reports AS a '
			. ' LEFT JOIN #__dfi_products AS cc ON cc.dfi_product_id = a.dfi_product_id '
			. ' LEFT JOIN #__dfi_shops AS bb ON bb.dfi_shop_id = a.dfi_shop_id '
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
		$dfi_shop_id		= $mainframe->getUserStateFromRequest( $option.'dfi_shop_id',		'dfi_shop_id',		0,				'int' );
		$month				= $mainframe->getUserStateFromRequest( $option.'month',			'month',			'',				'string' );
		$year				= $mainframe->getUserStateFromRequest( $option.'year',			'year',			'',				'string' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );

		$where = $_where = array();
		
		if ($filter_catid > 0) {
			//$where[] = 'a.catid = '.(int) $filter_catid;
		}
		
		if ($dfi_shop_id > 0) {
			$where[] = 'a.dfi_shop_id = '.(int) $dfi_shop_id;
		}
		
		if ($month) {
			$where[] = 'LOWER(a.month) = '.$db->Quote( $db->getEscaped( $month, true ), false );
		}
		
		if ($year) {
			$where[] = 'LOWER(a.year) = '.$db->Quote( $db->getEscaped( $year, true ), false );
		}
		
		if ($search) {
			$_where[] = 'LOWER(bb.butiksnr) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(bb.company_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(cc.product_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.quantity) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.month) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.year) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			
			$where[] = '('. implode( ' OR ', $_where ) .')';
		}
		
		if ($filter_state)
		{
			$state = array('P'=>1, 'U'=>0);
			
		}

		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}
}
