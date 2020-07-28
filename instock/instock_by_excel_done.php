<?php
include("../config.php3");
	include '../classes/PHPExcel.php';
	//instock header
	$ref_no=$_POST['ref_no'];
	$company_name=$_POST['company_name'];
	
	
	//import excel contents
	$file_name = $_FILES["updOrderFile"]["tmp_name"];
	$actual_file_name = $_FILES["updOrderFile"]["name"];
 	$objPHPExcel = getExcelReader($file_name, $actual_file_name);
	$ws = $objPHPExcel->getSheet(0);
	$table_html="";
	foreach ($ws->getRowIterator() as $row) {
		//if ($rowNo == 1) {
			// Skip 1st row (i.e. header)
			//continue;
		//}
		$rowNo = $row->getRowIndex();
		$goods_partno = trim($ws->getCell("A".$rowNo)->getValue());
		$cost = trim($ws->getCell("B".$rowNo)->getValue());
		$qty = trim($ws->getCell("C".$rowNo)->getValue());
		
		
		
		//insert db 1 record by 1
		if ($goods_partno!="")    {
		  $query3="insert into goods (ref_no,goods_id,goods_partno,cost,stock,stockout,place,date,status,in_comp_name) values ('$ref_no','$goods_partno','$goods_partno',$cost,'$qty',0,3,now(),'Y','$company_name')";
		  if (mysql_query($query3))
		   {
				$success=1;
		   $query2="update sumgoods set allstock=allstock+".$qty." where goods_partno='$goods_partno'";
		    
				if (mysql_query($query2)){
						$text="goodname updated";
				}else{
					$text="fail to update goodname";
				}

				$query3="select id from sumgoods where goods_partno='$goods_partno'";
				if ($result3=mysql_query($query3)){
					$num_rows3=mysql_num_rows($result3);
					if ($num_rows3==0)
					$text="fail to update goodname";
				}
			}
        
        
		}

		$table_html.="<tr><td>".$goods_partno."</td><td>".$cost."</td><td>".$qty."</td><td>".$text."</td></tr>";
		
		$rowNo++;
	}
	
	
	function getExcelReader($file_name, $actual_file_name) {
		$ext = getFileExtension($actual_file_name);
		
		$objPHPExcel = new PHPExcel();
		
		if ($ext == 'xls') {
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
		} else if ($ext == 'xlsx') {
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		}
		
		
		$objPHPExcel = $objReader->load($file_name);
		
		return $objPHPExcel;
	}

	function getFileExtension($file_name) {
		$pos = strrpos($file_name, '.');
		return substr($file_name, $pos + 1);
	}

?>
<html>
<head>

<title>instock by excel done </title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
 
 
</head>

<body bgcolor="#99CCFF" text="#003366">
 
 <?php 
 
 if ($success==1){

	echo "Batch Upload Success";

	echo "<br><table border='1'><tr ><td bgcolor='#99CC66'>Part No.</td><td bgcolor='#99CC66'>Cost </td><td bgcolor='#99CC66'>QTY</td><td bgcolor='#99CC66'>STATUS</td></tr>".$table_html."</table>";
 }
 echo "<br><a href=\"/instock/instock_by_excel.php\">back to input page</a>";?>
 
  
  
</body>
</html>
