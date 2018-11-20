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
    <title>Configurar</title>
    <link rel="stylesheet" href="../../public/css/dropzone.css">
    <style>
        .dropzone {
            border: 2px dashed #00a89e;
            background: white;
            padding: 54px 54px;
            /* border-color: #00a89e; */
        }
    </style>
</head>
<body>
    <br>
    <div class="container">
        <div class="row ">
            <div class="col">
                <h3 class="">Validacion</h3>
            </div>
        </div>
        <div class="row text-start">
            <div class="col-1"></div>
            <div class="col card">
                <p>Para la Activacion de su cuenta necesitamos comprobar que realmente es un profesional de la salud. 
                    Para esto requerimos una foto de algun documento de identidad y algo que certifique que es profesional </p>
            </div>
            <div class="col-1"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <div id="mydrop" class="dropzone">
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <br>
        <div class="row text-right">
            <div class="col">
                <button id="btnSend" class="btn btn-cmj">
                    Enviar
                </button>
            </div>
        </div>
    </div>
    <script src="../../public/js/dropzone.js"></script>
    <script>
        var myDropzone = new Dropzone("#mydrop", { 
            url: "../../functions/dbActions/uploadFile.php",
            params:{
                id:id
            },
            autoProcessQueue:false,
            addRemoveLinks:true,
            init:()=>{
                $('#btnSend').click(()=>{
                    myDropzone.processQueue();
                });
            },
            dictDefaultMessage:"Arrastre los archivos aqui!",
            dictRemoveFile:"Remover Archivo"
        });
    </script>
</body>
</html>
<?php include '../../template/footer.php';?>