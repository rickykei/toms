<?
   include("config.php3");
 
   $nitem=30+1; //the no. of the item + 1.

  
   for ($i=1;$i<$nitem;$i++)  //make the null field to go to lastest!
   {
    
      for ($j=1;$j<$nitem;$j++)
      {
      
//remove goods_id 10-6-02
         if (empty($goods_partno[$j]))
         {
        
 
            $temp1=$qty[$j];
            $qty[$j]=$qty[$j+1];
            $qty[$j+1]=$temp1;

            $temp2=$discountrate[$j];
            $discountrate[$j]=$discountrate[$j+1];
            $discountrate[$j+1]=$temp2;
            
            $temp3=$goods_partno[$j];
            $goods_partno[$j]=$goods_partno[$j+1];
            $goods_partno[$j+1]=$temp3;
            
            $temp4=$market_price[$j];
            $market_price[$j]=$market_price[$j+1];
            $market_price[$j+1]=$temp4;
            
            $temp5=$goods_detail[$j];
            $goods_detail[$j]=$goods_detail[$j+1];
            $goods_detail[$j+1]=$temp5;
            
            $qty[$j+1]="";
            $discountrate[$j+1]="";   }

      }
// "i=".$i."goodspart".$goods_partno[$i]."qty".$qty[$i]."discountrate".$discountrate[$i]."goods_deta".$goods_detail[$i]."marktetprice".$market_price[$i]."<p>";
   }
   
      for ($i=1;$i<$nitem;$i++) //set all empty goods_id's un & ext_price = 0
   {
   //changed at 26-5-01//
      if (empty($goods_partno[$i]))
      {
         $un[$i]="";
         $qty[$i]="";
         $market_price[$i]="";
      }
   }

 
$gitem=0; //check how many input goods item.
   for ($i=1;$i<$nitem+1;$i++)
   {
      if (empty($goods_partno[$i]))
      {
         $gitem=$i-1;
         break;
      }
   }
 

   for ($i=1;$i<=$gitem;$i++)
   {
   	
         $chpr=mysql_query("select goods_detail,market_price from sumgoods where goods_partno=\"$goods_partno[$i]\"");
         $chprs=mysql_fetch_row($chpr);
         list($detail,$lchpr)=$chprs;
        
		
		
         if ($market_price[$i]=="" )
         {
        
         $market_price[$i]=$lchpr;
         }
         if ($goods_detail[$i]=="")
         {
			$goods_detail[$i]=$detail;
         } 
		 
		 $goods_detail[$i]=stripslashes($goods_detail[$i]);
			  $goods_detail[$i]=addslashes($goods_detail[$i]);
	 
   }
   
   //added at 291001





 $cherr=0;
 
   if ($customer=='n'){
 $customer_car_no=$mem_car_no;
  $mile=$mem_mile;
    // 16-11-01 add check memeber_detail from member_id
 $query="select exp_date,mem_name_chi,mem_name_eng,mem_tel,mem_tel2 from member where mem_id='$member_id'";
 $result = mysql_query ($query);
 $row_mem_detail=mysql_fetch_array($result);
 $customer_name=$row_mem_detail["mem_name_eng"];
 if ($customer_name=="")
 $customer_name=$row_mem_detail["mem_name_chi"];
 $customer_exp_date=$row_mem_detail["exp_date"];
 $customer_tel=$row_mem_detail["mem_tel"];
 if (empty($customer_tel))
 {
 $customer_tel=$row_mem_detail["mem_tel2"];
 }
 }
      //$query="update invoice set invoice_date='$invoice_date', sales_name='$sales_name', customer_name='', customer_tel='', customer_detail='', member_id='$member_id' where invoice_no=$invoice_no";
//      $query="insert into invoice (invoice_no,invoice_date,sales_name,member_id,status) values ('$invoice_no','$invoice_date','$sales_name',$member_id,'Y')";

//      $query="insert into invoice (invoice_no,invoice_date,sales_name,customer_name,customer_tel,customer_detail,status) values ('$invoice_no','$invoice_date','$sales_name','$customer_name','$customer_tel','$customer_detail','Y')";
      $query="update invoice set invoice_date='$invoice_date', sales_name='$sales_name', customer_name='$customer_name', customer_tel='$customer_tel', customer_detail='$customer_detail', customer_car_type='$customer_car_type',customer_car_no='$customer_car_no', member_id='$member_id' , mile='$mile' where invoice_no=$invoice_no";
 
   
   
   
        if (!mysql_query($query))
  {
     $cherr=3;
    echo mysql_error();
   }
    


$query4="delete from goods_invoice where invoice_no=$invoice_no";  //delete old record
      if (!mysql_query($query4))
         $cherr=4;


   for ($i=1;$i<$gitem+1;$i++)
   {
      $query1="insert into goods_invoice (invoice_no,goods_id,goods_partno,qty,discountrate,marketprice,status,description) values ('$invoice_no','$goods_id[$i]','$goods_partno[$i]',$qty[$i],'$discountrate[$i]','$market_price[$i]','Y','$goods_detail[$i]')";
	  
      if (!mysql_query($query1))
     {
         $cherr=1;
         echo mysql_error();
      }

 
  }
   if ($cherr==0)
   {

      include("show_and_create_invoice.php3");
   }
   else
      echo "Error=".$cherr."資料出現問題! 請從新輸入!<br>";

?>







<?
   include("config.php3");
?>


<html>
<!--
<body onload="javascript=done()";>     
//-->
<SCRIPT LANGUAGE="JavaScript">
function printout()
{
window.open('./invoice_store/invoice<?echo $invoice_no;?>.rtf');
window.location="invoiceshow.php3?offset=0&rowset=30";
}
</script>
</body>
</html>
