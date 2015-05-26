<?php

jimport('joomla.application.component.controller');

class Salgsrapportering2Controller extends JController
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
		$mName = JRequest::getCmd( 'model', 'salgsrapportering2' );
		
		$document = &JFactory::getDocument();
		$vType = $document->getType();

		// Get/Create the view
		$view = &$this->getView( $vName, $vType);

		// Get/Create the model
		if ($mName && $model = &$this->getModel($mName)) {
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}
		
		// message		
		/*global $mainframe, $option;
		$msg = $mainframe->setUserState( $option.'msg' );
		$mainframe->setUserState( $option.'msg', '' );
		$view->assignRef( 'msg', $msg );*/

		// Set the layout
		$view->setLayout($vLayout);

		// Display the view
		$view->display();
    }
	
	function submit()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$post	= JRequest::get('post');
		
		// message
		$msg = JText::_( 'Submit' );
		
		/*global $mainframe, $option;
		$mainframe->setUserState( $option.'msg', $msg  );*/

		$link = 'index.php?option=com_salgsrapportering2';
		$this->setRedirect($link, $msg);
	}
}
?> 