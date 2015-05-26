<?php 
/**
* @package Admin-User-Access (com_pi_admin_user_access)
* @version 1.2.9
* @copyright Copyright (C) 2007-2008 Carsten Engel. All rights reserved.
* @license commercial license 
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
*/

//no direct access
if(!defined('_VALID_MOS') && !defined('_JEXEC')){
	die('Restricted access');
}

function com_install(){
	global $database, $mosConfig_db, $mosConfig_dbprefix, $mainframe;	
	
	
	
	if( defined('_JEXEC') ){
		//joomla 1.5
		$database = JFactory::getDBO();
	}		
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_access_components (
  `id` int(11) NOT NULL auto_increment,
  `component_usergroupid` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_items (
  `id` int(11) NOT NULL auto_increment,
  `itemid_usergroupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_access_pages (
  `id` int(11) NOT NULL auto_increment,
  `pageid_usergroupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();
	
//take this out for free version
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_actions (
  `id` int(11) NOT NULL auto_increment,
  `action_usergroupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_itemtypes (
   `id` int(11) NOT NULL auto_increment,
  `type_groupid` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version
$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_sections (
   `id` int(11) NOT NULL auto_increment,
  `section_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_categories (
   `id` int(11) NOT NULL auto_increment,
  `category_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_modules (
   `id` int(11) NOT NULL auto_increment,
  `module_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_plugins (
   `id` int(11) NOT NULL auto_increment,
  `plugin_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_usergroups (
	   `id` int(11) NOT NULL auto_increment,
  `name` tinytext NOT NULL,
  `email` text NOT NULL,
  `ua_toolbar` tinyint(1) NOT NULL default '0',
  `j_toolbar` tinyint(1) NOT NULL default '0',
  `extra` tinytext NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
	)");
		$database->query();
		
	$database->setQuery("SHOW COLUMNS FROM #__pi_aua_usergroups");
	$columns = $database->loadResultArray();	
	if(!in_array('description', $columns)){
		$database->setQuery("ALTER TABLE #__pi_aua_usergroups ADD `description` MEDIUMTEXT NOT NULL AFTER `extra`");
		$database->query();
	}	
		
		$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_userindex (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
)");
$database->query();

if( defined('_JEXEC') ){
	//joomla 1.5
	$icon_path = 'components';
}else{
	//joomla 1.0.x
	$icon_path = '../administrator/components';
}

	//do icon
	$database->setQuery("UPDATE #__components SET admin_menu_img='$icon_path/com_pi_admin_user_access/images/icon.gif' WHERE link='option=com_pi_admin_user_access'");
	$database->query();


	//table for configuration
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__pi_aua_config (
  `id` varchar(255) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY  (`id`)  
)");
	$database->query();

	//check if config is empty, if so insert default config
	$database->setQuery("SELECT id FROM #__pi_aua_config WHERE id='aua' ");
	$rows = $database -> loadObjectList();
	$aua_config = '';
	if(count($rows) > 0){
		$row = $rows[0];
		$aua_config = $row->id;
	}
	
	if($aua_config==''){		
		$configuration = 'language=english
default_tab=usergroups
redirect_to_pi=false
use_toolbar=true
display_usergroups=true
display_users=true
default_usergroup=
display_pagesaccess=true
active_pagesaccess=false
inherit_rights_parent_page=true
display_itemtypes=true			
active_itemtypes=false
display_items=true
active_items=false			
display_itemtype_in_list=false			
display_sections=true
active_sections=false
display_categories=true
active_categories=false
display_actions=true
active_actions=false
display_components=true
display_toolbars=true
show_joomla_group=true
disable_joomla_group_selectbox=false
item_inherits_access=no_default_has_access	
com_content_access=category_access
activate_modules=false
display_modules=true
activate_plugins=false
display_plugins=true
activate_toolbars=false
display_toolbar_superadmin=true
page_props=true	
item_props=true	
menutypes=mainmenu;Main Menu
dropdown_buttons=2;media,4;community
extra_buttons=			
notify_from_address=no-reply@pages-and-items.com
notify_from_name=	
use_componentaccess=false
components=com_poll;Polls;com_poll;0,com_pi_pages_and_items;Pages and Items;com_pi_pages_and_items;0,com_pi_admin_user_access;Admin User Access;com_pi_admin_user_access;0,com_banners;Banners;com_banners;2,com_media;Media Manager;com_media;2,com_trash;Trash manager;com_trash;0
';

		//insert fresh config
		$database->setQuery( "INSERT INTO #__pi_aua_config SET id='aua', config='$configuration'");
		$database->query();
	}
	
}

?>
<div style="width: 800px; text-align: left;">
	<h2>Admin-User-Access</h2>	
	<p>
		Thank you for using Admin-User-Access.
	</p>
	<p>
		In order for component Pages-and-Items to work with component Admin-User-Access, enable this in the <a href="index2.php?option=com_pi_pages_and_items&task=config&tab=admin-user-access">Pages-and-Items configuration</a>.
	</p>
	<p>
		Check <a href="http://www.pages-and-items.com" target="_blank">www.pages-and-items.com</a> for:
		<ul>
			<li>updates</li>
			<li>support</li>
			<li>documentation</li>	
			<li>email notification service for updates and new extensions</li>		
		</ul>
	</p>
</div>