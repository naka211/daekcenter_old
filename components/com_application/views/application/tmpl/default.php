<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="left-content">
	<div class="boder-left-menu">
		<div class="left-menu">
			<h3>DIN FREMTID HOS</h3>
			<h3>DIN ISENKRÆMMER</h3>
			<div class="menuleft">
                {module Menu Left}
            </div>
		</div>
	</div>
	<a href="#"><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/ledige-stillinger_06.jpg" alt=""/></a>

</div>
<style>
.frm_application .updnWatermark{padding-top: 5px !important;}
</style>
<div class="boder-right-content">
	<div class="right-content frm_application">
		<div class="title-content">ANSØGNINGSSKEMA</div>
     	<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="applicationForm" id="applicationForm">
			<fieldset>
				<div class="w300 fl-left mr30" style="padding-top:10px;">
					<input name="name" id="name" class="txt-pop" type="text" value="" title="Navn" />
					<input name="address" id="address" class="txt-pop" type="text" value="" title="Adresse" />
					<input name="cpr" id="cpr" class="txt-pop" type="text" value="" title="CPR-nr." />
					<input name="phone" id="phone" class="txt-pop" type="text" value="" title="Mobil" />
					<input name="email" id="email" class="txt-pop" type="text" value="" title="E-mail" />
					
				</div>
				<div class="w300 fl-left right-form">
					 <label>Er du gift/samlevende?</label>
					 <input name="marriage" type="radio" value="Nej"/> <span>Nej</span> 
					 <input name="marriage" type="radio" value="Ja"/> <span>Ja</span><br/>
					 <label>Har du børn?</label><br/>
					 <input name="children" type="radio" value="Nej"/> <span>Nej</span> 
					 <input name="children" type="radio" value="Ja"/> <span style="margin-right: 10px;">Ja</span>
					 <input name="numberchildren" class="txt-pop" style="float:none !important;width:100px; margin-top:0px; margin-bottom:0px;" type="text" value="" title="Hvor mange"/>
					 <div class="clear"></div>
					 <label>Ansættelsesform</label><br/>
					 <input name="contact" type="radio" value="Fuldtid"/> <span>Fuldtid</span> 
					 <input name="contact" type="radio" value="Deltid"/> <span>Deltid</span>
					 <input name="contact" type="radio" value="Efter skole"/> <span>Efter skole</span> 
					 <input name="contact" type="radio" value="Weekend"/> <span>Weekend</span>
				     <div class="clear" style="padding-bottom: 10px;"></div>
					 <input name="works" id="works" style="margin-bottom: 0px;" class="txt-pop" type="text" value="" title="Nuværende beskæftigelse"/>
					 <label>Tidligere ansat i butik?</label>
					 <input name="former" type="radio" value="Nej"/> <span>Nej</span> 
					 <input name="former" type="radio" value="Ja"/> <span>Ja</span><br/>
				</div>
				<div class="clear"></div>
				<div class="mt10">
					<label>Tidligere erhvervsmæssig beskæftigelse</label>
					<table class="occup-form">
						<tr>
							<td style="width:30%; background:silver;">Sted</td>
							<td style="width:40%; background:silver;">Jobfunktion</td>
							<td style="width:15%; background:silver;">Fra</td>
							<td style="width:15%; background:silver;">Til</td>
						</tr>
						<tr>
							<td><input name="f_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_job[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
						<tr>
							<td><input name="f_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_job[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
						<tr>
							<td><input name="f_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_job[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
						<tr>
							<td><input name="f_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_job[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
						<tr>
							<td><input name="f_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_job[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="f_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>

						
					</table>
				</div>
				<div class="mt10">
					<label>Uddannelse</label>
					<table class="occup-form">
						<tr>
							<td style="width:30%; background:silver;">Sted</td>
							<td style="width:40%; background:silver;">Uddannelse</td>
							<td style="width:15%; background:silver;">Fra</td>
							<td style="width:15%; background:silver;">Til</td>
						</tr>
						<tr>
							<td><input name="d_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_education[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
						<tr>
							<td><input name="d_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_education[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
						<tr>
							<td><input name="d_location[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_education[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_from[]" class="txt-occ" type="text" value=""/></td>
							<td><input name="d_to[]" class="txt-occ" type="text" value=""/></td>
						</tr>
					</table>
				</div>
				<div class="mt10">
					<label style="margin-right:37px;">Har du kørekort</label>
					 <input name="license" type="radio" value="Nej"/> <span>Nej</span> 
					 <input name="license" type="radio" value="under 3500 kg"/> <span>under 3500 kg</span>
					 <input name="license" type="radio" value="over 3500 kg"/> <span>over 3500 kg</span>
					 <div class="clear"></div>
					 <label>Ekstra bilag vedhæftet</label>
					 <input name="attached" type="radio" value="Nej"/> <span>Nej</span> 
					 <input name="attached" type="radio" value="Ja"/> <span>Ja</span>
				</div>
				<div class="mt10">
					<label>Bemærkninger (Udfyldes af butikken)</label>
					<textarea name="comments" class="txa-pop" style="width:665px; height:50px;margin-top: 10px;"></textarea>
				</div>
				<div class="mt10">
					<input name="received" id="received" class="txt-pop" style="width:540px;margin-right:10px;" type="text" value="" title="Modtaget af" />
					<input name="dato" id="dato" class="txt-pop" style="width:100px;" type="text" value="" title="Dato" />
				</div>
				<div class="clear"></div>
				<div class="btn-pop">
				<img style="cursor: pointer;" onclick="app_send();" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_send.jpg" />
				<img style="cursor: pointer;" onclick="app_reset();" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_cancle.jpg" />
				</div>
			</fieldset>
		
        
        <input type="submit" name="app_send" id="app_send" value="Send" style="display: none;" />
 
        <input type="hidden" name="option" value="com_application" />
        <input type="hidden" name="view" value="application" />
        <input type="hidden" name="id" value="" />
        <input type="hidden" name="task" value="submit" />
        <?php echo JHTML::_( 'form.token' ); ?>
        
        </form>
        <script language="javascript">
        	jQuery(document).ready(function() {	
                //jQuery.updnWatermark.attachAll();
        		jQuery("#applicationForm").validate({
        			errorPlacement: function(error, element) {			
        			},
        			invalidHandler: function(form, validator) {
        			  var errors = validator.numberOfInvalids();
        			  if (errors) {
                        jQuery('#alert').html(validator['errorList'][0]['message']);
            			jQuery('#backoverlay').show();
            			jQuery('#show_popup').show();
                        jQuery('#f_focus').html(validator['errorList'][0]['element'].name);
        				validator['errorList'][0]['element'].focus();
        			  } else {
        			  }
        			},
        			rules: {
                        name : "required",
                        address: "required",
                        phone: "required",
                        email: {
        					required: true,
        					email: true
        				},
                        received: "required",
                        dato: "required"
        				
        			},
        			messages: {
                        name: "<?php echo JText::_( 'Udfyld venligst navn' ); ?>",
                        address: "<?php echo JText::_( 'Udfyld venligst adresse' ); ?>",
                        phone: "<?php echo JText::_( 'Udfyld venligst telefon' ); ?>",
                        email: "<?php echo JText::_( 'Udfyld venligst email' ); ?>",
                        received: "<?php echo JText::_( 'Udfyld venligst modtaget af' ); ?>",
                        dato: "<?php echo JText::_( 'Udfyld venligst dato' ); ?>"
        			}
        		});
                close_popup=function(){		
            		var fel=jQuery('#f_focus').html();
                    jQuery('#backoverlay').hide();
            		jQuery('#show_popup').hide();
            		jQuery('#' + fel ).focus();
              };
              app_reset=function(){
                    document.forms[0].reset()
              };
              app_send=function(){
                    document.getElementById('app_send').click();
              }
        	});
        </script>
	</div>
</div>