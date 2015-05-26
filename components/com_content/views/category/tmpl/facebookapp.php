<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$db = &JFactory::getDBO();
$query = "SELECT *, shops.filename, shops.fax FROM #__dfi_maps AS maps, #__dfi_shops AS shops WHERE maps.dfi_shop_id=shops.dfi_shop_id";
$db->setQuery($query);
$row = $db->loadObjectList();

?>
	<script type="text/javascript">
	jQuery(document).ready(function(){	
    search=function(){  
        $('#send_search').click();
        return true;
	};    
    });

</script> 
<div id="w-contentFrame">
<div id="contentFrame">
                 <h1 class="f19 f-atial">HELE DANMARKS DÆKCENTER - <a class="cc3325" href="WWW.DÆKCENTER.NU">WWW.DÆKCENTER.NU</a> - SOMMERDÆK - VINTERDÆK - FÆLGE</h1>
				<div id="DCLocations">
                                	<h3>Klik på din nærmeste forhandler</h3>
				<div class="f-search">
					<form name="fromSearch" action="index.php" method="get">
						<input type="hidden" value="com_content" name="option">
						<input type="hidden" value="search" name="view">
						<a onclick="search();" href="javascript:void(0);" class="bntGo" href="#">Go</a>
							<button style="display:none;" id="send_search" name="send_search" type="submit">Click</button>
						<input type="text" value="" name="keyword">						
					</form>
				</div>
				<div class="clear"></div>
                                    <ul class="department-loc-list">
                                    	<li class="first"><a href="javascript:void(0)" onClick="goToByScroll('jylland')">DÆKCENTER JYLLAND</a></li>
                                        <li><a href="javascript:void(0)" onClick="goToByScroll('fyn')">DÆKCENTER FYN</a></li>
                                        <li><a href="javascript:void(0)" onClick="goToByScroll('sjaelland')">DÆKCENTER SJÆLLAND</a></li>
                                        <li><a href="javascript:void(0)" onClick="goToByScroll('falster')">DÆKCENTER LOLLAND - FALSTER</a></li>
                                    </ul>
                                </div>
                                <!-- The Map -->
                              <div id="DCMap1">
                                    <div class="map-inner">
									<?php for($i=0;$i<count($row);$i++) {?>
                                        <a id="loc<?php echo $i?>" href="<?php if($row[$i]->fax){?>index.php?option=com_content&view=category&layout=iframeapp-link&firma=<?php echo $row[$i]->dfi_shop_id?>&id=11&Itemid=27l<?php }else echo "#" ?>" data-tooltip="tip<?php echo $i?>" style="top: <?php echo ($row[$i]->y_value /(659/523))?>px; left: <?php echo ($row[$i]->x_value /(881/698)) ?>px;"></a> 
                                    
                                       <?php } ?>
                                    </div>
									<div class="follow-us2">
                                        <a class="bntFollow2" href="http://facebook.com/daekcenter" target="_blank">Følg os på</a>
                                    </div><!--.follow-us-->
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
                                <!-- /The Map -->
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
                                            <div class="info2 grid-3 toppush-1">
                                            	<h3><?php echo $iarray[$i]->company_name;?></h3>
                                                <p><?php echo $iarray[$i]->description;?><br>
                                                Tlf. <?php  echo $iarray[$i]->telephone?><br>
                                                <a href="http://<?php echo $iarray[$i]->website?>"><?php echo $iarray[$i]->website?></a>
                                                </p>
                                            </div>
                                            <a href="<?php if($iarray[$i]->butiksnr){?>index.php?option=com_content&view=category&layout=iframeapp&firma=<?php echo $iarray[$i]->dfi_shop_id?>&id=11&Itemid=27 <?php }else echo "#" ?>" class="firma-kort-btn">Se firma info og kort</a>
                                        </div>
										<div class="fl w280">
										<!--	
										<div class="face clearfix">
                                                <a href="#"><img src="templates/daecenter/img/iconFace.png" alt=""></a>
                                         </div>
										  -->
								
										  <div id="fb-root"></div>
										 
                                      	<div class="opening-hours2">
                                      		<div class="inner">
                                                <h4>Åbningstider:</h4>
                                                <p><?php echo $iarray[$i]->open_hour?></span></p>            
                                                <a href="<?php if($iarray[$i]->email){?>index.php?option=com_content&view=category&layout=firmainfoapp-kort-iframe-sample&firmainfo_kort=<?php echo $iarray[$i]->dfi_shop_id?>&id=11&Itemid=27 <?php }else echo "#"  ?>" class="see-price-btn">SE DIN DÆK PRIS HER</a>
                                        	</div>  
                                        </div>
										</div>						
                                    </div>
									<?php }?>                                 
                        </div>
								<?php 
									$db2 = JFactory::getDBO();
									$query2 = "SELECT shop.email, shop.butiksnr, shop.dfi_shop_id, shop.company_name, shop.description, shop.telephone, shop.website, shop.butiksnr, shop.open_hour, shop.dfi_shops_catid, catalog.dfi_catalog_id, catalog.catid, catalog.title  FROM #__dfi_shops AS shop, #__dfi_catalogs AS catalog WHERE shop.dfi_shops_catid=catalog.dfi_catalog_id AND catalog.catid=8 GROUP BY shop.company_name";
									$db2->setQuery($query2);
									$iarray2 = $db2->loadObjectList();
								?>
                                <div class="departments-list" id="fyn">
                                	<h1 class="head-tt"><span>DÆKCENTER </span><span class="highlite">FYN</span></h1>
                          <?php for($j=0;$j<count($iarray2); $j++) {?>
									<div class="department-item">
                                    	<h2>Dækcenter <span class="highlite"><?php echo $iarray2[$j]->title?></span></h2>
                                        <div class="desc grid-5">
                                        	<img alt="" src="templates/daecenter/img/home-icon.png" class="illu-icon fl-left rightgap-2 toppush-1">
                                            <div class="info grid-3 toppush-1">
                                            	<h3><?php echo $iarray2[$j]->company_name;?></h3>
                                                <p><?php echo $iarray2[$j]->description;?><br>
                                                Tlf. <?php  echo $iarray2[$j]->telephone?><br>
                                                <a href="http://<?php echo $iarray2[$j]->website?>"><?php echo $iarray2[$j]->website?></a>
                                                </p>
                                            </div>
                                            <a href="<?php if($iarray2[$j]->butiksnr){?>index.php?option=com_content&view=category&layout=iframeapp&firma=<?php echo $iarray2[$j]->dfi_shop_id?>&id=11&Itemid=27 <?php }else echo "#" ?>" class="firma-kort-btn">Se firma info og kort</a>
                                        </div>
                                      	<div class="opening-hours grid-5">
                                      		<div class="inner">
                                                <h4>Åbningstider:</h4>
                                                <p><?php echo $iarray2[$j]->open_hour?></span></p>
                                               
                                                <a href="<?php if($iarray2[$j]->email){?>index.php?option=com_content&view=category&layout=firmainfo-kort-iframe-sample&firmainfo_kort=<?php echo $iarray2[$j]->dfi_shop_id?>&id=11&Itemid=27<?php }else echo "#"  ?>" class="see-price-btn">SE DIN DÆK PRIS HER</a>
                                        	</div>  
                                        </div>
										
                                    </div>
									<?php }?>       
                              </div>       

								<?php							  
								$db3 = JFactory::getDBO();
								$query3 = "SELECT shop.email, shop.butiksnr, shop.dfi_shop_id, shop.company_name, shop.description, shop.telephone, shop.website, shop.butiksnr, shop.open_hour, shop.dfi_shops_catid, catalog.dfi_catalog_id, catalog.catid, catalog.title  FROM #__dfi_shops AS shop, #__dfi_catalogs AS catalog WHERE shop.dfi_shops_catid=catalog.dfi_catalog_id AND catalog.catid=9 GROUP BY shop.company_name";
								$db3->setQuery($query3);
								$iarray3 = $db3->loadObjectList();
								?>
                                <div class="departments-list" id="sjaelland">
                                	<h1 class="head-tt"><span>DÆKCENTER </span><span class="highlite">SJÆLLAND</span></h1>
                                    <?php for($k=0;$k<count($iarray3); $k++) {?>
									<div class="department-item">
                                    	<h2>Dækcenter <span class="highlite"><?php echo $iarray3[$k]->title?></span></h2>
                                        <div class="desc grid-5">
                                        	<img alt="" src="templates/daecenter/img/home-icon.png" class="illu-icon fl-left rightgap-2 toppush-1">
                                            <div class="info grid-3 toppush-1">
                                            	<h3><?php echo $iarray3[$k]->company_name;?></h3>
                                                <p><?php echo $iarray3[$k]->description;?><br>
                                                Tlf. <?php  echo $iarray3[$k]->telephone?><br>
                                                <a href="http://<?php echo $iarray3[$k]->website?>"><?php echo $iarray3[$k]->website?></a>
                                                </p>
                                            </div>
                                            <a href="<?php if($iarray3[$k]->butiksnr){?>index.php?option=com_content&view=category&layout=iframeapp&firma=<?php echo $iarray3[$k]->dfi_shop_id?>&id=11&Itemid=27 <?php }else echo "#" ?>" class="firma-kort-btn">Se firma info og kort</a>
                                        </div>
                                      	<div class="opening-hours grid-5">
                                      		<div class="inner">
                                                <h4>Åbningstider:</h4>
                                                <p><?php echo $iarray3[$k]->open_hour?></span></p>
                                               
                                                <a href="<?php if($iarray3[$k]->email){?>index.php?option=com_content&view=category&layout=firmainfo-kort-iframe-sample&id=11&firmainfo_kort=<?php echo $iarray3[$k]->dfi_shop_id?>&Itemid=27 <?php }else echo "#"  ?>" class="see-price-btn">SE DIN DÆK PRIS HER</a>
                                        	</div>  
                                        </div>
									
                                    </div>
									<?php }?>                             
                                </div>          

									<?php								
										$db4 = JFactory::getDBO();
										$query4 = "SELECT shop.email, shop.butiksnr, shop.dfi_shop_id, shop.company_name, shop.description, shop.telephone, shop.website, shop.butiksnr, shop.open_hour, shop.dfi_shops_catid, catalog.dfi_catalog_id, catalog.catid, catalog.title  FROM #__dfi_shops AS shop, #__dfi_catalogs AS catalog WHERE shop.dfi_shops_catid=catalog.dfi_catalog_id AND catalog.catid=10 GROUP BY shop.company_name";
										$db4->setQuery($query4);	
										$iarray4 = $db4->loadObjectList();
									?>
                                <div class="departments-list" id="falster">
                                	<h1 class="head-tt"><span>DÆKCENTER </span><span class="highlite">LOLLAND - FALSTER</span></h1>
                                         <?php for($l=0;$l<count($iarray4); $l++) {?>
									<div class="department-item">
                                    	<h2>Dækcenter <span class="highlite"><?php echo $iarray4[$l]->title?></span></h2>
                                        <div class="desc grid-5">
                                        	<img alt="" src="templates/daecenter/img/home-icon.png" class="illu-icon fl-left rightgap-2 toppush-1">
                                            <div class="info grid-3 toppush-1">
                                            	<h3><?php echo $iarray4[$l]->company_name;?></h3>
                                                <p><?php echo $iarray4[$l]->description;?><br>
                                                Tlf. <?php  echo $iarray4[$l]->telephone?><br>
                                                <a href="http://<?php echo $iarray4[$l]->website?>"><?php echo $iarray4[$l]->website?></a>
                                                </p>
                                            </div>
                                            <a href="<?php if($iarray4[$l]->butiksnr){?>index.php?option=com_content&view=category&layout=iframeapp&firma=<?php echo $iarray4[$l]->dfi_shop_id ?>&id=11&Itemid=27 <?php }else echo "#" ?>" class="firma-kort-btn">Se firma info og kort</a>
                                        </div>
                                      	<div class="opening-hours grid-5">
                                      		<div class="inner">
                                                <h4>Åbningstider:</h4>
                                                <p><?php echo $iarray4[$l]->open_hour?></span></p>
                                               
                                                <a href="<?php if($iarray4[$l]->email){?>index.php?option=com_content&view=category&layout=firmainfo-kort-iframe-sample&firmainfo_kort=<?php echo $iarray4[$l]->dfi_shop_id?>&id=11&Itemid=27 <?php }else echo "#" ?>" class="see-price-btn">SE DIN DÆK PRIS HER</a>
                                        	</div>  
                                        </div>
										
                                    </div>
									<?php }?>                             
                                </div>
						</div>
						</div><!--wcontent-->