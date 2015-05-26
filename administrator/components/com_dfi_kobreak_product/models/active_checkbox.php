<?php
/**
 * @version		$Id: active_checkbox.php 11282 2010-04-19 10:27:58 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_kobreak_product
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
 * Dfi_kobreak_products Component Dfi_kobreak_product Model
 *
 * @package		Joomla
 * @subpackage	Active_checkbox
 * @since 1.5
 */
class Dfi_kobreak_productsModelActive_checkbox extends JModel
{
	/**
	 * Dfi_kobreak_product ata array
	 *
	 * @var array
	 */
	var $_data = null;
    var $_data1 = null;
	/**
	 * Dfi_kobreak_product total
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
    var $_dfi_supplier_id;

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
        $this->_dfi_supplier_id	= $mainframe->getUserStateFromRequest( $option.'dfi_supplier_id',		'dfi_supplier_id',		0,				'int' );
	}
	
	function getCheckbox_id()
	{
		return $this->_checkbox_id;
	}
    function getDfi_supplier_id()
	{
		return $this->_dfi_supplier_id;
	}

	/**
	 * Method to get dfi_kobreak_products item data
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
            
			$ckey = Dfi_kobreak_product_active_checkboxHelper::checkbox_key();
			foreach ($this->_data as $i=>$row)
			{
				$row->checkbox_state = $this->_checkbox_values[$row->$ckey]['checkbox_state'];
				$row->quantity = $this->_checkbox_values[$row->$ckey]['quantity'];
				$row->nettopris = $this->_checkbox_values[$row->$ckey]['nettopris'];
				$row->hvidpris = $this->_checkbox_values[$row->$ckey]['hvidpris'];
				$row->rodpris = $this->_checkbox_values[$row->$ckey]['rodpris'];
				$row->nupris = $this->_checkbox_values[$row->$ckey]['nupris'];
				
				#list kampaign

				$sql = 'SELECT DISTINCT a.name, b.*'
					. ' FROM #__dfi_campaigns AS a'
					. ' JOIN #__dfi_campaign_to_products AS b ON b.dfi_campaign_id=a.dfi_campaign_id'
					. ' WHERE b.dfi_product_id='.$row->dfi_product_id
                    . ' ORDER BY a.ordering ASC';

                
				$this->_db->setQuery($sql);
				$data = $this->_db->loadObjectList();
				$row->list_kampagne=$data;
				
				$this->_data[$i] = $row;
			}
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of dfi_kobreak_product items
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
        
        #print_r($query);die;
	}

	/**
	 * Method to get a pagination object for the dfi_kobreak_products
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

		$fkey = Dfi_kobreak_product_active_checkboxHelper::checkbox_fkey();
		$ckey = Dfi_kobreak_product_active_checkboxHelper::checkbox_key();
		$query = 'SELECT b.*,a.dfi_kobreak_id,a.hvidpris price_hvidpris,a.quantity k_quantity,a.nettopris price_nettopris,a.dfi_kobreak_product_id'
				. ' FROM #__dfi_products b' // editable
				. ' LEFT JOIN #__dfi_kobreak_products a ON a.'.$ckey.'=b.'.$ckey
				. ($this->_checkbox_id >= 0?(' AND '.'a.'.$fkey.' = '.(int) $this->_checkbox_id):'')
				//. ' JOIN #__categories AS cc ON cc.id = a.catid '
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
		//$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		
		$dfi_campaign_id		= $mainframe->getUserState( $option.'dfi_campaign_id', 0);

		$where = $_where = array();
		
		/*if ($filter_catid > 0) {
			$where[] = 'a.catid = '.(int) $filter_catid;
		}*/
		
		if ($dfi_campaign_id > 0) {
            $where[] = 'b.dfi_product_id IN (SELECT dfi_product_id FROM #__dfi_campaign_to_products WHERE dfi_campaign_id='.((int) $dfi_campaign_id).')';
        }
		
		if ($search) {
			$_where[] = 'LOWER(b.product_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(b.ean_kode) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(b.serial_number) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			//$_where[] = 'LOWER(a.dfi_kobreak_id) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$_where[] = 'LOWER(a.quantity) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			
			$where[] = '('. implode( ' OR ', $_where ) .')';
		}
		
		if ($filter_state)
		{
			$ckey = Dfi_kobreak_product_active_checkboxHelper::checkbox_key();
			
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
    
    
    /** Get all products **/
    
    
    function getData_pro()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data1))
		{
			$query = $this->_buildQuery_pro();
			$this->_data1 = $this->_getList($query);
			
			foreach ($this->_data1 as $i=>$row)
			{
				$sql = 'SELECT DISTINCT a.name'
					. ' FROM #__dfi_campaigns AS a'
					. ' JOIN #__dfi_campaign_to_products AS b ON b.dfi_campaign_id=a.dfi_campaign_id'
					. ' WHERE b.dfi_product_id='.$row->dfi_product_id
					. ' ORDER BY a.ordering ASC';
				$this->_db->setQuery($sql);
				$data = $this->_db->loadObjectList();
				$this->_data1[$i]->active_checkbox = $data;
			}
		}

		return $this->_data1;
	}
    
   	function _buildQuery_pro()
	{
		// Get the WHERE and ORDER BY clauses for the query
	
		global $mainframe, $option;
	
		$query = ' SELECT a.*,cc.name AS supplier'
			. ' FROM #__dfi_products AS a '
			. ' LEFT JOIN #__dfi_suppliers AS cc ON cc.dfi_supplier_id = a.dfi_supplier_id '
			. ' WHERE a.dfi_supplier_id = '.(int)$this->_dfi_supplier_id
			//. ' GROUP BY a.dfi_product_id'
			. ' ORDER BY a.dfi_product_id DESC'
		;
		
		

		return $query;
	}
    
}
