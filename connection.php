<?php

    //Conectar e selecionar a DB salao
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "salao";

    $conn = new mysqli($servername, $username, $password, $dbname);

    //A conexão é verificada no processo de login (process.php)
?>