<!--Menu lateral-->
<?php 
session_start();
include "sidemenu.php";
include ('connection.php'); 
$typesession = $_SESSION['user_type'];
?> 


<!--Corpo da página-->
<body class="dashboard">
  <div class="main">
    <div class="text-center">
        <h1 class="jumbotron">Serviços</h1>
    </div>
<!--Conteúdo editavel-->
<div class="editor1">
   <!--Grid de Serviços-->
   <div class="row mw-100 ml-0 mr-0 mb-3">
      <!-- Coluna 1-->
      <div class="col-lg-4 col-md-12">
        <!--Wider-->
        <div class="card card-cascade wider">
            <!--Conteúdo-->
            <div class="card-body card-body-cascade text-center">
              <!--Título-->
              <h4 class="card-title"><strong><i class="fas fa-cut" style="font-size: 48px;"></i></strong></h4>
              <p id="title1"class="indigo-text"><strong>Corte Senhora</strong></p>
              <h5 id="content1" class="card-text">15€</h5>
              <!--Botão Editar apenas para administradores-->
              <?php if ($typesession == "admin") { ?>
              <button class="btn btn-light btn-sm border float-right" id="editBtn1" type="button"><i class="far fa-edit"></i></button>
              <?php } ?>
            </div>       
        </div>
      </div>
      <!--Coluna 2-->
      <div class="col-lg-4 col-md-12">
        <!--Wider-->
        <div class="card card-cascade wider">
            <!--Conteúdo-->
            <div class="card-body card-body-cascade text-center">
              <!--Título-->
              <h4 class="card-title"><strong><i class="far fa-hand-paper" style="font-size: 48px;"></i></strong></h4>
              <p id="title2" class="indigo-text"><strong>Verniz Gel</strong></p>
              <h5 id="content2" class="card-text">6€</h5>
              <!--Botão Editar apenas para administradores-->
              <?php if ($typesession == "admin") { ?>
              <button class="btn btn-light btn-sm border float-right" id="editBtn2" type="button"><i class="far fa-edit"></i></button>
              <?php } ?>
            </div>     
        </div>
      </div>
      <!--Coluna 3-->
      <div class="col-lg-4 col-md-12">
        <!--Wider-->
        <div class="card card-cascade wider">
            <!--Conteúdo-->
            <div class="card-body card-body-cascade text-center">
              <!--Título-->
              <h4 class="card-title"><strong><i class="fas fa-tint" style="font-size: 48px;"></i></strong></h4>
              <p id="title3" class="indigo-text"><strong>Coloração</strong></p>
              <h5 id="content3" class="card-text">35€</h5>
                            <!--Botão Editar apenas para administradores-->
                            <?php if ($typesession == "admin") { ?>
              <button class="btn btn-light btn-sm border float-right" id="editBtn3" type="button"><i class="far fa-edit"></i></button>
              <?php } ?>
            </div>    
        </div>
      </div>
    </div>
     <!--Grid de Contactos-->
   <div class="row content-justify-center mw-100 ml-0 mr-0 mb-3">
      <!-- Coluna 1-->
      <div class="col-lg-4 col-md-12">
        <!--Wider-->
        <div class="card card-cascade wider">
            <!--Conteúdo-->
            <div class="card-body card-body-cascade text-center">
              <!--Título-->
              <h4 class="card-title"><strong><i class="fas fa-cut" style="font-size: 48px;"></i></strong></h4>
              <p id="title4" class="indigo-text"><strong>Corte Homem</strong></p>
              <h5 id="content4" class="card-text">10€</h5>
                                          <!--Botão Editar apenas para administradores-->
                                          <?php if ($typesession == "admin") { ?>
              <button class="btn btn-light btn-sm border float-right" id="editBtn4" type="button"><i class="far fa-edit"></i></button>
              <?php } ?>
            </div>       
        </div>
      </div>
      <!--Coluna 2-->
      <div class="col-lg-4 col-md-12">
        <!--Wider-->
        <div class="card card-cascade wider">
            <!--Conteúdo-->
            <div class="card-body card-body-cascade text-center">
              <!--Título-->
              <h4 class="card-title"><strong><i class="far fa-hand-paper" style="font-size: 48px;"></i></strong></h4>
              <p id="title5" class="indigo-text"><strong>Remoção Verniz Gel</strong></p>
              <h5 id="content5" class="card-text">5€</h5>
              <!--Botão Editar apenas para administradores-->
              <?php if ($typesession == "admin") { ?>
              <button class="btn btn-light btn-sm border float-right" id="editBtn5" type="button"><i class="far fa-edit"></i></button>
              <?php } ?>
            </div>     
        </div>
      </div>
      <!--Coluna 3-->
      <div class="col-lg-4 col-md-12">
        <!--Wider-->
        <div class="card card-cascade wider">
            <!--Conteúdo-->
            <div class="card-body card-body-cascade text-center">
              <!--Título-->
              <h4 class="card-title"><strong><i class="fas fa-plus-circle" style="font-size: 48px;"></i></strong></h4>
              <p id="title6" class="indigo-text"><strong>Novo Serviço</strong></p>
              <h5 id="content6" class="card-text">Valor</h5>
                            <!--Botão Editar apenas para administradores-->
                            <?php if ($typesession == "admin") { ?>
              <button class="btn btn-light btn-sm border float-right" id="editBtn6" type="button"><i class="far fa-edit"></i></button>
              <?php } ?>
          </div>    
        </div>
      </div>
    </div>
    </div>
  </div>
