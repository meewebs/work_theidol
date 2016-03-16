// JavaScript Document

function js_Save($scope) {
	
 	$scope.submit = function() {
		
		var my_url = "../sys_menu/index_form.php";
		$("#loadPage").show();
		var  dataString 	  = $("#myForm").serialize();
				dataString 	+= "&action=SaveAdd";
				$.ajax({
				type: "POST",
				url: my_url,
				data: dataString,
				dataType: "html",
				success: function(data) {
					data = jQuery.trim(data);
					//alert(data);
					if(data == "OK"){
						js_load_page($("#area_input"),my_url,"action=OK");
					}else{
						js_load_page($("#area_input"),my_url,"action=Fail");
					}
					js_refresh_menu();
					
				}//end success
		 
		});
		
	}
	
}


function js_SaveSub($scope) {
	
 	$scope.submit = function() {
		
		var my_url = "../sys_menu/index_form.php";
		$("#loadPage").show();
		var  dataString 	  = $("#myForm").serialize();
				dataString 	+= "&action=SaveAddSub";
				$.ajax({
				type: "POST",
				url: my_url,
				data: dataString,
				dataType: "html",
				success: function(data) {
					data = jQuery.trim(data);
					//alert(data);
					if(data == "OK"){
						js_load_page($("#area_input"),my_url,"action=OK");
					}else{
						js_load_page($("#area_input"),my_url,"action=Fail");
					}
					js_refresh_menu();
					
				}//end success
		 
		});
		
	}
	
}



function load_mod(source){
		var  dataString = "dir="+name+"&action=SelectIcon";
			$.ajax({
			type: "POST",
			url: source,
			data: dataString,
			dataType: "html",
			success: function(data) {
				
				$("#area_file").html(data);	
					
			}//end success
	 
		});
}


function js_select_icon(file){
	
	$("#txt_Icon").val(file);
	$("#icon_show").html("<i class='"+file+"'></i>");
	$('#myModal').modal('hide');
	
}

function js_select_mod(id , name){
	$("#txt_Modhide").val(id);
	$("#txt_Mod").val(name);
	$('#myModule').modal('hide');
}


function js_delete_sub(source , variable){
	
	var  dataString = "action=DeleteSub&"+variable;
			$.ajax({
			type: "POST",
			url: source,
			data: dataString,
			dataType: "html",
			success: function(data) {
				js_load_page($("#area_panel") , source , "action=View&"+variable);
				js_refresh_menu();
			}//end success
	 
	});
	
}


function js_enable_sub(obj , source , variable){
	
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
	var  dataString = "action=enableDisableSub&nextStatus="+nextStatus+"&"+variable;
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
					js_refresh_menu();
				}else{
					alert("ระบบไม่สามารถเปลี่ยนสถานะได้ค่ะ");	
				}
			}//end success
	 
	});
	
}

function js_check_order(source){
	
	var column = [];
	$('ol#main_order li').each(function(i){
		column[i] = $(this).attr('rel');
	});
	
	//alert(column);
	
	var row 			= column.length;
	var newdata 	= [];
	var j 				= 0;
	for(var i=0;i<row;i++){
		
		if(column[i]){
			newdata[j++] = column[i]; 
		}
	}
	
	var data 	= [];
	row			= newdata.length;
	returns 	= "";
	for(i=0;i<row;i++){
		j		= 0;
		m 		= newdata[i];
		data = [];
		
		$('ol#sub_'+m+' li').each(function(j){
			data[j] = $(this).attr('id');
		});
		
		returns += m+"|"+data+":";

	}
	
	
	//alert(returns);
	var  dataString = "action=Sorting&txt_Order="+returns;
		$.ajax({
		type: "POST",
		url: source,
		data: dataString,
		dataType: "html",
		success: function(data) {
			data = jQuery.trim(data);
			alert("Order menu complete");
			js_refresh_menu();
			
		}//end success
	 
	});
	
	//alert(newdata);
		
}