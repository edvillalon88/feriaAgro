//para recojer los datos del url
function gup( name ){
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp ( regexS );
	var tmpURL = window.location.href;
	var results = regex.exec( tmpURL );
	if( results == null )
		return"";
	else
		return results[1];
}


function sizeUpdate(){
		var y = $(window).height()-140-($("footer").height());
		$("#main section").css("min-height",y+"px");
		
		}

function detectPantalla(){
		if($(window).width() > 1540){
			return("pc");
			}
		if($(window).width() < 1540 && $(window).width() > 661){
			return("tablet");
			}
		if($(window).width() < 661){
			return("movil");
		}
	}

