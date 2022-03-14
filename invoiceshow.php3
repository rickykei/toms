<html>
<head>
<title>invoice show</title>
<LINK REL=stylesheet HREF="invoiceedit.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#FFFFFF">
<SCRIPT LANGUAGE="JavaScript">
function check_del(aa)
{
var temp_pass = prompt('如你真的要刪除此項,請輸入密碼!!');
var pass="748";
if (temp_pass==pass)
{
alert(aa);
window.location="invoice_del.php3?id="+aa;
}
else
{
alert('error');
}
}
function chkdel2(aa)
{
var temp_pass = prompt('如你真的要編輯此項,請輸入密碼!!');
var pass="999";
if (temp_pass==pass)
{
window.location="invoiceedit.php3?ed="+aa;
}
else
{
alert('error');
}
}
</script>
<?
include("config.php3");
$rows=mysql_query("select * from invoice order by invoice_no desc LIMIT $offset, $rowset;");
$checktotal=mysql_query("select * from invoice");
$checktotal=mysql_num_rows($checktotal);
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
       <form method="post" name="browse1"      
          action="invoiceshow.php3?offset=0&rowset=<?echo $rowset;?>"><input type="submit" value="開始 &lt;&lt;" >
        </form>
        </td>
        <td>
        <form method="post" name="browse2" action="invoiceshow.php3?offset=<?$a=$offset-$rowset;echo $a;?>&rowset=<?echo $rowset?>"><input type="submit" value="前一個 &lt;"  >
        </form>
        </td>
    <td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td>
        <table><tr><td>
<?$a=$offset+$rowset;?>
<form method="post" action="invoiceshow.php3" name="browse3" >
            <input type="submit" value="&gt;">
            <input type="text" name="rowset" size="3" value="<?echo $rowset;?>">
            <input name="offset" type="text" size="3" value="<?echo $a;?>">
          </form>
        </td></tr></table>
    </td>
    <td>
<?$a=$checktotal-$rowset;?>
        <form method="post"
          onsubmit="return true" name="browse4" 

          action="invoiceshow.php3?offset=<?echo $a;?>&rowset=<?echo $rowset;?>"><input type="submit" value="&gt;&gt; 結束"  >
        </form>
        </td>
    </tr></table>
    <!--  end of table navigation bar -->
<?
//$rows=mysql_query("select * from invoice where invoice_no>=1764 order by invoice_no desc;");
//$rows=mysql_query("select * from invoice where to_days(now())-to_days(invoice_date) <=10 order by invoice_no desc ;"); //get the total of invoice no.

         echo '<table width="100%" border="1" class="login">';
         echo '<tr>';

             echo '<td>發票編號 </td>',"\n";
             echo '<td>total amount</td>',"\n";
             echo '<td>發票日期 </td>',"\n";
             echo '<td>售貨人 </td>',"\n";
             echo '<td>買貨人 </td>',"\n";
             echo '<td>電話 </td>',"\n";
             echo '<td>其他資料 </td>',"\n";
             echo '<td>會員編號 </td>',"\n";
             echo '<td>修改 </td>',"\n";
             echo '<td>RTF列印 </td>',"\n";
             echo '<td>PDF列印 </td>',"\n";
			 echo '<td>EMAIL PDF </td>',"\n";
         echo '</tr>',"\n";
      $chodd=0;
      while ($row=mysql_fetch_row($rows))
      {
         list($invoice_no,$invoice_date,$sales_name,$customer_name,$customer_tel,$customer_detail,$member_id,$istauts)=$row;
         
         // add at 19-2-03
         if (!empty($member_id))
         {
         $rows_member_check=mysql_query("select mem_name_eng,mem_tel,mem_tel2,other from member where mem_id=$member_id ");
	$rows_member_check2=mysql_fetch_array($rows_member_check);
	$customer_name=$rows_member_check2["mem_name_eng"];
	$customer_tel=$rows_member_check2["mem_tel"];
	if(empty($customer_tel))
	$customer_tel=$rows_member_check2["mem_tel2"];
	
	}

         for ($i=0;$i<count($rows);$i++)
         {
            if (($chodd % 2)==1)
               $bgcolor='bgcolor="#0066cc"';  //backgroud color
            else
               $bgcolor='bgcolor="#0066cc"';

            //$invoice_date=substr($invoice_date,0,10);

            if ($oinvno!=$invoice_no)  //check the invoice_no deplicate
            {

                  echo '<tr>',"\n";
                  echo '<td ',$bgcolor,'><a href="javascript:check_del(',$invoice_no,')">',$invoice_no,'</a></td>',"\n";

//11-6-01 add totol amount
$query_totalamount=mysql_query("select qty,discountrate,marketprice from goods_invoice where invoice_no=$invoice_no");
$amount=0.00;
$totalamount=0.00;
while ($query_totalamount2=mysql_fetch_row($query_totalamount))
      {
      list($qty,$discountrate,$marketprice)=$query_totalamount2;
      
       //20091201 rounding invoice >74102
			if ($invoice_no>74102){
				// round 20091201
				// round 20101215
				$amount=round($qty*round($marketprice-($marketprice*($discountrate/100))));
				}else{
      $amount=$qty*($marketprice-($marketprice*($discountrate/100)));
      }
      
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
                  echo '<td ',$bgcolor,'>',$invoice_date,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$sales_name,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$customer_name,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$customer_tel,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$customer_detail,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$member_id,'</td>',"\n";
		  $today = date("Y-m-d H:m:s");
		  if (substr($today,0,10)==substr($invoice_date,0,10)){
                  echo '<td ',$bgcolor,'><form name="form" method="post" action="invoiceedit.php3">',"\n";
                       echo '<input type="hidden" name="ed" value=',$invoice_no,' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";
                       echo '</form></td>',"\n";
		       }
		       else
		       {
		        echo '<td ',$bgcolor,'>';
                       echo '<a href="javascript:chkdel2('.$invoice_no.');">EDIT</a>',"\n";
		       echo '</td>',"\n";
		         
		       }
                  echo '<td ',$bgcolor,'><form name="form2" method="post" action="./invoice_store/invoice',$invoice_no,'.rtf">',"\n";
                       echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
		     
                       echo '</form></td>',"\n";
                              echo '<td ',$bgcolor,'><form name="form3" method="post" action="./invoice_pdf/',$invoice_no,'.pdf">',"\n";
                       echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
		     
                       echo '</form></td>',"\n";
					   
					      echo '<td ',$bgcolor,'><form name="form3" method="post" action="./invoice/pdf/',$invoice_no,'.pdf">',"\n";
                       echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
		     
                       echo '</form></td>',"\n";
              echo '</tr>',"\n";
              $chodd=$chodd+1;
           }
           $oinvno=$invoice_no;
         }
      }  echo '</table>',"\n";
   
   echo '<a href="index.php3">Index</a><br><br>',"\n";
   echo '<a href="invoiceap.php3">Add Invoice</a>',"\n";
?>
