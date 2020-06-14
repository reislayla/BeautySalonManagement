<?php

//insert.php
//include "includes/connection.php";
$connect = new PDO('mysql:host=localhost;dbname=salao', 'root', '');

//Validar se foi inserido um título.
if(isset($_POST["title"]))
{
 //Query para inserir
 $query = "
 INSERT INTO events 
 (title, start_event, end_event) 
 VALUES (:title, :start_event, :end_event)
 ";
 //preparar query para execução
 $statement = $connect->prepare($query);
 //execução
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>
