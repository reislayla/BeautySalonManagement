<?php
session_start();

include ("connection.php");
include ("function.php");
include ('sidemenu.php');

$NameError="";
$PhoneError="";
$EmailError="";

if (isset($_POST['AddClient'])) {
	$name = $phone = $email = $notes = "";
	if (!$_POST['name']) {
		$NameError = "Inserir nome do cliente <br />";
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
        $qry = "INSERT INTO `client`(`id`, `name`, `phone`, `email`, `notes`) VALUES (NULL, '$name', '$phone', '$email', '$notes')";
        //query com o time e data de adição do cliente
        //$qry = "INSERT INTO `client`(`id`, `name`, `phone`, `email`, `notes`) VALUES (NULL, '$name', '$phone', '$email', '$notes', CURRENT_TIMESTAMP)";
		$result = mysqli_query($conn, $qry);
		if ($result) {
			header("Location: clients.php?alert=Success");
		}
		else {
			echo "Error: " . $qry . "<br />" . mysqli_error($conn);
		}
	}
}

mysqli_close($conn);
?>

<body class="dashboard">
<!--Menu lateral-->
<div class="main">
    <div class="text-center">
        <h2 class="jumbotron">Adicionar Cliente</h2>
        <!--<p>Resize this responsive page to see the effect!</p>--> 
    </div>

<form action="<?php
    echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
        <div class="form-group col-sm-6 ">
            <label for="name" class="pull-left">Name *</label>
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
                <a href="clients.php" type="button" class="btn btn-lg btn-default pull-left">Cancelar</a>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="AddClient">Adicionar</button>
        </div>
</form>
</div>
</body>

<?php
include ('footer.php');

?>




