// JavaScript Document

function stick_one( a )
{
	var o = document.getElementById("selection");
	var s = Json.evaluate(o.value);	
	
	var qty = document.getElementById("qty_"+a.value);
	var row = {
		'selection_state':a.checked,
		'quantity':qty.value
	};
	s[a.value] = row;
	o.value = Json.toString(s);
}

function extra_stick_one( qty, p )
{
	var o = document.getElementById("selection");
	var s = Json.evaluate(o.value);	
	var a = document.getElementById("cb"+p);
	var row = {
		'selection_state':a.checked,
		'quantity':qty.value
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
			var qty = document.getElementById("qty_"+cb.value);
			var row = {
				'selection_state':cb.checked,
				'quantity':qty.value
			};
			s[cb.value] = row;
		}
	}	
	o.value = Json.toString(s);
}