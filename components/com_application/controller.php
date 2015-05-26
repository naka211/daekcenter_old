<?php

jimport('joomla.application.component.controller');

class ApplicationController extends JController
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
		$vName = JRequest::getCmd( 'view', 'application' );
		$mName = JRequest::getCmd( 'model', 'application' );
		
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
	
	function submit()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		global $mainframe, $option;
		#$post	= JRequest::get('post');
        $data[] = "";
        
        $data['name']	    = JRequest::getVar( 'name',		    '',		'post' );
        $data['address']	= JRequest::getVar( 'address',		'',		'post' );
        $data['cpr']	    = JRequest::getVar( 'cpr',		    '',		'post' );
        $data['phone']	    = JRequest::getVar( 'phone',		'',		'post' );
        $data['email']	    = JRequest::getVar( 'email',		'',		'post' );
        $data['marriage']	= JRequest::getVar( 'marriage',		'',		'post' );
        $data['children']	= JRequest::getVar( 'children',		'',		'post' );
        $data['numberchildren']	= JRequest::getVar( 'numberchildren',		'',		'post' );
        $data['contact']	= JRequest::getVar( 'contact',		'',		'post' );
        $data['works']	    = JRequest::getVar( 'works',		'',		'post' );
        $data['former']	    = JRequest::getVar( 'former',		'',		'post' );
        $data['license']	= JRequest::getVar( 'license',		'',		'post' );
        $data['attached']	= JRequest::getVar( 'attached',		'',		'post' );
        $data['comments']	= JRequest::getVar( 'comments',		'',		'post' );
        $data['received']	= JRequest::getVar( 'received',		'',		'post' );
        $data['dato']	    = JRequest::getVar( 'dato',		    '',		'post' );
        
        
        $f_location	= JRequest::getVar( 'f_location',		'',		'post' );
        $f_job	    = JRequest::getVar( 'f_job',		    '',		'post' );
        $f_from	    = JRequest::getVar( 'f_from',		    '',		'post' );
        $f_to	    = JRequest::getVar( 'f_to',		        '',		'post' );
        
        $d_location	= JRequest::getVar( 'd_location',		'',		'post' );
        $d_education= JRequest::getVar( 'd_education',		'',		'post' );
        $d_from	    = JRequest::getVar( 'd_from',		    '',		'post' );
        $d_to	    = JRequest::getVar( 'd_to',		        '',		'post' );
        
        
        $model = $this->getModel('application');
        
        $id = $model->save_app($data);
        
        for($i=0;$i<count($f_location);$i++){
            if($f_location[$i]){
                $model->save_former($id,$f_location[$i],$f_job[$i],$f_from[$i],$f_to[$i]);
            }
        }
        for($i=0;$i<count($d_location);$i++){
            if($d_location[$i]){
                $model->save_appeducation($id,$d_location[$i],$d_education[$i],$d_from[$i],$d_to[$i]);
            }
        }
        
        
        $this->send_email($data,$f_location,$f_job,$f_from,$f_to,$d_location,$d_education,$d_from,$d_to);
		#print_r(count($f_location));die;
		
		$link = 'index.php?option=com_application&view=success&Itemid=24';
        $msg = JText::_( 'Save' );
		$this->setRedirect($link, $msg);
	}
    
    function send_email($data=null,$f_location,$f_job,$f_from,$f_to,$d_location,$d_education,$d_from,$d_to){
        
        global $mainframe, $option;
        
        $MailFrom 	= $mainframe->getCfg('mailfrom');
		$FromName 	= $mainframe->getCfg('fromname');

		// Prepare email body
		
        $subject	= "DIN ISENKRÆMMER ANSØGNINGSSKEMA";
                    
       	$prefix = "Dette er en forespørgsel fra kontakt-formular: ".JURI::base();
        $body_1  = $prefix."\n".'Navn: '.$data['name']."\n"
                .'Adresse: '.$data['address']."\n"
                .'CPR-nr.: '.$data['cpr']."\n"
                .'Mobil: '.$data['phone']."\n"
                .'E-mail: '.$data['email']."\n"
                
                .'Er du gift/samlevende?: '.$data['marriage']."\n"
                .'Har du børn?: '.$data['children']."\n"
                .'Hvor mange: '.$data['numberchildren']."\n"
                .'Ansættelsesform: '.$data['contact']."\n"
                .'Nuværende beskæftigelse: '.$data['works']."\n"
                .'Tidligere ansat i butik?: '.$data['former']."\n";
         
         $body_1 .= "\n\r\n\r\n";    
         $body_1 .= "Tidligere erhvervsmæssig beskæftigelse: \n\r\n";     
         $body_1 .= "Sted - Jobfunktion - Fra - Til \n\r\n"; 
         
            for($i=0;$i<count($f_location);$i++){
                if($f_location[$i]){
                    #$model->save_former($id,$f_location[$i],$f_job[$i],$f_from[$i],$f_to[$i]);
                    $body_1 .= $f_location[$i]." - ".$f_job[$i]." - ".$f_from[$i]." - ".$f_to[$i]."\n"; 
                }
            } 
         $body_1 .= "\n\r\n\r\n";
         $body_1 .= "Uddannelse: \n\r\n";
         $body_1 .= "Sted - Uddannelse - Fra - Til \n\r\n"; 
            for($i=0;$i<count($d_location);$i++){
                if($d_location[$i]){
                    #$model->save_appeducation($id,$d_location[$i],$d_education[$i],$d_from[$i],$d_to[$i]);
                    $body_1 .= $d_location[$i]." - ".$d_education[$i]." - ".$d_from[$i]." - ".$d_to[$i]."\n"; 
                }
            }
         $body_1 .= "\n\r\n\r\n";
                
         $body_1 .= 'Har du kørekort: '.$data['license']."\n"
                .'Ekstra bilag vedhæftet: '.$data['attached']."\n\r\n\r\n"
                .'Bemærkninger: '.stripslashes($data['comments'])."\n\r\n\r\n"
                .'Modtaget af: '.$data['received']."\n"
                .'Dato: '.$data['dato']."\n";
        
        $admin = $mainframe->getCfg('mailfrom');
        #$admin = "nguyen.cuong@mwc.vn";
        
		$mail = JFactory::getMailer();
        #$mail->IsHTML(true);
		$mail->addRecipient($admin);
		$mail->setSender( array( $data['email'], $data['name'] ) );
		$mail->setSubject( $FromName.': '.$subject );
		$mail->setBody( $body_1 );

		$sent = $mail->Send();
    }
    
}
?> 