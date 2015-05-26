// JavaScript Document

function stick_one( a )
{
	var o = document.getElementById("selection");
	var s = Json.evaluate(o.value);	
	s[a.value] = a.checked;
	o.value = Json.toString(s);
}

function stick_all( n, fldName )
{
	var o = document.getElementById("selection");
	var s = Json.evaluate(o.value);	
	if (!fldName) {
		fldName = 'cb';
	}
	var f = document.adminForm;
	var c = f.toggle.checked;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			s[cb.value] = c;
		}
	}	
	o.value = Json.toString(s);
}