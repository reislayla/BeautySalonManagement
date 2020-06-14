<?php
session_start();

include ("connection.php");
include ("function.php");

$NameError="";
$PhoneError="";
$EmailError="";

if (isset($_POST['AddSupplier'])) {
	$name = $phone = $email = $notes = "";
	if (!$_POST['name']) {
		$NameError = "Inserir nome do fornecedor <br />";
	}
	else {
		$name = ValidateFormData($_POST['name']);
	}

	if (!$_POST['phone']) {
		$PhoneError = "Inserir telefone do cliente <br />";
	}
	else {

        $re = '/^(9[1236]\d{7}|2\d{8})$/';
        if(preg_match($re, trim($_REQUEST['phone'])) == 0)
        {
            $PhoneError = "Número inválido <br />";
        }
        
        else{
            $phone = ValidateFormData($_POST['phone']);
        }
		
	}
    
    //Validar email
    //$erro = ['email' => ''];
    //$var = false;

    if ($_POST['email']) {
        $email = $_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $email = ValidateFormData($_POST['email']);
            //$var = true;
        }else
        {
            $EmailError = 'O email submetido é inválido! Tente novamente <br />';
        }
    } 

    //$email = ValidateFormData($_POST['email']);
    $notes = ValidateFormData($_POST['notes']);
    

	if ($name && $phone) {
        $qry = "INSERT INTO `supplier`(`id`, `name`, `phone`, `email`, `notes`) VALUES (NULL, '$name', '$phone', '$email', '$notes')";
        //query com o time e data de adição do fornecedor
        //$qry = "INSERT INTO `supplier`(`id`, `name`, `phone`, `email`, `notes`) VALUES (NULL, '$name', '$phone', '$email', '$notes', CURRENT_TIMESTAMP)";
		$result = mysqli_query($conn, $qry);
		if ($result) {
			header("Location: supplier.php?alert=Success");
		}
		else {
			echo "Error: " . $qry . "<br />" . mysqli_error($conn);
		}
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
        <h2 class="jumbotron">Adicionar Fornecedor</h2>
        <!--<p>Resize this responsive page to see the effect!</p>--> 
    </div>

<form action="<?php
    echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
        <div class="form-group col-sm-6 ">
            <label for="name" class="pull-left">Nome *</label>
            <small class="pull-right"><?php
    echo $NameError; ?></small>
            <input type="text" class="form-control input-lg" id="name" name="name" value="">
        </div>
        <div class="form-group col-sm-6">
            <label for="phone" class="pull-left">Telemóvel *</label>
            <small class="pull-right"><?php
    echo $PhoneError; ?></small>
            <input type="text" class="form-control input-lg" id="phone" name="phone" value="">
        </div>
        <div class="form-group col-sm-6">
            <label for="email" class="pull-left">Email</label>
            <small class="pull-right"><?php 
    echo $EmailError; ?></small>
            <input type="text" class="form-control input-lg" id="email" name="email" value="">
        </div>
        <div class="form-group col-sm-6">
            <label for="notes" class="pull-left">Notes</label>
            <textarea type="text" class="form-control input-lg" id="notes" name="notes"></textarea>
        </div>
        <div class="col-sm-12">
                <a href="supplier.php" type="button" class="btn btn-lg btn-default pull-left">Cancelar</a>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="AddSupplier">Adicionar</button>
        </div>
</form>
</div>
</body>

<?php
include ('footer.php');

?>