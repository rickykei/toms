<html>
<head>
<title>po show</title>
<LINK REL=stylesheet HREF="po.css" TYPE="text/css">

<body bgcolor="#CCFFCC" text="#000000">
<SCRIPT LANGUAGE="JavaScript">
function check_del(aa)
{
var temp_pass = prompt('如你真的要刪除此項,請輸入密碼!!');
var pass="123";
if (temp_pass==pass)
{
alert(aa);
window.location="po_del.php3?id="+aa;
}
else
{
alert('error');
}
}

</script>
<?
include("../config.php3");
$rows=mysql_query("select * from po order by po_no desc LIMIT $offset, $rowset;");
$checktotal=mysql_query("select * from po");
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
         
          action="po_show.php3?offset=0&rowset=<?echo $rowset;?>"><input type="submit" value="開始 &lt;&lt;" >
        </form>
        </td>
        <td>
        <form method="post" action="po_show.php3?offset=<?$a=$offset-$rowset;echo $a;?>&rowset=<?echo $rowset?>"><input type="submit" value="前一個 &lt;"  >
        </form>
        </td>
    <td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td>
        <table><tr><td>
<?$a=$offset+$rowset;?>
<form method="post" action="po_show.php3">
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

          action="po_show.php3?offset=<?echo $a;?>&rowset=<?echo $rowset;?>"><input type="submit" value="&gt;&gt; 結束"  >
        </form>
        </td>
    </tr></table>
    <!--  end of table navigation bar -->
<?
//$rows=mysql_query("select * from invoice where invoice_no>=1764 order by invoice_no desc;");
//$rows=mysql_query("select * from invoice where to_days(now())-to_days(invoice_date) <=10 order by invoice_no desc ;"); //get the total of invoice no.

         echo '<table width="100%" border="0" bgcolor="DDDDDD" class="login">';
         echo '<tr>';
$bgcolor="bgcolor=AAAAAA";
             echo '<td ',$bgcolor,' >發票編號 </td>',"\n";
             echo '<td ',$bgcolor,' >total amount</td>',"\n";
             echo '<td ',$bgcolor,' >發票日期 </td>',"\n";
             echo '<td ',$bgcolor,' >售貨人 </td>',"\n";
             echo '<td ',$bgcolor,' >買貨人 </td>',"\n";
             echo '<td ',$bgcolor,' >電話 </td>',"\n";
             echo '<td ',$bgcolor,' >其他資料 </td>',"\n";
             echo '<td ',$bgcolor,' >會員編號 </td>',"\n";
             echo '<td ',$bgcolor,' >修改 </td>',"\n";
             echo '<td ',$bgcolor,' >列印 </td>',"\n";
         echo '</tr>',"\n";
      $chodd=0;
      while ($row=mysql_fetch_row($rows))
      {
         list($po_no,$po_date,$sales_name,$customer_name,$customer_tel,$customer_detail,$member_id,$istatus)=$row;


         for ($i=0;$i<count($rows);$i++)
         {
            if (($chodd % 2)==1)
               $bgcolor='bgcolor="#DDDDDD"';  //backgroud color
            else
               $bgcolor='bgcolor="#cccccc"';

            //$invoice_date=substr($invoice_date,0,10);

            if ($old_po_no!=$po_no)  //check the invoice_no deplicate
            {

                  echo '<tr>',"\n";
                  echo '<td ',$bgcolor,'><a href="javascript:check_del(',$po_no,')">',$po_no,'</a></td>',"\n";

//11-6-01 add totol amount
$query_totalamount=mysql_query("select qty,discountrate,marketprice from goods_po where po_no=$po_no");
$amount=0.00;
$totalamount=0.00;
while ($query_totalamount2=mysql_fetch_row($query_totalamount))
      {
      list($qty,$discountrate,$marketprice)=$query_totalamount2;
      $amount=$qty*($marketprice-($marketprice*($discountrate/100)));
      $totalamount=$totalamount+$amount;
        }

                  //$d=substr($invoice_date,8,2);
    //set date format
                  //$m=substr($invoice_date,5,2);
                  //$y=substr($invoice_date,0,4);
                  //$invoice_date=$d."/".$m."/".$y;

                  if (empty($customer_name))
     //set the field = "/" if NULL
                     $customer_name="/";

                  if (empty($customer_tel))
                     $customer_tel="/";

                  if (empty($customer_detail))
                     $customer_detail="/";

                  if (empty($member_id))
                     $member_id="/";

                 echo '<td ',$bgcolor,'>$',$totalamount,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$po_date,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$sales_name,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$customer_name,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$customer_tel,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$customer_detail,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$member_id,'</td>',"\n";
                  echo '<td ',$bgcolor,'><form name="form" method="post" action="po_edit.php3">',"\n";
                       echo '<input type="hidden" name="ed" value=',$po_no,' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";
                       echo '</form></td>',"\n";
                  echo '<td ',$bgcolor,'><form name="form" method="post1" action="./po_store/po-',$po_no,'.rtf">',"\n";
                       echo '<input type="hidden" name="po_no" value=',$po_no,' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
                       echo '</form></td>',"\n";
              echo '</tr>',"\n";
              $chodd=$chodd+1;
           }
           $old_po_no=$po_no;
         }
      }  echo '</table>',"\n";
   
   echo '<a href="index.php3">Index</a><br><br>',"\n";
   echo '<a href="po_ap.php3">Add po</a>',"\n";
?>
