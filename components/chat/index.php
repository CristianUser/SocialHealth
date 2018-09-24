<?php
include '../../functions/sesion.php';
include '../../template/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chat</title>
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"> -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="./style.css">
</head>
<body>     
    <div class="chat-container">   
        <ul class="list-unstyled">
            <div id="popover-content" class="hide">
                <div class="srch_bar">
                    <div class="stylish-input-group">
                      <input type="text" class="search-bar"  placeholder="Search" >
                      <span class="input-group-addon">
                      <button type="button"  id="btn"> <i class="fa fa-search"></i> </button>
                      </span> </div>
                  </div>
                <ul id="user-list" class="list-group" >
                  <!-- users to add here -->
                </ul>
            </div>
        </ul>
    </div> 
    <div class="container">
    <h3 class=" text-center">Mensajes</h3>
    <div class="messaging">
          <div class="inbox_msg">
            <div class="inbox_people">
              <div class="headind_srch">
                <div class="recent_heading">
                  <h4>Recientes</h4>
                </div>
                <div class="srch_bar">
                  <div class="stylish-input-group">
                    <!-- <input type="text" class="search-bar"  placeholder="Search" > -->
                    <span class="input-group-addon">
                    <button data-placement="bottom" data-toggle="popover" data-title="Agregar Chat" data-container="body"
                    type="button" data-html="true" id="login" onmouseout="stateC()" onclick="stateC()"> <i class="fa fa-plus"></i> </button>
                    </span></div>
                </div>
              </div>
              <div class="inbox_chat" id="inbox_chat">
                <!-- chat_list -->
              </div>
            </div>
            <div id="header-msj" style="text-align: center; color: white; background-color: #00A89E;"><h5 style="display:inline"  class="Nombre" >Usuario</h5></div>
            <div class="mesgs">
              <div class="msg_history" id="msg_history">
                <!-- msj_here -->
              </div>
              <div class="type_msg">
                <div class="input_msg_write">
                  <form name="formulario">
                    <input id="msj-body" autocomplete="off" name="body" type="text" class="write_msg" placeholder="Escribir Mensaje" />
                    <button id="enviarbtn" class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Template de los chats -->
      <div style="display:none;" id="template" class=" chat_list">
          <div class="chat_people">
          <div class="chat_img"> <img class="Foto" src="http://placehold.it/50/55C1E7/fff&text=U"> </div>
          <div class="chat_ib">
              <h5 class="Nombre"> </h5> <h5><span class="chat_date Fecha">fecha</span></h5>
              <p class="LastMsj">ultimo msj</p>
          </div>
      </div>
      </div>
      <!-- Template de mensajes -->
      <!-- Template de enviados -->
      <div style="display:none;" id="templateout" class="outgoing_msg">
          <div class="sent_msg">
          <p class="Body">body</p>
          <span class="time_date Date">hora   |    dia </span> </div>
      </div>
      <!-- Template de recibidos -->
      <div style="display:none;" id="templatein" class="incoming_msg">
        <div class="incoming_msg_img"> <img class="Foto" src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p class="Body">body</p>
              <span class="time_date Date"> hora    |    fecha</span></div>
          </div>
      </div>
      <!-- <script src="./js/jquery-3.3.1.js"></script> -->
      <script src="https://www.gstatic.com/firebasejs/5.5.1/firebase.js"></script>
      <script>
        var user=5;
        var userType=2;
      </script>
      <script src="./js/chat.js"></script>
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
      <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
  </body>
</html>
<?php include "../../template/footer.php"?>