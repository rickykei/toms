<?
include("config.php3");
$result = mysql_query ("select * from hkjp ");
$result2 = mysql_query ("select * from goods_company order by company_name");
$result3 = mysql_num_rows($result2);
$row=mysql_fetch_array ($result);
$row2=mysql_fetch_array ($result2);
?>
<html>
<head>

<title>goodsap.php3 <?echo $result3;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<? //<LINK REL=stylesheet HREF="english.css" TYPE="text/css">?>

<script language="JavaScript">
function checkform()
{
	if(document.goodadform.ref_no.value == "")
	{
	alert ("�п�ref_no.");
	document.goodadform.ref_no.focus();
	}else
	{
        document.goodadform.submit();
        }

}
</script>
</head>

<body bgcolor="#99CCFF" text="#003366">
<form name=goodadform method="post" action="goodsad.php3">
  <? /*<p><font face="�s�ө���" color="#FFFFFF" size="2"> �f���s��: </font>
    <input type="text" name="goods_id" maxlength="13" class="login">
    <font face="�s�ө���" color="#FFFFFF" size="2"> �f��Part NO.:</font>
    <input type="text" name="goods_partno" maxlength="20" class="login">
  </p>*/?>
  <table width="609" border="0">
    <tr> 
      <td width="52%"><font face="�s�ө���" color="#0066CC" size="2"> 
        <?echo $row["hk"];?>
        �䤸 &lt;--&gt; 
        <?echo $row["jp"];?>
        �餸</font></td>
      <td width="48%"><font face="�s�ө���" color="#0066CC" size="2"> </font></td>
    </tr>
  </table>
  <table width="750" border="0">
    <tr> 
      <th width="25%" height="20" bgcolor="#99CC66"> 
        <div align="left"><font face="�s�ө���" color="#0066CC" size="2">REFERENCE_NO 
          : </font></div>
      </th>
      <th width="25%" height="20" bgcolor="#99CC66"><font face="�s�ө���" color="#FFFFFF" size="2"> 
        <input type="text" name="ref_no" maxlength="20" class="login">
        </font></th>
      <td width="10%" height="20" bgcolor="#99CC66"> 
        <div align="center"><font color="#0066CC" size="2">�R�J��</font></div>
      </td>
      <td width="20%" height="20" bgcolor="#99CC66"><font color="#0066CC">
        <select name="company_name" size="1">
          <? for ($i=1;$i<=$result3;$i++)
		{
		echo "<option value=\"".$row2["company_name"]."\">".$row2["company_name"]."</option>";
$row2=mysql_fetch_array ($result2);
		}
	?>
        </select>
        </font></td>
      <td width="15%" height="20"><font color="#0066CC"><a href="goods_company_edit.php3" target="_blank">EDIT</a></font></td>
    </tr>
    <tr> 
      <td width="25%" bgcolor="#FFFFFF"><font face="�s�ө���" color="#0066CC" size="2">�f��Part 
        NO.:</font> </td>
      <td width="20%" bgcolor="#FFFFFF"><font face="�s�ө���" color="#0066CC" size="2">��������/�C�� 
        $</font> </td>
      
      <td width="20%" bgcolor="#FFFFFF"><font face="�s�ө���" color="#0066CC" size="2">�R�J�s�q</font></td>
      <td width="15%" bgcolor="#FFFFFF"><font face="�s�ө���" color="#0066CC" size="2">�s�f�a: </font></td>
    </tr>
    <? for($i=0;$i<30;$i++)
    {
    	?>
    <tr> 
      <td width="200" bgcolor="#99CCCC"><font face="�s�ө���" color="#FFFFFF" size="2"> 
        <input type="text" name="<? echo "goods_partno[$i]";?>" maxlength="20" class="login">
        </font></td>
      <td width="200" bgcolor="#99CCCC"> 
        <input type="text" name="<? echo "cost[$i]";?>" maxlength="9" class="login">
      </td>
     
        <input type="hidden" name="<? echo "fromdollar[$i]";?>" value="1" >
        
      <td width="200" bgcolor="#99CCCC"> <font color="#0066CC"> 
        <input type="text" name="<? echo "stock[$i]";?>" maxlength="9" class="login">
        </font></td>
      <td width="100" bgcolor="#99CCCC">
	   
		<font face="�s�ө���" size="2"><font color="#0066CC"> �g���W<font>
        <input type="radio" name="<? echo "place[$i]";?>" value="3" checked class="login">
        </font>
		</td>
    </tr>
    <? } ?>
    <tr> 
      <td width="25%">
	  <input type="button" onclick="JavaScript:checkform();" value="Submit">
        <input type="reset" name="Submit2" value="Reset" class="login">
      </td>
      <td colspan="5">&nbsp; </td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <td colspan="3">&nbsp;</td>
    <p></p>
  </form>
</body>
</html>
