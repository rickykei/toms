<?php
require_once('../pdf3/tcpdf.php');



//require('../fpdf.php');
 //class PDF extends FPDF
class PDFTOMS extends TCPDF
{
//Current column
var $col=0;
//Ordinate of column start
var $y0;
var $header_title=array();

function Set_header_title($header_title)
{
	$this->header_title=$header_title;
}

function Body($goods_partno,$goods_detail,$qty,$market_price,$discountrate,$co_no,$customer_name,$co_date,$customer_car_no,$customer_tel)
{  
$this->SetXY(0,-1);

 $this->SetTextColor(0);
 $this->SetFont($fontname,'',10,false);
 $this->SetDrawColor(0,0,0);
 $border="0";
 
   $h=6;
   
 $c0=5;  
 $c1=8;
 $c2=40;
 $c3=80;
 $c4=22;
 $c5=5;
 $c6=20;
 $c7=32;

 

  $this->setJPEGQuality(80);
  
  
   
	 $this->Cell($c7,6,"",$border,1,'R',0);
	 
	 
 $this->Cell(5,16,"",$border,0,'L',0);
   $this->Image('../pdf3/tomstrd_logo.jpg', '', '', 120, 17, 'JPG', '', 'T', false, 120, '', false, false, 0, false, false, false);
     $this->Cell(50,16," ",$border,0,'L',0);
	 $this->Image('../pdf3/toms_logo.jpg', '', '', 30, 15, 'JPG', '', 'T', false, 120, '', false, false, 0, false, false, false);
	 $this->Cell($c7,16,"",$border,1,'R',0);

	$h=6;
   $this->SetFont($fontname,'',7,false);
   $this->Cell(5,$h,"",$border,0,'L',0);
   $this->Cell(200,$h,"Website: http://www.toms-trd.com.hk","B",1,'L',0);	

 $h=6;
   $this->SetFont($fontname,'',10,false);
   $this->Cell(5,5,"",$border,0,'L',0);
   $this->Cell(150,5,"門市及維修部",$border,0,'L',0);	
   $this->Cell(50,5,"電話: (852) 2783 0993",$border,1,'R',0);	

   $this->SetFont($fontname,'',8,false);
   $this->Cell(5,5,"",$border,0,'L',0);
   $this->Cell(150,5,"香港九龍土瓜灣九龍城道61號同興花園地下3A舖",$border,0,'L',0);	
    $this->SetFont($fontname,'',10,false);
   $this->Cell(50,5,"(852) 2783 0443",$border,1,'R',0);	

   $this->SetFont($fontname,'',8,false);
   $this->Cell(5,5,"",$border,0,'L',0);
   $this->Cell(150,5,"Shop 3A, G/F, Harmony Garden, 61 Kowloon City Road, To Kwa Wan, Kowloon, Hong Kong",$border,0,'L',0);	
    $this->SetFont($fontname,'',10,false);
   $this->Cell(50,5,"傳真: (852) 2783 0449",$border,1,'R',0);	

$this->SetY(48);

	$this->SetFont($fontname,'',7,false);
	$this->Cell($c0,$h,"",$border,0,'L',0);
    $this->Cell($c1,$h,"TO:",$border,0,'L',0);
    $this->SetFont($fontname,'',10,false);
	 $this->Cell(80,$h,mb_convert_encoding($customer_name, "UTF-8", "BIG5"),"B",0,'L',0);
	 $this->Cell(35,$h,"CAR/ORDER NO:","TBL",0,'R',0);
	 $this->Cell(25,$h,$customer_car_no."(".$mile."km)","TBR",0,'L',0);
	 $this->Cell(30,$h,"Customer Order:",$border,0,'R',0);
	 $this->Cell($c7,$h,"".$co_no."",$border,1,'L',0);

 

	 $this->SetFont($fontname,'',10,false); 
	$this->Cell($c0,$h,"",$border,0,'L',0);
	$this->Cell($c1,$h,"",$border,0,'L',0);
     $this->Cell(80,$h,$customer_tel,"B",0,'L',0);
	 $this->Cell(60,$h,"",1,0,'C',0);
	 $this->Cell(30,$h,"Date:",$border,0,'R',0);
	 $this->Cell($c7,$h,"".$co_date."",$border,1,'L',0);	 
	 
	 
	$this->SetY(68);


	 $this->SetFont($fontname,'',10,false); 
	$this->Cell($c0,$h,"",$border,0,'L',0);
     $this->Cell(30,$h,"MODEL",1,0,'C',0);
	 $this->Cell(94,$h,"DESCRIPTION",1,0,'C',0);
	 $this->SetFont($fontname,'',7,false); 
	 $this->Cell(10,$h,"QTY",1,0,'C',0);
	 $this->Cell(22,$h,"UNIT PRICE  HK$",1,'C',0);
	 $this->Cell(20,$h,"NET PRICE  HK$",1,0,'C',0);
	 $this->Cell(25,$h,"AMOUNT HK$",1,1,'C',0);	 
	 
	 
	 
	  $this->SetFont($fontname,'',10,false); 
 //$this->Ln(22);
 $this->SetY(74);
 $h=6;
 $c1=5;
 $c2=30;
 $c3=94;
 $c4=10;
 $c5=22;
 $c6=20;
 $c7=25;
 $total=0;
	for ($i=1;$i<count($goods_partno);$i++)
	{
		if ($goods_partno[$i]=="")
		break;
	  $this->Cell($c1,$h,"",$border,0,'L',0);
	  //$this->Cell($c2,$h,$goods_partno[$i],"LR",0,'L',0);
	 $this->Cell($c2,$h,"","LR",0,'L',0);
	 $this->Cell($c3,$h,$goods_detail[$i],"LR",0,'L',0);
	 $this->Cell($c4,$h,$qty[$i]."","LR",0,'C',0);
	 $this->Cell($c5,$h,number_format($market_price[$i],2)."","LR",0,'R',0);
			 //20091201 rounding invoice >74102
			if ($co_no>2417){
				// round 20091201
			 $this->Cell($c6,$h,"".number_format(round($market_price[$i]-($market_price[$i]*$discountrate[$i]/100)),2),"LR",0,'R',0);
			 $this->Cell($c7,$h,"".number_format(round(round($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i]),2),"LR",1,'R',0);
			 
			 // round 20101215
			 $total=$total+round((round($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i]));	
			}else{
			 $this->Cell($c6,$h,"".number_format($market_price[$i]-($market_price[$i]*$discountrate[$i]/100),2),"LR",0,'R',0);
			 $this->Cell($c7,$h,"".number_format(($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i],2),"LR",1,'R',0);
			 $total=$total+(($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i]);
			}
	 
	}
	 	 
	
// print rest
for ($i;25-$i;$i++){
$this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,$goods_partno[$i],"LR",0,'L',0);
	 $this->Cell($c3,$h,$goods_detail[$i],"LR",0,'L',0);
	 $this->Cell($c4,$h,$qty[$i]."","LR",0,'C',0);
	 $this->Cell($c5,$h,"","LR",0,'R',0);	
	  $this->Cell($c6,$h,"","LR",0,'R',0);
	$this->Cell($c7,$h,"","LR",1,'R',0);
}

$h=5;
  $this->SetFont($fontname,'B',8,false); 
	 $this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,"","LR",0,'L',0);
	 $this->Cell($c3,$h,"","LR",0,'L',0);
	 $this->Cell($c4,$h,"","LR",0,'C',0);
	 $this->Cell($c5,$h,"","LR",0,'R',0);	
	 $this->Cell($c6,$h,"","LR",0,'R',0);
	 $this->Cell($c7,$h,"","LR",1,'R',0);

