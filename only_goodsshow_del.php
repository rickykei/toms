<html>
<head>
<title>del</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<style>
body { 
	 color : white;
}
</style>
<script language="JavaScript">
 
</script><?
   include("config.php3");

   $query="select * from goods where id=$ed";

   $rows2=mysql_query($query);
   if (!$rows2)
      echo "Too Bad!";
   else
   {
      $row=mysql_fetch_row($rows2);
      list($id,$ref_no,$goods_id,$goods_partno,$cost,$stock,$stockout,$place,$date,$status)=$row;  

   }
   
   	
		//delete db 1 record by 1
		if ($goods_partno!="")    {
		  $query3="delete from goods where id =$ed";
		  if (mysql_query($query3))
		   {
				echo "<p>instock deleted".$ed;
		           $query2="update sumgoods set allstock=allstock-".$stock." where goods_partno='$goods_partno'";
		    
				if (mysql_query($query2)){
						echo "<p>deduct stock";
				}else{
					echo "<p>fail to deduct stock";
				}
 
			}
        
        
		}
?>
</head>

<body bgcolor="#0066cc" text="#000000">
 
<table border="1">
<tr>
  <td> reference no : </td><td><?echo "$ref_no";?></td>
</tr>
<tr> 
 <td>�f���s��:  </td><td><?echo "$goods_id";?></td>
  </tr>
 <tr> <td>   �f��Part NO.: </td><td>
     <?echo "$goods_partno";?> </td>
   </tr>
    
	
    <tr> 
      <td> 0.066�䤸 </td>
      <td>  1.000�餸 </td>
    </tr>

    <tr> 
      <td>  ��������/�C�� $  </td>
      <td>
        <?echo "$cost";?> 
      </td>
    </tr>
    <tr> 
      <td  >&nbsp;</td>
      <td  ><font color="#FFFFFF" size="2">�餸 
        <input type="radio" name="fromdollar" value="0">
        �䤸 
        <input type="radio" name="fromdollar" value="1" checked>
        </font></td>
    </tr>
    <tr> 
      <td> �R�J�s�q </td>
      <td>
         <?echo "$stock";?> 
      </td>
    </tr>

    <tr> 
      <td><font face="�s�ө���" color="#FFFFFF" size="2"> �s�f�a: </font></td>
      <td><?php 
	  if ($place==1){echo "����";}
	  
	  if ($place==2){echo "�j��";}
	  
	  if ($place==3){echo "�g���W";}
	  ?>
	  
      </td>
    </tr>
    
  </table>
  <p>&nbsp; </p>
  <td colspan="3">&nbsp;</td>
 
</body>
</html>
