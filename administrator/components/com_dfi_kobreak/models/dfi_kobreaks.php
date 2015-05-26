<?php
/**
 * @version		$Id: dfi_kobreaks.php 3997 2010-04-19 10:27:45 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_kobreak
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
 * Dfi_kobreaks Component Dfi_kobreak Model
 *
 * @package		Joomla
 * @subpackage	Dfi_kobreak
 * @since 1.5
 */
class Dfi_kobreaksModelDfi_kobreaks extends JModel
{
	/**
	 * Dfi_kobreak data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Dfi_kobreak total
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
	 * Method to get dfi_kobreaks item data
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery1();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			
			/*foreach ($this->_data as $i=>$row)
			{
				$query = 'SELECT a.value,cc.name option_name'
					. ' FROM #__'
					. ' WHERE b.dfi_kobreak_id='.$row->dfi_kobreak_id;
				$this->_db->setQuery($query);
				$data = $this->_db->loadObjectList();
				$this->_data[$i]->active_checkbox = $data;
			}*/
		}
			
		return $this->_data;
	}

	/**
	 * Method to get the total number of dfi_kobreak items
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery1();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object for the dfi_kobreaks
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

		$query = ' SELECT a.*'
			. ' FROM #__dfi_kobreaks AS a '
			//. ' LEFT JOIN #__dfi_campaigns AS cc ON cc.dfi_campaign_id = a.dfi_campaign_id '
			//. ' LEFT JOIN #__dfi_suppliers AS f ON f.dfi_supplier_id = a.dfi_supplier_id '
			//. ' INNER JOIN #__dfi_orders AS op ON a.dfi_kobreak_id = op.dfi_kobreak_id '
			//. ' INNER JOIN #__dfi_order_statuses AS ot ON ot.dfi_order_status_id = op.dfi_order_status_id'
			. $where
			. $orderby
		;

		return $query;
	}
    function _buildQuery1()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$query = ' SELECT a.*,ot.name as status_name,ot.dfi_order_status_id'
			. ' FROM #__dfi_kobreaks AS a '
			. ' INNER JOIN #__dfi_order_statuses AS ot ON ot.dfi_order_status_id = a.status'
			. $where
			. $orderby
		;

		return $query;
	}
    
    function _buildQuery1111()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$query = ' SELECT a.*,ot.name as status_name,ot.dfi_order_status_id, cc.name AS campaign_name,f.name AS supplier_name'
			. ' FROM #__dfi_kobreaks AS a '
			. ' LEFT JOIN #__dfi_campaigns AS cc ON cc.dfi_campaign_id = a.dfi_campaign_id '
			. ' LEFT JOIN #__dfi_suppliers AS f ON f.dfi_supplier_id = a.dfi_supplier_id '
			. ' INNER JOIN #__dfi_orders AS op ON a.dfi_kobreak_id = op.dfi_kobreak_id '
			. ' INNER JOIN #__dfi_order_statuses AS ot ON ot.dfi_order_status_id = op.dfi_order_status_id'
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
		
		$dfi_supplier_id = $mainframe->getUserStateFromRequest( $option.'dfi_supplier_id',		'dfi_supplier_id',		0,				'int' );
		$dfi_campaign_id = $mainframe->getUserStateFromRequest( $option.'dfi_campaign_id',		'dfi_campaign_id',		0,				'int' );
		$status = $mainframe->getUserStateFromRequest( $option.'status',		'status',		0,				'int' );
		
		$where = $_where = array();
		
		if ($filter_catid > 0) {
			//$where[] = 'a.catid = '.(int) $filter_catid;
		}
		
		if ($dfi_supplier_id > 0) {
			$where[] = 'a.dfi_supplier_id = '.(int) $dfi_supplier_id;
		}
		
		if ($dfi_campaign_id > 0) {
			$where[] = 'a.dfi_campaign_id = '.(int) $dfi_campaign_id;
		}
		
		if ($status > 0) {
			#$where[] = 'a.status = '.(2-(int) $status);
            //$where[] = 'a.status = '.((int) $status);
		}
		
		if ($search) {
			$_where[] = 'LOWER(f.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.lev_uge) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.val_uge) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.lev_betingelse) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.ann_tilskud) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.franko) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(cc.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			
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
