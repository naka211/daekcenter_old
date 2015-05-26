<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class Search_resultModelSearch_result extends JModel
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
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', 6, 'int' );
		$limitstart	= JRequest::getVar('limitstart', '0', '', 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
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

		$query = ' SELECT a.*'
			. ' FROM #__dfi_shops AS a '
			. $where
			. $orderby
		;

		return $query;
	}

	function _buildContentOrderBy()
	{
		global $mainframe, $option;

		$orderby 	= ' ORDER BY ordering';

		return $orderby;
	}

	function _buildContentWhere()
	{
		global $mainframe, $option;
		$db					=& JFactory::getDBO();
		
		$firma = $mainframe->getUserState( 'firma'  );
		$postnumber = $mainframe->getUserState( 'postnumber'  );
		$searchword = $mainframe->getUserState( 'searchword'  );

		$where = array();
		
		if ($firma) {
			$where[] = 'a.company_name LIKE '.$db->Quote( '%'.$db->getEscaped( $firma, true ).'%', false );
		}
		
		if ($postnumber) {
			$where[] = 'a.zipcode LIKE '.$db->Quote( '%'.$db->getEscaped( $postnumber, true ).'%', false );
		}
		
		if ($searchword) {
			$_where[] = 'a.company_name LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.zipcode LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.city LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.street LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.telephone LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.fax LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.website LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.email LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.butiksnr LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			$_where[] = 'a.open_hour LIKE '.$db->Quote( '%'.$db->getEscaped( $searchword, true ).'%', false );
			
			$where[] = '('. implode( ' OR ', $_where ) .')';
		}

		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}
	
	function getSearchword()
	{
		global $mainframe, $option;
		$searchword = $mainframe->getUserState( 'searchword' );
		$searchword	= JString::strtolower( $searchword );
		return $searchword;
	}
} 

?>