<?php 
class PDF extends PDF_Chinese
{
//Current column
var $col=0;
//Ordinate of column start
var $y0;
var $header_title=array();


function Body($goods_partno,$goods_detail,$qty,$market_price,$discountrate,$invoice_no,$customer_name,$invoice_date,$customer_car_no,$customer_tel)
{
	
	 $this->SetXY(0,-1);

 $this->SetTextColor(0);
 $this->SetFont('Big5','',10);
 $this->SetDrawColor(0,0,0);
 $border="0";
 
   $h=6;
 $c1=10;
 $c2=31;
 $c3=80;
 $c4=22;
 $c5=5;
 $c6=10;
 $c7=24;


   $this->Cell($c1,$h,"",0,0,'L',0);
	 $this->Cell($c2,$h,"",0,0,'L',0);
	 $this->Cell($c3,$h,"",0,0,'L',0);
	 $this->Cell($c4,$h,"",0,0,'L',0);
	 $this->Cell($c5,$h,"",0,0,'R',0);
	 $this->Cell($c6,$h,"",0,0,'R',0);
	 $this->Cell($c7,$h,"",0,1,'R',0);
$this->SetFont('times','B',10); 
$this->SetY(54);
$this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,"",$border,0,'L',0);
	 $this->Cell($c3,$h,"",$border,0,'R',0);
	 $this->Cell($c4,$h,"",$border,0,'L',0);
	 $this->Cell($c5,$h,"",$border,0,'R',0);
	 $this->Cell($c6,$h,"",$border,0,'R',0);
	 $this->Cell($c7,$h,"CUSTOMER ORDER",$border,1,'R',0);
$this->SetFont('Big5','',10); 

$this->SetY(64);
   $this->Cell($c1,$h,"",$border,0,'L',0);
	 $this->Cell($c2,$h,$customer_name,$border,0,'L',0);
	 $this->Cell($c3,$h,$customer_car_no,$border,0,'R',0);
	 $this->Cell($c4,$h,"",$border,0,'L',0);
	 $this->Cell($c5,$h,"",$border,0,'R',0);
	 $this->Cell($c6,$h,"",$border,0,'R',0);
	 $this->Cell($c7,$h,"C/O: ".$invoice_no."",$border,1,'R',0);

$this->SetY(74);
   $this->Cell($c1,$h,"",$border,0,'L',0);
 $this->Cell($c2,$h,$customer_tel,$border,0,'L',0);
	 $this->Cell($c3,$h,"",$border,0,'L',0);
	 $this->Cell($c4,$h,"",$border,0,'L',0);
	 $this->Cell($c5,$h,"",$border,0,'R',0);
	 $this->Cell($c6,$h,"",$border,0,'R',0);
	 $this->Cell($c7,$h,"".$invoice_date."",$border,1,'R',0);	 
 //$this->Ln(22);
 $this->SetY(90);
 $h=6;
 $c1=6;
 $c2=38;
 $c3=86;
 $c4=10;
 $c5=15;
 $c6=17;
 $c7=26;
 $total=0;
   $this->SetFont('Big5','',9);
   
	for ($i=1;$i<count($goods_partno);$i++)
	{
		if ($goods_partno[$i]=="")
		break;
	 
	 $this->Cell($c2,$h,$goods_partno[$i],$border,0,'L',0);
	 $this->Cell($c3,$h,$goods_detail[$i],$border,0,'L',0);
	 $this->Cell($c4,$h,$qty[$i]."",$border,0,'C',0);
	 $this->Cell($c5,$h,number_format($market_price[$i],2)."",$border,0,'R',0);
	 
	  //20091201 rounding co_no >2417
		if ($invoice_no>2417){
	// round 20091201
	 $this->Cell($c6,$h,"".number_format(round($market_price[$i]-($market_price[$i]*$discountrate[$i]/100)),2),$border,0,'R',0);
	 $this->Cell($c7,$h,"".number_format(round(($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i]),2),$border,1,'R',0);
	  //$total=$total+round((($market_price[$i]-($market_price[$i]*$discountrate[$i]/100)))*$qty[$i]);
	  
	  			 // round 20101215
			 $total=$total+round((round($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i]));	
	  }else{
	 $this->Cell($c6,$h,"".number_format($market_price[$i]-($market_price[$i]*$discountrate[$i]/100),2),$border,0,'R',0);
	 $this->Cell($c7,$h,"".number_format(($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i],2),$border,1,'R',0);
	  $total=$total+(($market_price[$i]-($market_price[$i]*$discountrate[$i]/100))*$qty[$i]);
	 }
	
	}
	 	 
  $this->SetY(245); 
  
	 $this->Cell($c2,$h,"",0,0,'L',0);
	 $this->Cell($c3,$h,"",0,0,'L',0);
	 $this->Cell($c4,$h,"",0,0,'L',0);
	 $this->Cell($c5,$h,"",0,0,'R',0);
	 $this->Cell($c6,$h,"",0,0,'R',0);
	 $this->Cell($c7,$h,"".number_format($total,2),0,1,'R',0);
}


function Header()
{
	//Page header
	
	
}
function Footer()
{
	//Page footer
	

}
}
?>
