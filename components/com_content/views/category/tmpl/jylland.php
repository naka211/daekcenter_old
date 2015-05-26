<?php // no direct access
defined('_JEXEC') or die('Restricted access');
/*$db = JFactory::getDBO();
$query = "SELECT shop.email, shop.butiksnr, shop.dfi_shop_id, shop.company_name, shop.street, shop.telephone, shop.website, shop.butiksnr, shop.open_hour, shop.dfi_shops_catid, catalog.dfi_catalog_id, catalog.catid, catalog.title  FROM #__dfi_shops AS shop, #__dfi_catalogs AS catalog WHERE shop.dfi_shops_catid=catalog.dfi_catalog_id AND catalog.catid=1 GROUP BY shop.company_name";
$db->setQuery($query);
$iarray = $db->loadObjectList();*/
/*print "<pre>";
print_r($iarray);die;
print "</pre>";*/
?>

<div class="w950" id="contentFrame">
                            	<h1 class="h1-tt">HELE DANMARKS DÆKCENTER - <a href="index.html">WWW.DÆKCENTER.NU</a> - SOMMERDÆK - VINTERDÆK - FÆLGE</h1>

                                <!-- The Map -->
								<?php
								$db1 = &JFactory::getDBO();
								$query1 = "SELECT *, shops.filename, shops.fax, shops.description FROM #__dfi_maps AS maps, #__dfi_shops AS shops, #__dfi_catalogs AS catalog WHERE maps.dfi_shop_id=shops.dfi_shop_id AND catalog.catid=1 AND shops.dfi_shops_catid=catalog.dfi_catalog_id  GROUP BY shops.company_name";
								$db1->setQuery($query1);
								$row1 = $db1->loadObjectList();
								?>
                                 <div id="DCMap">
                                    <div class="map-inner">
                                    <?php for($i=0;$i<count($row1);$i++) {?>
                                        <a id="loc<?php echo $i?>" href="<?php if($row1[$i]->fax){?>index.php?option=com_content&view=category&layout=iframe-link&firma=<?php echo $row1[$i]->dfi_shop_id?>&id=11&Itemid=27l<?php }else echo "#" ?>" data-tooltip="tip<?php echo $i?>" style="top: <?php echo $row1[$i]->y_value?>px; left: <?php echo $row1[$i]->x_value ?>px;"></a> 
                                    
                                       <?php } ?>
                                    </div>
                                </div>
                                <!-- /The Map -->
								
                               <div id="mapTooltip" class="map-tips">
								  <?php for($j=0;$j<count($row1);$j++) {?>
                                	<div id="tip<?php echo $j?>" class="tip">
                                    	<img src="<?php echo $row1[$j]->filename?>" alt="" />
                                        <div class="info">
											<h3><?php echo $row1[$j]->company_name ?></h3>
                                        	<?php echo $row1[$j]->description; ?>
                                         <br />
												Tlf.: <?php echo $row1[$j]->telephone; ?><br />
												<a href="<?php echo $row1[$j]->website;?>"><?php echo $row1[$j]->website?></a>
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
                                
                              <?php 
								$db = JFactory::getDBO();
								$query = "SELECT shop.email, shop.butiksnr, shop.dfi_shop_id, shop.company_name, shop.description, shop.telephone, shop.website, shop.butiksnr, shop.open_hour, shop.dfi_shops_catid, catalog.dfi_catalog_id, catalog.catid, catalog.title  FROM #__dfi_shops AS shop, #__dfi_catalogs AS catalog WHERE shop.dfi_shops_catid=catalog.dfi_catalog_id AND catalog.catid=1 GROUP BY shop.company_name";
								$db->setQuery($query);
								$iarray = $db->loadObjectList(); ?>
						<div class="departments-list" id="jylland">
                                	<h1 class="head-tt"><span>DÆKCENTER </span><span class="highlite">JYLLAND</span></h1>
                                    <?php for($i=0;$i<count($iarray); $i++) {?>
									<div class="department-item">
                                    	<h2>Dækcenter <span class="highlite"><?php echo $iarray[$i]->title?></span></h2>
                                        <div class="desc grid-5">
                                        	<img alt="" src="templates/daecenter/img/home-icon.png" class="illu-icon fl-left rightgap-2 toppush-1">
                                            <div class="info grid-3 toppush-1">
                                            	<h3><?php echo $iarray[$i]->company_name;?></h3>
                                                <p><?php echo $iarray[$i]->description;?><br>
                                                Tlf. <?php  echo $iarray[$i]->telephone?><br>
                                                <a href="http://<?php echo $iarray[$i]->website?>"><?php echo $iarray[$i]->website?></a>
                                                </p>
                                            </div>
                                            <a href="<?php if($iarray[$i]->butiksnr){?>index.php?option=com_content&view=category&layout=iframe&firma=<?php echo $iarray[$i]->dfi_shop_id?>&id=11&Itemid=27 <?php }else echo "#" ?>" class="firma-kort-btn">Se firmainfo og kort</a>
                                        </div>
                                      	<div class="opening-hours grid-5">
                                      		<div class="inner">
                                                <h4>Åbningstider:</h4>
                                                <p><?php echo $iarray[$i]->open_hour?></span></p>
                                               
                                                <a href="<?php if($iarray[$i]->email){?>index.php?option=com_content&view=category&layout=firmainfo-kort-iframe-sample&firmainfo_kort=<?php echo $iarray[$i]->dfi_shop_id?>&id=11&Itemid=27<?php }else echo "#"  ?>" class="see-price-btn">SE DIN DÆK PRIS HER</a>
                                        	</div>  
                                        </div>
						
                                    </div>
									<?php }?>                                 
                        </div>
  
                        	</div>