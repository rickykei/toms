<? 
require_once('./include/class200411.php');
require_once('./include/connection.php');

		$sql="SELECT * , count( goods_partno ) AS abc FROM sheet1 GROUP BY goods_partno HAVING abc >1";
		echo $sql."<p>";
		$mysql_class=new mysql($sql,1);
		get_class($mysql_class);
		$result=$mysql_class->ask_mysql();
		
		$no_of_duplicate_record=$mysql_class->no_of_rows();
		echo $no_of_duplicate_record."<p>";
		
		while($row=mysql_fetch_array($result))
		{
			$sql="delete from sheet1 where goods_partno='".$row["goods_partno"]."' limit 1";
			echo $sql;
			$mysql_class->mysql($sql,1);
			if ($mysql_class->query_mysql())
			{
				echo "removed";
			}
			else
			{
				echo "can'tremove";
			}
			echo "<p>";
			echo $row["goods_partno"]." ".$row["abc"]."<p>";
			
			
		}
		?>
		
		
