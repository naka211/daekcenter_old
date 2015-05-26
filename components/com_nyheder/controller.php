<?php

jimport('joomla.application.component.controller');
jimport('3rdparty.utils');

class NyhederController extends JController
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
		$mName = JRequest::getCmd( 'model', 'nyheder' );
		
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

		$link = 'index.php?option=com_nyheder';
		$this->setRedirect($link, $msg);
	}
}
?> 