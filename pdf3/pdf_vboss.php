<?php
require_once('./pdf3/tcpdf.php');



//require('../fpdf.php');
 //class PDF extends FPDF
class PDF extends TCPDF
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

function Body($invoice_no)
{
  // $this->SetDrawColor(255,255,255);
   //$this->SetTextColor(0,0,0);
      
   $this->SetFont($fontname,'',26,false);
   $border=0;
  

   include("./include/config.php");
  
    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
   $result = $connection->query("SET NAMES 'UTF8'");
   $result = $connection->query("SELECT * FROM invoice where invoice_no=".$invoice_no);

      if (DB::isError($result))
      die ($result->getMessage());
	while ($row =& $result->fetchRow(DB_FETCHMODE_ASSOC))
   {
     // Print out each element in $row, that is, print the values of
      // the attributes
	$resultCust= $connection->query(" Select * from member where member_id like ".$row['member_id']);
    $rowCust=$resultCust->fetchRow(DB_FETCHMODE_ASSOC);
	$invoice_no1=$row['invoice_no'];
	$delivery_date=$row['delivery_date'];
	$invoice_date=$row['invoice_date'];
	$sales_name=$row['sales_name'];
	$sql=" Select * from staff where name = '".$sales_name."'";
	$resultStaff= $connection->query($sql);
	
	$rowStaff=$resultStaff->fetchRow(DB_FETCHMODE_ASSOC);
	
	$staffTel=$rowStaff['telno'];
 
	$customer_name=$row['customer_name']."    ".$rowCust["creditLevel"];
	$customer_tel=$row['member_id'];
	$customer_detail=$row['customer_detail'];
	$lastname=$row['lastname'];
	$receiver=$row['receiver'];
	$delivery=$row['delivery'];
	//20100805
	$creditLevel= $rowCust['creditLevel'];
	
	$discount_percent=$row['discount_percent'];
	//if($discount_percent==0)
	$discount_deduct=$row['discount_deduct'];
	
	$creditcardrate=$row['credit_card_rate'];
	
	$man_power_price=$row['man_power_price'];
	
	$branchid=$row['branchID'];
  

	if ($row["delivery"]=="Y")
	$delLabel='送貨';
	else if ($row["delivery"]=="C")
	{
		$delLabel='街車即走';
	//	$rightLabel1='收尾數';
		$rightLabel2='車費客付';
	}
	else if ($row["delivery"]=="S")
	$delLabel='自取';

	
	//if ($customer_tel=="888")
	//$delLabel='自取';
   }

  $this->SetY(-1);
  //$this->Ln(95);
  // $this->Ln(85);

  
  //20170709 disable shopname
  //$printShopName=$shopAddress[array_search($branchid,$shop_array)];
  //$printShopDetail=$shopDetail[array_search($branchid,$shop_array)];
  
   
	$this->SetFont($fontname,'',16);
	$this->Cell(5,8, "" ,$border,0,'R',0);
	
	$this->Cell(106,8, "收貨人:".$receiver.$lastname ,$border,0,'L',0);
 	$this->Cell(30,8, "" ,$border,0,'R',0);
	$this->Cell(65,8, $delLabel  ,$border,1,'R',0);
	
	$this->Cell(5,8, ""  ,$border,0,'R',0);
	
	$this->Cell(65,8, "姓名:" .$customer_name,$border,0,'L',0);
	$this->Cell(65,8, "" ,$border,0,'C',0);
	$this->Cell(70,8, "發票編號:" .$branchid.$invoice_no,$border,1,'R',0);

	$this->Cell(5,8, "" ,$border,0,'R',0);
	
	
	if ($creditLevel=='E'){
	$border=1;
	$this->Cell(65,8, "電話:".$customer_tel ,$border,0,'L',0);
	$border=0;
	}else{
	$this->Cell(65,8, "電話:".$customer_tel ,$border,0,'L',0);
	}
	$this->Cell(65,8, '' ,$border,0,'C',0);
	$this->Cell(70,8, "日期:落單"  .$invoice_date,$border,1,'R',0);
	
	
	$this->Cell(5,8, "" ,$border,0,'R',0);
	$this->SetFont($fontname,'',13);
	$this->Cell(95,8, "地址:" .$customer_detail,$border,0,'L',0);
	$this->SetFont($fontname,'',16);
	$this->Cell(35,8, "" ,$border,0,'R',0);
if ($customer_tel=="888")
	$this->Cell(70,8, "自取" .$delivery_date,$border,1,'R',0);
	else
	$this->Cell(70,8, "送貨" .$delivery_date,$border,1,'R',0);
//	$this->Cell(20,8,iconv("UTF-8", "DroidSansFallback-HKSCS","地址："),0,0,'R',0);
//	$this->Cell(170,8,$customer_detail,0,1,'L',0);

	
		$this->Ln(9);
	
	$this->Cell(5,8, "" ,0,0,'C',0);
	$this->Cell(45,8, "貨品編號" ,1,0,'C',0);
	$this->Cell(80,8, "項目" ,1,0,'C',0);
	$this->Cell(27,8, "數量",1,0,'C',0);
	$this->Cell(20,8,"單價",1,0,'C',0);
	$this->Cell(29,8,"共銀",1,1,'C',0);


//$this->SetFont($fontname,'',14);
//print goods_invoice
   $result = $connection->query("SET NAMES 'UTF8'");
   $result = $connection->query("SELECT goods_invoice.deductstock as deductstock, goods_invoice.cutting as cutting ,goods_invoice.goods_partno as goods_partno,goods_invoice.goods_detail as goods_detail,goods_invoice.qty as qty,goods_invoice.marketprice as marketprice,goods_invoice.manpower as manpower ,goods_invoice.subtotal as subtotal,sumgoods.goods_detail as goods_detail2 ,  discountrate,unit_name_chi FROM goods_invoice,sumgoods,unit where sumgoods.goods_partno=goods_invoice.goods_partno and invoice_no=".$invoice_no." and sumgoods.unitid=unit.id order by goods_invoice.id asc");
      if (DB::isError($result))
      die ($result->getMessage());
	  $i=1;
	while ($row2 =& $result->fetchRow(DB_FETCHMODE_ASSOC))
   {
   $cutting='';$deductstock='';
   		if ($row2['cutting']=='Y')
				$cutting='界';
			if ($row2['deductstock']=='N')
				$deductstock='行';
	$this->Cell(3,8,"",$border,0,'R',0);			
	$this->Cell(7,8,$i,$border,0,'L',0);
	$this->Cell(32,8,$row2['goods_partno'],$border,0,'L',0);
	
    $this->Cell(7,8,$cutting.$deductstock,$border,0,'L',0);
	
	if($row2['goods_detail']!="")
		$this->Cell(73,8,$row2['goods_detail'],$border,0,'L',0);
	else
		$this->Cell(73,8, $row2['goods_detail2'] ,$border,0,'L',0);
 
	$this->Cell(24,8, number_format($row2['qty']) ,$border,0,'R',0);

	$this->Cell(9,8, $row2['unit_name_chi'] ,$border,0,'R',0);
	
	$this->Cell(22,8, $row2['marketprice'] ,$border,0,'R',0);
	
//	$this->Cell(22,6,iconv("UTF-8", "DroidSansFallback-HKSCS",$row2['manpower']),0,0,'C',0);
	//20060410
	//$amount=((100-$row2["discountrate"])/100)*$row2["qty"]*$row2["marketprice"];
	$amount=$row2['subtotal'];
	$this->Cell(25,8,number_format($row2['subtotal'], 2, '.', ','),$border,0,'R',0);

 
	$this->SetFont($fontname,'',8);
	$discountrate="-".$row2['discountrate']."%";
	if ($row2['discountrate']==0)
	$this->Cell(14,8,"",$border,1,'R',0);
	else
	$this->Cell(10,8,"(".$discountrate.")",$border,1,'L',0);
	$this->SetFont($fontname,'',16);

	$i++;
    $total=$total+$amount;
   }
   
   
 $result->free ();
 for ($i=$i;$i<=17;$i++){
 $this->Cell(22,8,iconv("UTF-8", "DroidSansFallback-HKSCS",""),$border,1,'C',0);
 }

		$subtotal=$man_power_price+$total;
		$subtotal=$subtotal-($subtotal*$discount_percent/100);
		$subtotal=$subtotal-$discount_deduct;
		 $this->SetFont($fontname,'',13);
 
 	 $this->SetFont($fontname,'',14);
	if ($creditcardrate!=0){
		$creditcardtotal=round($subtotal*$creditcardrate/100);
	$this->Cell(5,6,"",$border,0,'R',0);		
 	$this->Cell(145,6,"@",$border,0,'R',0);
 	$this->Cell(25,6,number_format($creditcardtotal, 2, '.', ','),$border,0,'L',0);
 	$this->Cell(5,6,"",$border,1,'R',0);
	}
	else
	{ 
	
	$this->Cell(22,6,"",$border,1,'C',0);
	}
	
	
	
	
	
	$this->SetFont($fontname,'',10);
	$this->Cell(5,7,"",$border,0,'R',0);	
	$this->Cell(140,7,"*如對本公司服務有何意見，請電: 97227738。*",$border,0,'L',0);
	$this->Cell(50,7, "*如要入地盤需繳附加費$500*" ,$border,0,'R',0);
	$this->Cell(5,7, "" ,$border,1,'R',0);
	
	$this->Cell(5,7, "" ,$border,0,'R',0);	
	$this->Cell(140,7,"為保障客戶利益，收貨時請即點算清楚貨品及數量。訂造貨品，必須",$border,0,'L',0);
	$this->Cell(50,7,"*如禁區落貨，需附加費$450*",$border,0,'R',0);
	$this->Cell(5,7,"",$border,1,'R',0);
	
	$this->Cell(5,7,"",$border,0,'R',0);	
	$this->Cell(140,7, "由訂貨日起到60天內取，否則視作客戶自動放棄該貨品及訂金，日後不得追究",$border,0,'L',0);
	$this->Cell(50,7,"",$border,0,'R',0);
	$this->Cell(5,7,"",$border,1,'R',0);
	
	
	
	$this->SetFont($fontname,'',17);
	$this->Cell(5,7, "" ,$border,0,'R',0);	
	
	//$this->Cell(140,7,iconv("UTF-8", "DroidSansFallback-HKSCS","訂造貨品，必須貨到後一個月內取，否則視作客戶自動"),$border,0,'L',0);
	$this->Cell(140,7,"收貨人:",'B',0,'L',0);

	$this->Cell(50,7,"共銀:".number_format($subtotal+$creditcardtotal, 2, '.', ','),$border,0,'R',0);
	$this->Cell(5,7,"",$border,1,'R',0);

	//$this->Cell(5,7,iconv("UTF-8", "DroidSansFallback-HKSCS",""),$border,0,'R',0);	
	//$this->SetFont($fontname,'',14);
	//$this->Cell(140,7,iconv("UTF-8", "DroidSansFallback-HKSCS","放棄該貨品及所付訂金，日後不得追究。"),$border,0,'L',0);
	//$this->Cell(130,7,iconv("UTF-8", "DroidSansFallback-HKSCS",""),$border,0,'R',0);
	//$this->Cell(10,7,iconv("UTF-8", "DroidSansFallback-HKSCS",""),$border,0,'R',0);	
	//$this->SetFont($fontname,'',17);
	//$this->Cell(30,7,'',$border,0,'R',0);
 	//$this->Cell(5,7,iconv("UTF-8", "DroidSansFallback-HKSCS",""),$border,1,'R',0);
 
		$this->Ln(3);

 	
}
function Header()
{
	//Page header
	global $title;
	global $header_title;
	global $invoice_no;
	global $AREA;
	global $delivery;
	
	$w=$this->GetStringWidth($title)+6;
	$this->SetX(2);
	$this->Ln(12);
    $this->SetMargins(1, 70, 1);
	//$this->SetDrawColor(255,255,255);
	//$this->SetFillColor(233,233,233);
	//$this->SetTextColor(0,0,0);
	//20060621$this->Ln(35);
	//$this->Ln(19);
	$this->SetLineWidth(0);
	
  $this->SetFont($fontname,'',40);

  if ($AREA=='Y'){
	$shopAddress="落單電話周生 : 97227738";
	$shopDetail="";
  }
  else {
	$shopAddress="落單電話周生 : 97227738";
	$shopDetail="";
  }
	

 
	
	 
	if ($delivery=="Y")
	$delLabel='送貨';
	else if ($delivery=="C")
	{
		$delLabel='街車即走';
	//	$rightLabel1='收尾數';
		$rightLabel2='車費客付';
	}
	else if ($delivery=="S")
	$delLabel='自取';

	if ($delivery=="C")
	{
	$this->Cell(40,18,'',$border,0,'R',0);
	$this->Cell(125,18,"清洲木行",$border,0,'C',0);
	$this->Cell(40,18, $rightLabel1,$border,1,'C',0);
	
	 $this->SetFont($fontname,'',23);
	$this->Cell(40,8, "",$border,0,'R',0);
	$this->Cell(125,8, $shopAddress,$border,0,'C',0);
	$this->Cell(40,8, "" ,$border,1,'C',0);
	
	$this->SetFont($fontname,'',12);
	$this->Cell(40,8, "",$border,0,'C',0);
	$this->SetFont($fontname,'',16);
	$this->Cell(125,8,$shopDetail,$border,0,'C',0);
	$this->Cell(40,8,"",$border,1,'C',0);
  
	}else{	
 	$this->Cell(40,18,"",$border,0,'R',0);
	$this->Cell(125,18,"清洲木行",$border,0,'C',0);
	$this->Cell(40,18,$rightLabel1,$border,1,'C',0);
	
	$this->SetFont($fontname,'',23);
	$this->Cell(40,8,"",$border,0,'R',0);
	$this->Cell(125,8,$shopAddress,$border,0,'C',0);
	$this->Cell(40,8,"",$border,1,'C',0);
	
	$this->SetFont($fontname,'',12);
	$this->Cell(40,8,"",$border,0,'R',0);
	$this->SetFont($fontname,'',16);
    $this->Cell(125,8,$shopDetail,$border,0,'C',0);
    $this->Cell(40,8,"",$border,1,'C',0);

  }
  
  
    if ($title=='提貨單'){
		$this->SetTextColor(255,0,0);
		$this->SetFillColor(255,0,0);
		//$this->SetDrawColor(255, 0, 0);
	}else if ($title=='收據'){
		$this->SetTextColor(0,0,255);
		$this->SetFillColor(0,0,255);
		//$this->SetDrawColor(0, 0, 255);
	}
	
     $this->SetFont($fontname,'',23);

  	$this->Cell(40,18, "",$border,0,'R',0);
	 if ($title=='提貨單'){
	$this->Cell(125,18,"※※".$title."※※",$border,0,'C',0);
	 }else{
		 $this->Cell(125,18,$title,$border,0,'C',0);
	 }
	 
	 if ($delivery=="C")
	{
		$this->Cell(40,18, $rightLabel2 ,"BTRL",1,'C',0);
	}else{
		$this->Cell(40,18, $rightLabel2 ,$border,1,'C',0);
	}
	
	$this->SetFont($fontname,'',12);
  
	//Save ordinate
     $this->y0=$this->GetY();
}

