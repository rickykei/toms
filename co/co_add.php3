<?  //update at19-2-03
$today=Date("d/m/Y");
?>

<html>
<head>

<title>co add</title>
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#CCFFCC" text="#000000">
<?
   include("../config.php3");
   
   $nitem=30+1; //the no. of the item + 1.
   $totalamount=0.00;
   for ($i=1;$i<$nitem;$i++)  //make the null field to go to lastest!
   {
   
      for ($j=1;$j<$nitem;$j++)
      {
         if ( empty($goods_partno[$j]))
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
            $discountrate[$j+1]=0;
         }
            
      }
      
   }
//changed by 12-6-01 view input
//  for ($i=1;$i<$nitem;$i++)
//     {
//echo "<p>";
//echo "goodspart".$goods_partno[$i]."qty".$qty[$i]."discountrate".$dis[$i]."goods_deta".$goods_detail[$i]."marktetprice".$market_price[$i];
//}
//view input


   $gitem=0; //check how many input goods item.
   for ($i=1;$i<=30;$i++)
   {
      if (empty($goods_partno[$i]))
      {
         $gitem=$i-1;
         break;
      }
   }
/* remove good_id by 10-7-02 
   for ($i=1;$i<=$gitem;$i++) //check item no if ch=" " become "-"//
   {

   
      $cha="";
	for ($j=0;$j<13;$j++)
      {
         if (empty($goods_partno[$j]))  //check goods_id if empty
            break;

         $ch=substr($goods_id[$i],$j,1);

         if ($ch==" ")  //change the space to "-"
            $ch="-";

         $cha=$cha.$ch;
      }
      $goods_id[$i]=$cha;
      
   }
    //find the goods_id when it only enter goods_partno. Vice visa
    
    for ($i=1;$i<=$gitem;$i++)
    {
     
     if ($goods_id[$i]=="")
     {
     $chpr=mysql_query("select goods_id from sumgoods where goods_partno='$goods_partno[$i]'");
     $chprs=mysql_fetch_row($chpr);
     list($tgoods_id)=$chprs;
     $goods_id[$i]=$tgoods_id;
     
     }
     else if($goods_partno[$i]=="")
     {
     $chpr=mysql_query("select goods_partno from sumgoods where goods_id='$goods_id[$i]'");
     $chprs=mysql_fetch_row($chpr);
     list($tgoods_partno)=$chprs;
     $goods_partno[$i]=$tgoods_partno;
     }
    }
     
 remove good_id by 10-7-02*/
   // find the marketprice detail from sumgoods to the goods_id
   for ($i=1;$i<=$gitem;$i++)
   {
        // if ($goods_partno[$i]>=1 && $goods_partno[$i]<=999)
        // {
        // echo $goods_detail[$i];
        // }
        // else
        // {
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
        // }

   }



 $cherr=0;





 //insert to co DB
 if ($customer=="n")
  {
  	
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


 $query="insert into co (co_no,co_date,sales_name,customer_name,customer_tel,customer_detail,member_id,status) values ('$co_no',now(),'$sales_name','$cutomer_name','$customer_tel','$customer_detail','$member_id','Y')";
}   
else if ($customer=="y") 
{
      $query="insert into co (co_no,co_date,sales_name,customer_name,customer_tel,customer_detail,status) values ('$co_no',now(),'$sales_name','$customer_name','$customer_tel','$customer_detail','Y')";
 }  
 //if success to add then add goods_co DB
      
   if (!mysql_query($query))
    $cherr=3;
   else
   {
    for ($i=1;$i<$gitem+1;$i++) //insert goods_co
     {
     $query1="insert into goods_co (co_no,goods_id,goods_partno,qty,discountrate,marketprice,status) values ('$co_no','$goods_id[$i]','$goods_partno[$i]',$qty[$i],'$discountrate[$i]','$market_price[$i]','Y')";
     if (!mysql_query($query1))
     {
        $cherr=1;
     }
     
    }
   }
   
   ?>

   <? include("show_and_create_co.php3");?>


<SCRIPT LANGUAGE="JavaScript">
function printout()
{
window.open('./co_store/co-<?echo $co_no;?>.rtf');
window.location="co_ap.php3";
}
</script>
</body>
</html>
