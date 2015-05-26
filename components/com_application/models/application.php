<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class ApplicationModelApplication extends JModel
{
	function save_app($data=null){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__application SET ";
        $query .= "name = '" . $data['name'] . "', 
        address = '" . $data['address'] . "', 
        cpr = '" . $data['cpr'] . "', 
        phone = '" . $data['phone'] . "', 
        email = '" . $data['email'] . "', 
        marriage = '" . $data['marriage'] . "', 
        children = '" . $data['children'] . "', 
        numberchildren = '" . $data['numberchildren'] . "', 
        contact = '" . $data['contact'] . "', 
        works = '" . $data['works'] . "', 
        former = '" . $data['former'] . "', 
        license = '" . $data['license'] . "', 
        attached = '" . $data['attached'] . "', 
        comments = '" . $data['comments'] . "', 
        received = '" . $data['received'] . "', 
        dato = '" . $data['dato'] . "'";
        			
        $db->setQuery($query);		
        $db->query();
        
        return $db->insertid();
	}
    function save_former($id=null,$location=null,$job=null,$appfrom=null,$appto=null){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__appformer SET ";
        $query .= "id_app = '" . $id . "', 
        location = '" . $location . "', 
        job = '" . $job . "', 
        appfrom = '" .$appfrom . "', 
        appto = '" . $appto . "'";
			
        $db->setQuery($query);		
        $db->query();
        return true;
	}
    function save_appeducation($id=null,$location=null,$education=null,$appfrom=null,$appto=null){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__appeducation SET ";
        $query .= "id_app = '" . $id . "', 
        location = '" . $location . "', 
        education = '" . $education . "', 
        appfrom = '" .$appfrom . "', 
        appto = '" . $appto . "'";
			
        $db->setQuery($query);		
        $db->query();   
        return true;
	}
}
?>