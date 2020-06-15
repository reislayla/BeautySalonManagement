<?php 

include "connection.php";

 // dados de registo - nome, email, pass, repetir pass
 $productName = "";

 //ligacao com o botão submit
 if(isset($_POST['prod_user'])){ 

  //variaveis recebem os valores inseridos no formulario 
  $productName = mysqli_real_escape_string($conn, $_POST['productName']);

  //query para inserir na base de dados
  $query = "INSERT INTO `product` (`category`) 
        VALUES('$productName')";
  $result= mysqli_query($conn, $query);
    if ($result) {
        header("Location: supplier.php?alert=ProductSuccess");
    }
    else {
        echo "Error: " . $qry . "<br />" . mysqli_error($conn);
    }
}

?>