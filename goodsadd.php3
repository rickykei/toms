<?
   include("config.php3");
   $result = mysql_query ("select * from hkjp ");
   $row=mysql_fetch_array ($result);
   echo $row["hk"];
   echo $row["jp"];
   $hk=$row["hk"];
   $jp=$row["jp"];
  echo $goods_partno[0]; 
   
   // update at 18-6-02 add input data 30 item per times
for ($i=0;$i<30;$i++)
{
   if($goods_partno[$i]=="")
   break;
   $query="select * from sumgoods where goods_partno='$goods_partno[$i]'";
   $result=mysql_query($query);
   $row2= mysql_fetch_array ($result);
   echo $row2["goods_partno"];
   ///$goods_id=$row2["goods_id"];
   ///$goods_partno=$row2["goods_partno"];
   
   if ($fromdollar[$i]==0)
   $cost[$i]=$cost[$i]*$hk;
   
     if ($goods_partno[$i]!="")
     {
      $query3="insert into goods (ref_no,goods_id,goods_partno,cost,stock,stockout,place,date,status,in_comp_name) values ('$ref_no','$goods_partno[$i]','$goods_partno[$i]',$cost[$i],$stock[$i],0,$place[$i],now(),'Y','$company_name')";
      if (mysql_query($query3)or die(mysql_error()))
       {
       echo "Success!";
       $query2="update sumgoods set allstock=allstock+$stock[$i] where goods_partno='$goods_partno[$i]'";
        if (mysql_query($query2))
        echo "Success!";
        else
        echo "Too Bad!1";
       }
       else
       {
       echo "Too Bad!2";
       }
      }
      else
      {
      echo "can't find goods_id in sumgoods...plz go to 入貨名表";
      }   
}
echo "<a href=\"goodsap.php3?add=0\">續續入貨</a>";
?>
