<?php
/**
* @version		$Id: view.html.php 9110 2009-12-31 09:09:04 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_products
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');

/**
 * HTML View class for the Dfi_products component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_products
 * @since 1.0
 */
class Dfi_productsViewDfi_product extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}
		
		if($this->getLayout() == 'default') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_product
		$dfi_product =& $this->get('data');

		if ($dfi_product->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_product->url);
		}

		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		global $mainframe, $option;
        
        //$dfi_supplier_id	= $mainframe->getUserStateFromRequest( $option.'dfi_supplier_id',		'dfi_supplier_id',		0,				'int' );
        
        $dfi_supplier_id = JRequest::getVar( 'dfi_supplier_id','','' );
        
		$db		=& JFactory::getDBO();
		$uri 	=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();
		
		$editor =& JFactory::getEditor();
		$add =  JRequest::getVar( 'add','','' );
        
        //print_r($add);die;
        if($add){
            $check = $add;
        }
        else{
            $check = 0;
        }

		//JHTML::stylesheet( 'dfi_product.css', 'administrator/components/com_dfi_product/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_product
		$dfi_product	=& $this->get('data');
		$isNew		= ($dfi_product->dfi_product_id < 1);
      
		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_product->catid ) );
		
        if($dfi_product->dfi_supplier_id){
            require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
    		$lists['dfi_supplier_id'] = Dfi_supplierHelper::dropdown($model->_prefix.'dfi_supplier_id', intval( $dfi_product->dfi_supplier_id ), NULL, FALSE);
		
        }
        else{
            require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
    		$lists['dfi_supplier_id'] = Dfi_supplierHelper::dropdown($model->_prefix.'dfi_supplier_id', intval( $dfi_supplier_id ), NULL, FALSE);
	
        }
        
		// helper
		require_once "components/com_dfi_campaign_to_product/helpers/dfi_campaign_to_product.php"; 
		$lists['campaigns'] = Dfi_campaign_to_productHelper::campaigns_dropdown($model->_prefix.'campaigns[]', intval($dfi_product->dfi_product_id));
		
		// active checkbox
		//require_once "components/com_dfi_product_dfi_product/helpers/dfi_product_dfi_product.php";
		//$json = Dfi_product_dfi_productHelper::selection($dfi_product->dfi_product_id);
		//$mainframe->setUserState( 'com_dfi_productselection', $json );
		//$mainframe->setUserState( 'com_dfi_productfilter_selection', 'S' );
		$lists['sortimentsvare'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'range', 'class="inputbox"', $dfi_product->range );
		
		$lists['forced_distribution'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'forced_distribution', 'class="inputbox"', $dfi_product->forced_distribution );
		
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_product/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
	
		if((float)$dfi_product->wee <= 0){
			$wee=0;
		}else $wee=(float)$dfi_product->wee;
        
        if((int)$dfi_product->sortimentsnetto <= 0){
			$sortimentsnetto=0;
		}else $sortimentsnetto=(int)$dfi_product->sortimentsnetto;
		
        
        if($dfi_product->hvidpris){
            $v_hvidpris = ((((float)$dfi_product->hvidpris * 0.8 ) - ((float)$dfi_product->nettopris)) / ((float)$dfi_product->hvidpris * 0.8 ))*100;
            $v_hvidpris=round($v_hvidpris);
        }
        else{
            $v_hvidpris=0;
        } 
        
        if($dfi_product->rodpris){
            $v_rodpris = ((((float)$dfi_product->rodpris * 0.8 ) - ((float)$dfi_product->nettopris)) / ((float)$dfi_product->rodpris * 0.8 ))*100;
            $v_rodpris=round($v_rodpris);
        }
        else{
            $v_nuspris=0;
        }
        
        if($dfi_product->nupris){
            $v_nuspris = ((((float)$dfi_product->nupris * 0.8 ) - ((float)$dfi_product->nettopris)) / ((float)$dfi_product->nupris * 0.8 ))*100;
            $v_nuspris=round($v_nuspris);
        }
        else{
            $v_rodpris=0;	
        }
		
        
        
        $this->assignRef('check',$check);
  
        $this->assignRef('v_hvidpris',$v_hvidpris);
		$this->assignRef('v_nuspris',$v_nuspris);
		$this->assignRef('v_rodpris',$v_rodpris);
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_product', $dfi_product);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_product/params.xml');
		$params = new JParameter(@$dfi_product->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
