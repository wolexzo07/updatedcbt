
function result(str){
var xmlhttp;
if(window.XMLHttpRequest){

xmlhttp = new XMLHttpRequest();

}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

}
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

document.getElementById("search").style.display="block";
document.getElementById("search").innerHTML=xmlhttp.responseText;
document.getElementById("search").style.border="0px";

}



}
var url = "submitajax.php?opt=" + str + "&id=" + escape(document.getElementById("id").value) + "&tokken=" + escape(document.getElementById("tok").value) + "&subject=" + escape(document.getElementById("subjec").value) + "&typing=" + escape(document.getElementById("typet").value)+ "&emailer=" + escape(document.getElementById("emailed").value);

xmlhttp.open("GET",url ,true);
xmlhttp.send();

}




