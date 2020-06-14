<?php
    session_start();
    include "connection.php";

    $email = $_POST['email'];
    $password = $_POST['pass'];

    if(!empty($_POST)) {
    //Query a DB para utilizador
    $result=mysqli_query($conn, "SELECT id, name, phone, email, address, type, password FROM employee WHERE email='$email' and password='$password'") or die("Sem conexão com a Base de Dados");

    //$row = mysqli_fetch_array($result);   
    $count  = mysqli_num_rows($result);
    $user = $result->fetch_assoc();

    if($count==0) {
        //header('Location: index.php?error=1');
        echo "<script>
          alert('Login inválido! Tente novamente.');
          window.location.href='index.php';
        </script>";
    } else {
       $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
          $_SESSION['user_name'] = $user['name'];
      header('Location: schedule.php');
    }
  }
?>