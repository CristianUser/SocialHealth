var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
var chatS=false;
// Initialize Firebase
var config = {
  apiKey: "AIzaSyDexXq2xNPP6YsZs6k4ut-yl3mdSSAJVdI",
  authDomain: "chat-socialhealth.firebaseapp.com",
  databaseURL: "https://chat-socialhealth.firebaseio.com",
  projectId: "chat-socialhealth",
  storageBucket: "",
  messagingSenderId: "134984770390"
};
firebase.initializeApp(config);
var chatDB= firebase.database().ref('chat');
var msjDB;

//formatear fechas
var formatDate = (date,fType)=>{
  var d= date.getUTCDate();
  var m= date.getMonth();
  var y= date.getFullYear();
  var h=date.getHours();
  var min= date.getMinutes();
  var ampm;
  var now = new Date();
  var fDate;

if (h >= 12){
  h -= 12;
  ampm="PM";
}else{
    ampm="AM";
}
if(h == 0){
    h =12;
}
if (h<10){h = "0"+h;}
var hora = h;
if (min<10){min = "0"+min;}
var minutos = min;

if(fType== 1){
  fDate=h+':'+min+' '+ampm+"  |  "+meses[m];
}else if(fType==2){
  fDate=meses[m].substring(0,3)+' '+d;
  if(now.getMonth() == date.getMonth() && now.getFullYear()==date.getFullYear()){
    if(now.getUTCDate()==date.getUTCDate()){
     fDate="Hoy";
    }else if (now.getUTCDate()==date.getUTCDate()+1) {
     fDate="Ayer";
    }else{
      fDate="";
    }
  }
}
return fDate;
};

//obtener lista de usuarios para agregar chats
var getUserList = (id,uType)=>{
  var parametros = {
    "id":id,
  };
  $.ajax({
    url : 'request/getUserList'+uType+'.php',
    data : parametros,
    type : 'GET',
    success : function(req) {
      document.getElementById("user-list").innerHTML=req;
    },
    error : function(xhr, status) {
        alert('Disculpe, existió un problema');
    },
    complete : function(xhr, status) {
        //console.log('Petición realizada');
    }
  });
};
getUserList(user,userType);
// funcion para setear los mensajes
var setMsjDB = (idChat)=>{
  msjDB = firebase.database().ref('chat/'+idChat+'/Message');
}

