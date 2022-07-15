function current_timer(){
setInterval("timer_count()" , 200);

}



current_timer();




function forward(){

var ips = document.getElementById("next").href;
var  ty = document.getElementById("quest_type").value;
if(ty == "subjective"){
document.forms["datareader"].submit();
window.location = ips;

}
else{
window.location = ips;

}


}


function backward(){
var ipp = document.getElementById("last").href;
var ty = document.getElementById("quest_type").value;
if(ty == "subjective"){
document.forms["datareader"].submit();
window.location = ipp;

}
else{
window.location = ipp;

}


}
