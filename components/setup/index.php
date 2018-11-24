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
                <button id="btnSend" class="btn btn-cmj">Enviar</button>
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
                myDropzone = myDropzone;
                $('#btnSend').click(()=>{
                    myDropzone.processQueue();
                });

                $.get('./request/getFiles.php', function (data) {
                    if (data == null) {
                        return;
                    }
                    // 7
                    console.log(data);
                    $.each(data, function (key, value) {
                        var mockFile = { name: value.name, size: value.size };
                        myDropzone.emit("addedfile", mockFile);
                        //myDropzone.options.thumbnail.call(myDropzone, mockFile, '/SocialHealth/private/files/4/documents/' + value.name);
                        myDropzone.createThumbnailFromUrl(mockFile, '../../private/files'+id+'/documents/' + value.name);
                        // Make sure that there is no progress bar, etc...
                        myDropzone.emit("complete", mockFile);
                    });
                });

            },
            dictDefaultMessage:"Arrastre los archivos aqui!",
            dictRemoveFile:"Remover Archivo"
        });
        myDropzone.on("removedFile",()=>{
                    console.log("removed");
                })
    </script>
</body>
</html>
<?php include '../../template/footer.php';?>