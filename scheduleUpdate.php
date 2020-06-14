<?php

//update.php
//include "includes/connection.php";
$connect = new PDO('mysql:host=localhost;dbname=salao', 'root', '');

if(isset($_POST["id"]))
{
 //Query de atualização
 $query = "
 UPDATE events 
 SET title=:title, start_event=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 //preparar query para execução
 $statement = $connect->prepare($query);
 //Execucao
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>