// JavaScript Document

function js_Save($scope) {
	
 	$scope.submit = function() {
		
		var my_url = "../sys_permission/index_form.php";
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


function js_onoff(menu , status , id){
	
	if(menu == "main"){
		if(id){
			$("#txt_Mainstatus_"+id).val(status);
			
			if(status == "on"){
				$("#bnt_on_"+id).removeClass("btn-default");
				$("#bnt_on_"+id).addClass("btn-success");
				
				$("#bnt_off_"+id).removeClass("btn-danger");
				$("#bnt_off_"+id).addClass("btn-default");
			}else{
				
				$("#bnt_on_"+id).removeClass("btn-success");
				$("#bnt_on_"+id).addClass("btn-default");
				
				$("#bnt_off_"+id).removeClass("btn-default");
				$("#bnt_off_"+id).addClass("btn-danger");
				
			}
		}
	
	}else if(menu == "sub"){
		if(id){
			$("#txt_Substatus_"+id).val(status);
			
			if(status == "on"){
				$("#bnt_sub_on_"+id).removeClass("btn-default");
				$("#bnt_sub_on_"+id).addClass("btn-success");
				
				$("#bnt_sub_off_"+id).removeClass("btn-danger");
				$("#bnt_sub_off_"+id).addClass("btn-default");
			}else{
				
				$("#bnt_sub_on_"+id).removeClass("btn-success");
				$("#bnt_sub_on_"+id).addClass("btn-default");
				
				$("#bnt_sub_off_"+id).removeClass("btn-default");
				$("#bnt_sub_off_"+id).addClass("btn-danger");
				
			}
		}
	}
	
}