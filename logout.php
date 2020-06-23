<?php
session_start();

if (isset($_COOKIE[session_name() ])) {
	setcookie(session_name() , '', time() - 86400, '/');
}

session_unset();
session_destroy();
//include ('includes/header.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Área de Gestão</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="style/form-elements.css">
    </head>
    <body class="endsession">
		<div class="text-center mt-5">
			<img src="images/logo.png" style="max-width:200px"><br><br>
			<h1>Desconectado</h1>
			<p class="lead">A sessão foi encerrada. Até breve!</p>	
			<a href="index.php">2020 &copy;beautysolutions</a>
		</div>

	</body>