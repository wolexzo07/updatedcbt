function current_timer(){
setInterval("timer_count()" , 200);

}



current_timer();


function forward(){

var ips = document.getElementById("next").href;
var  ty = document.getElementById("quest_type").value;
var loc = "m_process?loc="+ips;
if(ty == "subjective"){
$("#datareader").attr("action",loc);
$("#datareader").submit();

}
else{
window.location = ips;

}


}


function backward(){
var ipp = document.getElementById("last").href;
var ty = document.getElementById("quest_type").value;
var loc = "m_process?loc="+ipp;
if(ty == "subjective"){
$("#datareader").attr("action",loc);
$("#datareader").submit();

}
else{
window.location = ipp;

}


}
