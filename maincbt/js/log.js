
function getid(elem){
	document.getElementById(elem).value="";
	}	
	
function proform(formid,url_link,showid,extra){
$(formid).on('submit',(function(e) {
		$(showid).show("slow");
		e.preventDefault();
		$.ajax({
        	url: url_link,
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$(showid).html(data);
				extra;
		    },
		  	error: function(){} 	        
	   });
	}));
	}
function scroll_it(){
	$(".chatme").scrollTop($(".chatme")[0].scrollHeight);
	}
	function scroll_up(){
	$(".chatme").scrollTop(0);
	}

$(document).ready(function(e){
	$("#uploadForm").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "log_processor",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
		    },
		  	error: function(){} 	        
	   });
	}));
});
