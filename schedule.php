
<!--Menu lateral-->
<?php
session_start();
include "sidemenu.php"; ?> 

<!--Corpo da página-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<link rel="stylesheet" href="style/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>  


<body class="dashboard">
  <div class="main">
    <div class="text-center">
      <h1 class="jumbotron">Agendamentos</h1>
      <?php $name = $_SESSION['user_name'];?>
      <p><?php echo $name.", bem vindo! Clique no botão "?><b style="color:#de615e">day</b><?php echo " e veja seus agendamentos para hoje." ?></p> 
    </div>    
    <!---------------------------------Início do Calendário-------------------------------->
<script>
$(document).ready(function() {
    //var para ativar o calendário
   var calendar = $('#calendar').fullCalendar({    
    editable:true,
    //Botões no topo do calendário
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay,'
    },
    //Ler eventos
    events: 'scheduleLoad.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Adicione um título ao evento");
     if(title)
     {
      //Data de início
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      //Data de fim
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       //Enviar pedido para insert.php
       url:"scheduleInsert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //Mensagem de sucesso
        alert("Evento adicionado com sucesso");
       }
      })
     }
    },
    editable:true,
    //Redimensionar evento e atualizar início e fim
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     //Enviar pedido para update.php
     $.ajax({
      url:"scheduleUpdate.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       //Mensagem de sucesso
       alert('Evento atualizado');
      }
     })
    },

    //Atualizar dados na base de dados
    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     //Enviar pedido para update.php
     $.ajax({
      url:"scheduleUpdate.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       //Mensagem de sucesso
       alert("Evento atualizado");
      }
     });
    },

    //Permitir remover ao clicar no evento
    eventClick:function(event)
    {
     if(confirm("Você tem certeza que quer remover este evento?"))
     {
      var id = event.id;
      //Enviar pedido para update.php
      $.ajax({
       url:"scheduleDelete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //Mensagem de sucesso
        alert("Evento removido");
       }
      })
     }
    },

   });
  });
   
  </script>
 </head>
 <body>
  <br />
  <br />
  <div class="container mb-4">
   <!--Tag calendário-->   
   <div id="calendar"></div>
  </div>
  </div>   
</body>
  <!--Footer-->
  <?php include "footer.php"?>

