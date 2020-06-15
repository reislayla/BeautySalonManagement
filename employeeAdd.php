
<?php
session_start();

include ("connection.php");
include ("function.php");
include ("sidemenu.php");

$NameError="";
$PhoneError="";
$EmailError="";

if (isset($_POST['AddEmployee'])) {
    $name = $phone = $email = $address = $type = $password = "";
    
    //name
	if (!$_POST['name']) {
		$NameError = "Inserir nome do funcionário <br />";
	}
	else {
		$name = ValidateFormData($_POST['name']);
    }
    
    //phone
	if (!$_POST['phone']) {
		$PhoneError = "Inserir telefone do cliente <br />";
	}
	else {

        //Validar número de telemóvel inserido, se for válido adicionar.
        $re = '/^(9[1236]\d{7}|2\d{8})$/';
        if(preg_match($re, trim($_REQUEST['phone'])) == 0)
        {
            $PhoneError = "Número inválido <br />";
        }
        
        else{
            $phone = ValidateFormData($_POST['phone']);
        }
		
	}

    if ($_POST['email']) {
        $email = $_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $email = ValidateFormData($_POST['email']);
        }else
        {
            $EmailError = 'O email submetido é inválido! Tente novamente <br />';
        }
    } 


    //Caso queira criar mensagens de erros para outras variáveis
    /*address
    if (!$_POST['address']) {
		$AddressError = "Inserir morada do funcionário <br />";
	}
	else {
		$address = ValidateFormData($_POST['address']);
    }    
    //type
    if (!$_POST['type']) {
		$typeError = "Inserir função do funcionário <br />";
	}
	else {
		$type = ValidateFormData($_POST['type']);
	}
    //date
    if (!$_POST['password']) {
		$DateError = "Inserir data de contratação do funcionário <br />";
	}
	else {
		$password = ValidateFormData($_POST['password']);
	}*/

    $address = ValidateFormData($_POST['address']);
    $type = ValidateFormData($_POST['type']);
    $password = ValidateFormData($_POST['password']);


	if ($name && $phone) {
        $qry = "INSERT INTO `employee`(`id`, `name`, `phone`, `email`, `address`, `type`, `password` ) VALUES (NULL, '$name', '$phone', '$email', '$address', '$type', '$password')";
        //query com o time e data de adição do cliente
        //$qry = "INSERT INTO `client`(`id`, `name`, `phone`, `email`, `notes`) VALUES (NULL, '$name', '$phone', '$email', '$notes', CURRENT_TIMESTAMP)";
		$result = mysqli_query($conn, $qry);
		if ($result) {
			header("Location: employee.php?alert=Success");
		}
		else {
			echo "Error: " . $qry . "<br />" . mysqli_error($conn);
		}
	}
}
mysqli_close($conn);
?>

<body class="dashboard">
    <div class="main">
        <div class="text-center">
            <h2 class="jumbotron">Adicionar Funcionário</h2>
            <!--<p>Resize this responsive page to see the effect!</p>--> 
        </div>
        <form action="<?php
            echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
            method="post" class="row ml-0 mr-0">
                <!--Name-->
                <div class="form-group col-sm-6 ">
                    <label for="name" class="pull-left">Name *</label>
                    <small class="pull-right"><?php
            echo $NameError; ?></small>
                    <input type="text" class="form-control input-lg" id="name" name="name" value="">
                </div>
                <!--Phone-->
                <div class="form-group col-sm-6">
                    <label for="phone" class="pull-left">Telemóvel *</label>
                    <small class="pull-right"><?php
            echo $PhoneError; ?></small>
                    <input type="text" class="form-control input-lg" id="phone" name="phone" value="">
                </div>
                <!--Email-->
                <div class="form-group col-sm-6">
                    <label for="email" class="pull-left">Email</label>
                    <small class="pull-right"><?php 
            echo $EmailError; ?></small>
                    <input type="text" class="form-control input-lg" id="email" name="email" value="Inserir email...">
                </div>
                <!--Address-->
                <div class="form-group col-sm-6">
                    <label for="address" class="pull-left">Morada</label>
                    <input type="text" class="form-control input-lg" id="address" name="address">
                </div>
                <!--type-->
                <div class="form-group col-sm-6">
                    <label for="type" class="pull-left">Tipo</label>
                    <input type="text" class="form-control input-lg" id="type" name="type">
                </div>
                <!--password-->
                <div class="form-group col-sm-6">
                    <label for="password" class="pull-left">Password</label>
                    <input type="password" class="form-control input-lg" id="password" name="password" value="">
                </div>
                <div class="col-sm-12 mt-5">
                <a href="clients.php" type="button" class="btn btn-lg btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="AddClient">Adicionar</button>
        </div>
        </form>
    </div>
</body>

<?php
include ('footer.php');

?>