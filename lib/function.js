function js_clip(id)
{
	//alert(id);
	$("#area_content").html("");
	$("#area_content").load("../vote/index_vote.php?id="+id);
	$("#vote_popup").show();
}



function js_like_photo(page,row,data){
	//alert(row+"="+data);
	
	$("#loadPage").show();
	var 	dataString = data;		
			$.ajax({
				type: "GET",
				url: "../vote/data_form.php",
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(data);
					data = jQuery.trim(data);
					
					arr_data = data.split("|");
					
					if(data == "EndTime"){
						alert('หมดเวลาการร่วมโหวตแล้วค่ะ');
						
					}else if(data == "False"){
						alert('ระบบขัดข้อง กรุณารอซักครู่ค่ะ');
						
					}else if(data=="FalseTime"){
						alert('ท่านทำการโหวตภาพนี้ไปแล้วค่ะ');
						
					}else if(data=="FalseVote"){
						alert('ท่านทำการโหวตครบ 3 ภาพแล้วค่ะ');
						
					}else if(data=="Voted"){
						alert('ท่านทำการโหวตภาพนี้ไปแล้ว สามารถโหวตได้ใหม่ในวันต่อไปค่ะ');
						
					}else if(data=="FalseFacebook"){
						//alert('เนื่องจาก facebook ยังไม่ส่งค่า ID ของคุณเข้าสู่ระบบในขณะนี้ค่ะ กรุณาคลิกตกลงเพื่อกดโหวดรูปภาพใหม่อีกครั้งค่ะ');
						alert('กรุณาล๊อคอิน facebook ก่อนค่ะ');
						$("#vote_popup").hide();
						$("#connect_facebook").show();
						//parent.window.location = '../facebook_login.php';
						//window.location = '#'+page+'?id='+row;
					}else if(arr_data[1] =="FALSE_EMAIL"){
						//document.getElementById("area_like_"+row).innerHTML 		= arr_data[0];
					}else if(arr_data[1] =="OK"){
						//alert(arr_data[0]);
						$("#area_like_"+row).html(arr_data[0]);	
						//$(".popup_thankyou").show();
					}else if(data == "Hacking"){
						alert("ระบบไม่รับคะแนน เนื่องจากผู้ใช้งานกำลังเล่นเกมส์ผิดกฎอยู่ !");	
					}
					
					$("#loadPage").hide();
					
				
				}//end success
			 
		});
}

function js_share_photo(page,row,data,status){
	
	$("#loadPage").show();
	
	var 	dataString 	 = data;		
			$.ajax({
				type: "POST",
				url: "../vote/data_form.php",
				data: dataString,
				dataType: "html",
				success: function(data) {
					//alert(data);
					data = jQuery.trim(data);
					
					arr_data = data.split("|");
						
					if(data == "False"){
						alert('ระบบขัดข้อง กรุณารอซักครู่ค่ะ');
						
					}else if(data=="FalseTime"){
						alert('สามารถโหวตได้อีกครั้งในวันพรุ่งนี้ค่ะ');
						
					}else if(data=="FalseFacebook"){
						alert('เนื่องจาก facebook ยังไม่ส่งค่า ID ของคุณเข้าสู่ระบบในขณะนี้ค่ะ กรุณาคลิกตกลง เพื่อกด Like รูปภาพใหม่อีกครั้งค่ะ');
						window.location = '#'+page+'?id='+row;
					}else if(arr_data[1] =="OK"){
						//alert("แชร์ข้อความเรียบร้อยแล้วค่ะ");
						$(".popup_share").show();
						
					}
					
					
					$("#loadPage").hide();
					
					if(status == "close"){
						parent.$.colorbox.close();
						parent.window.location = "#gallery";	
					}
				
				}//end success
			 
		});
}