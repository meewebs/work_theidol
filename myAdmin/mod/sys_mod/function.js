// JavaScript Document

function js_Save($scope) {
	
 	$scope.submit = function() {
		
		var my_url = "../sys_mod/index_form.php";
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
					
				}//end success
		 
		});
		
	}
	
}


function load_mod(source){
		var  dataString = "dir="+name+"&action=SelectMod";
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


function file_list( name , source){
		var  dataString = "dir="+name+"&action=SelectFile";
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

function select_Items(file){
	
	$("#txt_Mod").val(file);
	$('#myModal').modal('hide');
	
}