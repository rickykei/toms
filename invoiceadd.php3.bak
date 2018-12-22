<?  //update at19-2-03
$today=Date("d/m/Y");
?>

<html>
<head>

<title>invoice add</title>
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#FFFFFF">
<?
   include("config.php3");
   
   $nitem=30+1; //the no. of the item + 1.
   $totalamount=0.00;
   for ($i=1;$i<$nitem;$i++)  //make the null field to go to lastest!
   {
   
      for ($j=1;$j<$nitem;$j++)
      {
         if (empty($goods_partno[$j]))
         {
            $temp=$goods_id[$j];
            $goods_id[$j]=$goods_id[$j+1];
            $goods_id[$j+1]=$temp;

            $temp1=$qty[$j];
            $qty[$j]=$qty[$j+1];
            $qty[$j+1]=$temp1;

            $temp2=$discountrate[$j];
            $discountrate[$j]=$discountrate[$j+1];
            $discountrate[$j+1]=$temp2;
            
            $temp3=$goods_partno[$j];
            $goods_partno[$j]=$goods_partno[$j+1];
            $goods_partno[$j+1]=$temp3;
            
            $temp4=$market_price[$j];
            $market_price[$j]=$market_price[$j+1];
            $market_price[$j+1]=$temp4;
            
            $temp5=$goods_detail[$j];
            $goods_detail[$j]=$goods_detail[$j+1];
            $goods_detail[$j+1]=$temp5;
            
            $qty[$j+1]="";
            $discountrate[$j+1]=0;
         }
            
      }
      
   }
//changed by 12-6-01 view input
  for ($i=1;$i<$nitem;$i++)
    {
//echo "<p>";
//echo "goodspart".$goods_partno[$i]."qty".$qty[$i]."discountrate".$dis[$i]."goods_deta".$goods_detail[$i]."marktetprice".$market_price[$i];
}
//view input


   $gitem=0; //check how many input goods item.
   for ($i=1;$i<=30;$i++)
   {
      if (empty($goods_id[$i])&& empty($goods_partno[$i]))
      {
         $gitem=$i-1;
         break;
      }
   }
 
/*   for ($i=1;$i<=$gitem;$i++) //check item no if ch=" " become "-"//
   {

   
      $cha="";
      for ($j=0;$j<13;$j++)
      {
         if (empty($goods_id[$i])&& empty($goods_partno[$j]))  //check goods_id if empty
            break;

         $ch=substr($goods_id[$i],$j,1);

         if ($ch==" ")  //change the space to "-"
            $ch="-";

         $cha=$cha.$ch;
      }
      $goods_id[$i]=$cha;
      
   }

    //find the goods_id when it only enter goods_partno. Vice visa
    
    for ($i=1;$i<=$gitem;$i++)
    {
     
     if ($goods_id[$i]=="")
     {
     $chpr=mysql_query("select goods_id from sumgoods where goods_partno='$goods_partno[$i]'");
     $chprs=mysql_fetch_row($chpr);
     list($tgoods_id)=$chprs;
     $goods_id[$i]=$tgoods_id;
     
     }
     else if($goods_partno[$i]=="")
     {
     $chpr=mysql_query("select goods_partno from sumgoods where goods_id='$goods_id[$i]'");
     $chprs=mysql_fetch_row($chpr);
     list($tgoods_partno)=$chprs;
     $goods_partno[$i]=$tgoods_partno;
     }
    }
     
*/
   // find the marketprice detail from sumgoods to the goods_id
   for ($i=1;$i<=$gitem;$i++)
   {
        // if ($goods_partno[$i]>=1 && $goods_partno[$i]<=999)
        // {
        // echo $goods_detail[$i];
        // }
        // else
        // {
         $chpr=mysql_query("select goods_detail,market_price from sumgoods where goods_partno=\"$goods_partno[$i]\"");
         $chprs=mysql_fetch_row($chpr);
         list($detail,$lchpr)=$chprs;
         if ($market_price[$i]=="" )
         {
         $market_price[$i]=$lchpr;
         }
         if ($goods_detail[$i]=="")
         {
         $goods_detail[$i]=$detail;
         }
        // }

   }



 $cherr=0;





 //insert to invoice DB
        $temp_date=date('Y-m-d G:i:s');
        echo $temp_date;
        //$temp_date="2002-08-21 20:34:02";
        echo $temp_date;
         $query="select invoice_no from invoice order by invoice_no desc";
         $rows=mysql_query($query);
         $row=mysql_fetch_row($rows);
         list($invoice_no)=$row;
 
 if ($customer=="n")
  {
  // 16-11-01 add check memeber_detail from member_id
 $query="select exp_date,mem_name_chi,mem_name_eng,mem_tel,mem_tel2 from member where mem_id='$member_id'";
 $result = mysql_query ($query);
 $row_mem_detail=mysql_fetch_array($result);
 $customer_name=$row_mem_detail["mem_name_eng"];
 if ($customer_name=="")
 $customer_name=$row_mem_detail["mem_name_chi"];
 $customer_exp_date=$row_mem_detail["exp_date"];
 $customer_tel=$row_mem_detail["mem_tel"];
 if (empty($customer_tel))
 {
 $customer_tel=$row_mem_detail["mem_tel2"];
 }
do {

         $invoice_no=$invoice_no+1;
         echo $invoice_no; 
 $query="insert into invoice (invoice_no,invoice_date,sales_name,customer_name,customer_tel,customer_detail,member_id,status) values ('$invoice_no',now(),'$sales_name','$customer_name','$customer_tel','$customer_detail','$member_id','Y')";
}while(!mysql_query($query));
}

 else
 
   if ($customer=="y")
      {
do {

         $invoice_no=$invoice_no+1;
         echo $invoice_no;
	$query="insert into invoice(invoice_no,invoice_date,sales_name,customer_name,customer_tel,customer_detail,customer_car_no,customer_car_type,status) values ('$invoice_no','$temp_date','$sales_name','$customer_name','$customer_tel','$customer_detail','$customer_car_no','$customer_car_type','Y')";
   	}while(!mysql_query($query));
}




