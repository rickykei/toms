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
   $turnover = "<span class=\"style7\">第一頁|上一頁|</span>";
}else{
$turnover = "<a  href='?page=1&numItems=".$pager->numItems."'>首頁</a>|<a href='?page=".$pager->PreviousPageID."&numItems=".$pager->numItems."'> 上一頁</a>|";
}
if ( $pager->isLastPage ){
   $turnover .= "<span class=\"style7\">下一頁|尾頁</span>";
}else{
$turnover .= "<a class=style1 href='?page=".$pager->NextPageID."&numItems=".$pager->numItems."'> 下一頁</a>|<a href='?page=".$pager->numPages."&numItems=".$pager->numItems."'> 尾頁</a>";
}
?>