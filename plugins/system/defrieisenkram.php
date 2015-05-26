<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Defrieisenkram system plugin
 */
class plgSystemDefrieisenkram extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.0
	 */
	function plgSystemDefrieisenkram( &$subject, $config )
	{
			parent::__construct( $subject, $config );

			// Do some extra initialisation in this constructor if required	
			jimport('3rdparty.webshophelper');		
	}

	/**
	 * Do something onAfterInitialise 
	 */
	function onAfterInitialise()
	{
	}

	/**
	 * Do something onAfterRoute 
	 */
	function onAfterRoute()
	{
	}

	/**
	 * Do something onAfterDispatch 
	 */
	function onAfterDispatch()
	{
	}

	/**
	 * Do something onAfterRender 
	 */
	function onAfterRender()
	{
	}
}
?>