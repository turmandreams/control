<?php

$a=$_REQUEST["a"];

$db = mysqli_connect("turmandreams.mysql", "turmandreams","jugandoando@2","turmandreams");

$estado=0;

if($a=="0") {

	$consulta="select * from control where id=1";
	 //echo $consulta;
    
	$datos=mysqli_query($db,$consulta);

	while($registro = mysqli_fetch_assoc($datos)) {
		$estado=$registro["estado"];
		break;
	}
	
	echo "@".$estado."@";
	
	$consulta="update control set estado=0 where id=1";
	$datos=mysqli_query($db,$consulta);

	
}else{
	
	$consulta="update control set estado=".$a." where id=1";
	$datos=mysqli_query($db,$consulta);
	echo "OK";

}else {

?>

<html>
<script type="text/javascript">

var wi=window;

function get(dato){
	
	
	if(wi.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
	else{xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');}

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.responseText!='' && xmlhttp.readyState==4 && xmlhttp.status==200){	
			var datos=xmlhttp.responseText;	
			//alert(datos);
		}else if(xmlhttp.status==404){alert("FALLO COMUNICACION !!");}
	}


	var peticion='https://www.turmandreams.es/control/?a='+dato;

	//alert(peticion);

	xmlhttp.open('GET',peticion,true);
	xmlhttp.send();
	

}




</script>

<body bgcolor="#BBBBFF">
<center>
<table width="100%" height="100%">
<tr>
	<td width="33%" align="center"><td>
	<td width="33%" align="center"><table border=1><tr><td onclick="get(1);"><img width="200" height="200" src="arriba.png" /></td></tr></table><td>
	<td width="33%" align="center"><td>
<tr>
<tr>
	<td width="33%" align="center"><table border=1><tr><td onclick="get(2);"><img width="200" height="200" src="izquierda.png"/></td></tr></table><td>
	<td width="33%" align="center"><td>
	<td width="33%" align="center"><table border=1><tr><td onclick="get(3);"><img width="200" height="200" src="derecha.png"/></td></tr></table><td>
	
<tr>
<tr>
	<td width="33%" align="center"><td>
	<td width="33%" align="center"><table border=1><tr><td onclick="get(4);"><img width="200" height="200" src="abajo.png"/></td></tr></table><td>
	<td width="33%" align="center"><td>
<tr>

</table>
</center>
</body>
</html>

<?php

}

?>