<?php

jimport('joomla.application.component.controller');

class DateController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
	}

	function display( )
	{
		switch($this->getTask())
		{
			case 'add'     :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dateedit');
				JRequest::setVar( 'edit', false );

				$model = $this->getModel('dateedit');
				
			} break;
			case 'edit'    :
			{
                JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dateedit');
				JRequest::setVar( 'edit', true );

				$model = $this->getModel('howedit');
				
			} break;
		}

		parent::display();
	}

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$post	= JRequest::get('post');
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = (int) $cid[0];

		$model = $this->getModel('dateedit');

		if ($model->store($post)) {
			$msg = JText::_( 'Application have saved' );
		} else {
			$msg = JText::_( 'Error Saving Application' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		//$model->checkin();
		$link = 'index.php?option=com_date';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('dateedit');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_date' );
	}


	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_date' );
	}


	function orderup()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('weblink');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_weblinks');
	}

	function orderdown()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('weblink');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_weblinks');
	}

	function saveorder()
	{
        //print_r($_POST);die;
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$ordering 	= JRequest::getVar( 'ordering', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('dateedit');
		$model->saveorder($cid, $ordering);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_date', $msg );
	}
}
?>
