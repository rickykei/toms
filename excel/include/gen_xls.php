<?

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test.xls");

$submit = true;
$room_number = $_GET['room_number'];
$start_date  = $_GET['start_date'];
$end_date    = $_GET['end_date'];

if (($submit==true && $room_number!="") || ($submit==true && $start_date!=""))
{
  require("connection.php");
  require("class.php");
  $query_str = "SELECT * 
		FROM report 
		WHERE ";

  if ($room_number!="")
    $query_str .= " room=" . $room_number;

  if ($room_number!="" && $start_date!="")
    $query_str .= " AND ";

  if ($start_date!="")
  {
    $query_str.=" starttime>=\"".$start_date;
    $query_str.="\" and endtime<=\"".$end_date;
    $query_str.="\"";
  }

  $bar=new mysql("$query_str",1);
  get_class($bar);
  $result=$bar->ask_mysql();

  // print field's names
  for ($i=1; $i<mysql_num_fields($result); $i++)
    echo mysql_field_name($result, $i) . "\t";
  echo "\n";

  //gen xls
  $total_price = 0;
  while($row=mysql_fetch_array($result))
  {
    echo $row["room"]."\t";
    echo $row["starttime"]."\t";
    echo $row["endtime"]."\t";
    echo $row["movie_name"]."\t";
    echo $row["price"]."\t";
    echo "\n";
    $total_price += $row["price"];
  }
  echo "\t\t\tTotal Price:\t$" . number_format($total_price, 3);
}

?>
