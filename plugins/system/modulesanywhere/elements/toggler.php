<?php
/**
 * Element: Toggler
 * Adds slide in and out functionality to elements based on an elements value
 *
 * @package    NoNumber! Elements
 * @version    v1.0.9
 *
 * @author     Peter van Westen <peter@nonumber.nl>
 * @link       http://www.nonumber.nl
 * @copyright  Copyright (C) 2009 NoNumber! All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Toggler Element
 *
 * To use this, make a start xml param tag with the param and value set
 * And an end xml param tag without the param and value set
 * Everything between those tags will be included in the slide
 *
 * Available extra parameters:
 * param			The name of the reference parameter
 * value			a comma seperated list of value on which to show the elements
 */
class JElementToggler extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Toggler';

	function fetchTooltip( $label, $description, &$node, $control_name, $name )
	{
		return;
	}

	function fetchElement( $name, $value, &$node, $control_name )
	{
		$param =	$node->attributes( 'param' );
		$value =	$node->attributes( 'value' );
		$nofx =		$node->attributes( 'nofx' );

		$file_root =	str_replace( array( '\\', '/' ), DS, dirname( __FILE__ ) );
		$file_root = 	explode( DS, $file_root );
		foreach ( $file_root as $folder ) {
			if ( !in_array( $folder, array( 'administrator', 'components', 'modules', 'plugins', 'templates' ) ) ) {
				array_shift ( $file_root );
			} else {
				break;
			}
		}
		$file_root = implode( '/', $file_root );

		$document	=& JFactory::getDocument();
		$document->addScript( JURI::root(true).'/'.$file_root.'/toggler.js' );

		if ( $param != '' ) {
			$set_groups = explode( '|', $param );
			$set_values = explode( '|', $value );
			$ids = array();
			foreach ( $set_groups as $i => $group ) {
				$count = $i;
				if ( $count >= count( $set_values ) ) {
					$count = 0;
				}
				$values = explode( ',', $set_values[$count] );
				foreach ( $values as $val ) {
					$ids[] = $group.'.'.$val;
				}
			}
			$html = '<div id="'.implode( ' ', $ids ).'" class="toggler';
			if ( $nofx ) {
				$html .= ' toggler_nofx';
			}
			$html .= '">';
			$html .= '<table width="100%" class="paramlist admintable" cellspacing="1">';
			$html .= '<tr><td style="padding: 0px;" colspan="2">';
		} else {
			$html = '</td></tr></table>';
			$html .= '</div>';
		}

		return $html;
	}
}