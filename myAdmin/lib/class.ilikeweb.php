<?
class diskSpace {
	
	public $dir;
	public $_byte;
	public $_size;
	
	# get พท. ใน folder ออกมาเป็น byte
	public function getFolderSize(){
		
		$h = @opendir($this->dir);
		if($h==0)return 0;
	
		while ($f=readdir($h)){
			if ( $f!= "..") {
				$sf+=filesize($nd=$this->dir."/".$f);
				if($f!="."&&is_dir($nd)){
					$sf+=GetFolderSize ($nd);
				}
			}
		}
		
		closedir($h);
		return $this->_byte = $sf;
		
	}
	
	
	# get คำนวณขนาด พท. แสดงออกมาให้ คนทั่วไปเข้าใจ
	public function getFileSize($_size){
		
		if($_size == "Unlimit")
			return $this->_size = true;
		else if($_size >= (1024*1024))
			return $this->_size = number_format(($_size/(1024*1024)),2)." Mb";
		else if($_size >= 1024)
			return $this->_size = number_format($_size/1024)." Kb";
		else 
			return $this->_size = number_format($_size)." Byte";
		
	}
	
	public function getFile($_size){
		
		return $this->_size = number_format(($_size/(1024*1024)),2);
		
	}
	
}


# ตรวจสอบขนาด พท. ของผู้ใช้งาน เกินกำหนดหรือไม่
class repairDisk extends diskSpace {
	var $limit_space = "";
	
	public function getRepairDisk(){
		
		if($this->limit_space != "unlimited"){
			$my_size = number_format(($this->getFolderSize()/(1024*1024)),2);
			if($my_size <= $this->limit_space)
				return true;
			else
				return false;
				
		}else{
			return true;	
		}
		
	}
	
} 


class menuImage {
	
	var $menu_type_image 		= "";
	var $menu_name 				= "";
	var $menu_src						= "";
	var $menu_path_src			= "";
	var $menu_width					= "";
	var $menu_height				= "";
	
	public function getTypeMenu(){
		
		if($this->menu_type_image == "Yes" && $this->menu_src){
			
			$arr_type 		= explode(".",$this->menu_src);
			$type_file			= $arr_type[count($arr_type)-1];
			
			if(strtolower($type_file) == "swf"){

				$menu 	= '<embed id="Header" width="'.$this->menu_width.'" height="'.$this->menu_height.'" wmode="transparent" name="plugin" src="'.$this->menu_path_src.'" type="application/x-shockwave-flash" style="cursor:pointer; z-index:3;"></embed>';
	
			}else{
	
				$menu 	= '<img id="profile_picture" src="'.$this->menu_path_src.'" alt="'.$this->menu_name.'" align="absmiddle"  />';
	
			}
			return $menu;
			
		}else{
			return $this->menu_name;
		}
			
		
	}
}





class bank{
	
	public $branch;
	public function getBank(){
		
		$branchName = array(
				0 => "เลือกธนาคาร...",
				1 => "ธนาคารกรุงเทพ",
				2 => "ธนาคารกสิกรไทย",
				3 => "ธนาคารไทยพาณิชย์",
				4 => "ธนาคารกรุงไทย",
				5 => "ธนาคารธนชาต",
				6 => "ธนาคารออมสิน",
				7 => "ธนาคารทหารไทย"
		);
		
		return $branchName;
		
	}
	
	public function getIconBank(){
		
		$branchIcon = array(
				1 => "BKK.jpg",
				2 => "K Bank.jpg",
				3 => "SCB.jpg",
				4 => "K TH.jpg",
				5 => "T-Bank.jpg",
				6 => "GSB.jpg",
				7 => "TMB.jpg"
		);
		
		return $branchIcon;
		
	}
	
	public function getTypeBank(){
		$typeBank = array(
			   0 => "เลือก...",
			   1 => "ออมทรัพย์",
			   2 => "ฝากประจำ",
			   3 => "กระแสรายวัน"
		);
		
		return $typeBank;
		
	}
	
	
}


class menu{
	
	public $table;
	public $table_join;
	public $table_mod;
	public $main_menu;
	public $sub_menu;
	
