<?php
// FileName: Pager.class.php
// 分页类，这个类仅仅用于处理数据结构，不负责处理显示的工作
Class Pager
{
   var $PageSize;             //每页的数量
   var $CurrentPageID;        //当前的页数
   var $NextPageID;           //下一页
   var $PreviousPageID;       //上一页
   var $numPages;             //总页数
   var $numItems;             //总记录数
   var $isFirstPage;          //是否第一页
   var $isLastPage;           //是否最后一页
   var $sql;                  //sql查询语句
  
  function Pager($option)
   {
       global $db;
       $this->_setOptions($option);
       // 总条数
       if ( !isset($this->numItems) )
       {
           $res = $db->query($this->sql);
           $this->numItems = $res->numRows();
       }
       // 总页数

       if ( $this->numItems > 0 )
       {
           if ( $this->numItems < $this->PageSize )
		   { 
		   	$this->numPages = 1; 

		   }else if ( $this->numItems % $this->PageSize )
           {
		   
               $this->numPages= (int)($this->numItems / $this->PageSize) + 1;
           }
           else
           {
               $this->numPages = $this->numItems / $this->PageSize;
           }
       }
       else
       {
           $this->numPages = 0;
       }
      
       switch ( $this->CurrentPageID )
       {
          case $this->numPages == 1:
           case $this->numPages == 0:
               $this->isFirstPage = true;
               $this->isLastPage = true;
               break;
           case 1:
               $this->isFirstPage = true;
               $this->isLastPage = false;
               break;
           case $this->numPages:
               $this->isFirstPage = false;
               $this->isLastPage = true;
               break;
           default:
               $this->isFirstPage = false;
               $this->isLastPage = false;
       }
      
       if ( $this->numPages > 1 )
       {
           if ( !$this->isLastPage ) { $this->NextPageID = $this->CurrentPageID + 1; }
           if ( !$this->isFirstPage ) { $this->PreviousPageID = $this->CurrentPageID - 1; }
       }
      
       return true;
   }
  

  
   function getDataLink()
   {
       if ( $this->numItems )
       {
           global $db;
          
           $PageID = $this->CurrentPageID;
          
           $from = ($PageID - 1)*$this->PageSize;
           $count = $this->PageSize;
           $link = $db->limitQuery($this->sql, $from, $count);  
          
           return $link;
       }
       else
       {
           return false;
       }
   }
  

  
   function getPageData()
   {	
       if ( $this->numItems )
       {	
           if ( $res = $this->getDataLink() )
           {     
               if ( $res->numRows() )
               {
                   while ( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
                   {	
                       $result[] = $row;
                   }
               }
               else
               {
                   $result = array();
               }
              
               return $result;
           }
           else
           {
               return false;
           }
       }
       else
       {
           return $result=array();
       }
   }
  
   function _setOptions($option)
   {
       $allow_options = array(
                   'PageSize',
                   'CurrentPageID',
                   'sql',
                   'numItems'
       );
      
       foreach ( $option as $key => $value )
       {
           if ( in_array($key, $allow_options) && ($value != null) )
           {
               $this->$key = $value;
           }
       }
      
       return true;
   }
}
?>