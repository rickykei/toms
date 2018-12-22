<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_showHideLayers() { //v3.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
function detectKeyBoard(evt){
	
        if(document.all)evt = event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        var obj = document.getElementById('debug');
        // obj.innerHTML = charCode; // For testing purpose only -> get current charcode
		if(evt.ctrlKey){
            if(charCode==38) count_total();
            
        }
}    
function countSubTotal(i)
{
	var temp=0;
	temp=document.getElementById('market_price'+i).value*document.getElementById('qty'+i).value;
	document.getElementById('subtotal'+i).value=temp-(temp/100)*document.getElementById('discount'+i).value;;
}
function count_total()
{
	var total=0.00;
	var totaltotal=0.00;
	//cal basic total
	for (i=0;i<10;i++)
	{
		total=total+parseFloat(document.getElementById('subtotal'+i).value);
	}
	document.getElementById('count_price').value=total;
	document.getElementById('total_price').value=total-(total/100)*document.getElementById('sub_discount').value;;
}
	
function first_text_box_focus()
{
	//document.getElementById('goods_id0');
	document.getElementById('goods_partno0').focus();
	//<label></label>document.getElementById('goods_id0').focus();
}
function clickCheckBox(a)
{
	// $i 0-17
	if (document.getElementById('manpowerX'+a).checked)
	{
		document.getElementById('manpower'+a).value='Y';
	}
	else
	{
		document.getElementById('manpower'+a).value='N';
	}
	
}
function clickCheckBoxDeductStock(a)
{
	// $i 0-17
	if (document.getElementById('deductStockX'+a).checked)
	{
		document.getElementById('deductStock'+a).value='N';
	}
	else
	{
		document.getElementById('deductStock'+a).value='Y';
	}
	
}
function clickCheckBoxCutting(a)
{
	// $i 0-17
	if (document.getElementById('cuttingX'+a).checked)
	{
		document.getElementById('cutting'+a).value='Y';
	}
	else
	{
		document.getElementById('cutting'+a).value='N';
	}
	
}
function selectall()
{

	if (document.getElementById('allmanpower0').checked)
	{
		for (i=0;i<18;i++)
		{
		document.getElementById('manpowerX'+i).checked=true;
		document.getElementById('manpower'+i).value='Y';
		}
	}
	else
	{
		for (i=0;i<18;i++)
		{
		document.getElementById('manpowerX'+i).checked=false;
		document.getElementById('manpower'+i).value='Y';
		}
	}
}


function next_text_box(evt,box)
{
  var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));

	if (charCode==13)
	{
	document.getElementById(box).focus();
	//alert(event.keyCode);
	return false;
	}

}

function popUp(URL,w,h) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width="+ w +",height="+h+"');");
}

function AddrWindow(toccbcc){
	///var abc;
	//abc=document.form1.partno[0].value;
	//alert(abc);
	//window.open('page_search_partno.php?recid=' + toccbcc,"Searh GoodsID","left=400,screenY=300,width=530,height=360,scrollbars=yes");
	popUp("page_search_partno.php?recid=" + toccbcc,700,500);
}
function SearchStaff(){
	///var abc;
	//abc=document.form1.partno[0].value;
	//alert(abc);
	window.open('page_search_staff.php?recid=3',"Search Sfaff","left=400,screenY=300,width=530,height=360,scrollbars=yes");
}
function checkform()
{
	if (document.form1.invoice_no.value=="")
	{
		alert('發票編號');
		document.form1.invoice_no.focus();
	}
	else
	{
	
		document.form1.submit();
		
	}
}
function DisplayKey(e) {
   if (e.keyCode) keycode=e.keyCode;
     else keycode=e.which;
   character=String.fromCharCode(keycode);
   window.status += character;
  }