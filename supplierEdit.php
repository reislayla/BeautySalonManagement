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
		//$product = $row['product'];
	}
}
else {
	$AlertMSG = "<div class='alert alert-warning'>Página vazia<a href='supplier.php'>Voltar</a></div> ";
}

if (isset($_POST['Update'])) {
	$name = ValidateFormData($_POST['name']);
	$phone = ValidateFormData($_POST['phone']);
	$email = ValidateFormData($_POST['email']);
	$product = ValidateFormData($_POST['product']);
	$qry = "UPDATE supplier 
                    SET name     = '$name',
                        phone    = '$phone',
                        email    = '$email',
                        product    = '$product' WHERE id = '$id'";
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

//mysqli_close($conn);
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
echo $id; ?>" method="post" class="row mr-0 ml-0">
    <div class="form-group col-sm-6">
        <label for="supplier-name">Name</label>
        <input type="text" class="form-control input-lg" id="supplier-name" name="name" value="<?php
echo $name; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="supplier-phone">Telemóvel</label>
        <input type="text" class="form-control input-lg" id="supplier-phone" name="phone" value="<?php
echo $phone; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="supplier-email">Email</label>
        <input type="text" class="form-control input-lg" id="supplier-email" name="email" value="<?php
echo $email; ?>">
    </div>

    <div class="form-group col-sm-6">
            <label for="product" class="pull-left">Produtos</label>
            <div id="select">
            <select class="form-control input-lg" id="product" name="product">
                <option value=""> Selecione a categoria... </option>
                <?php
                    $records = mysqli_query($conn, "SELECT category From product");

                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['category'] ."'>" .$data['category'] ."</option>";  // displaying data in option menu
                    }                    
                    ?>  
            </select>
            </div>
            <!--?php mysqli_close($conn); ?>-->
        </div>    
        
        <div class="col-sm-12 mt-5 mb-3">
        <button type="submit" class="btn btn-sm btn-danger float-left" name="Delete">Remover</button>
        <button type="submit" class="btn btn-sm btn-success float-right ml-2" name="Update">Atualizar</button>
        <a href="supplier.php" type="button" class="btn btn-sm btn-secondary float-right">Cancelar</a>
        <br><hr>
    </div>
    <?php echo $product; ?>
    </div>-->
</form>
</div>
</body>
<?php
include ('footer.php');

?>
