<?
if ( isset($_GET['page']) )
{
   $page = (int)$_GET['page'];
}
else
{
   $page = 1;
}

$pager_option = array(
       "sql" => $sql,
       "PageSize" => 10,
       "CurrentPageID" => $page
);

if ( isset($_GET['numItems']) ){
   $pager_option['numItems'] = (int)$_GET['numItems'];
}

$pager = @new Pager($pager_option);
$result = $pager->getPageData();

if ( $pager->isFirstPage ){
   $turnover = "<span class=\"style7\">�Ĥ@��|�W�@��|</span>";
}else{
$turnover = "<a  href='?suppliername=$suppliername&instock_date_end=$instock_date_end&instock_date_start=$instock_date_start&goods_partno=$goods_partno&supplier_invoice_no=$supplier_invoice_no&instock_no=$instock_no&page=1&numItems=".$pager->numItems."'>����</a>|<a href='?suppliername=$suppliername&instock_date_end=$instock_date_end&instock_date_start=$instock_date_start&goods_partno=$goods_partno&supplier_invoice_no=$supplier_invoice_no&instock_no=$instock_no&page=".$pager->PreviousPageID."&numItems=".$pager->numItems."'> �W�@��</a>|";
}
if ( $pager->isLastPage ){
   $turnover .= "<span class=\"style7\">�U�@��|����</span>";
}else{
$turnover .= "<a href='?suppliername=$suppliername&instock_date_end=$instock_date_end&instock_date_start=$instock_date_start&goods_partno=$goods_partno&supplier_invoice_no=$supplier_invoice_no&instock_no=$instock_no&page=".$pager->NextPageID."&numItems=".$pager->numItems."'> �U�@��</a>|<a  href='?suppliername=$suppliername&instock_date_end=$instock_date_end&instock_date_start=$instock_date_start&goods_partno=$goods_partno&supplier_invoice_no=$supplier_invoice_no&instock_no=$instock_no&page=".$pager->numPages."&numItems=".$pager->numItems."'> ����</a>";
}
?>