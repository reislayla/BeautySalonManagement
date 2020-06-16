<?php
	session_start();
	include ('connection.php');
	include ('sidemenu.php');

	//Base de Dados e Tabela client
	$qry = "SELECT * FROM employee ORDER BY name ASC";
	$result = mysqli_query($conn, $qry);
	$AlertMsg = "";
	$typesession = $_SESSION['user_type'];

	//Alertas
	if (isset($_GET['alert'])) {
		if ($_GET['alert'] == 'Success') {
			$AlertMsg = "<div class = 'alert alert-success'>Funcionário adicionado.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
		elseif ($_GET['alert'] == 'UpdateSuccess') {
			$AlertMsg = "<div class = 'alert alert-success'>Funcionário atualizado com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
		elseif ($_GET['alert'] == 'Deleted') {
			$AlertMsg = "<div class = 'alert alert-success'>Funcionário removido com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
	}
//mysqli_close($conn);
?>

<!--Corpo da página-->
<body class="dashboard">
<div class="main">
    <div class="text-center">
        <h1 class="jumbotron">Funcionários</h1>
        <!--<p>Resize this responsive page to see the effect!</p>--> 
    </div>
<!--Mensagem-->
<?php echo $AlertMsg; ?>
<!--Tabela de Clientes-->
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover mb-5">
		<tr>
			<th>Nome</th>
			<th>Telefone</th>
			<!--Colunas apenas para administradores-->
			<?php if ($typesession == "admin") { ?>
			<th>Email</th>
            <th>Morada</th>
            <th>Tipo</th>
			<th>Editar</th> <?php }?>
		</tr>
    
    <?php
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td><td>" . $row['phone'] . "</td>"; if ($typesession == "admin") { echo "<td>" . $row['email'] . "</td><td>" . $row['address'] . "</td><td>" . $row['type'];
			echo '<td><a href="employeeEdit.php?id=' . $row['id'] . ' "type="button" class="btn btn-primary btn-sm"><i style="font-size:15px" class="far fa-edit"></i> </a></td>'; }
			echo "</tr>";
		}
	}

	else {
		echo "<div class='alert alert-warning'>Ainda não há funcionários registados.</div>";
	}

	mysqli_close($conn);
		
	//Adicionar funcionários apenas para administradores
		if ($typesession == "admin") { ?>
		<tr>
			<td colspan="7"><div class="text-center"><a href="employeeAdd.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Novo Funcionário</a></div></td>
		</tr> <?php } ?>
	</table>
</div>
	<div class="push"></div>
</div>
<?php include 'footer.php';?>
</body>

