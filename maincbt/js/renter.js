function renter(str){
if(str.length == 0){
document.getElementById("rent").style.display="none";
document.getElementById("rent").innerHTML=xmlhttp.responseText;
document.getElementById("rent").style.border="0px";
}
var xmlhttp;
if(window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

}
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
document.getElementById("rent").style.display="block";
document.getElementById("rent").innerHTML=xmlhttp.responseText;
document.getElementById("rent").style.border="0px";
}
}
var url = "renter?q=" + str ;
xmlhttp.open("GET",url ,true);
xmlhttp.send();
}