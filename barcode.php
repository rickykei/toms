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
  �п�J�����ͱ��X���r��G 
<input type="text" name="text"> 
  <input type="submit" name="transfer" value="�ন���X"> 
</form> 
<? if($text)barcode( "$text");?> 
</BODY>  
</HTML>  
