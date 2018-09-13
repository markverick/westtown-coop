
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Data with Ajax and PHP</title>
</head>

<body>
    <textarea id="data">Enter some content here you want to save as a file</textarea>
    <button id="save" onclick="save();return false;">Save</button>
    <div id="response"></div>
<script>
function save(){
	var response=document.getElementById("response");
	var data = 'data='+document.getElementById("data").value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	    response.innerHTML='<a href="files/'+xmlhttp.responseText+'.txt">'+xmlhttp.responseText+'.txt</a>';
	  }
	}
	xmlhttp.open("POST","circulation_fan_speed_command.php",true);
        //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}
</script>
</body>
</html>
