// JavaScript Document

function jSelectItem(id, title, object) 
{
	if (id != '') {
	var o = document.getElementById(object);
	if (o) o.value = id;}
	if (title != '') {
	var o = document.getElementById(object + '_name');
	if (o) o.value = title;}
	document.getElementById('sbox-window').close();
}

function campaign_ajax(x)
{
	new XHR({
		onSuccess: function(req){
			//alert request
		}}).send('index3.php?option=com_dfi_kobreak&task=change_campaign','dfi_campaign_id='+x);
}

function supplier_ajax(x)
{
	/*
	new XHR({
		onSuccess: function(req){
			//alert request
			var o = document.getElementById('lev_betingelse');
			o.value = req;
		}}).send('index3.php?option=com_dfi_kobreak&task=change_supplier','dfi_supplier_id='+x);*/
}