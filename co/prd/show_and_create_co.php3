<html>
<head>
<title>(co) toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#CCFFCC" text="#000000"> 
<?
   
   if ($cherr==0)
   {
   	echo "<table width=\"75%\" border=\"1\">";
	echo "<tr> ";
	echo "<td width=\"46%\" class=\"login\">�o���s��.:".$co_no."</td>";
	echo "<td width=\"54%\" class=\"login\">�o�����: ".$co_date."</td>";
	echo "</tr>";
	echo "<tr> ";
	echo "<td width=\"46%\">��f�H:".$sales_name."</td>";
	echo "<td width=\"54%\">�R�f�H:".$customer_name;
	if ($customer=='y'){ echo " [�D�|��]";}else if ($customer=='n'){echo " [�|��]";}
	echo "</td>";
	echo "</tr>";
	echo "<tr> ";
	echo "<td width=\"46%\">�q��: ".$customer_tel."<br>";
	echo "��L���:".$customer_detail." <br>";
	echo "</td>";
	echo "<td width=\"54%\">�|���s��:.$member_id.</td></tr><tr>";
	if ($today>$customer_exp_date)
	$color_warn="red";
	else
	$color_warn="white";

	if (!empty($member_id))
	{
	$customer_name=$customer_name." [".$member_id."]";
	}
	
		echo "<td width=\"46%\"><font color=\"$color_warn\">�|���Ҩ����G$customer_exp_date";
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
	
		if ($co_no>2417){
	// round 20091201
		$amount[$i]=round($qty[$i]*($market_price[$i]-($market_price[$i]*($discountrate[$i]/100))));
	// round 20101215
		$amount[$i]=round($qty[$i]*round($market_price[$i]-($market_price[$i]*($discountrate[$i]/100))));
	
	 }else{
		$amount[$i]=$qty[$i]*($market_price[$i]-($market_price[$i]*($discountrate[$i]/100)));
		}
		
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
	
//20071212 PDF ADD

define('FPDF_FONTPATH','../pdf/font/');
require('../pdf/chinese.php');
include_once('../pdf/co_pdf.php');

//$pdf=new pdf('P','mm',array(216,305));
$pdf=new pdf('P','mm',array(216,308));
$pdf->SetAutoPageBreak(true,1);
$pdf->SetTopMargin(0);
$pdf->AddBig5Font();
$title='�X�f��';
$pdf->Body($goods_partno,$goods_detail,$qty,$market_price,$discountrate,$co_no,$customer_name,$co_date,$customer_car_no,$customer_tel);
$pdf->Output("./co_pdf_store/".$co_no.'.pdf');



	$copath="./co_store/";
        $cofile="co-".$co_no.".rtf";
	$fp= fopen("$copath"."$cofile","w");
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
\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright \kerning2\loch\af0\hich\af0\dbch\f15\cgrid {\cell \cell \cell \hich\af0\dbch\af15\loch\f0 C.O.D\cell \hich\af0\dbch\af15\loch\f0 CO-'.$co_no.'\cell }\pard 
\widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\trowd \trgaph28\trrh524\trleft-28 \clvertalt\cltxlrtb \cellx4560\clvertalt\cltxlrtb \cellx5760\clvertalt\cltxlrtb \cellx8880\clvertalt\cltxlrtb \cellx10826\pard 
\nowidctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\hich\af0\dbch\f18\loch\af0 '.$customer_name.'\cell \cell \cell \hich\af0\dbch\af15\loch\f0 '.$co_date.'\cell }\pard \widctlpar\intbl\aspalpha\aspnum\faauto\adjustright {\row }\pard 
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
	
	echo "\n��ƶ��Q��J!<br><a href=\"javascript:printout();\">�C�L</a>";
		echo "<p><a target='_blank' href='./co_pdf_store/".$co_no.".pdf' > PDF �C�L </a>";
	
	}
   else if ($cherr==3)
      echo "\ncan not insert co";
   else if ($cherr==1)
      echo "\ncan not insert goods_co";
   else if ($cherr==2)
      echo "\ncan not update goods stockout=stockout+qty[$i]";
   else if ($cherr==4)
      echo "\n�N�f�սФJ�f";



?>