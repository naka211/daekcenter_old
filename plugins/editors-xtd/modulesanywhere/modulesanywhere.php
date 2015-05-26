<?php
/**
 * Popup page
 * Displays a list with modules
 *
 * @package    Modules Anywhere
 * @version    1.2.0
 * @since      File available since Release v1.1.5
 *
 * @author     Peter van Westen <peter@nonumber.nl>
 * @link       http://www.nonumber.nl/modulesanywhere
 * @copyright  Copyright (C) 2009 NoNumber! All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Add scripts and styles
$document = & JFactory::getDocument();
$script = "
	function modulesanywhere_jInsertEditorText( id, modulepos ) {
		f = document.getElementById( 'adminForm' );
		var style = f.style.value.trim();
		if ( modulepos ) {
			str = '{modulepos '+id+'}';
		} else {
			str = '{module '+id;
			if ( style ) {
				str += '|'+style;
			}
			str += '}';
		}
		window.parent.jInsertEditorText( str, '".JRequest::getVar( 'name' )."' );
		window.parent.document.getElementById( 'sbox-window' ).close();
	}
";
$document->addScriptDeclaration( $script );

$html = renderHTML();

function getPluginParams( $type, $plugin, $xml = '' ) {
	$db =& JFactory::getDBO();
	$query = "
		SELECT params
		FROM #__plugins
		WHERE folder = '".$type."'
		AND element = '".$plugin."'
		LIMIT 1";
	$db->setQuery( $query );
	$params = $db->loadResult();
	$params = new JParameter( $params );
	if ( $xml && isset( $params->_registry ) && isset( $params->_registry['_default'] ) && isset( $params->_registry['_default']['data'] ) ) {
		$params->loadSetupFile( $xml );
		$xml_params = $params->renderToArray();
		foreach( $params->_registry['_default']['data'] as $key => $val ) {
			if ( $val == '' && isset( $xml_params[$key] ) && isset( $xml_params[$key]['4'] ) ) {
				$params->_registry['_default']['data']->$key =  $xml_params[$key]['4'];
			}
		}
		foreach( $xml_params as $key => $val ) {
			if ( $key != '' && $key['0'] != '@' && !isset( $params->_registry['_default']['data']->$key ) && isset( $val['4'] ) ) {
				$params->_registry['_default']['data']->$key =  $val['4'];
			}
		}
	}

	return $params;
}

function renderHTML()
{
	global $mainframe;

	// Initialize some variables
	$db		=& JFactory::getDBO();
	$client	=& JApplicationHelper::getClientInfo( JRequest::getVar( 'client', '0', '', 'int' ) );
	$option	= 'modulesanywhere';

	$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'm.position',	'cmd' );
	$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
	$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
	$filter_position	= $mainframe->getUserStateFromRequest( $option.'filter_position',	'filter_position',	'',				'cmd' );
	$filter_type		= $mainframe->getUserStateFromRequest( $option.'filter_type',		'filter_type',		'',				'cmd' );
	$filter_assigned	= $mainframe->getUserStateFromRequest( $option.'filter_assigned',	'filter_assigned',	'',				'cmd' );
	$search			= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
	$search			= JString::strtolower( $search );

	$limit				= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg( 'list_limit' ), 'int' );
	$limitstart		= JRequest::getCmd( 'limitstart' );

	$where[] = 'm.client_id = '.( int ) $client->id;

	$joins[] = 'LEFT JOIN #__users AS u ON u.id = m.checked_out';
	$joins[] = 'LEFT JOIN #__groups AS g ON g.id = m.access';
	$joins[] = 'LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id';

	// used by filter
	if ( $filter_assigned ) {
		$joins[] = 'LEFT JOIN #__templates_menu AS t ON t.menuid = mm.menuid';
		$where[] = 't.template = '.$db->Quote( $filter_assigned );
	}
	if ( $filter_position ) {
		$where[] = 'm.position = '.$db->Quote( $filter_position );
	}
	if ( $filter_type ) {
		$where[] = 'm.module = '.$db->Quote( $filter_type );
	}
	if ( $search ) {
		$where[] = 'LOWER( m.title ) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
	}
	if ( $filter_state ) {
		if ( $filter_state == 'P' ) {
			$where[] = 'm.published = 1';
		} else if ( $filter_state == 'U' ) {
			$where[] = 'm.published = 0';
		}
	}

	$where		= ' WHERE ' . implode( ' AND ', $where );
	$join		= ' ' . implode( ' ', $joins );
	if ( $filter_order == 'm.ordering' ) {
		$orderby = ' ORDER BY m.position, m.ordering '. $filter_order_Dir;
	} else {
		$orderby = ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', m.ordering ASC';
	}

	// get the total number of records
	$query = 'SELECT COUNT( DISTINCT m.id )'
	. ' FROM #__modules AS m'
	. $join
	. $where
	;
	$db->setQuery( $query );
	$total = $db->loadResult();

	jimport( 'joomla.html.pagination' );
	$pageNav = new JPagination( $total, $limitstart, $limit );

	$query = 'SELECT m.*, u.name AS editor, g.name AS groupname, MIN( mm.menuid ) AS pages'
	. ' FROM #__modules AS m'
	. $join
	. $where
	. ' GROUP BY m.id'
	. $orderby
	;
	$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $db->loadObjectList();
	if ( $db->getErrorNum() ) {
		echo $db->stderr();
		return false;
	}

	// get list of Positions for dropdown filter
	$query = 'SELECT m.position AS value, m.position AS text'
	. ' FROM #__modules as m'
	. ' WHERE m.client_id = '.( int ) $client->id
	. ' GROUP BY m.position'
	. ' ORDER BY m.position'
	;
	$positions[] = JHTML::_( 'select.option',  '0', '- '. JText::_( 'Select Position' ) .' -' );
	$db->setQuery( $query );
	$positions = array_merge( $positions, $db->loadObjectList() );
	$lists['position']	= JHTML::_( 'select.genericlist',   $positions, 'filter_position', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', "$filter_position" );

	// get list of Positions for dropdown filter
	$query = 'SELECT module AS value, module AS text'
	. ' FROM #__modules'
	. ' WHERE client_id = '.( int ) $client->id
	. ' GROUP BY module'
	. ' ORDER BY module'
	;
	$db->setQuery( $query );
	$types[]		= JHTML::_( 'select.option',  '0', '- '. JText::_( 'Select Type' ) .' -' );
	$types			= array_merge( $types, $db->loadObjectList() );
	$lists['type']	= JHTML::_( 'select.genericlist',   $types, 'filter_type', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', "$filter_type" );

	// state filter
	$lists['state']	= JHTML::_( 'grid.state',  $filter_state );

	// template assignment filter
	$query = 'SELECT DISTINCT( template ) AS text, template AS value'.
			' FROM #__templates_menu' .
			' WHERE client_id = '.( int ) $client->id;
	$db->setQuery( $query );
	$assigned[]		= JHTML::_( 'select.option',  '0', '- '. JText::_( 'Select Template' ) .' -' );
	$assigned		= array_merge( $assigned, $db->loadObjectList() );
	$lists['assigned']	= JHTML::_( 'select.genericlist',   $assigned, 'filter_assigned', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', "$filter_assigned" );

	// table ordering
	$lists['order_Dir']	= $filter_order_Dir;
	$lists['order']		= $filter_order;

	// search filter
	$lists['search']= $search;

	outputHTML( $rows, $client, $pageNav, $lists );
}
function outputHTML( &$rows, &$client, &$page, &$lists )
{
	$user = & JFactory::getUser();

	$ordering = ( $lists['order'] == 'm.ordering' || $lists['order'] == 'm.position' );

	JHTML::_( 'behavior.tooltip' );
	$plugin_params = getPluginParams( 'system', 'modulesanywhere', JPATH_SITE.DS.'plugins'.DS.'system'.DS.'modulesanywhere.xml' );

	// Load plugin language
	$lang =& JFactory::getLanguage();
	$lang->load( 'plg_editors-xtd_modulesanywhere', JPATH_ADMINISTRATOR );
	$lang->load( 'plg_system_modulesanywhere', JPATH_ADMINISTRATOR );

	$document = & JFactory::getDocument();
	$document->addStyleSheet( JURI::root( true ).'/plugins/editors-xtd/modulesanywhere/css/modulesanywhere_popup.css' );
?>

	<form action="" method="post" name="adminForm" id="adminForm">
		<fieldset>
			<div style="float: left">
				<h1><?php echo JText::_( 'Modules Anywhere' ); ?></h1>
			</div>
			<div style="float: right">
				<div class="button2-left"><div class="blank hasicon cancel">
					<a rel="" onclick="window.parent.document.getElementById('sbox-window').close();" href="javascript://" title="<?php echo JText::_('Cancel') ?>"><?php echo JText::_('Cancel') ?></a>
				</div></div>
			</div>
		</fieldset>
			<p><?php echo JText::_('Click on one of the modules links') ?></p>
		<table class="adminlist adminform" cellspacing="1">
			<thead>
				<tr>
					<td width="1%" nowrap="nowrap"><?php echo JText::_( 'Module style' ); ?>:</td>
					<td>
						<select name="style" class="inputbox">
						<?php
							$style = JRequest::getCmd( 'style' );
							if ( !$style ) {
								$style = $plugin_params->get( 'style' );
							}

							echo '
								<option '.( ( $style == 'none' ) ? 'selected="selected" value=""' : 'value="none"' ).'>'.
									JText::_( 'No wrapping - raw output (none)' ).'</option>
								<option '.( ( $style == 'table' ) ? 'selected="selected" value=""' : 'value="table"' ).'>'.
									JText::_( 'Wrapped by Table - Column (table)' ).'</option>
								<option '.( ( $style == 'horz' ) ? 'selected="selected" value=""' : 'value="horz"' ).'>'.
									JText::_( 'Wrapped by Table - Horizontal (horz)' ).'</option>
								<option '.( ( $style == 'xhtml' ) ? 'selected="selected" value=""' : 'value="xhtml"' ).'>'.
									JText::_( 'Wrapped by Divs (xhtml)' ).'</option>
								<option '.( ( $style == 'rounded' ) ? 'selected="selected" value=""' : 'value="rounded"' ).'>'.
									JText::_( 'Wrapped by Multiple Divs (rounded)' ).'</option>
							';
						?>
						</select>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo JText::_( 'Filter' ); ?>:</td>
					<td>
						<input style="float:left;" type="text" name="search" id="search" value="<?php echo $lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
						<div class="button2-left"><div class="blank">
							<a rel="" onclick="this.form.submit();" href="javascript://" title="<?php echo JText::_('Go') ?>"><?php echo JText::_('Go') ?></a>
						</div></div>
						<div class="button2-left"><div class="blank">
							<a rel="" onclick="document.getElementById( 'search' ).value='';this.form.submit();" href="javascript://" title="<?php echo JText::_('Reset') ?>"><?php echo JText::_('Reset') ?></a>
						</div></div>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<?php
						echo $lists['assigned'];
						echo $lists['position'];
						echo $lists['type'];
						echo $lists['state'];
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="adminlist adminform" cellspacing="1">
			<thead>
				<tr>
					<th nowrap="nowrap" width="1%">
						<?php echo JHTML::_( 'grid.sort',   'ID', 'm.id', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th class="title">
						<?php echo JHTML::_( 'grid.sort', 'Module Name', 'm.title', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" width="7%">
						<?php echo JHTML::_( 'grid.sort',   'Position', 'm.position', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" width="7%">
						<?php echo JHTML::_( 'grid.sort', 'Published', 'm.published', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" width="1%">
						<?php echo JHTML::_( 'grid.sort', 'Order', 'm.ordering', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<?php
					if ( $client->id == 0 ) {
						?>
						<th nowrap="nowrap" width="7%">
							<?php echo JHTML::_( 'grid.sort', 'Access', 'groupname', @$lists['order_Dir'], @$lists['order'] ); ?>
						</th>
						<?php
					}
					?>
					<th nowrap="nowrap" width="5%">
						<?php echo JHTML::_( 'grid.sort',   'Pages', 'pages', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" width="10%"  class="title">
						<?php echo JHTML::_( 'grid.sort',   'Type', 'm.module', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="<?php echo ( $client->id == 0 ) ? '8' : '7'; ?>">
						<?php
							$pagination = str_replace( 'index.php?', 'plugins/editors-xtd/modulesanywhere/elements/modulesanywhere.page.php?name='.JRequest::getCmd( 'name', 'text' ).'&', $page->getListFooter() );
							$pagination = str_replace( 'index.php', 'plugins/editors-xtd/modulesanywhere/elements/modulesanywhere.page.php?name='.JRequest::getCmd( 'name', 'text' ), $pagination );
							echo $pagination;
						?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php
			$k = 0;
			for ( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
				$row = &$rows[$i];

				if ( $row->published ) {
					$img = 'tick.png';
					$alt = JText::_( 'Published' );
				} else {
					$img = 'publish_x.png';
					$alt = JText::_( 'Unpublished' );
				}
				$published = '<img src="'.JURI::base( true ).'/plugins/editors-xtd/modulesanywhere/images/'. $img .'" border="0" alt="'. $alt .'" />'
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td align="right">
						<?php echo '<label class="hasTip" title="{module '.$row->id.'}"><a href="javascript://" onclick="modulesanywhere_jInsertEditorText( \''.$row->id.'\' )">'.$row->id.'</a></label>';?>
					</td>
					<td>
						<?php echo '<label class="hasTip" title="{module '.$row->title.'}"><a href="javascript://" onclick="modulesanywhere_jInsertEditorText( \''.$row->title.'\' )">'.$row->title.'</a></label>'; ?>
					</td>
					<td align="center">
						<?php echo '<label class="hasTip" title="{modulepos '.$row->position.'}"><a href="javascript://" onclick="modulesanywhere_jInsertEditorText( \''.$row->position.'\', 1 )">'.$row->position.'</a></label>'; ?>
					</td>
					<td align="center">
						<?php echo $published; ?>
					</td>
					<td align="center">
						<?php echo $row->ordering; ?>
					</td>
					<?php
					if ( $client->id == 0 ) {
						?>
						<td align="center">
							<?php
								if ( !$row->access )  {
									$color_access = 'style="color: green;"';
								} else if ( $row->access == 1 ) {
									$color_access = 'style="color: red;"';
								} else {
									$color_access = 'style="color: black;"';
								}
								echo '<span '.$color_access.'>'.JText::_( $row->groupname ).'</span>';
							?>
						</td>
						<?php
					}
					?>
					<td align="center">
						<?php
						if ( is_null( $row->pages ) ) {
							echo JText::_( 'None' );
						} else if ( $row->pages > 0 ) {
							echo JText::_( 'Varies' );
						} else {
							echo JText::_( 'All' );
						}
						?>
					</td>
					<td>
						<?php echo $row->module ? $row->module : JText::_( 'User' ); ?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
		</table>
		<input type="hidden" name="name" value="<?php echo JRequest::getCmd( 'name', 'text' ); ?>" />
		<input type="hidden" name="client" value="<?php echo $client->id;?>" />
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
	</form>
<?php
}
?>