</body>

<!--Footer-->
<?php include "footer.php"?>

<script>
//Editar e gravar texto do perfil
var editBtn1 = document.getElementById('editBtn1');
//Guardar os elementos editáveis dentro da variávei editables
var editables1 = document.querySelectorAll('#title1, #content1')
if (typeof(Storage) !== "undefined") { 
 if (localStorage.getItem('title1') !== null) {
  editables1[0].innerHTML = localStorage.getItem('title1');
 } if (localStorage.getItem('content1') !== null) {
  editables1[1].innerHTML = localStorage.getItem('content1');
 }}editBtn1.addEventListener('click', function(e) {
  if (!editables1[0].isContentEditable) {
    editables1[0].contentEditable = 'true';
    editables1[1].contentEditable = 'true';
    editBtn1.innerHTML = '<i class="far fa-edit">';
    editBtn1.style.backgroundColor = '#6F9';
  } else {
    // Desabilitar edição
    editables1[0].contentEditable = 'false';
    editables1[1].contentEditable = 'false';
    // Alterar cor do botão
    editBtn1.innerHTML = '<i class="far fa-edit">';
    editBtn1.style.backgroundColor = '#F96';
    //Gravar
    for (var i = 0; i < editables1.length; i++) {
      localStorage.setItem(editables1[i].getAttribute('id'), editables1[i].innerHTML);
    }
  }
});
//Segundo serviço
var editBtn2 = document.getElementById('editBtn2');
var editables2 = document.querySelectorAll('#title2, #content2')
if (typeof(Storage) !== "undefined") { 
 if (localStorage.getItem('title2') !== null) {
  editables2[0].innerHTML = localStorage.getItem('title2');
 } if (localStorage.getItem('content2') !== null) {
  editables2[1].innerHTML = localStorage.getItem('content2');
 }}editBtn2.addEventListener('click', function(e) {
  if (!editables2[0].isContentEditable) {
    editables2[0].contentEditable = 'true';
    editables2[1].contentEditable = 'true';
    editBtn2.innerHTML = '<i class="far fa-edit">';
    editBtn2.style.backgroundColor = '#6F9';
  } else {
    editables2[0].contentEditable = 'false';
    editables2[1].contentEditable = 'false';
    editBtn2.innerHTML = '<i class="far fa-edit">';
    editBtn2.style.backgroundColor = '#F96';
    for (var i = 0; i < editables2.length; i++) {
      localStorage.setItem(editables2[i].getAttribute('id'), editables2[i].innerHTML);
    }
  }
});
//Terceiro serviço
var editBtn3 = document.getElementById('editBtn3');
var editables3 = document.querySelectorAll('#title3, #content3')
if (typeof(Storage) !== "undefined") { 
 if (localStorage.getItem('title3') !== null) {
  editables3[0].innerHTML = localStorage.getItem('title3');
 } if (localStorage.getItem('content3') !== null) {
  editables3[1].innerHTML = localStorage.getItem('content3');
 }}editBtn3.addEventListener('click', function(e) {
  if (!editables3[0].isContentEditable) {
    editables3[0].contentEditable = 'true';
    editables3[1].contentEditable = 'true';
    editBtn3.innerHTML = '<i class="far fa-edit">';
    editBtn3.style.backgroundColor = '#6F9';
  } else {
    editables3[0].contentEditable = 'false';
    editables3[1].contentEditable = 'false';
    editBtn3.innerHTML = '<i class="far fa-edit">';
    editBtn3.style.backgroundColor = '#F96';
    for (var i = 0; i < editables3.length; i++) {
      localStorage.setItem(editables3[i].getAttribute('id'), editables3[i].innerHTML);
    }
  }
});

