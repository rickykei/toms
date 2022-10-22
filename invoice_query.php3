<html>
<head>
<title>invoice show</title>
<LINK REL=stylesheet HREF="invioce_query.css" TYPE="text/css">
<style type="text/css">
@import url(./js/calendar/calendar-win2k-1.css);.style1 {
	color: #CCCCCC;
	font-size: medium;
}
.style5 {
	font-size: 12;
	color: #FFFFFF;
}
.style8 {color: #CCCCCC; font-size: medium; font-weight: bold; }
.style12 {font-size: medium}
.style13 {color: #FFFFFF}
.style15 {color: #FFFFFF; font-size: medium; font-weight: bold; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=big5"><body bgcolor="#0066cc" text="#000000">
<script type="text/javascript" src="./js/calendar/calendar.js"></script>
<script type="text/javascript" src="./js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="./js/calendar/calendar-setup.js"></script>

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
if ($offset=="")
$offset=30;
if ($rowset=="")
$rowset=0;

include("config.php3");

	if ($command=="")
	{
		$sql="select * from invoice order by invoice_no desc LIMIT $offset, $rowset";
	}
	else
	{
		//by invoice_no
		if ($command==1)
		$sql="select * from invoice  where invoice_no=$by_invoice_no";

		//by customer_name
		if ($command==2)
		$sql="select * from invoice where customer_name like \"%$by_buyer_name%\" order by invoice_no desc";

		// by invoice date
		if ($command==3)
		$sql="select * from invoice where invoice_date>='$by_date1' and invoice_date<='$by_date2' order by invoice_no desc";

		//by tel phone no.
		if ($command==4)
		$sql="select * from invoice,member where invoice.member_id=member.mem_id and (invoice.customer_tel like \"%$tel_no%\" or member.mem_tel like \"%$tel_no%\" or member.mem_tel2 like \"%$tel_no%\" )   order by invoice_no desc";


		if ($command==5)
		$sql="select * from invoice where member_id = $by_mem_id";


		//by invoice table's carno
		if ($command==6)
		{
		$sql="select mem_id from  member where  member.mem_carno like \"%$customer_car_no%\" or member.mem_carno2 like \"%$customer_car_no%\"";
		
		$rows=mysql_query($sql);
		$sql="select * from invoice where customer_car_no like \"%$customer_car_no%\" ";
		 	if ($rows) 
			 {
			 	
      			while ($row=mysql_fetch_array($rows))
		      	{
				 	$sql=$sql." or ";
					$sql=$sql." member_id = ".$row["mem_id"];
				}
			 }
				$sql=$sql." order by invoice_no desc ";
		}

		if ($command==7)
		{
		$sql="select mem_id from member where member.mem_cartype like \"%$customer_car_type%\" or member.mem_cartype2 like \"%$customer_car_type%\" ";
		
		$rows=mysql_query($sql);
		$sql="select * from invoice where customer_car_type like \"%$customer_car_type%\" ";
			if ($rows)
			{
				while($row=mysql_fetch_array($rows))
				{
					$sql=$sql." or ";
					$sql=$sql." member_id = ".$row["mem_id"];
				}
			}
			$sql=$sql." order by invoice_no desc ";
		}
 //echo "sql=".$sql;
 $rows=mysql_query($sql);
	
		if (!rows) {
  	 die('Invalid query: ' . mysql_error());
		}
	}
$checktotal=mysql_query("select * from invoice");
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
<table width="739" border=0>
  <tr>
    <td width="550">
	<form action="invoice_query.php3" method="post" class="style1 style5">
	  <strong>	<span class="style12">由Invoice Number搜索</span>	
	  <input type="text" name=by_invoice_no size="10" >
	<input type="hidden" name="command" value=1>
	<input type="submit" value="Search">
	  </strong>
	</form>	</td>
  </tr>
	<tr><td>
	<form action="invoice_query.php3" method="post" class="style8 style12 style13">
	  	由買貨人搜索
	    <input type="text" name=by_buyer_name size="50">
	    <input type="hidden" name="command" value=2>
	    <input type="submit" value="Search">
	</form>
		</td>
	</tr>
	<tr><td>
        <form action="invoice_query.php3" method="post" class="style8 style12 style13">
          由 memberID會員編號
          <input type="text" name=by_mem_id size="50">
          <input type="hidden" name="command" value=5>
          <input type="submit" value="Search">
        </form>
			</td>
	</tr>
	<tr><td>
        <form action="invoice_query.php3" method="post" class="style15">
          由 電話號碼
          <input type="text" name=tel_no size="50">
          <input type="hidden" name="command" value=4>
          <input type="submit" value="Search">
        </form>
			</td>
	</tr>
	<tr><td>
        <form action="invoice_query.php3" method="post" class="style15">
          由 車牌 搜索
          <input type="text" name=customer_car_no size="50">
          <input type="hidden" name="command" value=6 >
          <input type="submit" value="Search" id=button6 >
        </form>
			</td>
	</tr>
	<tr><td>
                <form action="invoice_query.php3" method="post" class="style15">
                  由 invoice Car_type 車種
                  <input type="text" name=customer_car_type size="50">
                  <input type="hidden" name="command" value=7>
                  <input type="submit" value="Search"  >
        </form>
			</td>
	</tr>
	<tr><td>
	<form action="invoice_query.php3" method="post" class="style15">
	日期由<input type="text" name=by_date1 id=by_date1 size="25" value="<? echo date("Y-m-d H:m");?>">
	<input type="button" name="button7" id="button7" value="...">
	
	至<input type="text" name=by_date2 id=by_date2 size="25" value="<? echo date("Y-m-d H:m");?>">	
	<input type="button" name="button8" id="button8" value="...">
	<input type="hidden" name="command" value="3">
	<input type="submit" value="Search">
	</form>


	
	<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "by_date1",         // ID of the input field
      ifFormat    : "%Y-%m-%d %H:%M",    // the date format
      showsTime   : true,
      button      : "button7"       // ID of the button
    }
  );
    Calendar.setup(
    {
      inputField  : "by_date2",         // ID of the input field
      ifFormat    : "%Y-%m-%d %H:%M",    // the date format
      showsTime   : true,
      button      : "button8"       // ID of the button
    }
  );
    </script>
	  
	  </td>
	</tr>
</table>
 
<table width="100%" height="0" border="0">
	<tr bgcolor="#339999">
	<td bgcolor="#666666">

         <table width="100%" border="0" cellpadding="3">
      <tr bgcolor="#C2C2C2">

             <td>發票編號 </td>
             <td>total amount</td>
             <td>發票日期 </td>
             <td>售貨人 </td>
             <td>買貨人 </td>
             <td>電話 </td>
             <td>車種 </td>
             <td>會員編號 </td>
             <td>修改 </td>
              <td>RTF列印 </td>
             <td>PDF列印 </td>
			 <td>Email PDF</td>
           </tr>
		 <?php
      $chodd=0;
	  if ($rows) {
      while ($row=mysql_fetch_array($rows))
      {
	  
         //list($invoice_no,$invoice_date,$sales_name,$customer_name,$customer_tel,$customer_detail,$member_id,$istauts,$customer_car_no,$customer_car_type )=$row;
		

         for ($i=0;$i<count($rows);$i++)
         {
            if (($chodd % 2)==1)
               $bgcolor='bgcolor="#ffffff"';  //backgroud color
            else
               $bgcolor='bgcolor="#ffffff"';

            //$invoice_date=substr($invoice_date,0,10);

            if ($oinvno!=$row['invoice_no'])  //check the invoice_no deplicate
            {

                  echo '<tr>',"\n";
                  echo '<td ',$bgcolor,'><a href="javascript:check_del(',$row['invoice_no'],')">',$row['invoice_no'],'</a></td>',"\n";

//11-6-01 add totol amount
	$sql2="select qty,discountrate,marketprice from goods_invoice where invoice_no=".$row['invoice_no'];
	$query_totalamount=mysql_query($sql2);
	$amount=0.00;
	$totalamount=0.00;
	
	while ($query_totalamount2=mysql_fetch_row($query_totalamount))
      {
      list($qty,$discountrate,$marketprice)=$query_totalamount2;
        
        //20091201 rounding invoice >74102
				if ($row['invoice_no']>74102){
				// round 20091201
				// round 20101215
				$amount=round($qty*round($marketprice-($marketprice*($discountrate/100))));
				}else{
      	$amount=$qty*($marketprice-($marketprice*($discountrate/100)));
      	}
      	
      $totalamount=$totalamount+$amount;
        }

        
                  if (empty($row['customer_name']))

     //set the field = "/" if NULL
                     $customer_name="/";

                  if (empty($row['customer_tel']))
                     $customer_tel="/";

                  if (empty($row['customer_detail']))
                     $customer_detail="/";


                 echo '<td ',$bgcolor,'>$',$totalamount,'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$row['invoice_date'],'</td>',"\n";
                  echo '<td ',$bgcolor,'>',$row['sales_name'],'</td>',"\n";

// 11-03-03 add member_detail
         if (!empty($row['member_id']))
         {
		 $sql3="select * from member where mem_id=".$row['member_id'];
        $rows_member_check=mysql_query($sql3);
        $rows_member_check2=mysql_fetch_array($rows_member_check);
        $customer_name=$rows_member_check2["mem_name_eng"];
        $customer_tel=$rows_member_check2["mem_tel"];
        if(empty($customer_tel))
        $customer_tel=$rows_member_check2["mem_tel2"];
        } 
		
		echo '<td ',$bgcolor,'>';
		if  ($row['customer_name']!='')
		echo $row['customer_name'];
		else
		echo $customer_name;
		echo '</td>',"\n";
			
        echo '<td ',$bgcolor,'>';
		if ($row['customer_tel']!='')
		echo $row['customer_tel'];
		else
		echo $customer_tel;
	    echo '</td>',"\n";
				   
				   
                  echo '<td ',$bgcolor,'>';
				  if ($row['customer_car_type']!='')
				  echo $row['customer_car_type'];
				  else
				  echo $rows_member_check2['customer_car_type'];
				  echo '</td>',"\n";
				  
                 echo '<td ',$bgcolor,'>',$row['member_id'],'</td>',"\n";
             //     echo '<form name="form" method="post" action="invoiceedit.php3"><td ',$bgcolor,'>',"\n";
             //          echo '<input type="hidden" name="ed" value=',$row['invoice_no'],' class="login">',"\n";
             //          echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";
             //          echo '</td></form>',"\n";
		
		//200705 control editing by password
		        $today = date("Y-m-d H:m:s");
	
	
		  if (substr($today,0,10)==substr($row['invoice_date'],0,10)){
                  echo '<form name="form" method="post" action="invoiceedit.php3"><td ',$bgcolor,'>',"\n";
                       echo '<input type="hidden" name="ed" value=',$row['invoice_no'],' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";
                       echo '</td></form>',"\n";
		       }
		       else
		       {
		        echo '<td ',$bgcolor,'>';
                       echo '<a href="javascript:chkdel2('.$row['invoice_no'].');">EDIT</a>',"\n";
		       echo '</td>',"\n";
		       }
		    //200705 control editing by password   
                  echo '<td ',$bgcolor,'><form name="form" method="post1" action="./invoice_store/invoice',$row['invoice_no'],'.rtf">',"\n";
                       echo '<input type="hidden" name="invoice_no" value=',$row['invoice_no'],' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
                       echo '</form></td>',"\n";
					   
				            echo '<td ',$bgcolor,'><form name="form3" method="post" action="./invoice_pdf/',$row['invoice_no'],'.pdf">',"\n";
                       echo '<input type="hidden" name="invoice_no" value=',$row['invoice_no'],' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
		     
                       echo '</form></td>',"\n";
					   
						echo '<td ',$bgcolor,'><form name="form3" method="post" action="./invoice/pdf/',$row['invoice_no'],'.pdf">',"\n";
                       echo '<input type="hidden" name="invoice_no" value=',$row['invoice_no'],' class="login">',"\n";
                       echo '<input type="submit" name="submit" value="PRINT" class="login">',"\n";
		     
                       echo '</form></td>',"\n";
					   
              echo '</tr>',"\n";
              $chodd=$chodd+1;
           }
           $oinvno=$invoice_no;
         }
      } 
	   
   }
   ?>
   </table>
</table>
 <a href="index.php3">Index</a><br><br>
<a href="invoiceap.php3">Add Invoice</a>
</body></html>

