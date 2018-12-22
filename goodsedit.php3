<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#000000">
<?
   include("config.php3");

   $query="select * from goods where id=$ed";

   $rows=mysql_query($query);

   if (!$rows)
      echo "Too Bad!";
   else
   {
      $row=mysql_fetch_row($rows);
      list($id,$goods_id,$goods_detail,$market_price,$cost,$stock,$place,$status)=$row;

      if ($place==1)     //check which place select.
         $HK="checked";
      else if ($place==2)
         $KL="checked";
      else
         $NT="checked";
   }
?>




<script language="JavaScript">
function checkform()
{
	if(document.form1.goods_id.value == "")
	{
	alert ("請輸入貨品編號.");
	document.form1.goods_id.focus();
	}else
	{
        document.form1.submit();
        }

}

<!--

<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->

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
</script>
</head>

<form name="form1" method="post" action="goodsed.php3">
  <p><font face="新細明體" color="#FFFFFF" size="2">Goods ID:</font>
    <input type="text" name="goods_id" maxlength="13" value='<? echo $goods_id; ?>' class="login">
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">Goods Details:</font></p>
  <p> 
    <textarea name="goods_detail" cols="80" rows="8" class="login"><? echo $goods_detail; ?></textarea>
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">Market Price: $ </font>
    <input type="text" name="market_price" maxlength="9" value='<? echo $market_price; ?>' class="login">
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">Cost: $ </font>
    <input type="text" name="cost" maxlength="9" value='<? echo $cost; ?>' class="login">
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">Stock: </font>
    <input type="text" name="stock" maxlength="9" value='<? echo $stock; ?>' class="login">
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">旺角 </font>
    <input type="radio" name="place" value="1" <? echo $HK; ?> class="login">
    <font face="新細明體" color="#FFFFFF" size="2">大圍</font>
    <input type="radio" name="place" value="2" <? echo $KL; ?> class="login">
    
  </p>
  <p>
    <td colspan="3"><a href="JavaScript:checkform();"><img src="submit.gif" border=0 align=bottom></a>
</td>
    <input type="reset" name="Submit2" value="Reset" class="login">
  </p>
  </form>
</body>
</html>
