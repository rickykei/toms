<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#000000">
<?
   include("config.php3");

   $query1="select * from sumgoods";
   $query2=$query1." order by goods_id";
   $query3=$query1." order by goods_partno";
   $query4=$query1." order by goods_detail";
   $query5=$query1." order by market_price";
   $query6=$query1." order by allstock";
   $query7=$query1." order by status";
   
   if ($sort==1)
   {$query1="select * from sumgoods order by id";
   $rows=mysql_query($query1);}
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
          echo '<td width="40"><a href="ingoodnameshow.php3?sort=1">id<a> </td>',"\n";
//          echo '<td width="90"><a href="ingoodnameshow.php3?sort=2">貨物編號 </td>',"\n";
          echo '<td width="90"><a href="ingoodnameshow.php3?sort=3">貨物partno. </td>',"\n";
          echo '<td width="300"><a href="ingoodnameshow.php3?sort=4">描述 </td>',"\n";
          echo '<td width="50"><a href="ingoodnameshow.php3?sort=5">市場價格 </td>',"\n";
          echo '<td width="40"><a href="ingoodnameshow.php3?sort=6">總存量 </td>',"\n";
          echo '<td width="10"><a href="ingoodnameshow.php3?sort=7">status </td>',"\n";
          echo '<td >修改 </td>',"\n";
      echo '</tr>',"\n";

      $chodd=0;
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
             //$query="select stock from goods where goods_id = \"$goods_id\"";
             $query="select sum(stock) from goods where goods_partno=\"$goods_partno\"";
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
               //$tstock=$tstock+$stock;
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
               //$tstockout=$tstockout+$stockout;
               }
              //$alllstock=$tstock-$tstockout;
              }
             // search sold out qty for goods_id from goods_invoice 
           $alllstock=$tstock-$tstockout; 
            echo '<tr>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>',$id,'</td>',"\n";
       //     echo '<td ',$bgcolor,' ',$bgtext,'>',$goods_id,'</td>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>'.$goods_partno.'</td>',"\n";
            echo '<td ',$bgcolor,'>',$goods_detail,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$market_price,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$alllstock,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$status,'</td>',"\n"; 
            echo '<td ',$bgcolor,'><form name="form" method="post" action="ingoodnameedit.php3">',"\n";
            echo '<input type="hidden" name="id" value=',$id,'>',"\n";
            echo '<input type="hidden" name="update" value=0>',"\n";
            echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";
            echo '</form></td>',"\n";
            echo '</tr>',"\n";

            $chodd=$chodd+1;
         }
      }
      echo "</table>\n";
   }



?>
</body>
</html>
