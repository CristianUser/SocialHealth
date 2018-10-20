        $('#progreso').hide();
        $('#alertSuccess').hide();
        $('#alertDanger').hide();
        $('#page').hide();
        let basic = $('#demo-basic').croppie({
            enableExif: true,
            viewport: {width: 200, height: 200, type: 'square'}
        });
        $("#btn").click(()=>{
           basic.croppie('result',{type:'base64',size:'original',format:'png'}).then(function(html){
            //$("#view").html(html);
               //console.log(html);
            enviarFoto(html);
           });
        })
        function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
          //Solo admitimos imágenes.
          if (!f.type.match('image.*')) {
              continue;
          }
    
          var reader = new FileReader();
    
          reader.onload = (function(theFile) {
              return function(e) {
                // Insertamos la imagen
                $('#example').hide();
                $('#page').show();
                $('#btn').show();
                basic.croppie('bind', {
                url: e.target.result,
                zoom:0
            });
              //document.getElementById("image").src = e.target.result;
              };
          })(f);
    
          reader.readAsDataURL(f);
        }
    }
    document.getElementById('upload').addEventListener('change',archivo, false);
    let enviarFoto = (req)=>{
        let parametros = {
            id:id,
            token:token,
            img:req
        };
        $.ajax({
            url : '/SocialHealth/functions/dbActions/uploadPhoto.php',
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(e) {
                    console.log(Math.floor(e.loaded / e.total *100) + '%');
                    let percent=e.loaded / e.total * 100;
                    $('#progreso').show();
                    $('#progreso .Barra').attr('style','width:'+percent+'%');
                    $('#progreso .Barra').html('Subiendo...');
                    if(percent==100){
                        $('#progreso .Barra').html('Comprimiendo...');
                    }
                };
                return xhr;
            },
            data : parametros,
            type : 'POST',
            success : function(res) {
                console.log(res);
                if(res=='Correcto'){
                    $('#alertSuccess').show();
                    setTimeout(function(){ window.location.reload(false); },3000);
                }else{
                    $('#alertDanger').show();
                }
            },
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
            },
            complete : function(xhr, status) {
                // $("#loadingreg").hide();
                console.log('Petición realizada');
            }
        });
    }