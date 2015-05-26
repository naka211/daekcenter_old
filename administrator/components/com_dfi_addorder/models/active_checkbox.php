<?php
/**
 * @version		$Id: active_checkbox.php 31085 2010-06-15 17:00:45 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_distribution_rate
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
 * Dfi_distribution_rates Component Dfi_distribution_rate Model
 *
 * @package		Joomla
 * @subpackage	Active_checkbox
 * @since 1.5
 */
class Dfi_addorderModelActive_checkbox extends JModel
{
	/**
	 * Dfi_distribution_rate ata array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Dfi_distribution_rate total
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
	 * Method to get dfi_distribution_rates item data
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
			
			$ckey = Dfi_addorder_active_checkboxHelper::checkbox_key();
			if ($this->_data)
				foreach ($this->_data as $i=>$row)
				{
					$row->checkbox_state = $this->_checkbox_values[$row->$ckey]['checkbox_state'];
					$row->rate = $this->_checkbox_values[$row->$ckey]['rate'];
					$this->_data[$i] = $row;
				}
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of dfi_distribution_rate items
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
	 * Method to get a pagination object for the dfi_distribution_rates
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
		#$key = 'dfi_distribution_rate_id';
		$fkey = Dfi_addorder_active_checkboxHelper::checkbox_fkey();
		$ckey = Dfi_addorder_active_checkboxHelper::checkbox_key();
		$query = 'SELECT b.*'
				. ' FROM #__dfi_products b'
				. ' LEFT JOIN #__dfi_kobreak_products c ON c.dfi_product_id=b.dfi_product_id'
				. ' LEFT JOIN #__dfi_kobreaks y ON y.dfi_kobreak_id=c.dfi_kobreak_id' 
				#. ' LEFT JOIN #__dfi_campaigns x ON x.dfi_campaign_id=y.dfi_campaign_id'
				#. ' LEFT JOIN #__dfi_distribution_rates a ON a.'.$ckey.'=c.dfi_kobreak_product_id'
				#. ($this->_checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $this->_checkbox_id):'')
				//. ' JOIN #__categories AS cc ON cc.id = a.catid '
				. $where
				. $orderby
				#. '	GROUP BY c.dfi_product_id'
		;		

		return $query;
	}
    function _buildQuery_old()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();
		$key = 'dfi_distribution_rate_id';
		$fkey = Dfi_addorder_active_checkboxHelper::checkbox_fkey();
		$ckey = Dfi_addorder_active_checkboxHelper::checkbox_key();
		$query = 'SELECT b.*,CONCAT(x.name,\' > \',y.name) dfi_kobreak_id,c.dfi_kobreak_product_id '.$ckey.',c.quantity,MAX(a.rate),a.'.$key
				. ' FROM #__dfi_products b'
				. ' LEFT JOIN #__dfi_kobreak_products c ON c.dfi_product_id=b.dfi_product_id'
				. ' LEFT JOIN #__dfi_kobreaks y ON y.dfi_kobreak_id=c.dfi_kobreak_id' 
				. ' LEFT JOIN #__dfi_campaigns x ON x.dfi_campaign_id=y.dfi_campaign_id'
				. ' LEFT JOIN #__dfi_distribution_rates a ON a.'.$ckey.'=c.dfi_kobreak_product_id'
				. ($this->_checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $this->_checkbox_id):'')
				//. ' JOIN #__categories AS cc ON cc.id = a.catid '
				. $where
				. $orderby
				. '	GROUP BY c.dfi_product_id'
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
		//$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		
		$filter_dfi_kobreak_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_kobreak_id',		'filter_dfi_kobreak_id',		0,				'int' );
		if (!$filter_dfi_kobreak_id)
			$filter_dfi_kobreak_id = Dfi_kobreakHelper::first_kobeark();

		$where = $_where = array();
		
		/*if ($filter_catid > 0) {
			$where[] = 'a.catid = '.(int) $filter_catid;
		}*/
		
		if ($filter_dfi_kobreak_id > 0) {
			$where[] = 'c.dfi_kobreak_id = '.(int) $filter_dfi_kobreak_id;
		}
		
		if ($search) {
			$_where[] = 'LOWER(b.product_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(b.ean_kode) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(b.serial_number) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(dfi_kobreak_id) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			#$_where[] = 'LOWER(a.rate) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			
			$where[] = '('. implode( ' OR ', $_where ) .')';
		}
		
        
		if ($filter_state)
		{
			$ckey = Dfi_addorder_active_checkboxHelper::checkbox_key();
			
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
					$where[] = ''.$ckey.' IN ('.implode(',', $cid).')';
				else
					$where[] = '1=0';	
			} else {
				if (count( $cid ))
					$where[] = ''.$ckey.' NOT IN ('.implode(',', $cid).')';
			}
		}
        
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}
}
