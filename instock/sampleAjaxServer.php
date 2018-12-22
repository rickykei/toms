<?
session_start();
header('Content-Type: text/xml; charset=UTF-8');
echo '<'.'?xml version="1.0" encoding="UTF-8"?'.'>';
?>
<ajax-response><response>
<? 
switch ($_GET['action']) {
	case 'select':
	case 'autocomplete':
	case 'callout':
	case 'updatefield':
	case 'htmlcontent':
	case 'portlet':
	case 'tabpanel':
	case 'toggle':
	case 'select2':
	case 'check_mem_id':
		include('server/server_'.$_GET['action'].'.php'); 
		break;
	default:
		echo "Wrong action parameter";
}
?>
</response></ajax-response>