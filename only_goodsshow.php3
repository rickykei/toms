<html>
<head>
<title>only_goodsshow.php3</title>
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">

<body bgcolor="#0066cc" text="#FFFFFF">
<SCRIPT LANGUAGE="JavaScript">
function check_del(aa)
{
var temp_pass = prompt('如你真的要刪除此項,請輸入密碼!!');
var pass="123";

 if (temp_pass==pass)
 {
 alert(aa);
 window.location="only_goodsshow_del.php3?id="+aa;
 }
 else
 {
 alert('error');
 }
}

</script>

<?
if($offset==0 && $rowset==0)
{
$offset=0;
$rowset=30;
}
include("config.php3");
$rows=mysql_query("select * from goods order by id desc LIMIT $offset, $rowset;");
$checktotal=mysql_query("select * from goods");
$checktotal=mysql_num_rows($checktotal);
//echo $checktotal;
?>   
  <!--  beginning of table navigation bar -->
<?
if ($rowset==0 || $rowset=="")
{
$rowset=30;
}
?>
<?
if ($offset==0 || $offset=="")
{
$offset=0;
}
?>
<table border=0><tr>
       <td>
       <form method="post"
         
          action="only_goodsshow.php3?offset=0&rowset=<?echo $rowset;?>"><input type="submit" value="開始 &lt;&lt;" >
        </form>
        </td>
        <td>
        <form method="post" action="only_goodsshow.php3?offset=<?$a=$offset-$rowset;echo $a;?>&rowset=<?echo $rowset?>"><input type="submit" value="前一個 &lt;"  >
        </form>
        </td>
    <td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td>
        <table><tr><td>
<?$a=$offset+$rowset;?>
<form method="post" action="only_goodsshow.php3">
            <input type="submit" value="&gt;">
            <input type="text" name="rowset" size="3" value="<?echo $rowset;?>">
            <input name="offset" type="text" size="3" value="<?echo $a;?>">
          </form>
        </td></tr></table>
    </td>
    <td>
<?$a=$checktotal-$rowset;?>
        <form method="post"
          onsubmit="return true"

          action="only_goodsshow.php3?offset=<?echo $a;?>&rowset=<?echo $rowset;?>"><input type="submit" value="&gt;&gt; 結束"  >
        </form>
        </td>
    </tr></table>
    <!--  end of table navigation bar -->
	<?

         echo '<table width="100%" border="1" class="login">';
         echo '<tr>';
         echo '<td>id </td>',"\n";
         echo '<td>reference_no</td>',"\n";
 //        echo '<td>barcode </td>',"\n";
         echo '<td>partno</td>',"\n";
         echo '<td>cost </td>',"\n";
         echo '<td>買入</td>',"\n";
         echo '<td>date</td>',"\n";
         echo '<td>status</td>',"\n";
         echo '<td>edit</td>',"\n";
echo '</tr>',"\n";
      $chodd=0;
      while ($row=mysql_fetch_row($rows))
      {
         list($id,$ref_no,$goods_id,$goods_partno,$cost,$stock,$stockout,$place,$date,$status)=$row;
         for ($i=0;$i<count($rows);$i++)
         {
            if (($chodd % 2)==1)
               $bgcolor='bgcolor="#0066cc"';  //backgroud color
            else
               $bgcolor='bgcolor="#0066cc"';
            echo '<tr>',"\n";
            echo '<td ',$bgcolor,'><a href="javascript:check_del(',$id,')">',$id,'</a></td>',"\n";
	    echo '<td ',$bgcolor,'>',$ref_no,'</td>',"\n";
 //           echo '<td ',$bgcolor,'>',$goods_id,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$goods_partno,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$cost,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$stock,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$date,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$status,'</td>',"\n";
            echo '<td ',$bgcolor,'><form name="form" method="post" action="only_goodsshow_edit.php3">',"\n";
            echo '<input type="hidden" name="ed" value=',$id,' class="login">',"\n";
            echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";
            echo '</form></td>',"\n";
            echo '</tr>',"\n";
            $chodd=$chodd+1;
           }

      } 
       echo '</table>',"\n";
   
?>
