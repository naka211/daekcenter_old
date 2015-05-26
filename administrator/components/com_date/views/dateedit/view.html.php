<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );


class DateViewDateedit extends JView{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		$date =& $this->get('data');

		if ($date->url) {
			// redirects to url if matching id found
			$mainframe->redirect($date->url);
		}

		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		global $mainframe, $option;
		
        $db		=& JFactory::getDBO();
		$uri 	=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();

		$lists = array();

		$data	=& $this->get('data');
        $dataf	=& $this->get('dataf');
        $datad	=& $this->get('datad');
        
		JFilterOutput::objectHTMLSafe( $how, ENT_QUOTES, 'description' );

		$file 	= JPATH_COMPONENT.DS.'models'.DS.'date.xml';
		$params = new JParameter( $how->params, $file );

		$this->assignRef('lists',		$lists);
		$this->assignRef('data',		$data);
        $this->assignRef('dataf',		$dataf);
        $this->assignRef('datad',		$datad);
		$this->assignRef('params',		$params);

		parent::display($tpl);
	}
}