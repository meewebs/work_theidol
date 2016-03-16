// JavaScript Document
function js_language(lang){
	
	if(lang){
		
		$("#loadPage").show();
		var  dataString 	  = $("#dataForm").serialize();
		        dataString 	  += "&lang="+lang+"&action=change_lang";
				//alert(dataString);
				$.ajax({
				type: "POST",
				url: "index_form.php",
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(this_page);
					if(this_page){
						js_load_page($("#area_panel") , this_page , $("#dataForm").serialize());
						js_refresh_menu();
					}else{
						window.location = "index.php";
					}

				}//end success
		 
		});
		
	}
	
}