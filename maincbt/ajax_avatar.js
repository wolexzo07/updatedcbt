
function avat(){
var xmlhttp = new XMLHttpRequest();
if(window.XMLHttpRequest){

xmlhttp = new XMLHttpRequest();

}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

}
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

document.getElementById("avatar").style.display="block";
document.getElementById("avatar").innerHTML=xmlhttp.responseText;
document.getElementById("avatar").style.border="0px";

}



}
var file = document.getElementById("file_uploader");

var formData = new FormData();

formData.append("upload" , file.files[0]);


var url = "avatar.php";

xmlhttp.open("POST",url , true);
xmlhttp.setRequestHeader("Content-Type" , "multipart/form-data");
xmlhttp.send(formData);

}
