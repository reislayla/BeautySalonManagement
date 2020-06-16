
<!--Menu lateral-->
<?php 
    include "sidemenu.php"; 
    session_start();
    include "connection.php";
    include "productAdd.php";

    //Base de Dados e Tabela client
    $qry = "SELECT * FROM supplier ORDER BY name ASC";
    $result = mysqli_query($conn, $qry);
    $AlertMsg = "";
    $typesession = $_SESSION['user_type'];

    /*Base de Dados e Tabela client
    $qry1 = "SELECT * FROM product ORDER BY name ASC";
    $result1 = mysqli_query($conn, $qry);*/

    //Alertas
    if (isset($_GET['alert'])) {
        if ($_GET['alert'] == 'Success') {
            $AlertMsg = "<div class = 'alert alert-success'>Novo fornecedor adicionado.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
        elseif ($_GET['alert'] == 'UpdateSuccess') {
            $AlertMsg = "<div class = 'alert alert-success'>Fornecedor atualizado com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
        elseif ($_GET['alert'] == 'ProductSuccess') {
            $AlertMsg = "<div class = 'alert alert-success'>Produto adicionado com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
        elseif ($_GET['alert'] == 'Deleted') {
            $AlertMsg = "<div class = 'alert alert-success'>Fornecedor removido com sucesso.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
    }
    //mysqli_close($conn);
?>

<!--Corpo da página-->

<body class="dashboard">
    <div class="main">
        <div class="text-center">
            <h1 class="jumbotron">Fornecedores</h1>
        </div>
    <?php echo $AlertMsg; ?>

    <!--Tabela de fornecedores-->
    <div class="table-responsive">
	<table class="table table-striped table-bordered table-hover mb-5">
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <!--Colunas apenas para administradores-->
                <?php if ($typesession == "admin") { ?>
                <th>Email</th>
                <th>Produtos</th>
                <th>Editar</th> <?php }?>
            </tr>
        
        <?php

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td><td>" . $row['phone'] . "</td>"; if ($typesession == "admin") { echo "<td>" . $row['email'] . "</td><td>" . $row['product'] .  "</td>";
                echo '<td><a href="supplierEdit.php?id=' . $row['id'] . ' "type="button" class="btn btn-primary btn-sm"><i style="font-size:15px" class="far fa-edit""></i> </a></td>'; }
                echo "</tr>";
            }
        }

        else {
            echo "<div class='alert alert-warning'>Ainda não há fornecedores registados.</div>";
        }

        mysqli_close($conn);
            //Botão Novo Fornecedor apenas para administradores
            if ($typesession == "admin") { ?>
            <tr>
                <td colspan="7"><div class="text-center"><a href="supplierAdd.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Novo Fornecedor</a></div></td>
            </tr> <?php } ?>
        </table>
    </div>
    <!--Botão para adicionar nova categoria de produto apenas para administradores-->
        <?php if ($typesession == "admin") { ?>
        <button onclick="document.getElementById('registo').style.display='block'"  class="btn btn-sm btn-primary float-right mr-2"><i style="font-size:12px" class="fas fa-plus mr-1"></i> Produto</button> 
        <?php } ?>                
    </div>
    
    <!--Início do Modal-->
            <div id="registo" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                <form class="needs-validation" novalidate method='POST'>
                    <div class="form-group">
                        <!--Nome do Produto-->
                        <label for="exampleInputEmail1"><b>Nome</b></label>
                        <input type="text" class="form-control border" id="exampleInputName1" name="productName" placeholder="Inserir Nome..." required value="<?php echo $productName; ?>">
                        <div class="invalid-feedback">
                        É obrigatório inserir um nome. 
                        </div>
                  </div>
                  <!--
                    <label for="name" class="float-left">Nome *</label>
                    <input type="text" class="form-control input-lg border" id="name" name="name" value="">-->

                    <!--Gravar-->
                    <button type="submit" name="prod_user" class="btn btn-success float-right ml-2" onclick="erromsg();">Gravar</button>
                    <!--Cancelar-->
                    <button type="button" onclick="document.getElementById('registo').style.display='none'" class="btn btn-secondary float-right">Cancelar</button>
                <!--<button type="button" class="btn btn-success">Gravar</button>-->
                </form>
                </div>
                </div>
            </div>
        </div>
    <!--Fim do modal-->
    <div class="push"></div>          
</body>
<!--Footer-->
<?php include 'footer.php';?>

<script>

//Vai desabilitar o submit caso tenha algum campo inválido
  (function erromsg() {
  'use strict';
  window.addEventListener('load', function() {
    //Busca todos os formulários que precisam de validação e aplica de forma personalizada a cada um.  
    var forms = document.getElementsByClassName('needs-validation');
    //Impede o envio 
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

</script>
