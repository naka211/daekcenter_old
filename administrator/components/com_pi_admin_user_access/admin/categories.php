<?php
/**
* @package Admin-User-Access (com_pi_admin_user_access)
* @version 2.0.2
* @copyright Copyright (C) 2007-2008 Carsten Engel. All rights reserved.
* @license GPL available versions: free, trail and pro
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
*/

//no direct access
if(!defined('_VALID_MOS') && !defined('_JEXEC')){
	die('Restricted access');
}

if(!$class_ua->ua_config['display_categories'] && $class_ua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_ua->echo_header();

//get usergroups from db
$class_ua->db->setQuery("SELECT * FROM #__pi_aua_usergroups ORDER BY name");
$usergroups = $class_ua->db-> loadObjectList();

//get category access from db
$class_ua->db->setQuery("SELECT category_groupid FROM #__pi_aua_categories");
$access_categories = $class_ua->db->loadResultArray();

//get sections from db
$class_ua->db->setQuery("SELECT id, title FROM #__categories ORDER BY title");
$categories = $class_ua->db->loadObjectList();

//spunk up headers in joomla 1.5
$class_ua->spunk_up_headers_1_5();



	//make javascript array from sections
	$javascript_array_categories = 'var categories = new Array(';
	$first = true;
	foreach($categories as $category){		
		if($first){
			$first = false;
		}else{
			$javascript_array_categories .= ',';
		}
		$javascript_array_categories .= "'".$category->id."'";
	}	
	$javascript_array_categories .= ');';
		
?>
<script language="javascript" type="text/javascript">

<?php echo $javascript_array_categories."\n"; ?>

function select_all(usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;	
	for (i = 0; i < categories.length; i++){
		box_id = categories[i]+'__'+usergroup_id;
		if(action==true){
			document.getElementById(box_id).checked = true;
		}else{
			document.getElementById(box_id).checked = false;
		}
	}	
}

</script>
<form name="adminForm" method="post" action="">
	<input type="hidden" name="option" value="com_pi_admin_user_access" />
	<input type="hidden" name="task" value="categories" />		
<p>
	<?php echo _pi_ua_lang_categories_info; ?>.
</p>
<table class="adminlist">
	<tr>		
		<th align="left">&nbsp;
						
		</th>
		<?php			
			$class_ua->loop_usergroups($usergroups);			
		?>		
		
	</tr>
		
	<?php
							
		$k = 1;		
		
		//row with select_all checkboxes
		echo '<tr class="row1">';
		echo '<td>'._pi_ua_lang_selectall.'</td>';
		foreach($usergroups as $usergroup){
			echo '<td style="text-align:center;"><input type="checkbox" name="checkall[]" value="" id="checkall_'.$usergroup->id.'" onclick="select_all('.$usergroup->id.',this.id);" /></td>';
		}
		echo '</tr>';
			
		$counter = 0;		
		foreach($categories as $category){						
			echo '<tr class="row'.$k.'"><td>'.$category->title.'</td>';			
			foreach($usergroups as $usergroup){
				$checked = '';
				if (in_array($category->id.'__'.$usergroup->id, $access_categories)) {
					$checked = 'checked="checked"';
				}
				echo '<td style="text-align:center;"><input type="checkbox" name="categoryAccess[]" id="'.$category->id.'__'.$usergroup->id.'" value="'.$category->id.'__'.$usergroup->id.'" '.$checked.' /></td>';
			}
			echo '</tr>';
			if($k==1){
				$k = 0;
			}else{
				$k = 1;
			}
			if($counter==15){
				echo '<tr><th>&nbsp;</th>';	
				$class_ua->loop_usergroups($usergroups);
				echo '</tr>';
				$counter = 0;
			}
			$counter = $counter+1;							
		}	

	?>			
</table>
</form>
<?php

$class_ua->display_footer();

?>