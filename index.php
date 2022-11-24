<?php require_once('euqZYnmTGOAo.php') ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  }

?>
<?php
	
  //Obtenemos el ID del Cliente
  $colname_idCliente = "";
  if (isset($_GET['idCliente'])) {
  	$colname_idCliente = $_GET['idCliente'];
  }

  //Listamos los autos
  $queryAutos = "SELECT * FROM autos";
  $stmtAutos = mysqli_query($conn, $queryAutos);
  $stmtAutosEd = mysqli_query($conn, $queryAutos);

  //Listamos los clientes y hacemos join a los autos y modelos
  $queryClientes = "SELECT * FROM clientes LEFT JOIN autos ON clientes.ID_MARCA = autos.ID_AUTO LEFT JOIN modelos ON clientes.ID_MODELO = modelos.ID_MODELO ORDER BY ID_CLIENTE ASC";
  $stmtClientes = mysqli_query($conn, $queryClientes);

  //Extraemos el Cliente para Editara
  $queryCliente = "SELECT * FROM clientes WHERE ID_CLIENTE = '$colname_idCliente'";
  $stmtCliente = mysqli_query($conn, $queryCliente);
  $row_ClienteByID = mysqli_fetch_assoc($stmtCliente);

  //Asignamos valor al idModel
  if (empty($colname_idCliente)) {
  	$idModel = 0;
  }else{
  	$idModel = $row_ClienteByID['ID_MODELO'];
  }

  //Añadimos al Cliente
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_cliente")) {
  	$name = $_POST['name'];
  	$edad = $_POST['edad'];
  	$phone = $_POST['phone'];
  	$email = $_POST['email'];
  	$marca = $_POST['auto'];
  	$modelo = $_POST['modelo'];
  	$FECHA_ACTUAL = date("Y-m-d H:i:s");

  	$insertCliente = "INSERT INTO clientes (NOMBRE, EDAD, TELEFONO, EMAIL, ID_MARCA, ID_MODELO, CREATE_RECORD) VALUES ('$name', '$edad', '$phone', '$email', '$marca', '$modelo', '$FECHA_ACTUAL')";

  	if (mysqli_query($conn, $insertCliente)) {
  		header('Location: index.php');
  	}else{
  		echo "Error: ".$insertCliente. "<br>" . mysqli_error($conn);
  	}

  }
  
  //Modificamos al cliente
  if ((isset($_POST["MM_edit"])) && ($_POST["MM_edit"] == "edit_cliente")) {
  	$name = $_POST['name'];
  	$edad = $_POST['edad'];
  	$phone = $_POST['phone'];
  	$email = $_POST['email'];
  	$marca = $_POST['autoE'];
  	$modelo = $_POST['modelo'];

  	$updateCliente = "UPDATE clientes SET NOMBRE = '$name', EDAD = '$edad', TELEFONO = '$phone', EMAIL = '$email', ID_MARCA = '$marca', ID_MODELO = '$modelo' WHERE ID_CLIENTE = '$colname_idCliente'";

  	if (mysqli_query($conn, $updateCliente)) {
  		header('Location: index.php');
  	}else{
  		echo "Error: ".$updateCliente. "<br>" . mysqli_error($conn);
  	}

  }

  //Eliminamos a cliente por ID
  if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "deleteCliente")) {
  	$idCliente = $_POST['idCliente'];
  	$deleteCliente = "DELETE FROM clientes WHERE ID_CLIENTE = '$idCliente'";

  	if (mysqli_query($conn, $deleteCliente)) {
  		header('Location: index.php');
  	}else{
  		echo "Error: ".$deleteCliente. "<br>" . mysqli_error($conn);
  	}

  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grupo Optima</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="container mt-4 mb-4">
		<h1>Autos de interés</h1>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
  			Launch demo modal
		</button>
		<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="POST" action="<?php echo $editFormAction; ?>">
        	<div class="row">
        		<div class="col-12 col-md-10 mb-3">
        			<label class="form-label">Nombre Completo</label>
        			<input minlength="5" required class="form-control" type="text" name="name">
        		</div>
        		<div class="col-12 col-md-2 mb-3">
        			<label class="form-label">Edad</label>
        			<input minlength="2" required class="form-control" type="text" name="edad">
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<label class="form-label">Numero de teléfono</label>
        			<input minlength="10" required class="form-control" type="text" name="phone">
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<label class="form-label">Correo Electrónico</label>
        			<input required class="form-control" type="email" name="email">
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<label class="form-label">Seleccione una Marca</label>
        			<select id="auto" class="form-control" name="auto">
        				<?php while($row_Auto = mysqli_fetch_assoc($stmtAutos)){ ?>
        					<option value="<?php echo $row_Auto['ID_AUTO']; ?>"><?php echo $row_Auto['MARCA']; ?></option>
        				<?php } ?> ?>
        			</select>
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<div id="select2lista"></div>
        		</div>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear</button>
        <input type="hidden" name="MM_insert" value="add_cliente">
        </form>
      </div>
    </div>
  </div>
</div>
		<hr>
		<table name="tbl-contact" id="tbl-contact" class="table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Auto de Interés</th>
                    <th>Modelo de Interés</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                	<?php while($row_Cliente = mysqli_fetch_assoc($stmtClientes)){ ?>
                    	<tr>
                    		<td><?php echo $row_Cliente['NOMBRE']; ?></td>
                    		<td><?php echo $row_Cliente['EDAD']; ?></td>
                    		<td><?php echo $row_Cliente['TELEFONO']; ?></td>
                    		<td><?php echo $row_Cliente['EMAIL']; ?></td>
                    		<td><?php echo $row_Cliente['MARCA']; ?></td>
                    		<td><?php echo $row_Cliente['MODELO']; ?></td>
                    		<td class="text-center"> <a class="btn btn-warning" href="index.php?idCliente=<?php echo $row_Cliente['ID_CLIENTE']; ?>"><i class="fa-solid fa-pen-to-square"></i></a> </td>
                    		<td class="text-center" > <form class="form-group" method="POST" action="<?php echo $editFormAction; ?>"><button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> <input type="hidden" name="MM_delete" value="deleteCliente"> <input type="hidden" name="idCliente" value="<?php echo $row_Cliente['ID_CLIENTE']; ?>"> </form> </td>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
	</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
        <?php if (!empty($colname_idCliente)) { ?>
		<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="POST" action="<?php echo $editFormAction; ?>">
        	<div class="row">
        		<div class="col-12 col-md-10 mb-3">
        			<label class="form-label">Nombre Completo</label>
        			<input minlength="5" required class="form-control" type="text" name="name" value="<?php echo $row_ClienteByID['NOMBRE']; ?>">
        		</div>
        		<div class="col-12 col-md-2 mb-3">
        			<label class="form-label">Edad</label>
        			<input minlength="2" required class="form-control" type="text" name="edad" value="<?php echo $row_ClienteByID['EDAD']; ?>">
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<label class="form-label">Numero de teléfono</label>
        			<input minlength="10" required class="form-control" type="text" name="phone" value="<?php echo $row_ClienteByID['TELEFONO']; ?>">
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<label class="form-label">Correo Electrónico</label>
        			<input required class="form-control" type="email" name="email" value="<?php echo $row_ClienteByID['EMAIL']; ?>">
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<label class="form-label">Seleccione una Marca</label>
        			<select id="autoE" class="form-control" name="autoE">
        				<?php while($row_AutoEd = mysqli_fetch_assoc($stmtAutosEd)){ ?>
        					<option <?php if ($row_AutoEd['ID_AUTO'] == $row_ClienteByID['ID_MARCA']) {
        						echo "selected";
        					}else{echo "none";} ?> value="<?php echo $row_AutoEd['ID_AUTO']; ?>"><?php echo $row_AutoEd['MARCA']; ?></option>
        				<?php } ?>
        			</select>
        		</div>
        		<div class="col-12 col-md-6 mb-3">
        			<div id="select3lista"></div>
        		</div>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <input type="hidden" name="MM_edit" value="edit_cliente">
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
document.onreadystatechange = function () {
  var myModal = document.getElementById('staticBackdrop');
  var modal = bootstrap.Modal.getOrCreateInstance(myModal)
  modal.show()
};
</script>
<?php } ?>
<script>
      $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tbl-contact thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tbl-contact thead');
 
    var table = $('#tbl-contact').DataTable({
        "dom": 'Blfrtip',
                "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
                "scrollX": true,
                "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                "pagingType": "numbers",
                "processing": true,
                order: [[2, 'asc']],
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
    </script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#auto').val(1);
		recargarLista();

		$('#auto').change(function(){
			recargarLista();
		});
	})

	$(document).ready(function(){
		$('#autoE').val(<?php echo $row_ClienteByID['ID_MARCA'] ?>);
		recargarLista2();

		$('#autoE').change(function(){
			recargarLista2();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"datos.php",
			data:"continente=" + $('#auto').val(),
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}

	function recargarLista2(){
		$.ajax({
			type:"POST",
			url:"datos.php",
			data:{"continente": $('#autoE').val(), "modelo": <?php echo $idModel; ?>},
			success:function(r){
				$('#select3lista').html(r);
			}
		});
	}
</script>