<?php
session_start();

include ("function.php");
include ("connection.php");
include ('sidemenu.php');

$id= $_GET['id'];
$qry = "SELECT * FROM client WHERE id = '$id'";
$result = mysqli_query($conn, $qry);
$AlertMSG="";

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$notes = $row['notes'];
	}
}
else {
	$AlertMSG = "<div class='alert alert-warning'>Página vazia<a href='clients.php'>Voltar</a></div> ";
}

if (isset($_POST['Update'])) {
	$name = ValidateFormData($_POST['name']);
	$phone = ValidateFormData($_POST['phone']);
	$email = ValidateFormData($_POST['email']);
	$notes = ValidateFormData($_POST['notes']);
	$qry = "UPDATE client 
                    SET name     = '$name',
                        phone    = '$phone',
                        email    = '$email',
                        notes    = '$notes' WHERE id = '$id'";
	$result = mysqli_query($conn, $qry);
	if ($result) {
		header("Location: clients.php?alert=UpdateSuccess");
	}
	else {
		echo "Erro no registo: " . mysqli_error($conn);
	}
}

if (isset($_POST['Delete'])) {
	$AlertMSG = "<div class='alert alert-danger'> 
                    <p>Você tem certeza que deseja remover este cliente?</p><br />
                    <form action ='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id' method='post' >
                        <input type = 'submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Sim, remover!'> 
                            <a type='button' href='clients.php' class='btn btn-default btn-sm' data-dismiss='alert'>Cancelar!</a>
                    </form>    
        </div>";
}

if (isset($_POST['confirm-delete'])) {
	$qry = "DELETE FROM client WHERE id = '$id'";
	$result = mysqli_query($conn, $qry);
	if ($result) {
		header("Location: clients.php?alert=Deleted");
	}
	else {
		echo "Erro na atualização: " . mysqli_error($conn);
	}
}

mysqli_close($conn);
?>

<body class="dashboard">
<div class="main">
    <div class="text-center">
        <h2 class="jumbotron">Editar Cliente</h2>
        <!--<p>Resize this responsive page to see the effect!</p>--> 
    </div>
    
<?php
echo $AlertMSG; ?>
<form action="<?php
echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php
echo $id; ?>" method="post" class="row mr-0 ml-0">
    <div class="form-group col-sm-6">
        <label for="client-name" class="float-left">Nome *</label>
        <input type="text" class="form-control input-lg" id="client-name" name="name" value="<?php
echo $name; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-phone" class="float-left">Telemóvel *</label>
        <input type="text" class="form-control input-lg" id="client-phone" name="phone" value="<?php
echo $phone; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email" class="float-left">Email</label>
        <input type="text" class="form-control input-lg" id="client-email" name="email" value="<?php
echo $email; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-notes" class="float-left">Notas</label>
        <input type="text" class="form-control input-lg" id="client-notes" name="notes" value="<?php
echo $notes; ?>">
    </div>
    <div class="col-sm-12 mt-5 mb-5">
        <button type="submit" class="btn btn-sm btn-danger float-left" name="Delete">Remover</button>
        <button type="submit" class="btn btn-sm btn-success float-right ml-2" name="Update">Atualizar</button>
        <a href="clients.php" type="button" class="btn btn-sm btn-secondary float-right">Cancelar</a>
        <br><hr>
    </div>
</form>
</div>
</body>
<?php
include ('footer.php');

?>
