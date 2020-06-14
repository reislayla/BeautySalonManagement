<?php

//delete.php
//include "includes/connection.php";

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=salao', 'root', '');
 //Query para remover evento de acordo com o id da base de dados
 $query = "
 DELETE from events WHERE id=:id
 ";
 //preparar query para execução
 $statement = $connect->prepare($query);
 //execução
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>