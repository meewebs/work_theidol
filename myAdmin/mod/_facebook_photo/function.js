// JavaScript Document

function js_Save($scope) {
	
 	$scope.submit = function() {
		
		var my_url 			= this_page;
		var oEditor 			= FCKeditorAPI.GetInstance('txt_Subject');
		var my_subject	= oEditor.GetXHTML(true) ;
		$("#subject").val(my_subject);

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
					$("#txt_Subject").val('').empty();
					$("#subject").val('').empty();
					if(data == "OK"){
						js_load_page($("#area_input"),my_url,"action=OK&"+$("#myForm").serialize());
					}else{
						js_load_page($("#area_input"),my_url,"action=Fail&"+$("#myForm").serialize());
					}
					
				}//end success
		 
		});
		
	}
	
}