<?php
session_start();

include ("connection.php");
include ("function.php");

$NameError="";
$PhoneError="";
$EmailError="";


if (isset($_POST['AddSupplier'])) {
    $name = $phone = $email = $product = "";
    

	if (!$_POST['name']) {
		$NameError = "Inserir nome do fornecedor <br />";
	}
	else {
		$name = ValidateFormData($_POST['name']);
	}

	if (!$_POST['phone']) {
		$PhoneError = "Inserir telemóvel do fornecedor <br />";
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
    $product = ValidateFormData($_POST['product']);
    

	if ($name && $phone) {
        $stmt = $conn->prepare("INSERT INTO `supplier`(`name`, `phone`, `email`, `product`) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $product);
        $stmt->execute();

		if ($stmt) {
			header("Location: supplier.php?alert=Success");
		}
		else {
			echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
        }
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
        <h2 class="jumbotron">Adicionar Fornecedor</h2>
        <!--<p>Resize this responsive page to see the effect!</p>--> 
    </div>

<form action="<?php
    echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row mr-0 ml-0">
        <div class="form-group col-sm-6 ">
            <label for="name" class="float-left">Nome *</label>
            <small class="ml-2 float-left text-danger"><?php
    echo $NameError; ?></small>
            <input type="text" class="form-control input-lg" id="name" name="name" value="">
        </div>
        <div class="form-group col-sm-6">
            <label for="phone" class="float-left">Telemóvel *</label>
            <small class="ml-2 float-left text-danger"><?php
    echo $PhoneError; ?></small>
            <input type="text" class="form-control input-lg" id="phone" name="phone" value="">
        </div>
        <div class="form-group col-sm-6">
                    <label for="email" class="float-left">Email</label>
                    <small class="ml-2 float-left text-danger"><?php 
            echo $EmailError; ?></small>
                    <input type="text" class="form-control input-lg" id="email" name="email" value="Inserir email...">
                </div>
        <!--Produtos-->
        <div class="form-group col-sm-6">
            <label for="product" class="float-left">Produtos</label>
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
        <div class="col-sm-12 mt-5">
                <button type="submit" class="btn btn-sm btn-success float-right ml-2" name="AddSupplier">Adicionar</button>
                <a href="supplier.php" type="button" class="btn btn-sm btn-secondary float-right">Cancelar</a>                
        </div>
</form>
</div>
</body>

<?php
include ('footer.php');

?>