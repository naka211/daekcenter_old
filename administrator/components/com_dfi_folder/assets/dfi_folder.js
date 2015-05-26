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