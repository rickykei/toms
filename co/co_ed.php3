<?
   include("../config.php3");

   $nitem=30+1; //the no. of the item + 1.

//change at 12-6-01
   //$d=substr($po_date,0,2);    //set date format
   //$m=substr($po_date,3,2);
   //$y=substr($po_date,6,4);
   //$po_date=$y."-".$m."-".$d;


   



   for ($i=1;$i<$nitem;$i++)  //make the null field to go to lastest!
   {
    
      for ($j=1;$j<$nitem;$j++)
      {
      

         if ((empty($goods_partno[$j])))
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
//for debug 6-11-01     echo "i=".$i."goodspart".$goods_partno[$i]."qty".$qty[$i]."discountrate".$discountrate[$i]."goods_deta".$goods_detail[$i]."marktetprice".$market_price[$i]."<p>";
   }
   
      for ($i=1;$i<$nitem;$i++) //set all empty goods_id's un & ext_price = 0
   {
   //changed at 26-5-01//
      if ((empty($goods_partno[$i])))
      {
         $un[$i]="";
         $qty[$i]="";
         $market_price[$i]="";
      }
   }

/* remove goods_id 10-7-02
for ($i=1;$i<$nitem;$i++)
   {
      $cha="";
      for ($j=0;$j<13;$j++)
      {
         if (empty($goods_id[$i]))  //check goods_id if empty
            break;

         $ch=substr($goods_id[$i],$j,1);

         if ($ch==" ")  //change the space to "-"
            $ch="-";

         $cha=$cha.$ch;
      }
      $goods_id[$i]=$cha;
   
      if (empty($market_price[$i]))  //match the ext_price and market_price
      {
         $extps=mysql_query("select market_price from goods where goods_partno=$goods_partno");
         if (!empty($extps))
         {
            $extp=mysql_fetch_row($extps);
            echo mysql_error();
            list($ext)=$extp;
            $market_price[$i]=$ext;
         }
      }
   }

*/

   $gitem=0; //check how many input goods item.
   for ($i=1;$i<$nitem+1;$i++)
   {
      if (empty($goods_partno[$i]))
      {
         $gitem=$i-1;
         break;
      }
   }
   //delete at 29-10-01 cos no check market detail copy new in po_add.php3
   //$chext=0;
 //  for ($i=1;$i<$gitem+1;$i++)
  // {
 //    if (empty($market_price[$i]))
  //    {
  //       $chpr=mysql_query("select market_price from sumgoods where goods_id='$goods_id[$i]'");
  //       if (!empty($chpr))
  //       {
  //          $chprs=mysql_fetch_row($chpr);
  //          list($lchpr)=$chprs;
  //          $market_price[$i]=$lchpr;
  //       }
  //       else
  //       {
  //          $chext=1;
  //       }
  //    }
  // }
  //   if ($chext==1)
  // {
  //   echo "沒有貨物編號, 請從新輸入! ";
  //   exit();
  // }
   // find the marketprice detail from sumgoods to the goods_id
   //added at 291001
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


   }
   
   //added at 291001





 $cherr=0;
   if ($customer=="y")
      $query="update co set co_date='$co_date', sales_name='$sales_name', customer_name='$customer_name', customer_tel='$customer_tel', customer_detail='$customer_detail', member_id='' where co_no=$co_no";
   else if ($customer=="n")
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
      $query="update co set co_date='$co_date', sales_name='$sales_name', customer_name='', customer_tel='', customer_detail='', member_id='$member_id' where co_no=$co_no";
}


        if (!mysql_query($query))
  {
     $cherr=3;
    echo mysql_error();
   }
//
//   else
//   {
//      $query5="select goods_id,un from goods_po where po_no=$po_no"; //add the goods before deleted
//      $gunss=mysql_query($query5);
//      if ($guns)
//      {
//         $cherr=5;
//         echo mysql_error();
//      }
//
//      else
//      {
//         while($guns=mysql_fetch_row($gunss))
//         {
//            list($gid,$gun)=$guns;
//            $query6="update goods set stock=stock+$gun where goods_id=$gid";
//            if (!mysql_query($query6))
//            {
//               $cherr=6;
//               echo mysql_error();
//            }
 //        }
//
//      }


$query4="delete from goods_co where co_no=$co_no";  //delete old record
      if (!mysql_query($query4))
         $cherr=4;


   for ($i=1;$i<$gitem+1;$i++)
   {
      $query1="insert into goods_co (co_no,goods_id,goods_partno,qty,discountrate,marketprice,status) values ('$co_no','$goods_id[$i]','$goods_partno[$i]',$qty[$i],'$discountrate[$i]','$market_price[$i]','Y')";
      if (!mysql_query($query1))
     {
         $cherr=1;
         echo mysql_error();
      }

//      $query2="update goods set stock=stock-$un[$i] where goods_id='$goods_id[$i]'";
//      if (!mysql_query($query2))
//      {
//         $cherr=2;
//         echo mysql_error();
//      }
//   }
  }
   if ($cherr==0)
   {
      echo "資料順利輸入!<br>";
      include("show_and_create_co.php3");
   }
   else
      echo "Error=".$cherr."資料出現問題! 請從新輸入!<br>";

?>







<?
//   include("config.php3");
//
//   if ($member_id==0) //set the member_id = NULL if = 0
 //     $member_id="NULL";
//
   //update goods_po database
//   $query="update goods_po set po_no='$po_no', goods_id=$goods_id, un=$un, ext_price=$market_price where id='$id'";
   //update po database
//   $query1="update po set po_no='$po_no', po_date='$po_date', sales_name='$sales_name', customer_name='$customer_name', customer_tel='$customer_tel', customer_detail='$customer_detail', member_id=$member_id, status='$status' where id='$iid'";

//   if (mysql_query($query) && mysql_query($query1))
///   {
///     echo "Success!<br>";
//      echo "<a href='po_show.php3'>SHOW TABLE</a>";
//   }
//   else
//   {
//      echo "BAD!";
//   } 
?>

<!--//cos need to show po and regenrate so disable......
//<script language=JavaScript>
//function done() {
//alert("資料更改了!!");
//window.navigate("po_edit.php3?ed=<? echo $po_no?>");

}
//</script>
//-->

<html>
<!--
<body onload="javascript=done()";>     
//-->
</body>
</html>
