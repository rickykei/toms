<?php 
class PDF extends PDF_Chinese
{
//Current column
var $col=0;
//Ordinate of column start
var $y0;
var $header_title=array();


function Body($goods_partno,$goods_detail,$qty,$market_price,$discountrate,$invoice_no,$customer_name,$invoice_date)
{
	
	 $this->SetXY(0,-1);

 $this->SetTextColor(0);
 $this->SetFont('Big5','',10);
 $this->SetDrawColor(255,255,255);
 $border=0;
 
   $h=6;
 $c1=20;
 $c2=36;
 $c3=85;
 $c4=7;
 $c5=5;
 $c6=5;
 $c7=18;

   $this->Cell($c1,$h,"",0,0,'L',0);
	 $this->Cell($c2,$h,"",0,0,'L',0);
	 $this->Cell($c3,$h,"",0,0,'L',0);
	 $this->Cell($c4,$h,"",0,0,'L',0);
	 $this->Cell($c5,$h,"",0,0,'R',0);
	 $this->Cell($c6,$h,"",0,0,'R',0);
	 $this->Cell($c7,$h,"",0,1,'R',0);

$this->SetY(67);
   $this->Cell($c1,$h,"",0,0,'L',0);
	 $this->Cell($c2,$h,$customer_name,0,0,'L',0);
	 $this->Cell($c3,$h,"",0,0,'L',0);
	 $this->Cell($c4,$h,"",0,0,'L',0);
	 $this->Cell($c5,$h,"",0,0,'R',0);
	 $this->Cell($c6,$h,"",0,0,'R',0);
	 $this->Cell($c7,$h,"INVOICE NO: ".$invoice_no."",0,1,'R',0);
	 $c3=88;
$this->SetY(75);
   $this->Cell($c1,$h,"",0,0,'L',0);
	 $this->Cell($c2,$h,"",0,0,'L',0);
	 $this->Cell($c3,$h,"",0,0,'L',0);
	 $this->Cell($c4,$h,"",0,0,'L',0);
	 $this->Cell($c5,$h,"",0,0,'R',0);
	 $this->Cell($c6,$h,"",0,0,'R',0);
	 $this->Cell($c7,$h,"".$invoice_date."",0,1,'R',0);	 
 //$this->Ln(22);
 $this->SetY(93);
 $h=6;
 $c1=6;
 $c2=36;
 $c3=87;
 $c4=7;
 $c5=18;
 $c6=18;
 $c7=18;
 $total=0;
	for ($i=1;$i<count($goods_partno);$i++)
	{
		if ($goods_partno[$i]=="")
		break;
	 $this->Cell($c1,$h,"",0,0,'L',0);
	 $this->Cell($c2,$h,$goods_partno[$i],0,0,'L',0);
	 $this->Cell($c3,$h,$goods_detail[$i],0,0,'L',0);
	 $this->Cell($c4,$h,$qty[$i]."",0,0,'L',0);
	 $this->Cell($c5,$h,number_format($market_price[$i],2)."",0,0,'R',0);
	 $this->Cell($c6,$h,"".number_format($market_price[$i]-($market_price[$i]*$discountrate[$i]/100),2),0,0,'R',0);
	 $this->Cell($c7,$h,"".number_format($market_price[$i]-(($market_price[$i]*$discountrate[$i]/100))*$qty[$i],2),0,1,'R',0);
	 $total=$total+($market_price[$i]-(($market_price[$i]*$discountrate[$i]/100))*$qty[$i]);
	}
	 	 
  $this->SetY(245); 
  $this->Cell($c1,$h,"",0,0,'L',0);
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