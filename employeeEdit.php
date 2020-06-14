<?php
session_start();

include ("function.php");
include ("connection.php");
include ('sidemenu.php');

$id= $_GET['id'];
$qry = "SELECT * FROM employee WHERE id = '$id'";
$result = mysqli_query($conn, $qry);
$AlertMSG="";

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
        $address = $row['address'];
        $type = $row['type'];
        $password = $row['password'];
	}
}
else {
	$AlertMSG = "<div class='alert alert-warning'>Página vazia<a href='employee.php'>Voltar</a></div> ";
}

if (isset($_POST['Update'])) {
	$name = ValidateFormData($_POST['name']);
	$phone = ValidateFormData($_POST['phone']);
	$email = ValidateFormData($_POST['email']);
    $address = ValidateFormData($_POST['address']);
    $type = ValidateFormData($_POST['type']);
    $password = ValidateFormData($_POST['password']);
	$qry = "UPDATE employee 
                    SET name     = '$name',
                        phone    = '$phone',
                        email    = '$email',
                        address    = '$address',
                        type    = '$type',
                        password    = '$password' WHERE id = '$id'";
	$result = mysqli_query($conn, $qry);
	if ($result) {
		header("Location: employee.php?alert=UpdateSuccess");
	}
	else {
		echo "Erro no registo: " . mysqli_error($conn);
	}
}

if (isset($_POST['Delete'])) {
	$AlertMSG = "<div class='alert alert-danger'> 
                    <p>Você tem certeza que deseja remover este funcionário?</p><br />
                    <form action ='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id' method='post' >
                        <input type = 'submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Sim, remover!'> 
                        <a href='employee.php' type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancelar!</a>
                    </form>    
        </div>";
}

if (isset($_POST['confirm-delete'])) {
	$qry = "DELETE FROM employee WHERE id = '$id'";
	$result = mysqli_query($conn, $qry);
	if ($result) {
		header("Location: employee.php?alert=Deleted");
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
            <h2 class="jumbotron">Editar Funcionário</h2>
            <!--<p>Resize this responsive page to see the effect!</p>--> 
        </div>
    
<?php
echo $AlertMSG; ?>
<form action="<?php
echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php
echo $id; ?>" method="post" class="row">
    <!--Name-->
    <div class="form-group col-sm-6">
        <label for="employee-name">Name</label>
        <input type="text" class="form-control input-lg" id="employee-name" name="name" value="<?php
echo $name; ?>">
    </div>
    <!--Phone-->
    <div class="form-group col-sm-6">
        <label for="employee-phone">Phone</label>
        <input type="text" class="form-control input-lg" id="employee-phone" name="phone" value="<?php
echo $phone; ?>">
    </div>
    <!--Email-->
    <div class="form-group col-sm-6">
        <label for="employee-email">Email</label>
        <input type="text" class="form-control input-lg" id="employee-email" name="email" value="<?php
echo $email; ?>">
    </div>
    <!--Address-->
    <div class="form-group col-sm-6">
        <label for="employee-address">Morada</label>
        <input type="text" class="form-control input-lg" id="employee-address" name="address" value="<?php
echo $address; ?>">
    </div>
    <!--Type-->
    <div class="form-group col-sm-6">
        <label for="employee-type">Tipo</label>
        <input type="text" class="form-control input-lg" id="employee-type" name="type" value="<?php
echo $type; ?>">
    </div>
        <!--password-->
        <div class="form-group col-sm-6">
        <label for="employee-password">Password</label>
        <input type="text" class="form-control input-lg" id="employee-password" name="password" value="<?php
echo $password; ?>">
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="Delete">Remover</button>
        <div class="pull-right">
            <a href="employee.php" type="button" class="btn btn-lg btn-default">Cancelar</a>
            <button type="submit" class="btn btn-lg btn-success" name="Update">Atualizar</button>
        </div>
    </div>
</form>
</div>
</body>
<?php
include ('footer.php');

?>