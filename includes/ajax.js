function createAjax(){
	if(window.ActiveXObject){
		try{
			return new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
	}
	else if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
}

var xmlhttp = createAjax();
function sendRequest(halaman, parameter, konten, komponen){
	var obj = window.document.getElementById(konten);
	obj.innerHTML = "<table border='0' width='100%'><tr><td align='center' valign='middle'><img src='images/loader.gif' width='24' height='24' style='border:0px groove #fff;' /></td></tr></table>";
	if(xmlhttp.readyState==4 || xmlhttp.readyState==0){
		xmlhttp.open('POST', halaman, true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				if(komponen=='div') obj.innerHTML=parseScript(xmlhttp.responseText);
				else obj.value=parseScript(xmlhttp.responseText);
			}
		}
		xmlhttp.send(parameter);
	}
}

function ajaxCustom(halaman, parameter, konten){
	var obj = window.document.getElementById(konten);
	obj.innerHTML = "";
	if(xmlhttp.readyState==4 || xmlhttp.readyState==0){
		xmlhttp.open('POST', halaman, true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				obj.innerHTML=parseScript(xmlhttp.responseText);
			}
		}
		xmlhttp.send(parameter);
	}
}

function parseScript(_source){
		var source = _source;
		var scripts = new Array();
		
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
 
			scripts.push(source.substring(s_e+1, e));
			source = source.substring(0, s) + source.substring(e_e+1);
		}
 
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
			}
			catch(ex) {
				// do what you want here when a script fails
			}
		}
		// Return the cleaned source
		return source;
}

function onlyNumbers(evt) { 
	var charCode = (evt.which) ? evt.which : event.keyCode; 
	if (charCode > 31 && (charCode < 48 || charCode > 57)) 
		return false; 
	return true; 
}

/**function sendRequest(File, Parameter, Direction, x){
	$.ajax({
		type:"POST",
		url:File,
		data:Parameter,
		success: function(msg){
			if(msg == 'error'){
				$('#'+Direction).html('Page not found 404');
			}else{
				$('#'+Direction).html(msg);
			}
		}
	}).fail(function(){
		$('#'+Direction).html('Page not found');
	});
}

$(document).ready(function(){
	$('[ajax-ready]').click(function(){
		var index = $("[ajax-ready]").index(this);
		
		var direction	= $('[ajax-ready]').eq(index).attr('ajax-direction');
		var parameter	= $('[ajax-ready]').eq(index).attr('ajax-data');
		
		var data			= parameter.split('&');
		var dataModule		= data[0].split('=');
		var dataComponent	= data[1].split('=');
		
		// localStorage.setItem('lastname', 'Smith');
		localStorage['direction'] 	= direction;
		localStorage['module'] 		= dataModule[1];
		localStorage['component'] 	= dataComponent[1];
		
		// localStorage.removeItem('lastname');

		sendRequest('content.php', parameter, direction, '');
	});
	
	sendRequest('content.php', 'module=' + localStorage.getItem('module') + '&component=' + localStorage.getItem('component'), localStorage.getItem('direction'), '');
});*/