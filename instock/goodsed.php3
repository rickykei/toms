<?
   include("../include/config.php");
   
  
   
   // update at 18-6-02 add input data 30 item per times
   
    
   if ($jp_price==0 || $jp_price==''){
	echo $goods_partno;    
   } else{
	 $jp_cost= $jp_price*(1-$discount)+$jp_delivery+$jp_paint;
     $cost= $jp_rate*$jp_cost;
   }
     if ($goods_partno!="")
     {
      
       $query2="update goods set jp_cost='$jp_cost', jp_price='$jp_price', discount='$discount', jp_delivery='$jp_delivery',jp_paint='$jp_paint' , jp_rate='$jp_rate', ref_no='$ref_no',in_comp_name='$company_name',goods_partno='$goods_partno' , cost='$cost', stock='$stock',place='$place' where id='$id'";
        if (mysql_query($query2))
        echo "Success!";
        else
        echo "Too Bad!1";
       }
        
       
 
echo "<a href=\"instocklist.php\">ÄòÄò¤J³f</a>";
?>
