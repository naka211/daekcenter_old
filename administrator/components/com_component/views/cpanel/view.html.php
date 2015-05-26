<?php
/**
* @version		$Id: view.html.php 31201 2009-11-02 22:14:59 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Components
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');

/**
 * HTML View class for the Components component
 *
 * @static
 * @package		Joomla
 * @subpackage	Components
 * @since 1.0
 */
class ComponentsViewCPanel extends JView
{
	/**
	 * Control Panel display function
	 *
	 * @param template $tpl
	 */
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'default') {
			$this->_displayForm($tpl);
			return;
		}

		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		$data = $this->get('data');
		$this->assignRef('data', $data);
		
		parent::display($tpl);
	}
	
	/**
	 * This method creates a standard cpanel button
	 *
	 * @param string $link
	 * @param string $image
	 * @param string $text
	 * @param string $path
	 * @param string $target
	 * @param string $onclick
	 * @access protected
	 */
	 function _quickiconButton( $link, $image, $text, $path=null, $target='', $onclick='' ) {
	 	if( $target != '' ) {
	 		$target = 'target="' .$target. '"';
	 	}
	 	if( $onclick != '' ) {
	 		$onclick = 'onclick="' .$onclick. '"';
	 	}
	 	if( $path === null || $path === '' ) {
	 		$path = 'components/com_component/assets/images/';
	 	}
		?>
		<div style="float:left;">
			<div class="icon">
				<a href="<?php echo $link; ?>" <?php echo $target;?>  <?php echo $onclick;?>>
					<?php echo JHTML::_('image.administrator', $image, $path, NULL, NULL, $text ); ?>
					<span><?php echo $text; ?></span>
				</a>
			</div>
		</div>
		<?	
	}	 
}