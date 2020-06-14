<?php
session_start();

include ("function.php");
include ("connection.php");

$id= $_GET['id'];
$qry = "SELECT * FROM supplier WHERE id = '$id'";
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
	$AlertMSG = "<div class='alert alert-warning'>Página vazia<a href='supplier.php'>Voltar</a></div> ";
}

if (isset($_POST['Update'])) {
	$name = ValidateFormData($_POST['name']);
	$phone = ValidateFormData($_POST['phone']);
	$email = ValidateFormData($_POST['email']);
	$notes = ValidateFormData($_POST['notes']);
	$qry = "UPDATE supplier 
                    SET name     = '$name',
                        phone    = '$phone',
                        email    = '$email',
                        notes    = '$notes' WHERE id = '$id'";
	$result = mysqli_query($conn, $qry);
	if ($result) {
		header("Location: supplier.php?alert=UpdateSuccess");
	}
	else {
		echo "Erro no registo: " . mysqli_error($conn);
	}
}

if (isset($_POST['Delete'])) {
	$AlertMSG = "<div class='alert alert-danger'> 
                    <p>Você tem certeza que deseja remover este fornecedor?</p><br />
                    <form action ='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id' method='post' >
                        <input type = 'submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Sim, remover!'> 
                            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancelar!</a>
                    </form>    
        </div>";
}

if (isset($_POST['confirm-delete'])) {
	$qry = "DELETE FROM supplier WHERE id = '$id'";
	$result = mysqli_query($conn, $qry);
	if ($result) {
		header("Location: supplier.php?alert=Deleted");
	}
	else {
		echo "Erro na atualização: " . mysqli_error($Connection);
	}
}

mysqli_close($conn);
include ('sidemenu.php');

?>
<body class="dashboard">
<!--Menu lateral-->
    <div>
    <?php include "sidemenu.php" ?> 
    </div>

<div class="main">
    <div class="text-center">
        <h2 class="jumbotron">Editar Fornecedor</h2>
        <!--<p>Resize this responsive page to see the effect!</p>--> 
    </div>
    
<?php
echo $AlertMSG; ?>
<form action="<?php
echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php
echo $id; ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="supplier-name">Name</label>
        <input type="text" class="form-control input-lg" id="supplier-name" name="name" value="<?php
echo $name; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="supplier-phone">Phone</label>
        <input type="text" class="form-control input-lg" id="supplier-phone" name="phone" value="<?php
echo $phone; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="supplier-email">Email</label>
        <input type="text" class="form-control input-lg" id="supplier-email" name="email" value="<?php
echo $email; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="supplier-notes">Notes</label>
        <textarea type="text" class="form-control input-lg" id="supplier-notes" name="notes"><?php
echo $notes; ?></textarea>
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="Delete">Remover</button>
        <div class="pull-right">
            <a href="supplier.php" type="button" class="btn btn-lg btn-default">Cancelar</a>
            <button type="submit" class="btn btn-lg btn-success" name="Update">Atualizar</button>
        </div>
    </div>
</form>
</div>
</body>
<?php
include ('footer.php');

?>
