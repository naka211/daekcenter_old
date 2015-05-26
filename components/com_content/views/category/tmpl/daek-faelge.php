
				<div class="w950" id="contentFrame">
					<?php 
					$db = &JFactory::getDBO();
					$query = "SELECT * FROM #__content WHERE id=26";
					$db->setQuery($query);
					$row = $db->loadObject();
					?>
					<?php echo $row->introtext?>
					
					   {module logo}
				
					<a href="index.php" class="back">Tilbage til forsiden</a>
				</div>
						