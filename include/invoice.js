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
function check888(){
	
	   if (document.getElementById('mem_id').value=='888')
	   {
		   
		   document.getElementById('status1').checked=true;
		   document.getElementById('delivery2').checked=true;

	   }
}
function detectKeyBoard(evt){
	
        if(document.all)evt = event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
        var obj = document.getElementById('debug');
        // obj.innerHTML = charCode; // For testing purpose only -> get current charcode
		if(evt.ctrlKey){
            if(charCode==38) count_total();
			 if(charCode==39) checkform();
            if(charCode==37) back(-1);
        }
}    
function count_total()
{
	var total=0.00;
	//cal basic total
	for(i=0;i<17;i++)
	{
		total=total+((document.getElementById('market_price'+i).value*document.getElementById('qty'+i).value*(100-document.getElementById('discount'+i).value))/100);
	}
	//find manpower total 找出苦力的total
	var manpower=0.00;
	var z=0;
	for(i=0;i<17;i++)
	{
		if (document.getElementById('manpowerX'+i).checked==true)
		{
		z=1;
		manpower=manpower+(document.getElementById('market_price'+i).value*document.getElementById('qty'+i).value);
		}
	}
	//count manpower total logic
	var totalmanpower=0.00;
	if (z==1){
	if (manpower>=2500)	{	
//	totalmanpower=manpower*0.06;20060625	
	totalmanpower=manpower*document.getElementById('special_man_power_percent').value/100;	
	}
	else	{	
		totalmanpower=2500*document.getElementById('special_man_power_percent').value/100;	

		
		}
		if (totalmanpower<150)
		totalmanpower=150;
		
		}
	
	//count specialmanpower total logic
	var totalspecialmanpower=0;
	//if (z==1){
	//totalspecialmanpower=manpower*(document.getElementById('special_man_power_percent').value)/100;
	//}
	
//	alert(total);
//	alert(totalmanpower);
//	alert(totalspecialmanpower);
	var subtotal=0;
	subtotal=total+totalmanpower+totalspecialmanpower;
//alert(subtotal);
	var subsubtotal=0;
	subsubtotal=(subtotal*((100-document.getElementById('subdiscount').value)/100))-document.getElementById('subdeduct').value;
	//subtotal - final discount - deuct
	
	//20080110 CreditCard Charge
	if (document.getElementById('creditcard').checked==true){
		subsubtotal=subsubtotal+Math.round(subsubtotal*1.5/100);
	}
	document.getElementById('countid').value=subsubtotal.toFixed(2);
	document.getElementById('mem_add').focus();
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

function clickCheckBoxDelivered(a)
{
	// $i 0-17
	if (document.getElementById('deliveredX'+a).checked)
	{
		document.getElementById('delivered'+a).value='Y';
	}
	else
	{
		document.getElementById('delivered'+a).value='N';
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
		for (i=0;i<17;i++)
		{
		document.getElementById('manpowerX'+i).checked=true;
		document.getElementById('manpower'+i).value='Y';
		}
	}
	else
	{
		for (i=0;i<17;i++)
		{
		document.getElementById('manpowerX'+i).checked=false;
		document.getElementById('manpower'+i).value='Y';
		}
	}
}
function selectall_delivered()
{

	if (document.getElementById('alldelivered0').checked)
	{
		for (i=0;i<17;i++)
		{
		document.getElementById('deliveredX'+i).checked=true;
		document.getElementById('delivered'+i).value='Y';
		}
	}
	else
	{
		for (i=0;i<17;i++)
		{
		document.getElementById('deliveredX'+i).checked=false;
		document.getElementById('delivered'+i).value='Y';
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
	if (document.form1.mem_name.value=="")
	{
		alert('請輸入客戶名稱');
		document.form1.mem_name.focus();
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
  
 function findPartNoAjax(goods_row, stockFlag) {
	index = goods_row;
	goods_partno = document.getElementById("goods_partno" + index).value;
	
	if (goods_partno == '') {
	//	document.getElementById("productCheckImg" + index).style.display = 'none';
	//	clearProductField(index);
	//	calSubTotal();
	}
	else {
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null) {
			alert ("Browser does not support HTTP Request");
			return;
		}
		
		//document.getElementById("real_stock" + index).value = 'Retrieving ...';

		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET","productxml.php?goods_partno=" + goods_partno,true);
		xmlhttp.send(null);
		
		 
	}
} 
 
function stateChanged() {
	if (xmlhttp.readyState==4) {
		xmlDoc=xmlhttp.responseXML;
		
		element = xmlDoc.getElementsByTagName("product_goods_partno")[0];
		//imgElem = document.getElementById("productCheckImg" + index);
		if (element == null) {
			//imgElem.src = "./images/wrong.png";
			//imgElem.style.display = 'inline';
			//document.getElementById("real_stock" + index).value = '0';
			return;
		}
		else {
			//imgElem.style.display = 'none';
		}
 
		document.getElementById("goods_partno" + index).value = xmlDoc.getElementsByTagName("product_goods_partno")[0].childNodes[0].nodeValue;
		
		node = xmlDoc.getElementsByTagName("product_goods_detail")[0].childNodes[0]
		if (node != null) document.getElementById("goods_detail" + index).value = node.nodeValue;
		

		node = xmlDoc.getElementsByTagName("product_market_price")[0].childNodes[0]
		if (node != null)	document.getElementById("market_price" + index).value = node.nodeValue;

		//check readonly
		node = xmlDoc.getElementsByTagName("product_readonly")[0].childNodes[0]
		
		if (node.nodeValue =='N') 
		document.getElementById("market_price" + index).readOnly=false;
		else
		document.getElementById("market_price" + index).readOnly=true;
		
// 20101223 adviced by WanChai Yan
	//	document.getElementById("qty" + index).value = "1";
	}
}

 function findMemIdAjax() {
	  
	mem_id = document.getElementById("mem_id").value;
	
	if (mem_id == '') {
	//	document.getElementById("productCheckImg" + index).style.display = 'none';
	//	clearProductField(index);
	//	calSubTotal();
	}
	else {
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null) {
			alert ("Browser does not support HTTP Request");
			return;
		}
		
		//document.getElementById("real_stock" + index).value = 'Retrieving ...';

		xmlhttp.onreadystatechange=memStateChanged;
		xmlhttp.open("GET","memberxml.php?mem_id=" + mem_id,true);
		xmlhttp.send(null);
		
		 
	}
} 


function memStateChanged() {
	if (xmlhttp.readyState==4) {
		xmlDoc=xmlhttp.responseXML;
		
		element = xmlDoc.getElementsByTagName("mem_id")[0];
		//imgElem = document.getElementById("productCheckImg" + index);
		if (element == null) {
			//imgElem.src = "./images/wrong.png";
			//imgElem.style.display = 'inline';
			//document.getElementById("real_stock" + index).value = '0';
			return;
		}
		else {
			//imgElem.style.display = 'none';
		}
 
		document.getElementById("mem_id").value = xmlDoc.getElementsByTagName("mem_id")[0].childNodes[0].nodeValue;
		
		node = xmlDoc.getElementsByTagName("mem_name")[0].childNodes[0]
		if (node != null) document.getElementById("mem_name").value = node.nodeValue;
		

		node = xmlDoc.getElementsByTagName("mem_credit_level")[0].childNodes[0]
		if (node != null)	document.getElementById("mem_credit_level").value = node.nodeValue;

		node = xmlDoc.getElementsByTagName("mem_alert")[0].childNodes[0]
		if (node != null)	document.getElementById("warning").value = node.nodeValue;

		 	node = xmlDoc.getElementsByTagName("mem_add")[0].childNodes[0]
		if (node != null)	document.getElementById("mem_add").value = node.nodeValue;

	}
}


function findAddressAlertAjax() {
	  
	mem_add = document.getElementById("mem_add").value;
	
	if (mem_add == '') {
	//	document.getElementById("productCheckImg" + index).style.display = 'none';
	//	clearProductField(index);
	//	calSubTotal();
	}
	else {
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null) {
			alert ("Browser does not support HTTP Request");
			return;
		}
		
		//document.getElementById("real_stock" + index).value = 'Retrieving ...';
 
		xmlhttp.onreadystatechange=addressStateChanged;
		xmlhttp.open("GET","addressxml.php?mem_add=" + mem_add,true);
		xmlhttp.send(null);
		
		 
	}
} 

function addressStateChanged() {

	if (xmlhttp.readyState==4) {
	 
		xmlDoc=xmlhttp.responseXML;
		
		element = xmlDoc.getElementsByTagName("address_mem_add")[0];
		//imgElem = document.getElementById("productCheckImg" + index);
		if (element == null) {
			//imgElem.src = "./images/wrong.png";
			//imgElem.style.display = 'inline';
			//document.getElementById("real_stock" + index).value = '0';
			return;
		}
		else {
			//imgElem.style.display = 'none';
		}
		
	 
		document.getElementById("mem_add").value = xmlDoc.getElementsByTagName("address_mem_add")[0].childNodes[0].nodeValue;
		

		node = xmlDoc.getElementsByTagName("address_alert")[0].childNodes[0]
		if (node != null)	document.getElementById("warning").value = node.nodeValue;



	}
}


function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}
