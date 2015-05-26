<?php

jimport('joomla.application.component.controller');

class Search_resultController extends JController
{
    /**
     * Method to display the view
     *
     * @access    public
     */
    function display()
    {
        //parent::display();
		
		$vLayout = JRequest::getCmd( 'layout', 'default' );
		$vName = JRequest::getCmd( 'view', 'index' );
		$mName = JRequest::getCmd( 'model', 'search_result' );
		
		$document = &JFactory::getDocument();
		$vType = $document->getType();

		// Get/Create the view
		$view = &$this->getView( $vName, $vType);

		// Get/Create the model
		if ($mName && $model = &$this->getModel($mName)) {
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}

		// Set the layout
		$view->setLayout($vLayout);

		// Display the view
		$view->display();
    }
	
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$msg = JText::_( 'Save' );
		
		global $mainframe, $option;
		
		$post	= JRequest::get('post');
		
		$mainframe->setUserState( 'searchword', $post['searchword'] );
		$mainframe->setUserState( 'firma', '' );
		$mainframe->setUserState( 'postnumber', '' );

		$link = 'index.php?option=com_search_result';
		$this->setRedirect($link, $msg);
	}
}
?> 