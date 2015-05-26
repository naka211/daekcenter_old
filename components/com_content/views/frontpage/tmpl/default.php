<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 

$db = &JFactory::getDBO();
$query = "SELECT * FROM #__dfi_maps AS maps, #__dfi_shops AS shops WHERE maps.dfi_shop_id=shops.dfi_shop_id";
$db->setQuery($query);
$row = $db->loadObjectList();
//print "<pre>";
//print_r($row);die;
//print "</pre>";
?>


 	<div id="contentFrame" class="w950">
                            	<h1 class="h1-tt">HELE DANMARKS DÆKCENTER - <a href="index.php">WWW.DÆKCENTER.NU</a> - SOMMERDÆK - VINTERDÆK - FÆLGE</h1>

                                <!-- The Map -->
                                <div id="DCMap">
                                    <div class="map-inner">
									<?php for($i=0;$i<count($row);$i++) {?>
                                        <a id="loc<?php echo $i?>" href="<?php if($row[$i]->fax){?>index.php?option=com_content&view=category&layout=iframe-link&firma=<?php echo $row[$i]->dfi_shop_id?>&id=11&Itemid=27<?php }else echo "#" ?>" data-tooltip="tip<?php echo $i?>" style="top: <?php echo $row[$i]->y_value?>px; left: <?php echo $row[$i]->x_value ?>px;"></a> 
                                    
                                       <?php } ?>
                                    </div>
                                    <div class="follow-us">
                                        <a target="_blank" href="http://facebook.com/daekcenter" class="bntFollow">Følg os på</a>
                                    </div>
                                </div>
                                <!-- /The Map -->
                                  <div id="mapTooltip" class="map-tips">
								  <?php for($j=0;$j<count($row);$j++) {?>
                                	<div id="tip<?php echo $j?>" class="tip">
                                    	<img src="<?php echo $row[$j]->filename?>" alt="" />
                                        <div class="info">
											<h3><?php echo $row[$j]->company_name ?></h3>
                                        	<?php echo $row[$j]->description; 
                                         ?><br />
												Tlf.: <?php echo $row[$j]->telephone; ?><br />
												<a href="<?php echo $row[$j]->website;?>"><?php echo $row[$j]->website?></a>
                                            </p>
                                        </div>
                                    </div>				
								<?php }?> 									
                                </div>
                                
                                <div id="DCLocations">
                                	<h1>Klik på din nærmeste forhandler</h1>
                                    <ul class="department-loc-list">
                                    	<li class="first"><a href="index.php?option=com_content&view=category&layout=jylland&id=11&Itemid=27">DÆKCENTER JYLLAND</a></li>
                                        <li><a href="index.php?option=com_content&view=category&layout=fyn&id=11&Itemid=27">DÆKCENTER FYN</a></li>
										
                                        <li><a href="index.php?option=com_content&view=category&layout=sjaelland&id=11&Itemid=27">DÆKCENTER SJÆLLAND</a></li>
                                        <li><a href="index.php?option=com_content&view=category&layout=falster&id=11&Itemid=27l">DÆKCENTER LOLLAND - FALSTER</a></li>
                                        <li class="last"><a href="index.php?option=com_content&view=category&layout=alle&id=11&Itemid=27">SE ALLE</a></li>
                                    </ul>
                                </div>
  
                        	</div> 