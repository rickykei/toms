<html>
<head>
<title>會員顯示</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#ffffff">
<form name=mem method=post action=membershow.php3>
<input type=text name=memid>
<input type=hidden name=method value=1>
<input type=submit name=submit value=by_member_no>
</form>
<form name=mem_carno method=post action=membershow.php3>
<input type=text name=mem_carno >
<input type=hidden name=method value=2>
<input type=submit name=submit value=by_car_no1>
</form>
<form name=mem_tel method=post action=membershow.php3>
<input type=text name=mem_tel>
<input type=hidden name=method value=3>
<input type=submit name=submit value=by_mem_tel>
</form>
<form name=mem_tel_mobile method=post action=membershow.php3>
<input type=text name=mem_tel2>
<input type=hidden name=method value=4>
<input type=submit name=submit value=by_mem_tel_mobile>
</form>
<form name=mem_chi method=post action=membershow.php3>
<input type=text name=mem_name_eng>
<input type=hidden name=method value=5>
<input type=submit name=submit value=由英文名>
</form>
<form name=mem_eng method=post action=membershow.php3>
<input type=text name=mem_name_chi>
<input type=hidden name=method value=6>
<input type=submit name=submit value=由中文名>
</form><?
if (!$memid)
$memid=0;
include("../config.php3");

//clear the allstock


// count all qty for all goods in goods_invoice  mark it in sumggoods.allstock

  if ($method==1)
   $query="select * from member where mem_id=$memid order by id";
  else if($method==2)
   $query="select * from member where mem_carno='$mem_carno' order by id";
  else if($method==3)
   $query="select * from member where mem_tel='$mem_tel' order by id";
  if ($method==4)
   $query="select * from member where mem_tel2='$mem_tel2' order by id";
  if ($method==5)
   $query="select * from member where mem_name_eng like \"%$mem_name_eng%\" order by id";
  if ($method==6)
   $query="select * from member where mem_name_chi like \"%$mem_name_chi%\" order by id";
 
   $rows=mysql_query($query);
   if (!$rows)
      echo "Please input data too Bad!\n";
   else
   {
      echo '<table width="2000" border=1 class="login" cellspacing="0" cellpadding="0" height="12">';
      echo '<tr>';
          echo '<td width="20" >no.</td>',"\n";
          echo '<td width="100" >會員編號</td>',"\n";
          echo '<td width="200">英文名</td>',"\n";
          echo '<td width="85">中文名</td>',"\n";
	  echo '<td width="60">身份証號碼</td>',"\n";
          echo '<td width="10">date of birth</td>',"\n";
	  echo '<td width="40">電話</td>',"\n";
          echo '<td width="40">電話2</td>',"\n";
          echo '<td width="250">地址</td>',"\n";
          echo '<td width="68">車號1</td>',"\n";
          echo '<td width="80">車種1</td>',"\n";
          echo '<td width="65">車年1</td>',"\n";
          echo '<td width="68">車號2</td>',"\n";
          echo '<td width="80">車種2</td>',"\n";
          echo '<td width="65">車年2</td>',"\n";
          echo '<td width="120">入會日期</td>',"\n";
          echo '<td width="120">exp date </td>',"\n";
	  echo '<td width="100">barcode</td>',"\n";
	  echo '<td width="67">修改</td>',"\n";
      echo '</tr>',"\n";

      $chodd=0;
      while ($row=mysql_fetch_row($rows))
      {
       $bgcolor='bgcolor="#0066cc"';
        list($id,$mem_id,$mem_name_eng,$mem_name_chi,$mem_hkid,$dob,$mem_tel,$mem_tel2,$mem_add,$mem_carno,$mem_cartype,$mem_caryear,$mem_carno2,$mem_cartype2,$mem_caryear2,$entry_date,$exp_date,$other,$barcode)=$row;
            echo '<tr>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'><a href=mem_del.php3?id=',$id,'>',$id,'</a></td>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>',$mem_id,'</td>',"\n";
            echo '<td ',$bgcolor,' ',$bgtext,'>'.$mem_name_eng.'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_name_chi,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_hkid,'</td>','</td>',"\n";
	    echo '<td ',$bgcolor,'>',$dob,'</td>','</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_tel,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_tel2,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_add,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_carno,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_cartype,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_caryear,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_carno2,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_cartype2,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$mem_caryear2,'</td>',"\n";
            echo '<td ',$bgcolor,'>',$entry_date,'</td>',"\n";
	    echo '<td ',$bgcolor,'>',$exp_date,'</td>',"\n";
	    echo '<td ',$bgcolor,'>',$barcode,'</td>',"\n";
            echo '<td ',$bgcolor,'><form name="form" method="post" action="mem_edit.php3">',"\n";
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
