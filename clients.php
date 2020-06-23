<?php
	session_start();
	include ('connection.php');
	include ('sidemenu.php');

	//Base de Dados e Tabela client
	$qry = "SELECT * FROM client ORDER BY name ASC";
	$result = mysqli_query($conn, $qry);
	$AlertMsg = "";
	$typesession = $_SESSION['user_type'];

	//Alertas
	if (isset($_GET['alert'])) {
		if ($_GET['alert'] == 'Success') {
			$AlertMsg = "<div class = 'alert alert-success'>Novo cliente adicionado.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
		elseif ($_GET['alert'] == 'UpdateSuccess') {
			$AlertMsg = "<div class = 'alert alert-success'>Cliente atualizado com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
		elseif ($_GET['alert'] == 'Deleted') {
			$AlertMsg = "<div class = 'alert alert-success'>Cliente removido com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
	}
//mysqli_close($conn);
?>

<!--Corpo da página-->
<body class="dashboard">
<div class="main">
    <div class="text-center">
        <h1 class="jumbotron">Clientes</h1>
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
			<th>Email</th>
			<th>Notas</th>
			<!--Coluna Editar apenas para administradores-->
			<?php if ($typesession == "admin") { ?>
			<th>Editar</th> <?php }?>
		</tr>
    
	<?php
	
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['email'] . "</td><td>" . $row['notes'] . "</td>";
				//Botão Editar apenas para administradores
				if ($typesession == "admin") {
					echo '<td><a href="clientEdit.php?id=' . $row['id'] . ' "type="button" class="btn btn-primary btn-sm"><i style="font-size:15px" class="far fa-edit"></i> </a></td>';
				}		
			echo "</tr>";
		}
	}

	else {
		echo "<div class='alert alert-warning'>Ainda não há clientes registados.</div>";
	}

	mysqli_close($conn);
	?>
    
		<tr>
			<td colspan="7"><div class="text-center"><a href="clientAdd.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Novo Cliente</a></div></td>
		</tr>
	</table>
</div>
</div>
<?php include 'footer.php';?>
</body>

