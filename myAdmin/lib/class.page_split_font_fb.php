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
	   
	   function _getTotalpage(){
			return  $this->var_totalPage;;
	   }
	   
   
       function _query($sql)  
       {  
             $result		=	mysql_query($sql);  
             $num		=	mysql_num_rows($result);  
             $rt 			= 	$num%$this->var_pageSize;
			 $this->var_totalRow = $num;
   
             # หาจำนวนหน้าทั้งหมด  
             $this->var_totalPage = ($rt!=0) ? ceil($num/$this->var_pageSize) : floor($num/$this->var_pageSize);  
             $goto = ($this->var_currentPage - 1) * $this->var_pageSize;  
             $sql .= " LIMIT $goto , ".$this->var_pageSize;  
			 #echo $sql;
			
             $result=mysql_query($sql);  
   
             return $result;  
       }  
   
       function _displayPage($option="",$align="left")  
       {  
			  
			 echo "<ul class='pagination'>";
			
			 echo "<li>หน้า&nbsp;&nbsp;&nbsp;<input type=\"text\" class=\"input_center\" name=\"page_size\" id=\"page_size\" value='".$this->var_currentPage."' style=\"width:30px; height:20px !important;\" onchange=\"js_load_page($('#area_panel') , '".$this->var_file."', 'page='+this.value+'&'+$('#myForm').serialize());\" maxlength=\"4\" style='z-index:100; position:absolute;' onKeyPress=\"return CheckNumericKeyInfo(event.keyCode, event.which);\"  />";
			 
             echo "&nbsp;&nbsp;&nbsp;จาก ".$this->var_totalPage." หน้า ";  
			  
			 
             if($this->var_currentPage >1 && $this->var_currentPage<=$this->var_totalPage) {  
                      $prevpage = $this->var_currentPage - 1;  
              }  
             #echo $this->var_currentPage."of ".$this->var_totalPage."";  
   
              if($this->var_currentPage != $this->var_totalPage){  
                      $nextpage = $this->var_currentPage + 1;  
              }    
			   
              echo "</li>";
			  
			  
               
               $b=floor($this->var_currentPage/10);   
               $c=(($b*10));  
			   
               if($c>1) {  
                       $prevpage = $c-1;  
					   #echo "<li><a href=\"javascript:void(0);\" onclick=\"js_load_page($('#area_panel') , '".$this->var_file."' , 'page=".$prevpage."&".$option."'+$('#dataForm').serialize());\" title=\"Pre\" class='page_number_ahref'> &laquo; </a></li>";
                }else{  
                }  
                #echo " <b>";  
   
                for($i=$c; $i<$this->var_currentPage ; $i++) {  
                        if($i>0)  {}
								#echo "<li><a href=\"javascript:void(0);\" onclick=\"js_load_page($('#area_panel') , '".$this->var_file."', 'page=".$i."&".$option."'+$('#dataForm').serialize());\">$i</a></li>";
                }  
                #echo "<li class='active'><a href='javascript:void(0);'>".$this->var_currentPage."</a></li>";  
  
                for($i=($this->var_currentPage+1); $i<($c+10) ; $i++) {  
                       if($i<=$this->var_totalPage)  {}
								#echo "<li><a href=\"javascript:void(0);\" onclick=\"js_load_page($('#area_panel') , '".$this->var_file."','page=".$i."&".$option."'+$('#dataForm').serialize());\" class='page_number_ahref'>$i</a></li>";
                }  
                #echo "</b> ";  
   
                if($c>=0) {  
				 if(($c+10)<=$this->var_totalPage){  
						   $nextpage = $c+10;  
							#echo "<li><a href=\"javascript:void(0);\" onclick=\"js_load_page($('#area_panel') , '".$this->var_file."','page=".$nextpage."&".$option."'+$('#dataForm').serialize());\" title=\"Next \" class='page_number_ahref'>&raquo;</a></li>"; 
				  }else{  
				  }
               }else{  
                    #echo "<li> &raquo; </li>";  
                }  
				
				
     
                echo "</ul>";  
          }# _displayPage  
 } # ปิด Class  