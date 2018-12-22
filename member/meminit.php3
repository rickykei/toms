<?
function genid() {
	$query = "select max(mem_id) as id from member";
	$result = mysql_query($query);
	if ($row = mysql_fetch_array($result)) {
	//if($row = mysql_field_name($result, 0)) {
		return $row['id'] + 1;
	} else {
		return 1;
	}
}
?>
