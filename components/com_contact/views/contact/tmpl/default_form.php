<?php
/** $Id: default_form.php 11917 2009-05-29 19:37:05Z ian $ */
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class="title-content">Kontakt Os</div>
<p>Du er altid velkommen til at kontakte os, hvis du har interesse i at høre mere om Dias Danmark. Ønsker du yderligere informationer, kan du ringe til os på telefon 8661 4300 eller udfylde nedenstående skema.
Udfyld venligst skemaet og klik på "send" - så hører du fra os hurtigst muligt </p>
<div class="w300 fl-left mr30 mt10 p13">
    <img class="mb10" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/dfi-logo.jpg" alt=""/>
    <p>Dias Danmark a.m.b.a.
    Fabrikvej 13 - 8800 Viborg</p>
    <p>Tlf. 8661 4300 - fax 8661 1920</p>
    <p>E-mail: <a href="mailto:post@dias-danmark.dk">post@dias-danmark.dk</a></p>
</div>
<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="emailForm" id="emailForm">
	<fieldset>
		
		<div class="w300 fl-left">
			<input class="txt-pop" name="name" id="name" type="text" value="" title="Navn:" />
			<input class="txt-pop" name="address" id="address" type="text" value="" title="Adresse:" />
			<input class="txt-pop" name="post" id="post" maxlength="4" type="text" value="" title="Postnr:" />
			<input class="txt-pop" name="city" id="city" type="text" value="" title="By:" />
			<input class="txt-pop" name="phone" id="phone" type="text" value="" title="Telefon:" />
			<input class="txt-pop" name="email" id="email" type="text" value="" title="E-mail:" />
			<textarea class="txa-pop h100" name="text" id="text" title="Besked:"></textarea>
			<div class="clear"></div>
			<div class="mb20">
                <img style="cursor: pointer;" onclick="click_send();" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_send.jpg"/>
                <img style="cursor: pointer;" onclick="reset_form();" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_cancle.jpg"/>
            
            </div>
		</div>
	
	</fieldset>
 <input type="submit" name="send" id="send" value="Send" style="display: none;" />
 
<input type="hidden" name="option" value="com_contact" />
<input type="hidden" name="view" value="contact" />
<input type="hidden" name="id" value="<?php echo $this->contact->id; ?>" />
<input type="hidden" name="task" value="submit" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>

<script language="javascript">
	jQuery(document).ready(function() {	
        //jQuery.updnWatermark.attachAll();
		jQuery("#emailForm").validate({
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
				}
				
			},
			messages: {
                name: "<?php echo JText::_( 'Udfyld venligst navn' ); ?>",
                address: "<?php echo JText::_( 'Udfyld venligst adresse' ); ?>",
                phone: "<?php echo JText::_( 'Udfyld venligst telefon' ); ?>",
                email: "<?php echo JText::_( 'Udfyld venligst email' ); ?>"
			}
		});
        close_popup=function(){		
    		var fel=jQuery('#f_focus').html();
            jQuery('#backoverlay').hide();
    		jQuery('#show_popup').hide();
    		jQuery('#' + fel ).focus();
      };
      reset_form=function(){
            document.forms[0].reset()
      };
      click_send=function(){
            document.getElementById('send').click();
      }
	});
</script>
