 <?   

class page_split  
{  
       var $var_pageSize;  
       var $var_currentPage;  
       var $var_totalPage;  
       var $var_file;  
	   var $var_totalRow;
   
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
             $this->var_file=$file;  
       }  
   
       function _query($sql)  
       {  
             $result=mysql_query($sql);  
             $num=mysql_num_rows($result);  
             $rt = $num%$this->var_pageSize;
			 $this->var_totalRow = $num;
   
             # ËÒ¨Ó¹Ç¹Ë¹éÒ·Ñé§ËÁ´  
             $this->var_totalPage = ($rt!=0) ? ceil($num/$this->var_pageSize) : floor($num/$this->var_pageSize);  
             $goto = ($this->var_currentPage - 1) * $this->var_pageSize;  
             $sql .= " LIMIT $goto , ".$this->var_pageSize;  
             $result=mysql_query($sql);  
   
             return $result;  
       }  
   
       function _displayPage($option="",$align="left")  
       {  
 
             echo "<table align=center width=100%   cellspacing=0 cellpadding=0 border=0 class=txt_normal>\n";  
             echo "<tr><td align='".$align."'  height='30px;'>\n";  
			  
             echo $this->var_totalRow." Data  Page(s)  ";  
             if($this->var_currentPage >1 && $this->var_currentPage<=$this->var_totalPage) {  
                      $prevpage = $this->var_currentPage - 1;  
              }  
              echo $this->var_currentPage." Of ".$this->var_totalPage;  
   
              if($this->var_currentPage != $this->var_totalPage){  
                      $nextpage = $this->var_currentPage + 1;  
               }  
            
               echo "</td>\n";  

               echo "<td align=right>\n";  
               
               $b=floor($this->var_currentPage/10);   
               $c=(($b*10));  
               if($c>1) {  
                       $prevpage = $c-1;  
					   echo "<a href=\"javascript:void(0);\" onclick=\"js_main_ajax('".$this->var_file."' , 'page=".$prevpage."&".$option."','list_data','area_data_list');\" title=\"Pre\" class='page_number_ahref'> << Previous</a>\n";
                }else{  
                }  
                echo " <b>";  
   
                for($i=$c; $i<$this->var_currentPage ; $i++) {  
                        if($i>0)  
								echo "<a href=\"javascript:void(0);\" onclick=\"js_main_ajax('".$this->var_file."', 'page=".$i."&".$option."','list_data','area_data_list');\" class='page_number_ahref'>$i</a>\n";
                }  
                echo "<a href='javascript:void(0);' class='page_number_ahref_active'>".$this->var_currentPage."</a> \n";  
  
                for($i=($this->var_currentPage+1); $i<($c+10) ; $i++) {  
                       if($i<=$this->var_totalPage)  
								echo "<a href=\"javascript:void(0);\" onclick=\"js_main_ajax('".$this->var_file."','page=".$i."&".$option."','list_data','area_data_list');\" class='page_number_ahref'>$i</a>\n";
                }  
                echo "</b> ";  
   
                if($c>=0) {  
                         if(($c+10)<=$this->var_totalPage){  
                                   $nextpage = $c+10;  
								    echo "<a href=\"javascript:void(0);\" onclick=\"js_main_ajax('".$this->var_file."','page=".$nextpage."&".$option."','list_data','area_data_list');\" title=\"Next \" class='page_number_ahref'> Next >> </a>\n"; 
                          }else{  
						  }
               }else{  
                          echo ">>\n";  
                }  
   
                echo "</td></tr>\n";  
                echo "</table>\n";  
          }# »Ô´ ¿Ñ§¡ìªÑè¹ _displayPage  
 } # »Ô´ Class  