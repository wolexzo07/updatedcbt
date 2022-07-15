
function logout_id(){
var xmlhttp;
if(window.XMLHttpRequest){

xmlhttp = new XMLHttpRequest();

}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

}
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

document.getElementById("log").style.display="block";
document.getElementById("log").innerHTML=xmlhttp.responseText;
document.getElementById("log").style.border="0px";

}



}
var url = "logit.php";

xmlhttp.open("GET",url ,true);
xmlhttp.send();

}



function log(){
setInterval("logout_id()" , 200);

}
log();






