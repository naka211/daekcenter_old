<?php

jimport('joomla.application.component.controller');

class KontaktController extends JController
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
		$mName = JRequest::getCmd( 'model', 'kontakt' );
		
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
    
    function submit(){
        global $mainframe;
        JRequest::checkToken() or jexit( 'Invalid Token' );

        $SiteName	= $mainframe->getCfg('sitename');

		$name		= JRequest::getVar( 'name',			'',			'post' );
		$email	    = JRequest::getVar( 'email',		'',			'post' );
		$vname	    = JRequest::getVar( 'vname',		'',	        'post' );
		$house	    = JRequest::getVar( 'house',	    '',			'post' );
		$vhouse		= JRequest::getVar( 'vhouse',		'',			'post' );
		$floor		= JRequest::getVar( 'floor',		'',			'post' );
        $page		= JRequest::getVar( 'page',		    '',			'post' );
        $post		= JRequest::getVar( 'post',		    '',			'post' );
        $phone		= JRequest::getVar( 'phone',		'',			'post' );
        $case1		= JRequest::getVar( 'case1',		'',			'post' );
        $cause		= JRequest::getVar( 'cause',		'',			'post' );
		$text		= JRequest::getVar( 'text',			'',			'post' );
        
        $subject	= "DIN ISENKRÆMMER KONTAKT";
        jimport('joomla.mail.helper');

        $MailFrom 	= $mainframe->getCfg('mailfrom');
		$FromName 	= $mainframe->getCfg('fromname');
        
       	$prefix = "Dette er en forespørgsel fra kontakt-formular: ".JURI::base();
        $body  = $prefix."\n".'Navn: '.$name."\n".'Email: '.$email."\n".'Vejnavn: '.$vname."\n";
        $body .= 'Hus nr.: '.$house."\n".'Hus bogst.: '.$vhouse."\n".'Etage: '.$floor."\n";
        $body .= 'Side: '.$page."\n".'Postnr.: '.$post."\n".'Telefonnr.: '.$phone."\n";
        $body .= 'Sag: '.$case1."\n".'Årsag: '.$cause."\n";
        $body .= "\r\n\r\n".'Kommentar: '.stripslashes($text);
        
		$mail = JFactory::getMailer();

		$mail->addRecipient( $MailFrom );
		$mail->setSender( array( $email, $name ) );
		$mail->setSubject( $FromName.': '.$subject );
		$mail->setBody( $body );

		$sent = $mail->Send();
        
        //Save DB
        
		$msg = JText::_( 'Save' );

		$link = 'index.php?option=com_kontakt';
		$this->setRedirect($link, $msg);
    }
	
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$msg = JText::_( 'Save' );

		$link = 'index.php?option=com_kontakt';
		$this->setRedirect($link, $msg);
	}
}
?> 