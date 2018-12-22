<?php  

   // barcode.php 
//-----------code2(i.e. barcode.php)---------------------------------    

      function  barcode($text)  {  
            $enc_text  =  urlencode($text);  
            echo  "<img  src=\"barcodeimage.php?$enc_text\"  border=0   
Alt=\"$text\">";  
    }  
?>  
<HTML>  
<BODY  bgcolor=white> 
<form name="form1" method="post" action=""> 
  請輸入欲產生條碼之字串： 
<input type="text" name="text"> 
  <input type="submit" name="transfer" value="轉成條碼"> 
</form> 
<? if($text)barcode( "$text");?> 
</BODY>  
</HTML>  
