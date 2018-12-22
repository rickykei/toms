<?
include("config.php3");
//$query="SELECT DISTINCT ref_no,date,place,in_comp_name,status FROM `goods`";

$query="SELECT ref_no,date,place,in_comp_name,status FROM goods order by ref_no";
$db_ingood_check="delete from in_goods";
$result=mysql_query($query); 
$result2=mysql_query($db_ingood_check);
$num_of_goods=mysql_num_rows($result);
echo "no.of.goods".$num_of_goods."<p>";

$temp="";
//copy data to in_goods;
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $ref_no=$row["ref_no"];
      $ref_no=strtoupper($ref_no);
      $date=$row["date"];
      $place=$row["place"];
      if ($place==null)
      $place=0;
      $in_comp_name=$row["in_comp_name"];
      if ($in_comp_name==null)
      $in_comp_name="NA";
      $status=$row["status"];
      if ($status==null)
      $status=="Y";
      

	//if ($temp!=strtoupper($ref_no))
	//if ($temp!=$ref_no)
	
	if (strcmp($temp, $ref_no) != 0)
	{
//echo "<font color=blue>temp=".$temp."refno=".$ref_no."+".$date."+".$place."+".$in_comp_name."+".$status;
//echo "copy oK</font><p>";
		$query2="INSERT INTO in_goods ( id , ref_no , place , date , status , in_comp_name ) values ('','$ref_no',$place,'$date','$status','$in_comp_name')";
		$result2=mysql_query($query2);
	}
	else
	{
//echo "<font color=red>temp=".$temp."refno=".$ref_no."+".$date."+".$place."+".$in_comp_name."+".$status;
//echo "not copied</font><p>";
	}
	$temp=$ref_no; 
	//$temp=strtoupper($ref_no); 
}

    mysql_free_result($result);
    
    
    $query_count_in_goods="select * from in_goods";
    $result=mysql_query($query_count_in_goods); 
    $num_of_count_ingoods=mysql_num_rows($result);
    echo "</font>no.of.count.ingoods".$num_of_count_ingoods."<p>";
    
    //check record after join goods & in_goods
    
    $queryjoin="select * from in_goods,goods where in_goods.ref_no like goods.ref_no order by in_goods.ref_no";
    $result=mysql_query($queryjoin); 
    $num_of_join_ingoods=mysql_num_rows($result);
    echo "no.of.join.ingoods".$num_of_join_ingoods."<p>";
    //while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    //	echo ++$i;
    //	echo "$$".$row[0]."+".$row[1]."+".$row[2]."+".$row[3]."+".$row[4]."+".$row[5]."+".$row[6]."+".$row[7]."+".$row[8]."+".$row[9]."+".$row[10]."+".$row[11]."+".$row[12]."<p>";
    //}

    mysql_free_result($result);

?>
