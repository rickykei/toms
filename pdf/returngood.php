<?php
define('FPDF_FONTPATH','./font/');
require('chinese.php');

//require('../fpdf.php');

//class PDF extends FPDF
class PDF extends PDF_Chinese
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
function Body($return_no)
{
   include("../include/config.php");

    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
   $result = $connection->query("SET NAMES 'UTF8'");
   $sql="SELECT * FROM returngood where return_no=".$return_no;

   $result = $connection->query($sql);
   
      if (DB::isError($result))
      die ($result->getMessage());
	while ($row =& $result->fetchRow(DB_FETCHMODE_ASSOC))
   {
     // Print out each element in $row, that is, print the values of
      // the attributes
	$return_no1=iconv("UTF-8", "BIG5-HKSCS",$row['return_no']);
	$return_date=iconv("UTF-8", "BIG5-HKSCS",$row['return_date']);
	$last_modify_date=iconv("UTF-8", "BIG5-HKSCS",$row['last_modify_date']);
	$sales_name=iconv("UTF-8", "BIG5-HKSCS",$row['staff_name']);
	$member_id=iconv("UTF-8", "BIG5-HKSCS",$row['member_id']);
	$invoice_no=iconv("UTF-8", "BIG5-HKSCS",$row['invoice_no']);
	$remark=iconv("UTF-8", "BIG5-HKSCS",$row['remark']);

	$total_price=iconv("UTF-8", "BIG5-HKSCS",$row['total_price']);

	
	
	$discount_percent=$row['discount_percent'];
	//if($discount_percent==0)
	$discount_deduct=$row['discount_deduct'];
	
	
	$man_power_price=$row['man_power_price'];
    $branchid=$row['branchID'];
   }
   $result->free ();
   
   $this->SetY(-5);
   $this->Ln(95);
   $this->SetTextColor(128);
   $this->SetFont('Big5','',11);
  // $this->SetDrawColor(255,255,255);

	$this->Cell(20,8,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
	$this->Cell(80,8,$customer_name,0,0,'L',0);
	$this->Cell(40,8,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
	$this->Cell(50,8,$branchid.$invoice_no,0,1,'C',0);
	
	$this->Cell(20,8,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
	$this->Cell(80,8,"$customer_tel",0,0,'L',0);
	$this->Cell(40,8,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
	$this->Cell(50,8,$return_date,0,1,'C',0);
	$this->Cell(20,8,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
	$this->Cell(80,8,$customer_detail,0,0,'L',0);
	$this->Cell(40,8,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
	$this->Cell(50,8,$delivery_date,0,1,'C',0);
	
//	$this->Cell(20,8,iconv("UTF-8", "BIG5-HKSCS","地址："),0,0,'R',0);
//	$this->Cell(170,8,$customer_detail,0,1,'L',0);
		$this->Ln(9);
		/*
	$this->Cell(20,8,iconv("UTF-8", "BIG5-HKSCS","行數"),0,0,'C',0);
	$this->Cell(30,8,iconv("UTF-8", "BIG5-HKSCS","貨品編號"),0,0,'C',0);
	$this->Cell(52,8,iconv("UTF-8", "BIG5-HKSCS","項目"),0,0,'C',0);
	$this->Cell(22,8,iconv("UTF-8", "BIG5-HKSCS","數量"),0,0,'C',0);
	$this->Cell(22,8,iconv("UTF-8", "BIG5-HKSCS","單價"),0,0,'C',0);
	$this->Cell(22,8,iconv("UTF-8", "BIG5-HKSCS","扶力"),0,0,'C',0);
	$this->Cell(22,8,iconv("UTF-8", "BIG5-HKSCS","共銀"),0,1,'C',0);
*/


//print goods_invoice

  // $result = $connection->query("SELECT goods_invoice.goods_partno as goods_partno,goods_invoice.goods_detail as goods_detail,goods_invoice.qty as qty,goods_invoice.marketprice as marketprice,goods_invoice.manpower as manpower ,goods_invoice.subtotal as subtotal,sumgoods.goods_detail as goods_detail2 FROM goods_invoice,sumgoods where sumgoods.goods_partno=goods_invoice.goods_partno and invoice_no=".$invoice_no);
  $sql="Select * from goods_return where return_no=".$return_no;

  $result = $connection->query($sql);
      if (DB::isError($result))
      die ($result->getMessage());
	  $i=1;
	while ($row2 =& $result->fetchRow(DB_FETCHMODE_ASSOC))
   {
   
	$this->Cell(20,6,iconv("UTF-8", "BIG5-HKSCS",$i),0,0,'C',0);
	$this->Cell(30,6,iconv("UTF-8", "BIG5-HKSCS",$row2['goods_partno']),0,0,'C',0);
	if($row2['goods_detail']!="")
	$this->Cell(52,6,iconv("UTF-8", "BIG5-HKSCS",$row2['goods_detail']),0,0,'C',0);
	else
	$this->Cell(52,6,iconv("UTF-8", "BIG5-HKSCS",$row2['goods_detail2']),0,0,'C',0);
	$this->Cell(22,6,iconv("UTF-8", "BIG5-HKSCS",$row2['qty']),0,0,'C',0);
	$this->Cell(22,6,iconv("UTF-8", "BIG5-HKSCS",$row2['marketprice']),0,0,'C',0);
	$this->Cell(22,6,iconv("UTF-8", "BIG5-HKSCS",$row2['manpower']),0,0,'C',0);
	//20060410
	//$amount=((100-$row2["discountrate"])/100)*$row2["qty"]*$row2["marketprice"];
	$amount=$row2['subtotal'];
	$this->Cell(22,6,iconv("UTF-8", "BIG5-HKSCS",number_format($row2['subtotal'], 2, '.', ' ')),0,1,'C',0);

	$i++;
    $total=$total+$amount;
   }
 $result->free ();
 for ($i=$i;$i<=18;$i++){
 $this->Cell(22,6,iconv("UTF-8", "BIG5-HKSCS",""),0,1,'C',0);
 }
  $this->Ln(3);
 	$this->Cell(150,7,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
 	$this->Cell(20,7,iconv("UTF-8", "BIG5-HKSCS",number_format($total, 2, '.', ' ')),0,0,'R',0);
 	$this->Cell(20,7,iconv("UTF-8", "BIG5-HKSCS",""),0,1,'R',0);
 	$this->Cell(150,7,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
 	$this->Cell(20,7,iconv("UTF-8", "BIG5-HKSCS",number_format($man_power_price, 2, '.', ' ')),0,0,'R',0);
 	$this->Cell(20,7,iconv("UTF-8", "BIG5-HKSCS",""),0,1,'R',0);
 	$this->Cell(150,7,iconv("UTF-8", "BIG5-HKSCS",""),0,0,'R',0);
		$subtotal=$man_power_price+$total;
	//	if ($discount_percent!=0)
//		{
		$subtotal=$subtotal-($subtotal*$discount_percent/100);
	//	}
	//	else
	//	{
		$subtotal=$subtotal-$discount_deduct;
	//	}
		
	$this->Cell(20,7,iconv("UTF-8", "BIG5-HKSCS",number_format($subtotal, 2, '.', ' ')),0,0,'R',0);
 	$this->Cell(20,7,iconv("UTF-8", "BIG5-HKSCS",""),0,1,'R',0);


 	
}
function Header()
{
	//Page header
	global $title;
	global $header_title;
	
	
	$w=$this->GetStringWidth($title)+6;
	$this->SetX(5);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(233,233,233);
	$this->SetTextColor(0,0,0);
	$this->Ln(45);
	$this->SetLineWidth(0);
	
//      $abc=iconv("UTF-8", "iso-8859-2", "黃河木行有限公司");
	/*$this->SetFont('Big5','B',30);
	$companyName=iconv("UTF-8", "BIG5-HKSCS", "黃河木行有限公司");
	$companyAddress=iconv("UTF-8", "BIG5-HKSCS", "旺角新填地街609-613號地下");
	$companyTel=iconv("UTF-8", "BIG5-HKSCS", "電話:241-22-241  241-22-335  傳真:241-33-373");
	$INVOICE=iconv("UTF-8", "BIG5-HKSCS", "發票");
	$this->Cell(190,14,$companyName,2,1,'C',0);
	$this->SetFont('Big5','',15);
	$this->Cell(190,5,$companyAddress,1,1,'C',0);
	$this->Cell(190,5,$companyTel,1,1,'C',0);
	$this->SetFont('Big5','B',25);
	$this->Cell(190,12,$INVOICE,1,1,'C',0);
	$this->Ln(8);*/
	//Save ordinate
    $this->y0=$this->GetY();
}

function Footer()
{
	//Page footer
	$this->SetY(-5);
	//$this->SetFont('Big5','',9);
	//$this->SetTextColor(128);
	//$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}






}





$pdf=new pdf('P','mm',array(216,217));
$pdf->SetAutoPageBreak(true,2);
$pdf->SetTopMargin(1);
$pdf->AddBig5Font();
$title='出貨單';
$header=array('出貨單','出貨單','出貨單','出貨單','出貨單');
$col_size=array(15,95,10,50,20);
$header2=array('出貨單','出貨單','出貨單','出貨單');
$col_size2=array(15,100,30,45);
$header_title=array();

$pdf->Body($return_no);
//$pdf->Set_header_title($header_title);


$pdf->SetAuthor('YRT Company Limited');
$section1_label=" ";

//$pdf->PrintChapter1($section1_label,$section2_label);
//$pdf->FancyTable($header,$data=$pdf->LoadData('countries.txt'));
//$pdf->PrintChapter(1,'Name: Wong Wan Kei','20k_c1.txt');
//$pdf->PrintChapter(2,'THE PROS AND CONS','20k_c2.txt');


$pdf->Output('../return/pdf/'.$return_no.'.pdf');




?>
