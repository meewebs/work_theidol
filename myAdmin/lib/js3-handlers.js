
var js3_loadingstack = 0;
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function js3_getHtmlByPost(myurl,myvars,updateto) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	js3_loadingstack++;
	if(js3_loadingstack==1) {
		js3_loadingHandler.style.display='';
		js3_loadingHandler.effect('opacity').custom(0,1);
	}
	new ajax(myurl,{ method: 'post', postBody: myvars, onComplete: js3_getHtml_onComplete, update: updateto}).request();

}
//#######################################
function js3_getHtmlByGet(myurl,myvars,updateto) {
//#######################################
	js3_loadingstack++;
	if(js3_loadingstack==1) {
		js3_loadingHandler.style.display='';
		js3_loadingHandler.effect('opacity').custom(0,1);
	}
	new ajax(myurl+"?"+myvars,{ method: 'get', onComplete: js3_getHtml_onComplete, update: updateto}).request();
}
//#######################################
function js3_getHtml_onComplete() {
//#######################################
	js3_loadingstack--;
	if(js3_loadingstack<=0) {
		js3_loadingHandler.effect('opacity').custom(1,0);
	}
}

//#######################################
function js3_getHtmlByPost_Effect(myurl,myvars,updateto,divObj) {
//#######################################
	js3_loadingstack++;
	if(js3_loadingstack==1) {
		js3_loadingHandler.style.display='';
		js3_loadingHandler.effect('opacity').custom(0,1);
	}
	var slidereffect = new Fx.Slide(divObj, {mode: 'vertical', duration: 1500, transition:Fx.Transitions.bounceOut, wait: true }).show();
	slidereffect.toggle();
	new ajax(myurl,{ method: 'post', postBody: myvars, onComplete: function() { js3_getHtml_onComplete_Effect(slidereffect); } , update: updateto}).request();
}
//#######################################
function js3_getHtmlByGet_Effect(myurl,myvars,updateto,divObj) {
//#######################################
	js3_loadingstack++;
	if(js3_loadingstack==1) {
		js3_loadingHandler.style.display='';
		js3_loadingHandler.effect('opacity').custom(0,1);
	}
	var slidereffect = new Fx.Slide(divObj, {mode: 'vertical', duration: 1500, transition:Fx.Transitions.bounceOut, wait: true }).show();
	slidereffect.toggle();
	new ajax(myurl+"?"+myvars,{ method: 'get', onComplete: function() { js3_getHtml_onComplete_Effect(slidereffect); } , update: updateto}).request();
}
//#######################################
function js3_getHtml_onComplete_Effect(slidereffect) {
//#######################################
	js3_loadingstack--;
	if(js3_loadingstack<=0) {
		js3_loadingHandler.effect('opacity').custom(1,0);
	}
	slidereffect.toggle();
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function JS3_ChainObject() {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  AJAX Chain handle Object 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	this.fnlist = [];
	//http://localhost/akin_Engine/object/obj_ecard/obj_something_browser.php?id=&menu_id=7
	this.fntype = [];
	this.addChain_AJAX = function (fn) {  
		this.fnlist.push(fn);
		this.fntype.push('AJAX');		
	}
	this.addChain_Function = function (fn) {  
		this.fnlist.push(fn);
		this.fntype.push('Function');		
	}
	this.callChain = function () {
		if(this.fnlist.length) {
			this.fnlist.splice(0, 1)[0].call();
			if(this.fntype.splice(0, 1)[0]=='Function') {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function js3_callAJAXChain() {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	while(js3_chain.callChain());
}
var js3_chain = new JS3_ChainObject();


// # Prompt Function #############################################################################
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function JS3_Prompt() {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	this.close = function () {
		this.box.close();
		// show all select object
		var elements = $A(document.getElementsByTagName('object'));
		elements.extend(document.getElementsByTagName(window.ActiveXObject ? 'select' : 'embed'));
		elements.each(function(el){ el.style.visibility = ''; });
		mod_ajax_Scrollbar('enable'); // à¾ÔèÁâ´Â Pu ÊÓËÃÑº à»Ô´»Ô´ Scroll Bar ·ÓãËé Pompbox äÁèàÅ×èÍ¹ä»ÁÒ
	};
	this.show = function (wd,hi,content) {
		var elements = $A(document.getElementsByTagName('object'));
		elements.extend(document.getElementsByTagName(window.ActiveXObject ? 'select' : 'embed'));
		elements.each(function(el){ el.style.visibility = 'hidden'; });

		// create box
		js3_prompt_iframe_targetname = "ifname"+Math.floor(Math.random()*10000);
		this.box = new MooPrompt('myPrompt', content , js3_prompt_iframe_targetname , { buttons: 0, width: wd, height: hi });
	}; 
}
var js3_promptBox = new JS3_Prompt();
var js3_promptOnOpen = false;
var js3_prompt_iframe_targetname;

//=== µÃÇ¨ÊÍº¤ÇÒÁá¢ç§áÃ§¢Í§ÃËÑÊ¼èÒ¹
function passwordChanged(id,pass) {
//=============================
	var strength = document.getElementById(id);
	var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
	var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	var enoughRegex = new RegExp("(?=.{6,}).*", "g");
	var pwd = document.getElementById(pass);
	if (pwd.value.length==0) {
	strength.innerHTML = "¡ÃØ³Ò¾ÔÁ¾ìÃËÑÊ¼èÒ¹";
	} else if (false == enoughRegex.test(pwd.value)) {
	strength.innerHTML = "¾ÔÁ¾ìÃËÑÊ¼èÒ¹ÍÂèÒ§¹éÍÂ 6 µÑÇÍÑ¡ÉÃ";
	} else if (strongRegex.test(pwd.value)) {
	strength.innerHTML = "<span style='color:green'>ÂÍ´àÂÕèÂÁ!</span>";
	} else if (mediumRegex.test(pwd.value)) {
	strength.innerHTML = "<span style='color:orange'>»Ò¹¡ÅÒ§!</span>";
	} else {
	strength.innerHTML = "<span style='color:red'>¹éÍÂ!</span>";
	}
/**/
}

function CheckNumericKeyInfo($char, $mozChar) {
 if($mozChar != null) { // Look for a Mozilla-compatible browser
 if(($mozChar >= 48 && $mozChar <= 57) || $mozChar == 0 || $char == 8 || $mozChar == 13) $RetVal = true;
 else {
 $RetVal = false;
// alert('Please enter a numeric value.');
 }
 }
 else { // Must be an IE-compatible Browser
 if(($char >= 48 && $char <= 57) || $char == 13) $RetVal = true;
 else {
 $RetVal = false;
 //alert('Please enter a numeric value.');
 }
 }
 return $RetVal;
 }

 function CheckNumericKeyInfo_dot($char, $mozChar) {
 if($mozChar != null) { // Look for a Mozilla-compatible browser
 if(($mozChar >= 48 && $mozChar <= 57) || $mozChar == 0 || $char == 8 || $mozChar == 13 || $mozChar == 46) $RetVal = true;
 else {
 $RetVal = false;
// alert('Please enter a numeric value.');
 }
 }
 else { // Must be an IE-compatible Browser
 if(($char >= 48 && $char <= 57) || $char == 13  || $char == 46) $RetVal = true;
 else {
 $RetVal = false;
 //alert('Please enter a numeric value.');
 }
 }
 return $RetVal;
 }

function CheckNumericKeyInfo_NoHome($char, $mozChar) {
	 if($mozChar != null) { // Look for a Mozilla-compatible browser
	 if(($mozChar >= 48 && $mozChar <= 57) || $mozChar == 0 || $char == 8 || $mozChar == 13 || $mozChar == 47) $RetVal = true;
	 else {
	 $RetVal = false;
	// alert('Please enter a numeric value.');
	 }
	 }
	 else { // Must be an IE-compatible Browser
	 if(($char >= 48 && $char <= 57) || $char == 13  || $char == 47) $RetVal = true;
	 else {
	 $RetVal = false;
	 //alert('Please enter a numeric value.');
	 }
	 }
	 return $RetVal;
}

function CheckNumericKeyInfo_NumberAndText($char, $mozChar) {
	//alert($mozChar);
	 if($mozChar != null) { // Look for a Mozilla-compatible browser
	 if(($mozChar >= 33 && $mozChar <= 44) || ($mozChar >= 58 && $mozChar <= 63)  || ($mozChar >= 95 && $mozChar <= 60) || ($mozChar >= 123 && $mozChar <= 146)) $RetVal = false;
	 else {
	 $RetVal = true;
	// alert('Please enter a numeric value.');
	 }
	 }
	 else { // Must be an IE-compatible Browser
	 if(($mozChar >= 33 && $mozChar <= 44) || ($mozChar >= 58 && $mozChar <= 63)  || ($mozChar >= 95 && $mozChar <= 60) || ($mozChar >= 123 && $mozChar <= 146)) $RetVal = false;
	 else {
	 $RetVal = true;
	 //alert('Please enter a numeric value.');
	 }
	 }
	 return $RetVal;
}


function CheckNumericKeyDomain($char, $mozChar) {
 if($mozChar != null) { // Look for a Mozilla-compatible browser
 if(($mozChar >= 48 && $mozChar <= 57) || ($mozChar >=97 && $mozChar <= 122 ) || $mozChar == 45 || $mozChar == 0 || $char == 8 || $mozChar == 13) $RetVal = true;
 else {
 $RetVal = false;
 }
 }
 else { // Must be an IE-compatible Browser
 if(($char >= 48 && $char <= 57) || ($char >=97 && $char <= 122 ) || $char == 45 || $char == 13) $RetVal = true;
 else {
 $RetVal = false;
 }
 }
 return $RetVal;
 }

function numbersonly(){
    var c=allEve(e).key;
    // do something with c;
	alert(c);
	 if (c<48||c>57)
	  return false;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function mod_ajax_SortingMoveUp(myListObj) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	var Len = $(myListObj).options.length;
	var tmpID,tmpValue;
	if(Len>0) 
	{
		for(var i=1;i<Len;i++)
		{
	    	if ($(myListObj).options[i]!=null && $(myListObj).options[i].selected==true) {
					if(!$(myListObj).options[i-1].selected) {
					   $(myListObj).options[i].selected=false;
					   tmpID = $(myListObj).options[i].value;
					   tmpValue = $(myListObj).options[i].text;
					   $(myListObj).options[i].value = $(myListObj).options[i-1].value;
					   $(myListObj).options[i].text = $(myListObj).options[i-1].text;
					   $(myListObj).options[i-1].value = tmpID;
					   $(myListObj).options[i-1].text = tmpValue;
					   $(myListObj).options[i-1].selected=true;
				}
			}
		}
	}
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function mod_ajax_SortingMoveDown(myListObj) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	var Len = $(myListObj).options.length;
	var tmpID,tmpValue;
	if(Len>0) 
	{
		for(var i=Len-2;i>=0;i--)
		{
	    	if ($(myListObj).options[i]!=null && $(myListObj).options[i].selected==true) {
					if(!$(myListObj).options[i+1].selected) {
					   $(myListObj).options[i].selected=false;
					   tmpID = $(myListObj).options[i].value;
					   tmpValue = $(myListObj).options[i].text;
					   $(myListObj).options[i].value = $(myListObj).options[i+1].value;
					   $(myListObj).options[i].text = $(myListObj).options[i+1].text;
					   $(myListObj).options[i+1].value = tmpID;
					   $(myListObj).options[i+1].text = tmpValue;
					   $(myListObj).options[i+1].selected=true;
				}
			}
		}
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function mod_ajax_SelectAllSorting(myListObj) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	var Len = $(myListObj).options.length;
	if(Len>0) 
	{
		for(var i=0;i<Len;i++) { 
		   $(myListObj).options[i].selected=true;
		}
	}
}

function CheckSubmitFrom($char, $mozChar) {
 if($mozChar != null) { // Look for a Mozilla-compatible browser
	 if($mozChar == 13) $RetVal = true;
	 else {
	 $RetVal = false;
	 }
 }
 else { // Must be an IE-compatible Browser
	 if($char == 13) $RetVal = true;
	 else {
	 $RetVal = false;
	 }
 }
 return $RetVal;
 }


//=== µÃÇ¨ÊÍº¤ÇÒÁ¶Ù¡µéÍ§¢Í§ email =====
function emailCheck(obj) {
//===============================
txt = obj.value;
if (txt.indexOf("@")<3){
	alert('รูปแบบอีเมล์ไม่ถูกต้อง กรุณาระบุอีเมล์ใหม่');
	obj.value = "";
	obj.focus();
	return false;
}
	return true;
}


function js_send_mail(email,id){ // count banner
	var js_vars = "&action=send_mail&email="+email+"&id="+id;
	new ajax("index_form.php",{ method: 'post', postBody: js_vars, onComplete: function(responseText) { 
		if(responseText.trim()=='OK') {
			alert("receive e-mail "+email+" Complete");
		}else if(responseText.trim() == 'Have_Email'){
			alert("E-mail : "+email+" is register !");
		}else {
			alert("Error ! Can't receive e-mail : "+email);
		}
	} }).request();
	/**/
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
function js_loadAction2Prompt(js3_filename,mywidth,myheight,id) {
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	if(js3_promptOnOpen || js3_loadingstack>0) { // checking for js3_prompt is open or not
		return false;
	} else {
		js3_promptOnOpen = true;
		mod_ajax_Scrollbar('disable');  // «èÍ¹ Scroll Bar

		// loading blank prompt
		js3_chain.addChain_Function(function() { 
				
				if (navigator.appVersion.indexOf("MSIE") != -1){
					var padding = 470;
					myheight += 350;
				}else{
					
					var padding = 0;
				}
				js3_promptBox.show(mywidth,myheight,"<div  id=\"area_show_data\" style=\"padding-top:"+padding+";\"><div style='background-color:#FFFFFF;width:80px; height:20px;' align='center'><img src=\"../images/load/load001.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" onClick=\"js3_promptBox.close(); \" style=\"cursor:pointer\" /> Loading...</div></div>");
		});
		// loading html form xxx-ajax-form.php
		js3_chain.addChain_AJAX(function() {  
				var js_vars = "&id="+id+"";
				js3_getHtmlByPost(js3_filename,js_vars,'area_show_data');
				//alert($('area_show_data'));
		});
		//js3_callAJAXChain();
		//return true;
	}
}

function mod_ajax_Scrollbar(status)
{
	if(status=='disable')
	{
		document.body.style.overflow='hidden';
		document.documentElement.style.overflow='hidden';
	}
	else{
		document.body.style.overflow='';
		document.documentElement.style.overflow='';
	}
}

function js_repeat_data(){
   //alert(123);
	if(js3_promptOnOpen) {
		var content = $('idTemp').innerHTML;
		$('idTemp').innerHTML='';
		$('promptContentData').innerHTML= content;
	}
	$('idTemp').style.display='none';

}

function printpr(){
		window.print();
}
