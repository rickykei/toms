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
   include("./include/config.php");

    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
   $result = $connection->query("SET NAMES 'UTF8'");
   $result = $connection->query("SELECT * FROM invoice_scrap where invoice_no=".$invoice_no);

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
	$cal_unit=$row['cal_unit'];
	
	if (strtoupper($cal_unit)=="IN")
		$cal_unit_label="寸";
	else
		$cal_unit_label="毫米";
	
	$sql=" Select * from staff where name = '".$sales_name."'";
	$resultStaff= $connection->query($sql);
	
	$rowStaff=$resultStaff->fetchRow(DB_FETCHMODE_ASSOC);
	
	$staffTel=$rowStaff['telno'];
 
	$customer_name=$row['customer_name']."    ".$rowCust["creditLevel"];
	$customer_tel =$row['member_id'];
	$customer_detail= $row['customer_detail'];
	$receiver= $row['receiver'];
	$delivery=$row['delivery'];
	//20100805
	$creditLevel= $rowCust['creditLevel'];
	
	$discount_percent=$row['discount_percent'];
	//if($discount_percent==0)
	$discount_deduct=$row['discount_deduct'];
	
	$creditcardrate=$row['credit_card_rate'];
	
	$man_power_price=$row['man_power_price'];
	
	$branchid=$row['branchID'];
  
	if ($row['delivery']=="Y")
	$delLabel='送貨';
	else if ($row['delivery']=="C")
	{
		$delLabel='街車即走';
		$rightLabel1='收尾數';
		$rightLabel2='車費客付';
	}
	else if ($row['delivery']=="S")
	$delLabel='自取';
	
	//if ($customer_tel=="888")
	//$delLabel='自取';
   }

 $this->SetY(-1);
   //$this->Ln(95);
  // $this->Ln(85);
   $this->SetTextColor(0,0,0);
   $this->SetFont('msungstdlight','',16);
  // $this->SetDrawColor(255,255,255);
  $border=1;
  
  
  //$printShopName=$shopAddress[array_search($branchid,$shop_array)];
  //$printShopDetail=$shopDetail[array_search($branchid,$shop_array)];
  
  /*
  if ($branchid=="A")  {
  	$printShopName=SHOP_A;
  	$printShopDetail=SHOP_A_DETAIL;
  }
  else if ($branchid=="Y") {
  	$printShopName=SHOP_Y;
  	$printShopDetail=SHOP_Y_DETAIL;
	}
	else 
	{
	  $printShopName=SHOP_H;
  	$printShopDetail=SHOP_H_DETAIL;
	}*/
	
	
	
	
	if ($delivery=="C")
	{
	
	$this->Cell(40,8,"",$border,0,'R',0);
	$this->Cell(125,8,$printShopName,$border,0,'C',0);
	$this->Cell(40,8,$rightLabel1,"TRL",1,'C',0);
	 
	$this->Cell(40,8,"",$border,0,'C',0);
	 
  $this->Cell(125,8,$printShopDetail,$border,0,'C',0);
  $this->Cell(40,8,$rightLabel2,"BRL",1,'C',0);
  
	}else{	
//   $this->Cell(216,8,$printShopName),$border,1,'C',0);
//   $this->Cell(216,8,$printShopDetail),$border,1,'C',0);

	$this->Cell(40,8,"",$border,0,'R',0);
	$this->Cell(125,8,$printShopName,$border,0,'C',0);
	$this->Cell(40,8,"",$border,1,'C',0);
	$this->SetFont('msungstdlight','',12);
		$this->Cell(40,8,"",$border,0,'R',0);
		$this->SetFont('msungstdlight','',16);
  $this->Cell(125,8,$printShopDetail,$border,0,'C',0);
  $this->Cell(40,8,"",$border,1,'C',0);

  }
    $result->free ();
   
	$this->SetFont('msungstdlight','',16);
	$this->Cell(5,8,"",$border,0,'R',0);
	$this->Cell(105,8,$receiver,$border,0,'L',0);
	$this->SetFont('msungstdlight','',14);
	
	$this->Cell(35,8,"",$border,0,'R',0);
	$this->Cell(50,8,$delLabel,$border,1,'C',0);
	
	$this->Cell(5,8,"",$border,0,'R',0);
	$this->Cell(15,8,"",$border,0,'R',0);
	$this->Cell(70,8,$customer_name,$border,0,'L',0);
	$this->Cell(55,8,$sales_name),$border,0,'C',0);
	$this->Cell(50,8,$invoice_no.$branchid."P",$border,1,'C',0);

	$this->Cell(5,8,""),$border,0,'R',0);
	$this->Cell(15,8,""),$border,0,'R',0);
	//20100805
	if ($creditLevel=='E'){
	$border=0;
	$this->Cell(60,8,$customer_tel,$border,0,'L',0);
	$border=0;
	}else{
	$this->Cell(60,8,$customer_tel,$border,0,'L',0);
	}
	$this->Cell(65,8,$staffTel),$border,0,'C',0);
	$this->Cell(60,8,"落單").$invoice_date,$border,1,'R',0);
	
	$this->Cell(5,8,""),$border,0,'R',0);
	$this->Cell(15,8,""),$border,0,'R',0);
	$this->Cell(90,8,$customer_detail,$border,0,'L',0);
	$this->Cell(35,8,""),$border,0,'R',0);
