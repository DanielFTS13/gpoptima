<?php require_once('euqZYnmTGOAo.php') ?>
<?php 
$continente=$_POST['continente'];
if (!isset($_POST['modelo'])) {
	$modelo = 0;
}else{
	$modelo = $_POST['modelo'];
}

	$sql="SELECT ID_MODELO,
			 ID_MARCA,
			 MODELO 
		from modelos 
		where ID_MARCA='$continente'";

	$result=mysqli_query($conn,$sql);

	$cadena="<label class='form-label'>Modelo</label> 
			<select class='form-control' id='modelo' name='modelo'>";

	while ($ver=mysqli_fetch_row($result)) {
		$select = "";
		if ($ver[0] == $modelo) {
			$select = "selected";
		}
		$cadena=$cadena.'<option '.$select.' value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";
	

?>