// find out the invoiceno add it b4 20-8-2002
 
 //if success to add then add goods_invoice DB
      
//   if (!mysql_query($query))
//    $cherr=3;
//   else
//   {

	// find out the invoiceno add it b4 20-8-2002   
	for ($i=1;$i<$gitem+1;$i++) //insert goods_invoice
     	{
     $query1="insert into goods_invoice (invoice_no,goods_id,goods_partno,qty,discountrate,marketprice,status) values ('$invoice_no','$goods_id[$i]','$goods_partno[$i]',$qty[$i],'$discountrate[$i]','$market_price[$i]','Y')";
     if (!mysql_query($query1))
     {
        $cherr=1;
     }
     
    }
 //  }
   
   ?>
   <? include("show_and_create_invoice.php3");?>
   <? /*
<html>
<head>
<title>(invoice) toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#FFFFFF"> 

   
   if ($cherr==0)
   {
   	echo "<table width=\"75%\" border=\"0\">";
	echo "<tr> ";
	echo "<td width=\"46%\" class=\"login\">發票編號.:".$invoice_no."</td>";
	echo "<td width=\"54%\" class=\"login\">發票日期: ".$invoice_date."</td>";
	echo "</tr>";
	echo "<tr> ";
	echo "<td width=\"46%\">售貨人:".$sales_name."</td>";
	echo "<td width=\"54%\">買貨人:".$customer_name;
	if ($customer=='y'){ echo "[非會員]";}else if ($customer=='n'){echo " [會員]";}
	echo "</td>";
	echo "</tr>";
	echo "<tr> ";
	echo "<td width=\"46%\">電話: ".$customer_tel."<br>";
	echo "其他資料:".$customer_detail." <br>";
	echo "</td>";
	echo "<td width=\"54%\">會員編號:".$member_id."</td></tr><tr>";
	
	if ($today>$customer_exp_date)
	$color_warn="red";
	else
	$color_warn="white";
	
	if (!empty($customer_tel))
	{
	$customer_name=$customer_name." Tel-".$customer_tel." [".$member_id."]";
	}
	else 
	{
	$customer_name=$customer_name." [".$member_id."]";
	}
	
	echo "<td width=\"46%\"><font color=\"$color_warn\">會員證到期日：$customer_exp_date";
	echo "</font></td>";
	echo "<td width=\"54%\">&nbsp;</td></tr></table>";
	echo "<table width=\"75%\" border=\"1\"><tr><td>&nbsp;</td><td>item_partno</td><td>description</td><td>qty</td><td>unitprice</td><td>discount</td><td>amount</td><td>&nbsp;</td>";
	echo "</tr>";
	$totalamount=0;
	for ($i=1;$i<$gitem+1;$i++)
	{
	echo "<tr>";
	echo "<td>".$i."</td>";
	echo "<td>".$goods_partno[$i]."</td>";
	echo "<td>".$goods_detail[$i]."</td>";
	echo "<td>".$qty[$i]."</td>";
	echo "<td>".$market_price[$i]."</td>";
	echo "<td>".$discountrate[$i]."</td>";
	$amount[$i]=$qty[$i]*($market_price[$i]-($market_price[$i]*($discountrate[$i]/100)));
	$totalamount=$totalamount+$amount[$i];
	$amount[$i]=number_format($amount[$i],2);
	echo "<td>".$amount[$i]."</td>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	}
	echo "<tr>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>total</td>";
	$totalamount=number_format($totalamount,2);
	echo "<td>".$totalamount."</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</table>";
	

	$invoicepath="./invoice_store/";
        $invoicefile="invoice".$invoice_no.".rtf";
	$fp= fopen("$invoicepath"."$invoicefile","w");
	$string='{\rtf1\ansi\ansicpg950\uc2 \deff15\deflang1033\deflangfe1028{\fonttbl{\f0\froman\fcharset0\fprq2{\*\panose 02020603050405020304}Times New Roman;}{\f18\froman\fcharset136\fprq2{\*\panose 02020300000000000000}\'b7\'73\'b2\'d3\'a9\'fa\'c5\'e9{\*\falt PMingLiU};}{\f15\froman\fcharset136\fprq2{\*\panose 02010601000101010101}\'b7\'73\'b2\'d3\'a9\'fa\'c5\'e9;}
{\f24\froman\fcharset136\fprq2{\*\panose 02010601000101010101}@\'b7\'73\'b2\'d3\'a9\'fa\'c5\'e9;}{\f110\froman\fcharset238\fprq2 Times New Roman CE;}{\f111\froman\fcharset204\fprq2 Times New Roman Cyr;}
{\f113\froman\fcharset161\fprq2 Times New Roman Greek;}{\f114\froman\fcharset162\fprq2 Times New Roman Tur;}{\f115\froman\fcharset186\fprq2 Times New Roman Baltic;}{\f202\froman\fcharset0\fprq2 \'b7\'73\'b2\'d3\'a9\'fa\'c5\'e9;}
{\f256\froman\fcharset0\fprq2 @\'b7\'73\'b2\'d3\'a9\'fa\'c5\'e9;}}{\colortbl;\red0\green0\blue0;\red0\green0\blue255;\red0\green255\blue255;\red0\green255\blue0;\red255\green0\blue255;\red255\green0\blue0;\red255\green255\blue0;\red255\green255\blue255;
\red0\green0\blue128;\red0\green128\blue128;\red0\green128\blue0;\red128\green0\blue128;\red128\green0\blue0;\red128\green128\blue0;\red128\green128\blue128;\red192\green192\blue192;}{\stylesheet{\nowidctlpar\aspalpha\aspnum\faauto\adjustright 
\kerning2\loch\af0\hich\af0\dbch\f15\cgrid \snext0 Normal;}{\*\cs10 \additive Default Paragraph Font;}}{\info{\title SOLDTO}{\author TOMS & TRD SHOP}{\operator sunglan}{\creatim\yr2001\mo6\dy4\hr13\min18}{\revtim\yr2001\mo6\dy4\hr13\min27}
{\printim\yr2001\mo3\dy26\hr17\min31}{\version4}{\edmins1}{\nofpages2}{\nofwords438}{\nofchars2499}{\vern93}}\paperw11906\paperh16838\margl480\margr626\margt3414\margb1440\gutter0 {\*\fchars 
!),.:\'3b?]\'7d\'a1\'50\'a1\'56\'a1\'58\'a1\'a6\'a1\'a8\'a1\'4c\'a1\'4b\'a1\'45\'a1\'ac\'a1\'5a\'a1\'42\'a1\'43\'a1\'72\'a1\'6e\'a1\'76\'a1\'7a\'a1\'6a\'a1\'66\'a1\'aa\'a1\'4a\'a1\'57\'a1\'59\'a1\'5b\'a1\'60\'a1\'64\'a1\'68\'a1\'6c\'a1\'70\'a1\'74
\'a1\'78\'a1\'7c\'a1\'5c\'a1\'4d\'a1\'4e\'a1\'4f\'a1\'51\'a1\'52\'a1\'53\'a1\'54\'a1\'7e\'a1\'a2\'a1\'a4\'a1\'49\'a1\'5e\'a1\'41\'a1\'44\'a1\'47\'a1\'46\'a1\'48\'a1\'55\'a1\'62\'a2\'46}{\*\lchars 
([\'7b\'a1\'a5\'a1\'a7\'a1\'ab\'a1\'71\'a1\'6d\'a1\'75\'a1\'79\'a1\'69\'a1\'65\'a1\'a9\'a1\'5f\'a1\'63\'a1\'67\'a1\'6b\'a1\'6f\'a1\'73\'a1\'77\'a1\'7b\'a1\'7d\'a1\'a1\'a1\'a3\'a1\'5d\'a1\'61\'a2\'47\'a2\'44}
\deftab480\ftnbj\aenddoc\hyphcaps0\formshade\horzdoc\dgmargin\dghspace120\dgvspace180\dghorigin480\dgvorigin3414\dghshow0\dgvshow2\jcompress\lnongrid\viewkind1\viewscale75 \fet0\sectd 
\psz9\linex0\headery851\footery992\colsx425\endnhere\sectlinegrid360\sectspecifyl {\*\pnseclvl1\pnucrm\pnstart1\pnindent720\pnhang{\pntxta \dbch .}}{\*\pnseclvl2\pnucltr\pnstart1\pnindent720\pnhang{\pntxta \dbch .}}{\*\pnseclvl3
\pndec\pnstart1\pnindent720\pnhang{\pntxta \dbch .}}{\*\pnseclvl4\pnlcltr\pnstart1\pnindent720\pnhang{\pntxta \dbch )}}{\*\pnseclvl5\pndec\pnstart1\pnindent720\pnhang{\pntxtb \dbch (}{\pntxta \dbch )}}{\*\pnseclvl6\pnlcltr\pnstart1\pnindent720\pnhang
{\pntxtb \dbch (}{\pntxta \dbch )}}{\*\pnseclvl7\pnlcrm\pnstart1\pnindent720\pnhang{\pntxtb \dbch (}{\pntxta \dbch )}}{\*\pnseclvl8\pnlcltr\pnstart1\pnindent720\pnhang{\pntxtb \dbch (}{\pntxta \dbch )}}{\*\pnseclvl9\pnlcrm\pnstart1\pnindent720\pnhang
{\pntxtb \dbch (}{\pntxta \dbch )}}\trowd \trgaph28\trrh528\trleft-28 \clvertalt\cltxlrtb \cellx1200\clvertalt\cltxlrtb \cellx4560\clvertalt\cltxlrtb \cellx5760\clvertalt\cltxlrtb \cellx8880\clvertalt\cltxlrtb \cellx10826\pard\plain 
\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright \kerning2\loch\af0\hich\af0\dbch\f15\cgrid {\cell \cell \cell \hich\af0\dbch\af15\loch\f0 C.O.D\cell \hich\af0\dbch\af15\loch\f0 RS-'.$invoice_no.'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\trowd \trgaph28\trrh524\trleft-28 \clvertalt\cltxlrtb \cellx4560\clvertalt\cltxlrtb \cellx5760\clvertalt\cltxlrtb \cellx8880\clvertalt\cltxlrtb \cellx10826\pard 
\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\f18\loch\af0 '.$customer_name.'\cell \cell \cell \hich\af0\dbch\af15\loch\f0 '.$invoice_date.'\cell }\pard \widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard 
\nowidctlpar\aspalpha\aspnum\faauto\adjustright {
\par }\trowd \trgaph28\trleft-28 \clvertalt\cltxlrtb \cellx2280\clvertalt\cltxlrtb \cellx7320\clvertalt\cltxlrtb \cellx8160\clvertalt\cltxlrtb \cellx9360\clvertalt\cltxlrtb \cellx10560\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {
\hich\af0\dbch\af15\loch\f0 '.$goods_partno[1].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[1].'\cell \hich\af0\dbch\af15\loch\f0 '.$qty[1].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 
'.$market_price[1].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[1].'\cell }\pard \widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\trowd \trgaph28\trleft-28 \clvertalt\cltxlrtb \cellx2280
\clvertalt\cltxlrtb \cellx7320\clvertalt\cltxlrtb \cellx8160\clvertalt\cltxlrtb \cellx9360\clvertalt\cltxlrtb \cellx10560\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[2].'\cell 
\hich\af0\dbch\f18\loch\af0 '.$goods_detail[2].'\cell \hich\af0\dbch\af15\loch\f0 '.$qty[2].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[2].'\cell \hich\af0\dbch\af15\loch\f0 
'.$amount[2].'\cell }\pard \widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[3].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[3].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[3].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[3].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[3].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[4].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[4].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[4].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[4].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[4].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[5].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[5].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[5].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[5].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[5].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[6].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[6].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[6].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[6].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[6].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[7].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[7].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[7].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[7].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[7].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[8].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[8].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[8].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[8].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[8].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[9].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[9].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[9].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[9].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[9].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[10].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[10].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[10].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[10].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[10].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[11].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[11].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[11].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[11].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[11].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[12].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[12].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[12].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[12].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[12].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[13].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[13].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[13].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[13].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[13].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[14].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[14].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[14].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[14].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[14].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[15].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[15].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[15].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[15].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[15].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[16].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[16].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[16].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[16].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[16].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[17].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[17].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[17].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[17].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[17].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[18].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[18].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[18].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[18].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[18].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[19].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[19].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[19].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[19].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[19].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[20].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[20].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[20].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[20].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[20].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[21].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[21].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[21].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[21].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[21].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[22].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[22].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[22].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[22].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[22].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[23].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[23].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[23].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[23].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[23].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[24].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[24].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[24].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[24].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[24].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[25].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[25].'
\cell \hich\af0\dbch\af15\loch\f0 '.$qty[25].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[25].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[25].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[26].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[26].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[26].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[26].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[26].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[27].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[27].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[27].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[27].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[27].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[28].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[28].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[28].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[28].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[28].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[29].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[29].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[29].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[29].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[29].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$goods_partno[30].'\cell \hich\af0\dbch\f18\loch\af0 '.$goods_detail[30].'\cell 
\hich\af0\dbch\af15\loch\f0 '.$qty[30].'\cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 '.$market_price[30].'\cell \hich\af0\dbch\af15\loch\f0 '.$amount[30].'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\af15\loch\f0 \cell \hich\af0\dbch\f18\loch\af0 \cell 
\hich\af0\dbch\af15\loch\f0 \cell }\pard
\qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright
{\hich\af0\dbch\af15\loch\f0 \cell \hich\af0\dbch\af15\loch\f0 \cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\cell \cell \cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\cell \hich\af0\dbch\af15\loch\f0 '.$totalamount.'
\cell }\pard \widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\trowd \trgaph28\trleft-28 \clvertalt\cltxlrtb \cellx2280\clvertalt\cltxlrtb \cellx7320\clvertalt\cltxlrtb \cellx8160\clvertalt\cltxlrtb \cellx9360\clvertalt\cltxlrtb \cellx10560
\pard \nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\cell \cell \cell }\pard \qr\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\cell \cell }\pard \widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard 
\nowidctlpar\aspalpha\aspnum\faauto\adjustright {
\par }}';

fputs($fp,$string);
fclose($fp);
	
	echo "\n資料順利輸入!<br><a href=\"javascript:printout();\">列印</a>";
	
	
	}
   else if ($cherr==3)
      echo "\ncan not insert invoice";
   else if ($cherr==1)
      echo "\ncan not insert goods_invoice";
   else if ($cherr==2)
      echo "\ncan not update goods stockout=stockout+qty[$i]";
   else if ($cherr==4)
      echo "\n冇貨啦請入貨";


*/
?>
<SCRIPT LANGUAGE="JavaScript">
function printout()
{
window.open('./invoice_store/invoice<?echo $invoice_no;?>.rtf');
window.location="invoiceap.php3";
}
</script>
</body>
</html>