function Footer()
{
 
}






}





//$pdf=new pdf('P','mm',array(216,217));
$pdf=new pdf('P','mm','A4', true, 'UTF-8', false);
$pdf->SetAutoPageBreak(true,2);
$pdf->SetTopMargin(1);
$pdf->SetLeftMargin(0);
//$fontname = TCPDF_FONTS::addTTFfont('d:/github/yrt/pdf3/fonts/DroidSansFallback.ttf', 'TrueTypeUnicode', '', 96);
$fontname="msungstdlight";
 
$pdf->SetFont($fontname, '', 10);
 
 
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(0,0,0);
$pdf->SetDrawColor(0, 0, 0);
//$pdf->SetDrawColor(255, 0, 0);

$header_title=array();


$title='收據';
$pdf->Body($invoice_no);

$title='發票';
$pdf->Body($invoice_no);

$title='提貨單';
$pdf->Body($invoice_no);


$title='收據';
$pdf->Body($invoice_no);



$pdf->SetAuthor('YRT Company Limited');

$filepath='./invoice/pdf/'.$invoice_no.'.pdf';

if (file_exists($filepath)) {
	//move to backup
	$file_timestamp=date("Ymd_His") ;
	$filepathnew='./invoice/backuppdf/'.$invoice_no.'_'.$file_timestamp.'.pdf';
	copy($filepath, $filepathnew);
}
$pdf->Output($filepath,'F');
?>
