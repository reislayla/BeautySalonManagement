
<!--Menu lateral-->
<?php 
session_start();
include "sidemenu.php"; 
include ('connection.php');
$typesession = $_SESSION['user_type'];
$name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];?> 

<!--Corpo da página-->
<body class="dashboard">
  <div class="main">
    <div class="text-center">
      <h1 class="jumbotron">Minha Conta</h1>
    </div>
  <div class="mr-5 mb-5">
    <!--Botão Terminar Sessão-->
      <a href="logout.php" class="btn btn-danger btn-sm float-right">Terminar sessão</a>
      <!--<a href="employee.php" class="btn btn-secondary btn-sm float-right mr-2">Funcionários</a>-->     
  </div>
  <hr class="m-0">   
  <!--Área do perfil do utilizador-->
  <div class="container">  
    <div class="text-center py-5">
      <!--Imagem-->
      <img src="images/avatar.jpg" alt="Imagem de perfil" style="max-height:160px;" class="p-3 rounded-circle"><br>
      <div class="p-2 mx-auto">
        <!--Texto-->
        <div class="editor">
          <h4 id="title" class="font-weight-bold my-4">Nome</h4>
          <p id="content" class="text-muted mb-3">Texto</p>
          <p><?php echo $name . " - " . $email ?> </p>
        </div>
        <br>
        <!--Botão Editar Perfil do Salão apenas para administradores-->
        <?php if ($typesession == "admin") { ?>
        <button class="btn btn-light btn-sm border float-right" id="editBtn" type="button">Editar Perfil</button>
        <?php } ?>
        </div>
      </div>
    </div>
  <hr class="m-0">
  <!--Botões-->
    <ul class="nav nav-tab justify-content-center my-3">
      <li>
        <a href="https://pt.wix.com/" target="_blank" class="mr-3" >Site oficial</a>
      </li>
      <li>
        <a href="https://gmail.com/" target="_blank" class="mr-3">Gmail</a>
      </li>
      <li>
        <a href="https://facebook.com/" target="_blank" class="mr-3">Facebook</a>
      </li>
      <li >
        <a href="https://instagram.com/" target="_blank">Instagram</a>
      </li>
    </ul><hr class="m-0 mb-5">
  </div>
</body>
<!--Footer--> 
<?php include "footer.php"?> 

<script>
  //Editar e gravar texto do perfil
var editBtn = document.getElementById('editBtn');
//Guardar os elementos editáveis dentro da variávei editables
var editables = document.querySelectorAll('#title, #content')
if (typeof(Storage) !== "undefined") {
 
 if (localStorage.getItem('title') !== null) {
   editables[0].innerHTML = localStorage.getItem('title');
 }
  
 if (localStorage.getItem('content') !== null) {
   editables[1].innerHTML = localStorage.getItem('content');
 } 
}

editBtn.addEventListener('click', function(e) {
  if (!editables[0].isContentEditable) {
    editables[0].contentEditable = 'true';
    editables[1].contentEditable = 'true';
    editBtn.innerHTML = 'Save Changes';
    editBtn.style.backgroundColor = '#6F9';
  } else {
    // Disable Editing
    editables[0].contentEditable = 'false';
    editables[1].contentEditable = 'false';
    // Change Button Text and Color
    editBtn.innerHTML = 'Enable Editing';
    editBtn.style.backgroundColor = '#F96';
    // Save the data in localStorage 
    for (var i = 0; i < editables.length; i++) {
      localStorage.setItem(editables[i].getAttribute('id'), editables[i].innerHTML);
    }
  }
});
</script>