if ($customer_tel=="888")
	$this->Cell(60,8,"自取").$delivery_date,$border,1,'R',0);
	else
	$this->Cell(60,8,"送貨").$delivery_date,$border,1,'R',0);
//	$this->Cell(20,8,"地址："),0,0,'R',0);
//	$this->Cell(170,8,$customer_detail,0,1,'L',0);

$this->Cell(5,8,""),$border,0,'R',0);
	$this->Cell(15,8,""),$border,0,'R',0);
	$this->Cell(80,8,"",$border,0,'L',0);
	
		$this->Ln(12);
 

//print goods_invoice
   $sql="SELECT   a.goods_partno as goods_partno ,a.width as width,a.height as height,a.qty,a.unit_price,a.subtotal FROM goods_invoice_scrap a where invoice_no=".$invoice_no." order by a.id asc";
   $result = $connection->query($sql);
  
      if (DB::isError($result))
      die ($result->getMessage());
	  $i=1;
	  $this->SetFont('msungstdlight','',15);
	while ($row2 =& $result->fetchRow(DB_FETCHMODE_ASSOC))
   {
   
	$this->Cell(5,6,""),$border,0,'R',0);			
	$this->Cell(10,6,$i),$border,0,'L',0);
	$this->Cell(65,6,$row2['goods_partno']."碎料"),$border,0,'L',0);
	
	//201712 display all mm / inch to ->mm
	if ($cal_unit=="mm"){
			$this->Cell(65,6,iconv("UTF-8","BIG5-HKSCS",$row2['width'].' x '.$row2['height'].'['.$cal_unit_label.']'),$border,0,'L',0);
	}else{
			$row2['width']=$row2['width']*25.416;
			$row2['height']=$row2['height']*25.416;
			$this->Cell(65,6,iconv("UTF-8","BIG5-HKSCS",round($row2['width']).' x '.round($row2['height']).'[mm]'),$border,0,'L',0);
	}
	
	$this->Cell(10,6,number_format($row2['qty'])),$border,0,'R',0);
  
  	$this->Cell(18,6,number_format($row2['unit_price'])),$border,0,'R',0);
	
	$amount=$row2['subtotal'];
	$this->Cell(30,6,number_format($row2['subtotal'], 2, '.', ',')),$border,1,'R',0);



	//20071006 add discount display
	 
	

	$i++;
    $total=$total+$amount;
   }
   $this->SetFont('msungstdlight','',14);
 $result->free ();
 for ($i=$i;$i<=17;$i++){
 $this->Cell(22,6,""),$border,1,'C',0);
 }

		$subtotal=$man_power_price+$total;
		$subtotal=$subtotal-($subtotal*$discount_percent/100);
		$subtotal=$subtotal-$discount_deduct;
		 $this->SetFont('msungstdlight','',13);
	$this->Cell(5,7,""),$border,0,'R',0);	
	$this->Cell(100,7,""),$border,0,'L',0);
	$this->Cell(101,7," "),$border,1,'R',0);
 	 $this->SetFont('msungstdlight','',14);
	if ($creditcardrate!=0){
		$creditcardtotal=round($subtotal*$creditcardrate/100);
	$this->Cell(5,6,""),$border,0,'R',0);		
 	$this->Cell(145,6,"@"),$border,0,'R',0);
 	$this->Cell(25,6,number_format($creditcardtotal, 2, '.', ',')),$border,0,'L',0);
 	$this->Cell(5,6,""),$border,1,'R',0);
	}
	else
	{ 
	
	//$this->Cell(22,6,""),$border,1,'C',0);
	}

	$this->Cell(5,7,""),$border,0,'R',0);	
	$this->Cell(140,7,""),$border,0,'L',0);
	$this->Cell(30,7,""),$border,0,'R',0);
	$this->Cell(5,7,""),$border,1,'R',0);
	
	$this->Cell(5,7,""),$border,0,'R',0);	
	$this->SetFont('msungstdlight','',10);
	//$this->Cell(140,7,"訂造貨品，必須貨到後一個月內取，否則視作客戶自動"),$border,0,'L',0);
	$this->Cell(140,7,""),$border,0,'L',0);
	$this->SetFont('msungstdlight','',14);
	$this->Cell(30,7,number_format($subtotal+$creditcardtotal, 2, '.', ',')),$border,0,'R',0);
	$this->Cell(5,7,""),$border,1,'R',0);

	$this->Cell(5,7,""),$border,0,'R',0);	
	$this->SetFont('msungstdlight','',14);
	//$this->Cell(140,7,"放棄該貨品及所付訂金，日後不得追究。"),$border,0,'L',0);
	$this->Cell(130,7,""),$border,0,'R',0);
	$this->Cell(10,7,""),$border,0,'R',0);	
	$this->SetFont('msungstdlight','',14);
	$this->Cell(30,7,''),$border,0,'R',0);
 	$this->Cell(5,7,""),$border,1,'R',0);
 
		$this->Ln(3);

 	
}
function Header()
{
	//Page header
	global $title;
	global $header_title;
	
	
	$w=$this->GetStringWidth($title)+6;
	$this->SetX(2);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(233,233,233);
	$this->SetTextColor(0,0,0);
	//20060621$this->Ln(35);
	$this->Ln(12);
	$this->SetMargins(1, 10, 1);
	$this->SetLineWidth(0);
	
//      $abc=iconv("UTF-8", "iso-8859-2", "黃河木行有限公司");
	/*$this->SetFont('msungstdlight','B',30);
	$companyName= "黃河木行有限公司");
	$companyAddress= "旺角新填地街609-613號地下");
	$companyTel= "電話:241-22-241  241-22-335  傳真:241-33-373");
	$INVOICE= "發票");
	$this->Cell(190,14,$companyName,2,1,'C',0);
	$this->SetFont('msungstdlight','',15);
	$this->Cell(190,5,$companyAddress,1,1,'C',0);
	$this->Cell(190,5,$companyTel,1,1,'C',0);
	$this->SetFont('msungstdlight','B',25);
	$this->Cell(190,12,$INVOICE,1,1,'C',0);
	$this->Ln(8);*/
	//Save ordinate
    $this->y0=$this->GetY();
}

function Footer()
{
	//Page footer
	//$this->SetY(-5);
	//$this->SetFont('msungstdlight','',9);
	//$this->SetTextColor(128);
	//$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}






}





//$pdf=new pdf('P','mm',array(216,217));
$pdf=new pdf('P','mm',array(216,217), true, 'UTF-8', false);
$pdf->SetAutoPageBreak(true,2);
$pdf->SetTopMargin(1);
$pdf->SetLeftMargin(0);
//$pdf->AddBig5Font();
$title='出貨單';
$header_title=array();
$pdf->Body($invoice_no);
$title='出貨單';
$header_title=array();
$pdf->Body($invoice_no);
$title='出貨單';
$header_title=array();
$pdf->Body($invoice_no);
$pdf->SetAuthor('YRT Company Limited');

$filepath='./invoice_scrap/pdf/'.$invoice_no.'.pdf';
 
if (file_exists($filepath)) {
	//move to backup
	$file_timestamp=date("Ymd_His") ;
	$filepathnew='./invoice_scrap/backuppdf/'.$invoice_no.'_'.$file_timestamp.'.pdf';
	copy($filepath, $filepathnew);
}
//echo $filepath;
$pdf->Output($filepath,'F');
?>
