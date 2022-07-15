shortcut.add("Alt+4",function() {
var answer = window.confirm("Are you sure you want to check your result now?");
if(answer){
window.location = "result_p.php";
return true;
}else{
return false;
}

})

shortcut.add("Alt+N",function() {
forward()

})

shortcut.add("Alt+P",function() {
backward()

})

shortcut.add("Alt+L",function() {


var answer = window.confirm("Are you sure you want to logout?");
if(answer){
window.location = "logout.php";
return true;
}else{
return false;
}

})


shortcut.add("Alt+H",function() {

$(document).ready(function(){
$("#scor").slideUp("slow");
$("#student_help").toggle("slow");

})


})


shortcut.add("Alt+1",function() {

$(document).ready(function(){
$("#scor").slideUp("slow");
$("#instru").toggle("slower");
$(".exam_ins , .per_user , .exam_ass , .exam_pr").show("slower");
})


})


shortcut.add("Alt+2",function() {

$(document).ready(function(){
$("#scor").slideUp("slow");
$("#perso_pro").toggle("slow");

})


})



shortcut.add("Alt+3",function() {

$(document).ready(function(){
$("#scor").slideUp("slow");
$("#student_score").toggle("slow");
$(".exam_ins , .per_user , .exam_ass , .exam_pr").show("slower");
})


})

document.onkeydown = function (e) {
	        if(e.which == "65"){
				
			
					$(":radio.a").attr("checked","checked");
					result("a");
					
	

	        }
	        else if(e.which == "66"){
				
					$(":radio.b").attr("checked","checked");
					result("b");
					
				
				}
				else if(e.which == "67"){
				
					$(":radio.c").attr("checked","checked");
					result("c");
				
					
					}
					
					else if(e.which == "68"){
				
					$(":radio.d").attr("checked","checked");
					
					result("d");
					
		
						
						}
						else{
							return true;
							
							}
	}

function shu(){


var answer = window.confirm("Are you sure you want to logout?");
if(answer){
window.location = "logout.php";
return true;
}else{
return false;
}
}

