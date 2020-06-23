<?php 

include "connection.php";

 // dados de registo - nome, email, pass, repetir pass
 $productName = "";

 //ligacao com o botão submit
 if(isset($_POST['prod_user'])){ 

  //variaveis recebem os valores inseridos no formulario 
  $productName = mysqli_real_escape_string($conn, $_POST['productName']);

  //query para inserir na base de dados
    $stmt = $conn->prepare( "INSERT INTO `product`(`category` ) VALUES (?)");
    $stmt->bind_param("s", $productName);
    $stmt->execute();

    if ($stmt) {
        header("Location: supplier.php?alert=SuccessProd");
    }
    else {
        echo "Error: " . $stmt . "<br />" . mysqli_error($conn);
    }
}

?>