	public function get_menu_header(){
		
		if($this->main_menu && $this->sub_menu){
			
			$sql = 	" SELECT ".$this->table."_ID , ".$this->table_join."_ID , ".$this->table_join."_Title ".
						" FROM ".$this->table.
						" LEFT JOIN ".$this->table_join." ON ".$this->table_join."_GroupID = ".$this->table."_ID ".
						" WHERE ".$this->table."_Status = 'Enable' ".
						" AND ".$this->table_join."_ID = '".$this->sub_menu."' ";
			#echo $sql;
			$result = mysql_query($sql);
			if($rs = mysql_fetch_assoc($result)){
				$_return		= $rs[$this->table_join."_Title"];		
			}
			
		}else if($this->main_menu){
			
			$sql = 	" SELECT ".$this->table."_ID , ".$this->table."_Title ".
						" FROM ".$this->table.
						" WHERE ".$this->table."_Status = 'Enable' ".
						" AND ".$this->table."_ID = '".$this->main_menu."' ";
			#echo $sql;
			$result = mysql_query($sql);
			if($rs = mysql_fetch_array($result)){
				$_return		= $rs[$this->table."_Title"];		
			}
			
		}
		
		return $_return;
	}#end get menu header
	
	
	public function getModMenu($mod_id , $user_id){
		
		$sql = 	" SELECT ".$this->table."_ID  ".
					" FROM ".$this->table.
					" LEFT JOIN ".$this->table_mod." ON ".$this->table_mod."_ID = ".$this->table."_ModuleID ".
					" WHERE ".$this->table_mod."_ID = '".$mod_id."' ".
					" AND ".$this->table."_UserID = '".$user_id."' ";
			#echo $sql;
			$result = mysql_query($sql);
			if($rs = mysql_fetch_array($result)){
				$_return		= true;		
			}else{
				$_return		= false;		
			}
			
			return $_return;
	}
	
}#end class menu



class shop{
	
	public function getCustomerStatus(){
		
		$customerStatus = array(
				0 => "สั่งซื้อสินค้า",
				1 => "ลูกค้ายืนยันการชำระเงิน",
				2 => "ชำระเงินเรียบร้อย",
				3 => "จัดเตรียมสินค้า",
				4 => "อยู่ระหว่างการขนส่ง",
				5 => "ทำการขายเรียบร้อย",
				6 => "ยกเลิก",
		);
		
		return $customerStatus;
	}
	
}



class imageAlbum{
	
	var $dir;
	
	function getDirFile(){
		
		if (is_dir($this->dir)) {
			if ($dh = opendir($this->dir)) {
				$arr_file = "";
				while (($file = readdir($dh)) !== false) {
					if($file != "." && $file != ".." && $file != "Thumbs.db"){
						$my_file_type = filetype($this->dir . $file);
						if($my_file_type === "file")
						{
							
							$arr_file[] = $this->dir.$file;
						}
					}
				}
				closedir($dh);
				if($arr_file) sort($arr_file);
				return $arr_file;
			}
		}
		
		
	
	}
	
}


class file_content{
	var $path;
	var $mode;
	function setFile($filename,$data,$header=""){
		
		if ($this->mode == "Edit") {
			
			@unlink($this->path.$filename);
			$this->filename = $header."_".date("Y_m_d_H_i_s").".html";
			js3_setPathForReady($this->path);
			$fp = fopen($this->path.$this->filename, 'w');
			fwrite($fp, $data);
			fclose($fp);
			return $this->filename;
			
		}else{
			
			$this->filename = $filename."_".date("Y_m_d_H_i_s").".html";
			js3_setPathForReady($this->path);
			$fp = fopen($this->path.$this->filename, 'w');
			fwrite($fp, $data);
			fclose($fp);
			return $this->filename;
			
		}
		
	}
	
	function getFile($filename){
		
		if (file_exists($this->path.$filename)) {
			$data = php_readfile($this->path.$filename);
		}else{
			$data = $filename;
		}
		
		return php_decode_html2($data);
	}
		
}
?>