<?php
/**
 * @version		$Id: active_checkbox.php 4143 2010-05-21 17:28:59 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_order
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
 * Dfi_orders Component Dfi_order Model
 *
 * @package		Joomla
 * @subpackage	Active_checkbox
 * @since 1.5
 */
class Dfi_ordersModelActive_checkbox2 extends JModel
{
	/**
	 * Dfi_order ata array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Dfi_order total
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
	 * Active_checkbox object
	 *
	 * @var object
	 */	
	var $_checkbox_id;
	var $_checkbox_values;

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
		
		// active checkbox
		$this->_checkbox_id		= $mainframe->getUserStateFromRequest( $option.'checkbox_id',		'checkbox_id',		0,				'int' );
		$this->_checkbox_values = $mainframe->getUserState( $option.$this->_checkbox_id.'checkbox_values', array());
	}
	
	function getCheckbox_id()
	{
		return $this->_checkbox_id;
	}

	/**
	 * Method to get dfi_orders item data
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
			
			//$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
			if ($this->_data)
				foreach ($this->_data as $i=>$row)
				{
					if ($row->dfi_order_id)
					{
						$sql = "SELECT b.*,a.quantity product_quantity,c.hvidpris product_hvidpris,c.nettopris product_nettopris FROM #__dfi_order_products AS a"
								. " LEFT JOIN #__dfi_kobreak_products AS c ON c.dfi_product_id=a.dfi_product_id"
								. " LEFT JOIN #__dfi_products AS b ON a.dfi_product_id=b.dfi_product_id"
								. " WHERE c.dfi_kobreak_id=".$this->_checkbox_id." AND a.dfi_order_id=".$row->dfi_order_id." ORDER BY b.dfi_product_id";
						$this->_db->setQuery($sql);
						$data = $this->_db->loadObjectList();
						$row->products = $data;
					} else {
						$sql = "SELECT a.*,c.quantity product_quantity,c.hvidpris product_hvidpris,c.nettopris product_nettopris FROM #__dfi_products AS a"
								. " JOIN #__dfi_kobreak_products AS c ON c.dfi_product_id=a.dfi_product_id"
								. " WHERE c.dfi_kobreak_id=".$this->_checkbox_id." ORDER BY a.dfi_product_id";
						$this->_db->setQuery($sql);
						$data = $this->_db->loadObjectList();
						$row->products = $data;
					}
					
					$this->_data[$i] = $row;						
				}
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of dfi_order items
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
	 * Method to get a pagination object for the dfi_orders
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

		$fkey = Dfi_order_active_checkboxHelper::checkbox_fkey();
		$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
		$query = 'SELECT b.*,a.name status_name,c.company_name,c.butiksnr'
				//. ' CASE WHEN CHAR_LENGTH(b.dfi_kobreak_id) THEN CONCAT_WS(":", b.id, b.alias) ELSE b.id END as catslug,'
				. ' FROM #__dfi_shops c' // editable
				. ' LEFT JOIN #__dfi_orders b ON c.dfi_shop_id=b.dfi_shop_id'
				. ' LEFT JOIN #__dfi_order_statuses a ON a.dfi_order_status_id=b.dfi_order_status_id'
				//. ($this->_checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $this->_checkbox_id):'')
				//. ' JOIN #__categories AS cc ON cc.id = a.catid '
				. $where
				//. $orderby
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
		
		$filter_dfi_shop_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_shop_id',		'filter_dfi_shop_id',		0,				'int' );

		$where = $_where = array();
		
		/*if ($filter_catid > 0) {
			$where[] = 'a.catid = '.(int) $filter_catid;
		}*/
		
		if ($filter_dfi_shop_id > 0) {
			$where[] = '(b.dfi_shop_id = '.((int) $filter_dfi_shop_id).' AND b.dfi_order_status_id > 1 AND b.dfi_kobreak_id = '.(int) $this->_checkbox_id.')';
		} else		
			$where[] = '(b.dfi_kobreak_id IS NULL OR (b.dfi_order_status_id > 1 AND b.dfi_kobreak_id = '.(int) $this->_checkbox_id.'))';
		//$where[] = 'b.dfi_order_status_id > 1';
		
		if ($search) {
			//$_where[] = 'LOWER(a.dfi_shop_id) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.dfi_kobreak_id) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(b.note) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.sent) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.dfi_order_status_id) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			
			//$where[] = '('. implode( ' OR ', $_where ) .')';
		}
		
		if ($filter_state)
		{
			$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
			
			$cid = array();
			foreach ($this->_checkbox_values as $k=>$x)
			{
				if ($x['checkbox_state'])
					$cid[] = $k;
			}	
			
			$state = array('P'=>1, 'U'=>0);
			if ($state[$filter_state])
			{			
				if (count( $cid ))
					$where[] = 'b.'.$ckey.' IN ('.implode(',', $cid).')';
				else
					$where[] = '1=0';	
			} else {
				if (count( $cid ))
					$where[] = 'b.'.$ckey.' NOT IN ('.implode(',', $cid).')';
			}
		}

		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}
}
