
function first_text_box_focus()
{
	document.form1.elements[0].focus();
}

function next_text_box(a)
{
	if (event.keyCode==13)
	{
	//alert(a);
	eval("document.form1.elements["+a+"].focus();");
	//alert(event.keyCode);
	return false;
	}

}

function AddrWindow(toccbcc){
	///var abc;
	//abc=document.form1.partno[0].value;
	//alert(abc);
	window.open('b.php?recid=' + toccbcc,"","width=600,height=360,scrollbars=yes");
}
