<?
   include("../include/config.php");
   
  echo $goods_partno; 
   
   // update at 18-6-02 add input data 30 item per times
   
    
   
   
   
   
     if ($goods_partno!="")
     {
      
       $query2="update goods set ref_no='ref_no',in_comp_name='$company_name',goods_partno='$goods_partno' , cost='$cost', stock='$stock',place='$place' where id='$id'";
        if (mysql_query($query2))
        echo "Success!";
        else
        echo "Too Bad!1";
       }
        
       
 
echo "<a href=\"instocklist.php\">ÄòÄò¤J³f</a>";
?>
