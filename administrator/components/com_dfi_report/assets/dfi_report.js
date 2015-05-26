// JavaScript Document

function stick_one( a )
{
	var o = document.getElementById("selection");
	var s = Json.evaluate(o.value);	
	var row = {
		'selection_state':a.checked
	};
	s[a.value] = row;
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
			var row = {
				'selection_state':c
			};
			s[cb.value] = row;
		}
	}	
	o.value = Json.toString(s);
}