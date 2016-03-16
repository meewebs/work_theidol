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
   
             # หาจำนวนหน้าทั้งหมด  
             $this->var_totalPage = ($rt!=0) ? ceil($num/$this->var_pageSize) : floor($num/$this->var_pageSize);  
             $goto = ($this->var_currentPage - 1) * $this->var_pageSize;  
             $sql .= " LIMIT $goto , ".$this->var_pageSize;  
			#echo $sql;
             $result=mysql_query($sql);  
   
             return $result;  
       }  
   
       function _displayPage($option="",$align="center")  
       {  
             # รูปแบบตัวแปร option คือ $option = "id=$c_id";  
             # ถ้ามีหลายตัวแปรก็จะเป็น  $option = "id=$c_id&name=$myname&action=$action";  
             echo "<table align=center width=100%   cellspacing=0 cellpadding=0 border=0>\n";  
             echo "<tr><td align='".$align."'  height='30px;'   width='40px;'  class='pagehref_gallery'>\n";  
			 #echo "<span class='txt_detail_writh' >ค้นพบ</span> <span class='txt_detail_writh'>".$this->var_totalRow."</span> <span class='txt_detail_writh' >ข้อมูล</span> ";
             #echo "<font color=#686898>\n";  
  
             # สร้าง link เพื่อไปหน้าก่อน-หน้าถัดไป  
             echo "หน้าที่  ";  
		 
             if($this->var_currentPage >1 && $this->var_currentPage<=$this->var_totalPage) {  
                      $prevpage = $this->var_currentPage - 1;  
              }  
           #   echo $this->var_currentPage." จาก ".$this->var_totalPage." หน้า";
   
              if($this->var_currentPage != $this->var_totalPage){  
                      $nextpage = $this->var_currentPage + 1;  
               }  
             # echo "</font>\n";  
               echo "</td>\n";  

               echo "<td align=left>\n";  
		#	     echo "page";
               # วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า  
               $b=floor($this->var_currentPage/50);   
               $c=(($b*50));  
               if($c>1) {  
                       $prevpage = $c-1;  
					   echo "<a href=\"".$this->var_file."?page=".$prevpage."&".$option."\" class='page_number_ahref'><< Previous </a>\n";
                }else{  
                }  
                echo " <b>";  
   
                for($i=$c; $i<$this->var_currentPage ; $i++) {  
                        if($i>0)  
								echo "<a href=\"".$this->var_file."?page=".$i."&".$option."\" class='page_number_ahref'>$i </a> \n";
                }  
                echo "<a href='javascript:void(0);' class='page_number_ahref_active'>".$this->var_currentPage."</a> \n";  
  
                for($i=($this->var_currentPage+1); $i<($c+50) ; $i++) {  
                       if($i<=$this->var_totalPage)  
								echo " <a href=\"".$this->var_file."?page=".$i."&".$option."\" class='page_number_ahref'> $i</a>\n";
                }  
                echo "</b> ";  
   
                if($c>=0) {  
                         if(($c+50)<=$this->var_totalPage){  
                                   $nextpage = $c+50;  
								    echo "<a href=\"".$this->var_file."?page=".$nextpage."&".$option."\" title=\"23 หน้าถัดไป \" class='page_number_ahref'> Next >></a>\n"; 
                          }else{  
						  }
               }else{  
                          echo ">>\n";  
                }  
   
                echo "</td></tr>\n";  
                echo "</table>\n";  
          }# ปิด ฟังก์ชั่น _displayPage  
 } # ปิด Class  