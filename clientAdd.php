<?php
session_start();

include ("connection.php");
include ("function.php");
include ('sidemenu.php');

$NameError="";
$PhoneError="";
$EmailError="";
$name = $phone = $email = $notes = "";

if (isset($_POST['AddClient'])) {
	
	if (!$_POST['name']) {
		$NameError = "Inserir nome do cliente <br />";
	}
	else {
		$name = ValidateFormData($_POST['name']);
	}

	if (!$_POST['phone']) {
		$PhoneError = "Inserir telemóvel do cliente <br />";
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


    if ($_POST['email']) {
           if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $email = ValidateFormData($_POST['email']);
        }else
        {
            $EmailError = ' O email submetido é inválido! Tente novamente <br />';
        }
    } 
 
    $notes = ValidateFormData($_POST['notes']);

 
	if ($name && $phone) {
        $stmt = $conn->prepare("INSERT INTO `client`(`name`, `phone`, `email`, `notes`) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $notes);
        $stmt->execute();

		if ($stmt) {
			header("Location: clients.php?alert=Success");
		}
		else {
			echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
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
    echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row ml-0 mr-0">
    <!--Name-->
        <div class="form-group col-sm-6 ">
            <label for="name" class="float-left">Nome *</label>
            <small class="ml-2 float-left text-danger"><?php
    echo $NameError; ?></small>
            <input type="text" class="form-control input-lg" id="name" name="name" value="">
        </div>
    <!--Telemóvel-->
        <div class="form-group col-sm-6">
            <label for="phone" class="float-left">Telemóvel *</label>
            <small class="ml-2 float-left text-danger"><?php
    echo $PhoneError; ?></small>
            <input type="text" class="form-control input-lg" id="phone" name="phone" value="">
        </div>
    <!--Email-->
    <div class="form-group col-sm-6">
                    <label for="email" class="float-left">Email</label>
                    <small class="ml-2 float-left text-danger"><?php 
            echo $EmailError; ?></small>
                    <input type="text" class="form-control input-lg" id="email" name="email" value="Inserir email...">
                </div>
    <!--Notes-->
        <div class="form-group col-sm-6">
            <label for="notes" class="float-left">Notas</label>
            <input type="text" class="form-control input-lg" id="notes" name="notes">
        </div>
        <div class="col-sm-12 mt-5">
                <button type="submit" class="btn btn-sm btn-success float-right ml-2" name="AddClient">Adicionar</button>
                <a href="clients.php" type="button" class="btn btn-sm btn-secondary float-right">Cancelar</a>                
        </div>
</form>
</div>
</body>

<?php
include ('footer.php');

?>




