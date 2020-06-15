<?php
session_start();

include ("connection.php");
include ("function.php");

$NameError="";
$PhoneError="";
$EmailError="";


if (isset($_POST['AddClient'])) {
    $name = $phone = $email = $product = "";
    

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
    $product = ValidateFormData($_POST['product']);
    

	if ($name && $phone) {

            //Query da tabela supplier 
            $qry = "INSERT INTO `supplier`(`id`, `name`, `phone`, `email`, `product`) VALUES (NULL, '$name', '$phone', '$email', '$product')";
            //query com o time e data de adição do fornecedor
            //$qry = "INSERT INTO `supplier`(`id`, `name`, `phone`, `email`, `notes`) VALUES (NULL, '$name', '$phone', '$email', '$product', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                header("Location: supplier.php?alert=Success");
            }
            else {
                echo "Error: " . $qry . "<br />" . mysqli_error($conn);
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
                    <input type="text" class="form-control input-lg" id="email" name="email" value="Inserir email...">
                </div>
        <!--Produtos-->
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
        <div class="col-sm-12 mt-5">
                <a href="supplier.php" type="button" class="btn btn-lg btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="AddClient">Adicionar</button>
        </div>
</form>
</div>
</body>

<?php
include ('footer.php');

?>