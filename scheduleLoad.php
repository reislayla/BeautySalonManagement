<?php

//conexão com a base de dados
//include "includes/connection.php";
$connect = new PDO('mysql:host=localhost;dbname=salao', 'root', '');

$data = array();
$query = "SELECT * FROM events ORDER BY id";
//preparar query para execução
$statement = $connect->prepare($query);
//executar
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}
echo json_encode($data);
?>