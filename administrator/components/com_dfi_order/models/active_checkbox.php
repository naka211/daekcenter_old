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
class Dfi_ordersModelActive_checkbox extends JModel
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
	 
	 /* comment mr BIEU 
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
		
			$this->_data = $this->_getList($query);
		 
			#$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			
			$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
			if ($this->_data)
			{
				foreach ($this->_data as $i => $row)
				{
				
					$sql = "SELECT b.*,d.name supplier,a.quantity product_quantity,c.hvidpris product_hvidpris,c.nettopris product_nettopris,c.rodpris product_rodpris,c.nupris product_nupris"
							. " FROM #__dfi_kobreak_products AS c"
							. " LEFT JOIN #__dfi_order_products AS a ON c.dfi_product_id=a.dfi_product_id"
							. " LEFT JOIN #__dfi_products AS b ON a.dfi_product_id=b.dfi_product_id"
							. " LEFT JOIN #__dfi_suppliers AS d ON d.dfi_supplier_id=b.dfi_supplier_id"
							. " WHERE a.dfi_order_id=".$row->dfi_order_id."";
					$this->_db->setQuery($sql);
					$data = $this->_db->loadObjectList();
					$row->products = $data;
					//$row->checkbox_state = $this->_checkbox_values[$row->$ckey]['checkbox_state'];
					$this->_data[$i] = $row;
				}
			}
		}

		
		return $this->_data;
	}
	  end comment of mr BIeu*/
	
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
		
			$this->_data = $this->_getList($query);
		 
			#$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			
			$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
			if ($this->_data)
			{
				foreach ($this->_data as $i => $row)
				{
				
					$sql = 	'SELECT od.quantity,c.company_name,c.butiksnr,c.fax'
									. ' FROM  #__dfi_shops c ' // editable
									. ' LEFT JOIN #__dfi_orders b ON c.dfi_shop_id=b.dfi_shop_id AND b.dfi_order_status_id > 1 AND b.dfi_kobreak_id ='.$row->dfi_kobreak_id
									. ' LEFT JOIN #__dfi_order_products od ON b.dfi_order_id = od.dfi_order_id'
									. ' AND od.dfi_product_id ='.$row->dfi_product_id ;
					#echo $sql."<br />";			
					$this->_db->setQuery($sql);
					$data = $this->_db->loadObjectList();
					
					$row->products = $data;
					//$row->checkbox_state = $this->_checkbox_values[$row->$ckey]['checkbox_state'];
					$this->_data[$i] = $row;
				
				}
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
		global $mainframe,$option;
		$filter_kamp		= $mainframe->getUserStateFromRequest( $option.'filter_kamp',		'filter_kamp',		0,				'int' );
	 
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$fkey = Dfi_order_active_checkboxHelper::checkbox_fkey();
		$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
		/* $query = 'SELECT b.*,c.company_name,c.butiksnr'
				. ' FROM #__dfi_orders b' // editable
				//. ' LEFT JOIN #__dfi_order_statuses a ON a.dfi_order_status_id=b.dfi_order_status_id'
				. ' LEFT JOIN #__dfi_shops c ON c.dfi_shop_id=b.dfi_shop_id'
				//. ($this->_checkbox_id >= 0?(' AND '.'b.'.$fkey.' = '.(int) $this->_checkbox_id):'')
				//. ' JOIN #__categories AS cc ON cc.id = a.catid '
				. $where
				//. $orderby
		;		*/
		
		/* $query = 'SELECT b.*,c.company_name,c.butiksnr'
				. ' FROM  #__dfi_shops c ' // editable
				. ' LEFT JOIN #__dfi_orders b ON c.dfi_shop_id=b.dfi_shop_id AND '
				. preg_replace('/WHERE/i','',$where) */
				
				//. $orderby
		/*
        $query= 'SELECT s.name as s_name,k.*,p.product_name,p.ean_kode,p.serial_number,p.package_quantity,ko.name as k_name FROM #__dfi_products p
						 INNER JOIN #__dfi_kobreak_products k ON k.dfi_product_id = p.dfi_product_id
						 INNER JOIN #__dfi_suppliers s ON s.dfi_supplier_id = p.dfi_supplier_id
						 INNER JOIN #__dfi_kobreaks ko ON ko.dfi_kobreak_id = k.dfi_kobreak_id
						 WHERE ko.dfi_campaign_id = '.$filter_kamp.'
                         ORDER BY ko.name
                         ';
       */                  
       $query= 'SELECT s.name as s_name,k.*,p.product_name,p.ean_kode,p.serial_number,p.package_quantity,ko.name as k_name FROM #__dfi_products p
						 INNER JOIN #__dfi_kobreak_products k ON k.dfi_product_id = p.dfi_product_id
                         INNER JOIN #__dfi_campaign_to_products ck ON k.dfi_product_id = ck.dfi_product_id
						 INNER JOIN #__dfi_suppliers s ON s.dfi_supplier_id = p.dfi_supplier_id
						 INNER JOIN #__dfi_kobreaks ko ON ko.dfi_kobreak_id = k.dfi_kobreak_id
						 WHERE ck.dfi_campaign_id = '.$filter_kamp.'
                         ORDER BY ko.name
                         ';
	
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
		#$where[] = 'b.dfi_kobreak_id = '.(int) $this->_checkbox_id;
		$where[] = 'b.dfi_order_status_id > 1';
		if ($filter_dfi_shop_id > 0) {
			$where[] = 'b.dfi_shop_id = '.(int) $filter_dfi_shop_id;
		}
		
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