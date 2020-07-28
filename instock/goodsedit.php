<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#000000">
<?
   include("../include/config.php");

   $query="select * from goods where id=$ed";

   $rows=mysql_query($query);

   if (!$rows)
      echo "Too Bad!";
   else
   {
      $row=mysql_fetch_array($rows);
	
	  $id=$row['id'];
	  $ref_no=$row['ref_no'];
	  $goods_id=$row['goods_partno'];
	 $company_name=$row['in_comp_name'];
	  $cost=$row['cost'];
	  $stock=$row['stock'];
	  $place=$row['place'];
	  $status=$row['status'];
	  
      if ($place==1)     //check which place select.
         $HK="checked";
      else if ($place==2)
         $KL="checked";
      else if ($place==3)
         $TKW="checked";
		 
		 $result2 = mysql_query ("select * from goods_company order by company_name");
		 $result3 = mysql_num_rows($result2);
		$row3 = mysql_fetch_array($result2);
   }
   
 
?>




<script language="JavaScript">
function checkform()
{
	if(document.form1.goods_partno.value == "")
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
<input type="hidden" name="id" value="<?=$id?>">
 <p><font   color="#FFFFFF" size="2">Ref No.:</font>
    <input type="text" name="ref_no" maxlength="13" value='<? echo $ref_no; ?>'  class="login">
  </p>
  
  <p>
   <select name="company_name" size="1">
          <? for ($i=1;$i<=$result3;$i++)
		{
		if ($row3["company_name"]==$company_name)
		echo "<option value=\"".$row3["company_name"]."\" selected>".$row3["company_name"]."</option>";
		else
		echo "<option value=\"".$row3["company_name"]."\">".$row3["company_name"]."</option>";
		$row3=mysql_fetch_array ($result2);
		}
	?>
        </select>
  </p>
  <p><font   color="#FFFFFF" size="2">Goods ID:</font>
    <input type="text" name="goods_partno" maxlength="30" value='<? echo $goods_id; ?>' class="login">
  </p>
  
 
  <p><font  color="#FFFFFF" size="2">Cost: $ </font>
    <input type="text" name="cost" maxlength="9" value='<? echo $cost; ?>' class="login">
  </p>
  <p><font  color="#FFFFFF" size="2">Stock: </font>
    <input type="text" name="stock" maxlength="9" value='<? echo $stock; ?>' class="login">
  </p>
  <p><font  color="#FFFFFF" size="2">旺角 </font>
    <input type="radio" name="place" value="1" <? echo $HK; ?> class="login">
    <font  color="#FFFFFF" size="2">大圍</font>
    <input type="radio" name="place" value="2" <? echo $KL; ?> class="login">
    <font  color="#FFFFFF" size="2">土瓜灣</font>
    <input type="radio" name="place" value="3" <? echo $TKW; ?> class="login">
  </p>
  <p>
    <td colspan="3"><input type="button" onclick="javascript:checkform();" value="submit">
</td>
    <input type="reset" name="Submit2" value="Reset" class="login">
  </p>
  </form>
</body>
</html>