//Quarto serviço
var editBtn4 = document.getElementById('editBtn4');
var editables4 = document.querySelectorAll('#title1, #content1')
if (typeof(Storage) !== "undefined") { 
 if (localStorage.getItem('title1') !== null) {
  editables4[0].innerHTML = localStorage.getItem('title1');
 } if (localStorage.getItem('content1') !== null) {
  editables4[1].innerHTML = localStorage.getItem('content1');
 }}editBtn4.addEventListener('click', function(e) {
  if (!editables4[0].isContentEditable) {
    editables4[0].contentEditable = 'true';
    editables4[1].contentEditable = 'true';
    editBtn4.innerHTML = '<i class="far fa-edit">';
    editBtn4.style.backgroundColor = '#6F9';
  } else {
    editables4[0].contentEditable = 'false';
    editables4[1].contentEditable = 'false';
    editBtn4.innerHTML = '<i class="far fa-edit">';
    editBtn4.style.backgroundColor = '#F96';
    for (var i = 0; i < editables4.length; i++) {
      localStorage.setItem(editables4[i].getAttribute('id'), editables4[i].innerHTML);
    }
  }
});
//Quinto serviço
var editBtn5 = document.getElementById('editBtn5');
var editables5 = document.querySelectorAll('#title2, #content2')
if (typeof(Storage) !== "undefined") { 
 if (localStorage.getItem('title2') !== null) {
  editables5[0].innerHTML = localStorage.getItem('title2');
 } if (localStorage.getItem('content2') !== null) {
  editables5[1].innerHTML = localStorage.getItem('content2');
 }}editBtn5.addEventListener('click', function(e) {
  if (!editables5[0].isContentEditable) {
    editables5[0].contentEditable = 'true';
    editables5[1].contentEditable = 'true';
    editBtn5.innerHTML = '<i class="far fa-edit">';
    editBtn5.style.backgroundColor = '#6F9';
  } else {
    editables5[0].contentEditable = 'false';
    editables5[1].contentEditable = 'false';
    editBtn5.innerHTML = '<i class="far fa-edit">';
    editBtn5.style.backgroundColor = '#F96';
    for (var i = 0; i < editables5.length; i++) {
      localStorage.setItem(editables5[i].getAttribute('id'), editables5[i].innerHTML);
    }
  }
});
//Sexto serviço
var editBtn6 = document.getElementById('editBtn6');
var editables6 = document.querySelectorAll('#title3, #content3')
if (typeof(Storage) !== "undefined") { 
 if (localStorage.getItem('title3') !== null) {
  editables6[0].innerHTML = localStorage.getItem('title3');
 } if (localStorage.getItem('content3') !== null) {
  editables6[1].innerHTML = localStorage.getItem('content3');
 }}editBtn6.addEventListener('click', function(e) {
  if (!editables6[0].isContentEditable) {
    editables6[0].contentEditable = 'true';
    editables6[1].contentEditable = 'true';
    editBtn6.innerHTML = '<i class="far fa-edit">';
    editBtn6.style.backgroundColor = '#6F9';
  } else {
    editables6[0].contentEditable = 'false';
    editables6[1].contentEditable = 'false';
    editBtn6.innerHTML = '<i class="far fa-edit">';
    editBtn6.style.backgroundColor = '#F96';
    for (var i = 0; i < editables6.length; i++) {
      localStorage.setItem(editables6[i].getAttribute('id'), editables6[i].innerHTML);
    }
  }
});

</script>