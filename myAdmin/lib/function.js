// JavaScript Document

function js_load_page(taget , file , action){
	//alert(action);
	$("#loadPage").show();
	taget.load(file+"?"+action, function(response, status, xhr) {
	  if (status == "error") {
		var msg = "Sorry but there was an error: ";
		taget.html(msg + xhr.status + " " + xhr.statusText);
	  }
	  
	  $("#loadPage").hide();  
		  
	});	
	
}


function js_main_search(area , source , variable){
	$("#loadPage").show();
	var  dataString 	  = $("#dataForm").serialize();
			dataString 	+= variable;
				$.ajax({
				type: "POST",
				url: source,
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(data);
					js_load_page(area , source , dataString)
				}//end success
		 
	});
	
}


function js_main_sorting(area , source){
	
	var  dataString 	  = $("#dataForm").serialize();
			dataString 	+= "&action=Sorting";
			
			//alert(dataString);
			$.ajax({
			type: "POST",
			url: source,
			data: dataString,
			dataType: "html",
			success: function(data) {
				//alert(data);
				alert("Save order complete");
				//js_load_page($("#area_panel") , source , "action=View&"+variable);
			}//end success
	 
	});
	
}


function js_main_delete(source , variable){

	var  dataString = "action=Delete&"+variable;
			$.ajax({
			type: "POST",
			url: source,
			data: dataString,
			dataType: "html",
			success: function(data) {
				js_load_page($("#area_panel") , source , "action=View&"+variable);
			}//end success
	 
	});
	
}


function js_main_delete_all(source , variable){
    
	var all_colum = document.getElementById("txt_colum").value;
	var status = false;
	for(var i = 0; i<all_colum;i++){
			if(document.getElementById("txt_no_"+i).checked == true){
				status = true;
				break;
			}
	}
	
	if(status == true){
		
		var  dataString 	  = $("#dataForm").serialize();
				dataString 	+= "&action=DeleteAll";
				
				//alert(dataString);
				$.ajax({
				type: "POST",
				url: source,
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(data);
					js_load_page($("#area_panel") , source , "action=View&"+variable);
				}//end success
		 
		});
		
	}else{
		alert('Please select file to delete');
	}
	
}


function js_main_enable(obj , source , variable){
	
	var statusArray = ["Enable","Disable"];
	var nextStatus = '';
	
	// find nextStatus
	for(i=0;i<statusArray.length;i++) {
		if(statusArray[i]==obj.innerHTML) {
			if(i+1==statusArray.length) {
				nextStatus = statusArray[0];
			} else {
				nextStatus = statusArray[i+1];
			}
			break;
		}
	}
	
	//alert(nextStatus+source);
	var  dataString = "action=enableDisable&nextStatus="+nextStatus+"&"+variable;
			$.ajax({
			type: "POST",
			url: source,
			data: dataString,
			dataType: "html",
			success: function(data) {
				data = jQuery.trim(data);
				//alert(data);
				if(data == "OK"){
					js_load_page($("#area_panel") , source , "action=View&"+variable);
				}else{
					alert("ระบบไม่สามารถเปลี่ยนสถานะได้ค่ะ");	
				}
			}//end success
	 
	});
	
}


function js_main_select_all(obj){
	var all_colum = $("#txt_colum").val();
	//alert(obj.checked);
	if(obj.checked == true){
		var status = true;
	}else{
		var status = false;	
	}
	for(var i = 0; i<all_colum;i++){
		document.getElementById("txt_no_"+i).checked = status;
	}
		
}


function js_main_showHome(obj , source , variable){
	
	var statusArray = ["Show","Hide"];
	var nextStatus = '';
	
	// find nextStatus
	for(i=0;i<statusArray.length;i++) {
		if(statusArray[i]==obj.innerHTML) {
			if(i+1==statusArray.length) {
				nextStatus = statusArray[0];
			} else {
				nextStatus = statusArray[i+1];
			}
			break;
		}
	}
	
	//alert(nextStatus+source);
	var  dataString = "action=ShowHide&nextStatus="+nextStatus+"&"+variable;
			$.ajax({
			type: "POST",
			url: source,
			data: dataString,
			dataType: "html",
			success: function(data) {
				data = jQuery.trim(data);
				//alert(data);
				if(data == "OK"){
					js_load_page($("#area_panel") , source , "action=View&"+variable);
				}else{
					alert("ระบบไม่สามารถเปลี่ยนสถานะได้ค่ะ");	
				}
			}//end success
	 
	});
	
}


function js_main_select_all(obj){
	var all_colum = $("#txt_colum").val();
	//alert(obj.checked);
	if(obj.checked == true){
		var status = true;
	}else{
		var status = false;	
	}
	for(var i = 0; i<all_colum;i++){
		document.getElementById("txt_no_"+i).checked = status;
	}
		
}


function js_change_page(obj , source , variable){
	
	//alert(obj.value);
	var  dataString = "action=ChangePage&page="+obj.value;
			$.ajax({
			type: "POST",
			url: "../sys_load/index_form.php",
			data: dataString,
			dataType: "html",
			success: function(data) {
				data = jQuery.trim(data);
				//alert(data);
				if(data == "OK"){
					js_load_page($("#area_panel") , source , variable);
				}else{
					alert("ระบบไม่สามารถเปลี่ยนสถานะได้ค่ะ");	
				}
			}//end success
	 
	});
	
}


function js_refresh_menu(){
	js_load_page($("#area_menu") ,"../sys_menu/index_menu.php" , "action=Menu");
}


function js_return_login(){
	window.location = "../index.php";	
}

function js_return_parent_login(){
	window.parent.location = "../../index.php";	
}