var getMsjDB = (idChat)=>{
  msjDB.limitToLast(20).on('value',function(snapshot){  
  $(".msg_history").html(""); // Limpiar todo el contenido del chat
   // Leer todos los mensajes en firebase
  snapshot.forEach(function(e){
    var objeto=e.val();
    var type="";
    if(objeto.Author==user){type="out";}else{type="in";}
    //formatear fecha
    var date = new Date(Date.parse(objeto.Date));
    fDate=formatDate(date,1);

    // Copiar el contenido al template y luego lo inserta en el chat     
    $( "#template"+type ).clone().appendTo( ".msg_history" );
    $('.msg_history #template'+type).show(10);
    $('.msg_history #template'+type+' .Body').html(objeto.Body);
    $('.msg_history #template'+type+' .Date').html(fDate);
    $('.msg_history #template'+type+' .Foto').attr("src",document.getElementById(idChat).children[0].children[0].children[0].src);
    $('.msg_history #template'+type).attr("id",e.key);
    // document.getElementById(e.key).focus;
    // var id="";
    // id=e.key;
    // document.getElementById(id).addEventListener('click',()=>{
    //   idChat=e.key;
    //   setMsjDB();
    //   console.log('oh yeah');
    // });
        
       
   });
  });
  var goToLast = ()=>{
    var objDiv = document.getElementById("msg_history");
    objDiv.scrollTop = objDiv.scrollHeight;
  };
  setTimeout(goToLast,50);
};
// funcion para agregar chats a la lista
var agregarChat = (userAv)=>{
  var validate=true;
  if(validate){
  chatDB.push({
    Members:[user,userAv],
    Message:[]
  });
  }
};
// funcion para enviar mensajes
var enviarMsj = (body)=>{
  var aDate= new Date(); 
  msjDB.push({
    Author:user,
    Body:body,
    Date:aDate.toString(),
    Status:'Sent'
  })
};
let userAvData;
//Obtener los nombres de los usuarios
var getUserName = (id)=>{
  var parametros = {
    "id":id,
  };
  $.ajax({
    url : 'request/getPersona.php',
    data : parametros,
    type : 'GET',
    success : function(req) {
      userAvData=JSON.parse(req);
      $('#'+id+' .Nombre').html(userAvData.nombre +' ' +userAvData.apellido);
      $('#'+id+' .Foto').attr('src',userAvData.foto);
    },
    error : function(xhr, status) {
        alert('Disculpe, existió un problema');
    },
    complete : function(xhr, status) {
        //console.log('Petición realizada');
    }
  });
  return userAvData;
};
//Obtener los chats
chatDB.limitToLast(20).on('value',function(snapshot){
$(".inbox_chat").html(""); // Limpiamos todo el contenido del chat
// Leer todos los mensajes en firebase
snapshot.forEach(function(e){
  var objeto=e.val(); // Asignar todos los valores a un objeto
  //console.log(e.key);
    //if ( objeto.Members.indexOf(user) >=0  ) {
    if ( objeto.Members[0]==user || objeto.Members[1]==user ) {
      let userTo=0;
      if(objeto.Members[0]==user){
        userTo=objeto.Members[1];
      }else{
          userTo=objeto.Members[0];
      };
      //console.log(userTo);
      // Copia el contenido al template y luego lo inserta en el chat
      getUserName(userTo);
      $( "#template" ).clone().prependTo( ".inbox_chat" );
      $('.inbox_chat #template').show(10);
      //$('.inbox_chat #template .Nombre').html(userAvData.nombre);
      lastMsj="";
      lastMsjDate="";
      setMsjDB(e.key);
      msjDB.limitToLast(1).on('value',function(snapshot){snapshot.forEach((e)=>{objeto=e.val();lastMsj=objeto.Body;lastMsjDate=objeto.Date;})});
      //formatear fecha
        if(lastMsj!=""){
        var ftDate = new Date(Date.parse(lastMsjDate));
        fDate = formatDate(ftDate,2);
        }else{
          fDate="";
        }
      $('.inbox_chat #template .LastMsj').html(lastMsj);
      $('.inbox_chat #template .Fecha').html(fDate);
      $('.inbox_chat #template .chat_people').attr("id",userTo);
      $('.inbox_chat #template').attr("id",e.key);
      var id="";
      id=e.key;
      document.getElementById(id).addEventListener('click',()=>{
        chatS=true;
        setMsjDB(e.key);
        getMsjDB(e.key);
        $('#header-msj .Nombre').html($('#'+id+' .Nombre').html() );
        //console.log('oh yeah');
      });
    }
  });
});

//click en add
var state=false;
var stateC = ()=>{
if(state){
  setTimeout(quitarUsers,1000);
  state=false;
}else{
  quitarUsers();
  setTimeout(parsear,300);
  setTimeout(quitarUsers,500);
  setTimeout(quitarUsers,1000);
  state=true;
}
}
//Parsear lista de usuarios disponibles
var popover = document.getElementsByClassName('popover-body');
var parsear=()=>{
var userList = popover[0].children[1];
for(let i=0;i<userList.children.length;i++){
  userList.children[i].addEventListener('click',setTimeout(1000,()=>{
    //console.log("click "+userList.children[i].value);
    agregarChat(userList.children[i].value);
    userList.children[i].parentNode.removeChild(userList.children[i]);
  }));
  //console.log(i);
}
};
//funcion para vaciar lista de chats agregados
var quitarUsers = ()=>{
  lista = document.getElementById("user-list");
  lista2 = document.getElementById("inbox_chat");
  for (var x = 0; x < lista2.children.length+4; x++){
    for (var i = 0; i < lista.children.length; i++) {
      for (var e = 0; e < lista2.children.length; e++){
        if(lista.children[i].value==lista2.children[e].children[0].id){
          lista.children[i].parentNode.removeChild(lista.children[i]);
        }
      }
    }}
  };
$(window).ready(function() {
    //popover
      $("[data-toggle=popover]").popover({
      html: true, 
      content: function() {
        return $('#popover-content').html();
      }  
      });
    
//boton enviar mensaje

  var input = document.getElementById("msj-body");
  input.addEventListener("keydown", function(event) {
      if (event.keyCode == 13) {
          document.getElementById("enviarbtn").click();
          event.preventDefault();
      }
      //return false;
  });
  var boton = document.getElementById("enviarbtn");
  boton.addEventListener('click',(e)=>{
    if(formulario.body.value!="" && chatS){
    enviarMsj(formulario.body.value);
    }
    formulario.body.value="";
    e.preventDefault();
  });
});

