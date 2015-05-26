<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
//session_start();

//$sAmount = $HTTP_SESSION_VARS["Amountp"];
//$sAmount = number_format($sAmount, 2, ',', ''); //"Amount as string". Decimal separator, brug ","

//if(isset($SessionID)) {
//  session_id($SessionID); // Hvis session id er defineret, kan den bruges
//}

//$bDebug = false; // Skal sættes til false ved normal brug. Hvis den er true. Bruges kun i testmode.



$sOKURL = "http://".getenv("SERVER_NAME")."/hudlagenscremeshop/success.php"; // Returnere hvis indbetalingen gik godt
$sFAILURL = "http://".getenv("SERVER_NAME")."/hudlagenscremeshop/error.php"; // Returnere hvis inbetalingen fejlede

// Hvis De vil have kreditkort logoer med på indtasningssiden, samt stylesheet

//$sTunnelURI = "https://pay.dandomain.dk/securetunnel-bin.asp?url="; //Secure tunnel - is prepended all external URIs
//$sLogoDankort = "http://www.deres-domain.dk/images/icon_dankort.gif"; 
//$sLogoVISA = "http://www.deres-domain.dk/images/icon_visa.gif";
//$sLogoMastercard = "http://www.deres-domain.dk/images/icon_mastercard.gif";
//$sLogoCart = "http://www.deres-domain.dk/images/cart_big.gif";
//$sStylesheet = "http://www.deres-domæne.dk/styles.css"; Evt. brug af stylesheet
// Hent evt. logoer på www.betaling.dk



$sInputType = "hidden"; // Standard input felter sættes "hidden"
/*if($bDebug) {
  $sInputType = "text"; // Text felter sættes til "Text" ved test
}*/                                            
//echo $_REQUEST['MerchantNumber']."/".$_REQUEST['sAmount']."/".$_REQUEST['OrderID'];
//var_dump($_REQUEST);
$arr=split("_",$_REQUEST['OrderID']);

//var_dump($_SESSION);
?> 
	
     <!--<div class="title_4">DANDOMAIN</div>
  <div class="m10l p10t">-->
<form method="POST" action="https://pay.dandomain.dk/securecapture.asp" name="payform" autocomplete="off">
      <? //if ($bDebug) { ?>
        <!--<input type="<?php //echo $sInputType ?>" name="TestMode" value="1" />--> <!-- Bruges i Test mode. Husk manuelt at tilrettet Merchantnr. til 1234567 -->
      <? //} ?>
         <!-- CurrentcyID vælger hvilken valuta der handles med -->     
      	<input type="<?php echo $sInputType ?>" name="CurrencyID" title="CurrencyID" value="208">
    	<input type="<?php echo $sInputType ?>" name="MerchantNumber" title="MerchantNumber" value="<?php echo $arr[2] ?>" >
    	<input type="<?php echo $sInputType ?>" name="OrderID" title="OrderID" value="<?php echo $arr[0] ?>" >
    	<input type="<?php echo $sInputType ?>" name="Amount" title="Amount" value="<?php echo $arr[1] ?>" >
    	<input type="<?php echo $sInputType ?>" name="OKURL" title="OKURL" value="<?php echo $sOKURL ?>" >
    	<input type="<?php echo $sInputType ?>" name="FAILURL" title="FAILURL" value="<?php echo $sFAILURL ?>" > 
        <input type="<?php echo $sInputType ?>" name="SessionId" title="SessionId" value="<?php echo $arr[3]; //array_pop(array_keys($_REQUEST)); ?>" > 
        <!--<input type="hidden" name="CardTypeID" value="0">-->
        
  		<input type="hidden" name="CheckSum" value=""><p>Betalingsmetode</p><select name="CardTypeID">
        <option value="1">Dankort</option>
        <option value="2">Visa</option>
        <option value="3"> Mastercard</option>
        <option value="4">Visa / Dankort</option>
        </select>
      <!--<p>
        I alt trækkes DKK <strong><?php echo $arr[1] ?></strong> på nedenstående kort.
      </p>-->
      	<p id="payrule">Indtast kort nummer, udløbsdato, og kontrolkode (CVC):</p><br />
  			<input class="textboxgray" type="text" name="CardNumber" maxlength="30" />&nbsp;
  			<select name="ExpireMonth" class="textboxgray"  style="width: 40px;">
    			<?
    			  for($month = 1; $month < 13; $month++) { 
    			    echo '<option value="'.$month.'">'.sprintf("%02u",$month).'</option>'; 
    			  }
    			?>
  			</select>&nbsp;
  			<select name="ExpireYear" class="textboxgray" style="width: 40px;">
    			<?
    				$thisyear = strftime("%y");
    				for($year = $thisyear; $year < ($thisyear + 12); $year++) {
    				  echo '<option value="'.$year.'">'.sprintf("%02u",$year).'</option>';
    				}
    			?>
  			</select>&nbsp;
  			<input class="textboxgray" type="text" name="CardCVC" maxlength="3" style="width:40px;"/>
      </p>
    	<p>
    		<input type="submit" value="Fortsæt &raquo;" /><!--<img style="cursor:pointer" onClick="document.payform.submit();"  class="m10t" alt="" src="<?php echo "http://".getenv("SERVER_NAME")."/hudlagenscremeshop" ?>/templates/mwc_hudlagenscremeshop/assets/img/Button.png"/>-->
    	</p>
    </form>
<script>
function SubmitPayForm()
{
	//document.payform.submitbtn.disabled=true;
	document.payform.submit();
}
</script>
</body>
</html>