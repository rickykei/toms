<html>
<head>
<title>TOM'S & TRD SHOP 會員申請表</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<SCRIPT Language="JavaScript" SRC="checkmem.js">
</SCRIPT>
<style type="text/css">
<!--
.style2 {
	font-family: "細明體";
	font-size: 18px;
	font-weight: bold;
}
.style7 {font-size: 16px}
body {
	background-color: #C2C2C2;
}
-->
</style>
</head>
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body text="#FFFFFF">
<? php_track_vars ?>
<?
   	include("../config.php3");
	include("meminit.php3");
	$date1 = date("d-m-Y");
	$temp = substr($date1, 6, 4) + 1;
	$date2 = substr($date1, 0, 6) . $temp;
	$id = genid();
	mysql_close();
?>
<div align="center">
  <form name="memadd" method="POST" action="memadd.php3">
    <table width="620" border="0" cellpadding="2" cellspacing="2">
      <tr bgcolor="#336699"><td colspan="4"><div align="center" class="style2"><font color="#FFFFFF">TOM'S &amp; TRD SHOP 會員申請表</font></div></td>
      </tr>
	  <tr bgcolor="#7E94F8"> 
        <td colspan=" 2"><span class="style7">會員號碼：
          <input type="text" name="mem_id" size="10" maxlength="10" class="login" value=<?echo $id?>>
        </span></td>
        <td colspan="2"><span class="style7">出生日期：
          <input type="text" name="dob" size="10" maxlength="10" class="login
" value=<?echo $dob?>>
          &lt;dd-mm-yyyy&gt;</span></td>
      </tr>
      <tr bgcolor="#7E94F8"> 
        <td colspan="2"><span class="style7">英文姓名：
          <input name="mem_name_eng" type="text" class="login" value="<? echo $row["mem_name_eng"];?>" size="20" maxlength="50">
        </span></td>
        <td colspan="2"><span class="style7">中文姓名： 
          <input name="mem_name_chi" type="text" class="login" value="<? echo $row["mem_name_chi"];?>" size="20" maxlength="50">
        </span></td>
      </tr>
      <tr bgcolor="#7E94F8"> 
        <td colspan="2"><span class="style7">身份証號碼：
            <input name="mem_hkid" type="text" class="login" value="<? echo $row["mem_hkid"];?>" size="10" maxlength="10">
          <br>
          <br>
          &lt;Z123456(7)&gt;</span></td>
        <td width="53%"><span class="style7">電話：
          <input name="mem_tel" type="text" class="login" value="<? echo $row["mem_tel"];?>" size="15" maxlength="15">
            <br>
            <br>
          手提電話：
          <input name="mem_tel2" type="text" class="login" value="<? echo $row["mem_tel2"];?>" size="15" maxlength="15">
        </span></td>
      </tr>
      <tr align="center" valign="middle" bgcolor="#7E94F8"> 
        <td colspan="4"><div align="left" class="style7">
          <div align="center">地址:
            <textarea name="mem_add" cols="70" class="login"><? echo $row["mem_add"];?></textarea>        
              </div>
        </div></td>
      </tr>
      <tr bgcolor="#7E94F8"> 
        <td width="22%"><span class="style7">車輛號碼 1: 
          <input name="mem_carno" type="text" class="login" value="<? echo $row["mem_carno"];?>" size="10" maxlength="10">
        </span></td>
        <td width="25%"><span class="style7">型號 1：
          <input name="mem_cartype" type="text" class="login" value="<? echo $row["mem_cartype"];?>" size="12" maxlength="20">
        </span></td>
        <td colspan="2"><span class="style7">年份 1：
          <input name="mem_caryear" type="text" class="login" value="<? echo $row["mem_caryear"];?>" size="4" maxlength="4">
&lt;yyyy&gt; </span></td>
      </tr>
      <tr bgcolor="#7E94F8"> 
        <td width="22%"><span class="style7">車輛號碼 2: 
          <input name="mem_carno2" type="text" class="login" value="<? echo $row["mem_carno2"];?>" size="10" maxlength="10">
        </span></td>
        <td width="25%"><span class="style7">型號 2：
          <input name="mem_cartype2" type="text" class="login" value="<? echo $row["mem_cartype2"];?>" size="12" maxlength="20">
        </span></td>
        <td colspan="2"><span class="style7">年份 2：
          <input name="mem_caryear2" type="text" class="login" value="<? echo $row["mem_caryear2"];?>" size="4" maxlength="4">
&lt;yyyy&gt; </span></td>
      </tr>
      <tr bgcolor="#7E94F8"> 
        <td colspan="2"><span class="style7">入會日期 : 
          <input type="text" name="apply_date" size="10" maxlength="10" class="login" value=<?echo $date1?>>
        &lt;dd-mm-yyyy&gt;</span></td>
        <td colspan="2"><span class="style7">到期日期 : 
          <input type="text" name="exp_date" size="10" maxlength="10" class="login" value=<?echo $date2?>>
        &lt;dd-mm-yyyy&gt;</span></td>
      </tr>
      <tr bgcolor="#7E94F8"> 
        <td colspan="2"><span class="style7">會員証Bar Code : 
            <input name="barcode" type="text" class="login" value="<?echo $row["barcode"];?>" size="10" maxlength="10">
        </span></td>
		<td colspan="2"><span class="style7">備註: 
            <textarea name="other" cols="40" class="login"><?echo $row["other"];?></textarea>
        </span></td>
      </tr>
      <tr bgcolor="#7E94F8">
        <td colspan="4"><div align="right">
          <input type="submit" name="submit" value="輸入" class="login" onClick="return submitcheck()">
          <input type="reset" name="Reset" value="清除" class="login">
        </div></td>
      </tr>
    </table>
    <p>&nbsp;    </p>
  </form>
</div>
</body>
</html>
