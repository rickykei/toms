<?php
require "../include/Pager.class.php";
if ( isset($_GET['page']) )
{
   $page = (int)$_GET['page'];
}
else
{
   $page = 1;
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head><script language="javascript">

function typeSelectSubmit()

{

	document.typeForm.submit();

}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body><?php
   include_once("../include/config.php");
   $query="SET NAMES 'UTF8'";
    $db = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
 	$result = $db->query("SET NAMES 'UTF8'");
 

 
 	//get type
 	$sqlType="select * from type";
	$resType=$db->query($sqlType);
	
	
   // (Run the query on the winestore through the connection

   
 if ($goods_partno!="")
	  $sql="select * from sumgoods where goods_partno like '".$goods_partno."' order by goods_partno";
	  else if ($typeSelect!="")
      $sql="select * from sumgoods where model='".$typeSelect."' order by goods_partno";
	  else
      $sql="SELECT id,model,goods_partno,goods_detail,market_price,status FROM sumgoods order by goods_partno";
   
   $pager_option = array(
       "sql" => $sql,
       "PageSize" => 10,
       "CurrentPageID" => $page
);
if ( isset($_GET['numItems']) )
{
   $pager_option['numItems'] = (int)$_GET['numItems'];
}
$pager = @new Pager($pager_option);
$result = $pager->getPageData();

if ( $pager->isFirstPage )
{
   $turnover = "第一頁|上一頁|";
}
else
{
   $turnover = "<a href='?page=1&typeSelect=".$typeSelect."&numItems=".$pager->numItems."'>首頁</a>|<a href='?page=".$pager->PreviousPageID."&typeSelect=".$typeSelect."&numItems=".$pager->numItems."'> 上一頁</a>|";
}
if ( $pager->isLastPage || $pager->NextPageID=="")
{
   $turnover .= "下一頁|尾頁";
}
else
{
   $turnover .= "<a href='?page=".$pager->NextPageID."&typeSelect=".$typeSelect."&numItems=".$pager->numItems."'> 下一頁</a>|<a href='?page=".$pager->numPages."&typeSelect=".$typeSelect."&numItems=".$pager->numItems."'> 尾頁</a>";
}
?>
<form method="post" name="typeForm" action="goodStockList.php">
<?=$turnover?>

<select name="typeSelect" onchange="javascript:typeSelectSubmit()"><option value="">ALL</option><? while($rowType = $resType->fetchRow(DB_FETCHMODE_ASSOC))
{?>
  <option value="<?=$rowType['typeName']?>"  <? if($typeSelect==$rowType['typeName']) {echo "selected";}?>><?=$rowType['typeName']?></option>
<?
}
?>
</select>

<input type="text" name="goods_partno" />
<input type="button" name="button" onclick="javascript:typeSelectSubmit()" />
</form>
  
  
<table width="763" border=1><TR><TD width="45">ID</TD>
<TD width="184">貨品編號</TD>
<TD width="259">貨品名</TD>
<TD width="81">售價</TD>
<TD width="100">種頪</TD>
<TD width="100">出貨量</TD>
<TD width="100">入貨量</TD>
<TD width="100">退貨量</TD>
<TD width="100">Balance</TD>
<TD width="26">EDIT</TD>
<TD width="26">DEL</TD>
</TR>
    <?php 
	for ($i=0;$i<count($result);$i++)
	{ $row=$result[$i];
	
?><tr>
<td><?=$row['id']?></td>
<td><?=$row['goods_partno']?></td>
<td><?=$row['goods_detail']?></td>
<td><?=$row['market_price']?></td>
<td><?=$row['model']?></td>
<td><?$a=check_invoice($row['goods_partno'],$db,'I');echo $a;?></td>
<td><?$b=check_invoice($row['goods_partno'],$db,'S');echo $b;?></td>
<td><?$c=check_invoice($row['goods_partno'],$db,'R');echo $c;?></td>
<td><?echo $c+$b-$a;?></td>
      <TD><a href="ingoodnameedit.php?goods_partno=<?=$row['goods_partno']?>&amp;update=2">EDIT</a></TD>
      <td>DEL</td>
    </tr>
<?
		 }
   ?>
   </table>
<?php echo $turnover;?>
</body></html>
<?
 function check_invoice($part_no,$db,$type)
{
if ($type=='I')
 $res=$db->query("select sum(qty) qty from goods_invoice where goods_partno='".$part_no."'");
else if  ($type=='S')
  $res=$db->query("select sum(qty) qty from goods_instock where goods_partno='".$part_no."'");
else if ($type=='R')
  $res=$db->query("select sum(qty) qty from goods_return where goods_partno='".$part_no."'");
  
 $row = $res->fetchRow(DB_FETCHMODE_ASSOC);
 return $row['qty'];
}
?>