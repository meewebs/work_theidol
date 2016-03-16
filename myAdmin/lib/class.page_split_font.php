
 <?   

class page_split {  
       var $var_pageSize;  
       var $var_currentPage;  
       var $var_totalPage;  
       var $var_file;  
	   var $var_totalRow;
	   var $var_namefile;
	   var $var_per_page = 10;
   
       function page_split($pagesize=10, $file="")  
       {  
            $this->var_pageSize=$pagesize;  
            $this->var_currentPage=$page;  
            $this->var_file=$file;  
       }  
   
       function _setPageSize($size=10)  
       {  
             $this->var_pageSize=$size;  
       }  
   
       function _setPage($page=1)  
       {  
             if(empty($page)) $page=1;  
             $this->var_currentPage=$page;  
       }  
   
       function _setFile($file="")  
       {  
             $this->var_file	 = $file;  
       }  
	   
	   function _setNamefile($file="")  
       {  
             $this->var_namefile = $file;  
       }  
   
       function _query($sql)  
       {  
             $result=mysql_query($sql);  
             $num=mysql_num_rows($result);  
             $rt = $num%$this->var_pageSize;
			 $this->var_totalRow = $num;
   
             # หาจำนวนหน้าทั้งหมด  
             $this->var_totalPage = ($rt!=0) ? ceil($num/$this->var_pageSize) : floor($num/$this->var_pageSize);  
             $goto 		= ($this->var_currentPage - 1) * $this->var_pageSize;  
             $sql 	   .= " LIMIT $goto , ".$this->var_pageSize;  
             $result		= mysql_query($sql);  
   
             return $result;  
       }  
   
       function _displayPage($option="",$align="center")  
       {  
             $html =  "<table align=center width=100%   cellspacing=5 cellpadding=0 border=0>\n";  
             $html .= "<tr><td align='".$align."'  height='10px;'>\n";  
  
             if($this->var_currentPage >1 && $this->var_currentPage<=$this->var_totalPage) {  
                      $prevpage = $this->var_currentPage - 1;  
              }  
           		#$html .=  "หน้า ". $this->var_currentPage." ทั้งหมด ".$this->var_totalPage." &nbsp;&nbsp;";
   
              if($this->var_currentPage != $this->var_totalPage){  
                      $nextpage = $this->var_currentPage + 1;  
               }  
              # วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า  
               $b=floor($this->var_currentPage/$this->var_per_page);   
               $c=(($b*$this->var_per_page));  
               if($c>1) {  
                       $prevpage = $c-1;  
					   $html .= "<a href=\"".$this->var_file.$prevpage.$this->var_namefile."\" class='page_number_ahref'><< Previous</a>\n";
                }else{  
                }  
                $html .= " <b>";  
   
                for($i=$c; $i<$this->var_currentPage ; $i++) {  
                        if($i>0)  
								$html .= "<a href=\"".$this->var_file."".$i.$this->var_namefile."\" class='page_number_ahref'>".$i."</a>\n";
                }  
                $html .= "<a href='javascript:void(0);' class='page_number_ahref_active'>".$this->var_currentPage."</a> \n";  
  
                for($i=($this->var_currentPage+1); $i<($c+10) ; $i++) {  
                       if($i<=$this->var_totalPage)  
								$html .= "<a href=\"".$this->var_file."".$i.$this->var_namefile."\" class='page_number_ahref'>".$i."</a>\n";
                }  
                $html .= "</b> ";  
   
                if($c>=0) {  
                         if(($c+$this->var_per_page)<=$this->var_totalPage){  
                                   $nextpage = $c+$this->var_per_page;  
								    $html .= "<a href=\"".$this->var_file.$nextpage.$this->var_namefile."\" title=\"10 หน้าถัดไป \" class='page_number_ahref'>Next >></a>\n"; 
                          }else{  
						  }
               }else{  
                          $html .= ">>\n";  
                }  
   
                $html .= "</td></tr>\n";  
                $html .= "</table>\n";  
				
				return $html;
          }# ปิด ฟังก์ชั่น _displayPage  
 } # ปิด Class  