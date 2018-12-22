<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#ffffff">
<?
include("config.php3");

//clear the allstock

$query2="update sumgoods set allstock=0";
$rows=mysql_query($query2);

// count all qty for all goods in goods_invoice  mark it in sumggoods.allstock

   $query1="select  goods_partno, sum(qty) as qty from goods_invoice group by goods_partno";
   $rows=mysql_query($query1);
   while ($row=mysql_fetch_row($rows))
      {
         list($partno,$qty)=$row;
        // echo $partno."#".$qty."#";
         $query2="update sumgoods set allstock=allstock-$qty where goods_partno='$partno'";
         $rows2=mysql_query($query2);
       }
   
   $query="select * from goods ";
   $rows=mysql_query($query);
   if (!$rows)
      echo "Too Bad!\n";
   else
   {
      echo '<table width="913" border=1 class="login" cellspacing="0" cellpadding="0" height="12">';
      echo '<tr>';
          echo '<td width="20" >no.</td>',"\n";
          echo '<td width="40" >reference_no.</td>',"\n";
//          echo '<td width="100" >貨物編號</td>',"\n";
          echo '<td width="85">貨物partno. </td>',"\n";
          echo '<td width="200">描述 </td>',"\n";
          echo '<td width="51">成本價 </td>',"\n";
          echo '<td width="40">買入量 </td>',"\n";
          echo '<td width="38">售出量 </td>',"\n";
          echo '<td width="68">剩餘量 </td>',"\n";
          echo '<td width="65">放置地點 </td>',"\n";
          echo '<td width="119">買入時間 </td>',"\n";
          echo '<td width="20">status </td>',"\n";
          echo '<td width="67">修改 </td>',"\n";
      echo '</tr>',"\n";

      $chodd=0;
      while ($row=mysql_fetch_row($rows))
      {

         list($id,$ref_no,$goods_id,$goods_partno,$cost,$stock,$stockout,$place,$date,$status)=$row;

            if (($chodd % 2) ==1)
            {
               $bgcolor='bgcolor="#0066cc"';  //backgroud color
                       }
            else
               $bgcolor='bgcolor="#0066cc"';
            
            // search good name from sumgoods DB
             $query="select goods_detail from sumgoods where goods_partno =\"$goods_partno\"";
             $rows2=mysql_query($query);
                         
             if (!$rows2)
              echo "Too Bad!\n";
             else
              {
               while ($rows3=mysql_fetch_row($rows2))
               {
               list($goods_detail)=$rows3;
                            
               }
             }
             // search good name from sumgoods DB
             
            // update sumgoods.allstock + goods.stock
            



         $query5="select allstock from sumgoods where goods_partno=\"$goods_partno\"";
         $result5=mysql_query($query5);
         $row5=mysql_fetch_array ($result5);                
        // echo $row5["allstock"];
         
         if ($row5["allstock"]<=0)
         {
          if ((-1)*($row5["allstock"])<$stock)
          $stockout=(-1)*($row5["allstock"]);
          if ($stock<((-1)*($row5["allstock"])))
          $stockout=$stock;
          if ($stock==((-1)*$row5["allstock"]))
          $stockout=$stock;
         }
         else
         $stockout=0;
         
         $query4="update sumgoods set allstock=allstock+$stock where goods_partno=\"$goods_partno\"";
         $rows4=mysql_query($query4);
                         
             if (!$rows4)
              echo "Too Bad!\n";     
            echo '<tr>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>',$id,'</td>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>',$ref_no,'</td>',"\n";
  //          echo '<td ',$bgcolor,' ',$bgtext,'>',$goods_id,'</td>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>'.$goods_partno.'</td>',"\n";
            echo '<td ',$bgcolor,'>',$goods_detail,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$cost,'</td>','</td>',"\n";
            echo '<td ',$bgcolor,'>',$stock,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$stockout,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$stock-$stockout,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$place,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$date,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$status,'</td>',"\n";
            echo '<td ',$bgcolor,'><form name="form" method="post" action="goodsedit.php3">',"\n";
            echo '<input type="hidden" name="ed" value=',$id,'>',"\n";
            echo '<input type="submit" name="submit" value="EDIT" class="login">',"\n";

            echo '</form></td>',"\n";
            echo '</tr>',"\n";

            $chodd=$chodd+1;
         //}
      }
      echo "</table>\n";
   }
?>
</body>
</html>
