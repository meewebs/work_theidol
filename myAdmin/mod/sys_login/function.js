// JavaScript Document

function js_login($scope) {
	
 	$scope.submit = function() {
		
		$("#loadPage").show();
		//alert(123);
		var  dataString 	  = $("#myForm").serialize();
				dataString 	+= "&action=User_Login";
				$.ajax({
				type: "POST",
				url: "sys_login/index_form.php",
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(data);
					if(data == "OK"){
						
						/* cookie */
						var i_username 	= $("#txt_Username").val();
						var i_password 	= $("#txt_Password").val();
						//alert(i_password);
						var days=10; // กำหนดจำนวนวันที่ต้องการให้จำค่า  
						var date = new Date();  
						date.setTime(date.getTime()+(days*24*60*60*1000));  
						var expires = "; expires="+date.toGMTString();  
						document.cookie = "G_Username=" +i_username+ "; expires=" + expires + "; ";  
						document.cookie = "G_Password=" +i_password+ "; expires=" + expires + ";"; 
						/* cookie */
						
						window.location = "sys_load/";	
						
					}else{
						alert("ข้อมูลไม่ถูกต้องกรุณา login ใหม่");	
						$("#loadPage").hide();
						
						$("#txt_Username").val("");
						$("#txt_Password").val("");
						$("#txt_Username").focus();
					}

				}//end success
		 
		});
		
	}
	
}



function js_auto_login(i_username,i_password)
{
		$("#loadPage").show();
		//alert(123);
		var  dataString 	  = "&txt_Username="+i_username+"&txt_Password="+i_password+"&action=User_Login";
				$.ajax({
				type: "POST",
				url: "sys_login/index_form.php",
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(data);
					if(data == "OK"){
						/* cookie */
						//alert(i_password);
						var days 				=10; // กำหนดจำนวนวันที่ต้องการให้จำค่า  
						var date  				= new Date();  
						date.setTime(date.getTime()+(days*24*60*60*1000));  
						var expires = "; expires="+date.toGMTString();  
						document.cookie = "G_Username=" +i_username+ "; expires=" + expires + "; ";  
						document.cookie = "G_Password=" +i_password+ "; expires=" + expires + ";"; 
						/* cookie */
						window.location = "sys_load/";	
					}
					else
					{
						//alert(123);
						var i_username 	= "";
						var i_password 	= "";
						var days 				=10; // กำหนดจำนวนวันที่ต้องการให้จำค่า  
						var date  				= new Date();  
						date.setTime(date.getTime()-(days*24*60*60*1000));  
						var expires = "; expires="+date.toGMTString();  
						document.cookie = "G_Username=" +i_username+ "; expires=" + expires + "; ";  
						document.cookie = "G_Password=" +i_password+ "; expires=" + expires + ";"; 
						
						//window.location = "logout.php";	
					}

				}//end success
		 
		});
		$("#loadPage").hide();
}