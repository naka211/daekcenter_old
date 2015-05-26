<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class DateModelDateedit extends JModel{

	/**
	 * Book id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Book data
	 *
	 * @var array
	 */
	var $_data = null;
    var $_data_f = null;
    var $_data_d = null;
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
	 * Method to set the weblink identifier
	 *
	 * @access	public
	 * @param	int Weblink identifier
	 */
	function setId($id)
	{
		// Set weblink id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a weblink
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		// Load the weblink data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initData();

		return $this->_data;
	}
    function &getDataf()
	{
		// Load the weblink data
		if ($this->_loadData_f())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initDataf();

		return $this->_data_f;
	}
    function &getDatad()
	{
		// Load the weblink data
		if ($this->_loadData_d())
		{
			// Initialize some variables
			$user = &JFactory::getUser();
		}
		else  $this->_initDatad();

		return $this->_data_d;
	}

	/**
	 * Method to store the weblink
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data){
        $db =& JFactory::getDBO();
        
        /*
        $id = $_POST['cid'][0];
        $name = $_POST['name']?$_POST['name']:"";
        $price = $_POST['price']?$_POST['price']:"";
        $charac = $_POST['charac']?$_POST['charac']:"";
        $ordering = $_POST['ordering']?$_POST['ordering']:0;
       
        if($id==0){
            $query="INSERT INTO #__guld(name,price,charac,ordering) VALUES('".$name."','".$price."','".$charac."',".$ordering.")";
            
            $db->setQuery($query);		
            $db->query();
        }else{
    		$query = "UPDATE #__guld SET name='".$name."', price='".$price."', charac='".$charac."', ordering=".$ordering." WHERE id='".$id."'";
            #print_r($query);die;
            $db->setQuery($query);
    		$db->query();
        }
        */
		return true;
	}

	/**
	 * Method to remove a weblink
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
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM #__application'
				. ' WHERE id IN ( '.$cids.' )';

			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
        if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
		
            $queryf = 'DELETE FROM #__appformer'
				. ' WHERE id_app IN ( '.$cids.' )';
         
            $this->_db->setQuery( $queryf );
          
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
        
        if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
		
            $queryd = 'DELETE FROM #__appeducation'
				. ' WHERE id_app IN ( '.$cids.' )';   
            
            $this->_db->setQuery( $queryd );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}

	/**
	 * Method to move a weblink
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function saveorder($cid = array(), $order)
	{
        
		return true;
	}

	/**
	 * Method to load content weblink data
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
			$query = 'SELECT * '.
					' FROM #__application ' .
					' WHERE id = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}
    function _loadData_f()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data_f))
		{
			$query = 'SELECT * '.
					' FROM #__appformer ' .
					' WHERE id_app = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data_f = $this->_db->loadObjectList();
			return (boolean) $this->_data_f;
		}
		return true;
	}
    function _loadData_d()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data_d))
		{
			$query = 'SELECT * '.
					' FROM #__appeducation ' .
					' WHERE id_app = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data_d = $this->_db->loadObjectList();
			return (boolean) $this->_data_d;
		}
		return true;
	}
    function _initData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			
		}
		return true;
	}
    function _initDataf()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data_f))
		{
			
		}
		return true;
	}
    function _initDatad()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data_d))
		{
			
		}
		return true;
	}
}
?>