$h=4;
  $this->SetFont($fontname,'B',7,false); 
	 $this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,"","LR",0,'L',0);
	 $this->Cell($c3,$h,"","LR",0,'L',0);
	 $this->Cell($c4,$h,"","LR",0,'C',0);
	 $this->Cell($c5,$h,"","LR",0,'R',0);	
	 $this->Cell($c6,$h,"","LR",0,'R',0);
	 $this->Cell($c7,$h,"","LR",1,'R',0);

$h=4;
  $this->SetFont($fontname,'',7,false); 
	 $this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,"","LRB",0,'L',0);
	 $this->Cell($c3,$h,"","LRB",0,'L',0);
	 $this->Cell($c4,$h,"","LRB",0,'C',0);
	 $this->Cell($c5,$h,"","LRB",0,'R',0);	
	 $this->Cell($c6,$h,"","LRB",0,'R',0);
	 $this->Cell($c7,$h,"","LRB",1,'R',0);
	 
  $h=8;  
   $this->SetFont($fontname,'B',10,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,"",0,0,'L',0);
	 $this->Cell($c3,$h,"E.& O.E.",0,0,'C',0);
	 $this->Cell($c4,$h,"",0,0,'L',0);
	 $this->Cell($c5,$h,"",0,0,'R',0);
	 $this->Cell($c6,$h,"TOTAL HK$:",0,0,'R',0);
	 $this->Cell($c7,$h,"".number_format($total,2),1,1,'R',0);
	 
	 
	 
	 
	 
	$h=5;  
    $this->SetFont($fontname,'I',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(80,$h,"* 所有訂貨一經客戶簽署確認，恕不接受退款或更改。",$border,0,'L',0);
	$this->Cell(20,$h,"",$border,0,'R',0);
	$this->SetFont($fontname,'',8,false); 
	$this->Cell(40,$h,"",$border,0,'L',0);
	$this->Cell($c7,$h,"",$border,1,'R',0);
	 
$h=5;  
    $this->SetFont($fontname,'I',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(80,$h,"* 如收到貨到通知後30天內不到取，訂金將會作廢。",$border,0,'L',0);
	$this->Cell(20,$h,"",$border,0,'R',0);
	$this->SetFont($fontname,'',8,false); 
	$this->Cell(40,$h,"",$border,0,'L',0);
	$this->Cell($c7,$h,"",$border,1,'R',0);
	
		 $h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(50,$h,"",$border,0,'L',0);
	$this->Cell(20,$h,"",$border,0,'R',0);
	$this->SetFont($fontname,'',8,false); 
	$this->Cell(40,$h,"",$border,0,'L',0);
    $this->Cell($c7,$h,"",$border,1,'R',0);
	
 
	
	 $h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(60,$h,"銀行轉帳 Bank A/C:","B",0,'L',0);
	$this->Image('../pdf3/qrcode.jpg', '', '', 40, 40, 'JPG', '', 'T', false, 150, '', false, false, 0, false, false, false);
	$this->Cell($c7,$h,"",$border,1,'R',0);
	
	 
	
	$h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(25,$h,"HSBC 匯豐銀行",$border,0,'L',0);
	$this->Cell(30,$h,"124-072869-838",$border,0,'L',0);
	$this->Cell(10,$h,"",$border,0,'R',0);
	 
	
    $this->Cell($c7,$h,"",$border,1,'R',0);
	
	$h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(60,$h,"TOM’S & TRD Co. Limited","B",0,'L',0);
	$this->Cell(10,$h,"",$border,0,'R',0);
	$this->Cell(10,$h,"",$border,0,'R',0);
	
	$this->Cell(40,$h,"",$border,0,'L',0);
    $this->Cell($c7,$h,"",$border,1,'R',0);
	
	$h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(25,$h,"BOC 中國銀行",$border,0,'L',0);
	$this->Cell(30,$h,"012-889-2-018521-3",$border,0,'L',0);
	$this->SetFont($fontname,'',8,false); 
	 	$this->Cell(40,$h,"",$border,0,'L',0);
    $this->Cell($c7,$h,"",$border,1,'R',0);
	
	$h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(60,$h,"TOM’S & TRD Shop","B",0,'L',0);
	$this->Cell(10,$h,"",$border,0,'R',0);
	$this->SetFont($fontname,'',8,false); 
	$this->Cell(40,$h,"",$border,0,'L',0);
    $this->Cell($c7,$h,"",$border,1,'R',0);
 
    
	
	 $h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(50,$h,"轉數快 FPS：63918395","",0,'L',0);
	$this->Cell(20,$h,"",$border,0,'R',0);
	$this->SetFont($fontname,'',8,false); 
	 	$this->Cell(40,$h,"",$border,0,'L',0);
    $this->Cell($c7,$h,"",$border,1,'R',0);
	 $h=5;  
    $this->SetFont($fontname,'',8,false); 
    $this->Cell($c1,$h,"",$border,0,'L',0);
	$this->Cell(50,$h,"PayMe : https://payme.hsbc/tomstrd","",0,'L',0);
	$this->Cell(20,$h,"",$border,0,'R',0);
	$this->SetFont($fontname,'',8,false); 
	 	$this->Cell(40,$h,"",$border,0,'L',0);
    $this->Cell($c7,$h,"",$border,1,'R',0);
	
}

	function Header()
	{
		//Page header
		global $title;
		global $header_title;
		global $invoice_no;
		global $AREA;
		global $delivery;
		
		 
	 
	}

	function Footer()
	{
	 
	}






}





//$pdf=new pdf('P','mm',array(216,217));
$pdf=new pdftoms('P','mm','A4', true, 'UTF-8', false);
$pdf->SetAutoPageBreak(true,2 );
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);
//$fontname = TCPDF_FONTS::addTTFfont('d:/github/yrt/pdf3/fonts/DroidSansFallback.ttf', 'TrueTypeUnicode', '', 96);
 $fontname="msungstdlight";
 
 $pdf->SetFont($fontname, '', 10);
  
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(0,0,0);
$pdf->SetDrawColor(0, 0, 0);
//$pdf->SetDrawColor(255, 0, 0);
$title='發票';
$header_title=array();
 
 
$pdf->Body($goods_partno,$goods_detail,$qty,$market_price,$discountrate,$co_no,$customer_name,$co_date,$customer_detail,$customer_tel);
$pdf->SetAuthor('Toms & TRD Limited');


$filepath='./pdf/'.$co_no.'.pdf';

if (file_exists($filepath)) {
	//move to backup
	$file_timestamp=date("Ymd_His") ;
	$filepathnew='./backuppdf/'.$co_no.'_'.$file_timestamp.'.pdf';
	copy($filepath, $filepathnew);
}
$pdf->Output($filepath,'F');


$pdf="";
?>
