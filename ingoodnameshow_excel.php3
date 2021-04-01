<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#000000">
<?
$date=date("d-m-y_h-i-s");
echo "$date";
//$openstring="D:/GitHub/yrt/invoice_store/";
$openstring="/home/vhost/tomsracing.com/invoice_store/";
$openstring.="$date";
$openstring.=".csv";

   include("config.php3");
$fp=fopen("$openstring","w");
   $string="";
$query1="select * from sumgoods  ";
//$query1="select * from sumgoods where goods_partno='16340-SP000' ";
   $query2=$query1." order by goods_id";
   $query3=$query1." order by goods_partno";
   $query4=$query1." order by goods_detail";
   $query5=$query1." order by market_price";
   $query6=$query1." order by allstock";
   $query7=$query1." order by status";
   
   if ($sort==1 || $sort=="")
   $rows=mysql_query($query1);
   if ($sort==2)
   $rows=mysql_query($query2);
   if ($sort==3)
   $rows=mysql_query($query3);
   if ($sort==4)
   $rows=mysql_query($query4);
   if ($sort==5)
   $rows=mysql_query($query5);
   if ($sort==6)
   $rows=mysql_query($query6);
   if ($sort==7)
   $rows=mysql_query($query7);
   if (!$rows)
      echo "Too Bad!\n";
   else
   {
      echo '<table width="700" border="1" class="login">';
      echo '<tr>';
$openstring="<a href=\"./invoice_store/";
$openstring.="$date";
$openstring.=".csv\">顯示存貨量</a>";

      echo "$openstring";

      echo '</tr>',"\n";

      $chodd=0;
	  $string="id,partno,detail,marketprice,stock,costavg"."\n";
	  fputs($fp,$string);
      while ($row=mysql_fetch_row($rows))
      {
         list($id,$goods_id,$goods_partno,$goods_detail,$market_price,$allstock,$status)=$row;


	for ($i=0;$i<count($rows);$i++)
         {
            if (($chodd % 2) ==1)
            {
               $bgcolor='bgcolor="#0066cc"';  //backgroud color
            }
            else
            {   $bgcolor='bgcolor="#0066cc"';
            }
             
             // search allstock for goods_id from goodsDB
             $query="select sum(stock) from goods where goods_partno = \"$goods_partno\"";
             $rows2=mysql_query($query);
             $tstock=0;
             $tstockout=0;
             if (!$rows2)
             { echo "Too Bad!\n";
              echo $goods_id;}
             else
              {
               while ($rows3=mysql_fetch_row($rows2))
               {
               list($tstock)=$rows3;
               }
              
              }
              // search allstock for goods_id from goodsDB
              
             // search sold out qty for goods_id from goods_invoice
             $query="select sum(qty) from goods_invoice where goods_partno = \"$goods_partno\"";
             $rows4=mysql_query($query);
             $tstockout=0;
             
             if (!$rows4)
              echo "too bad! for search goods_invoice\n";
             else
              {
               while ($rows5=mysql_fetch_row($rows4))
               {
               list($tstockout)=$rows5;
               }
              }
             // search sold out qty for goods_id from goods_invoice 
           $allstock=$tstock-$tstockout; 
		   $cost_per_stock=0;
		   $cost_total=0;
		   if ($allstock>0){
		   // search in stock order by desc again
		   // find the stock rest and cal the average of cost
		    $query="select cost,stock from goods where goods_partno = \"$goods_partno\" order by date desc";
		    $rows6=mysql_query($query);
			 if (!$rows6){
              echo "too bad! for search instock table\n";
			 }   else  {
				 
				 $temp_stock=$allstock;
				while ($rows7=mysql_fetch_assoc($rows6)){
				   if ($temp_stock>=$rows7["stock"]){
                     //echo $rows7["cost"]." ".$rows7["stock"]."<p>";
					 
					 $cost_total=$cost_total+($rows7["cost"]*$rows7["stock"]);
					 
				   }else if ($temp_stock<$rows7["stock"] && $temp_stock!=0 ){
					   $cost_total=$cost_total+($rows7["cost"]*$temp_stock);
					   break;
				   }
				   $temp_stock=$temp_stock-$rows7["stock"];
               }
			   
			   $cost_per_stock=$cost_total/$allstock;
			  }
		   }
		   
$string="$id".","."\"$goods_partno\"".","."\"$goods_detail\"".","."$market_price".","."$allstock".","."$cost_per_stock"."\n";
           fputs($fp,$string);
 $chodd=$chodd+1;
         }
      }
      echo "</table>\n";
   }

fclose($fp);

?>
</body>
</html>
