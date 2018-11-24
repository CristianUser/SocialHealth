<?php
include '../../functions/sesion.php'; 
include '../../template/header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            /* width:600px; */
        font-family:"Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif;font-size:14px;}
        .link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}
        .disabled {cursor:not-allowed;color: #bccfd8;}
        .current {background: #bccfd8;}
        .first{border-left:#bccfd8 1px solid;}
        .question {font-weight:bold;}
        .answer{padding-top: 10px;}
        #pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}
        .dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}
        #overlay {background-color: rgba(255, 255, 255, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 90%;height: 90%;display: none;}
        #overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
        .page-content {padding: 20px;margin: 0 auto;}
        .pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}
        .col{
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <form action="">
                    <div class="">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchBox" placeholder="Buscar" aria-describedby="searchButton" required>
                            <div class="input-group-prepend" id="searchButton">
                                <span class="input-group-text text-primary" >
                                    <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row text-right">
            <div class="col">
                    <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span><i class="fas fa-filter"></i></span>Filtro
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col">
                                            <p>Region</p>
                                            <select class="form-control" name="" id="">
                                                <option value="">Seleccion</option>
                                            </select>
                                    </div>
                                    <div class="col">
                                        <p>Provincia</p>
                                        <select class="form-control" name="" id="">
                                            <option value="">Seleccion</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col">

            
            <div id="overlay"><div><img src="/SocialHealth/loading.gif" width="64px" height="64px"/></div></div>
                <div class="page-content">
                    
                        <div id="pagination-result">
                    
                    <input type="hidden" name="rowcount" id="rowcount" />
                </div>
            </div>


            </div>
        </div>
    </div>
    <script>
function getresult(url) {
    var datos={
            rowcount:$("#rowcount").val(),
            pagination_setting:$("#pagination-setting").val()
        };
	$.ajax({
		url: url,
		type: "GET",
		data:  datos,
		beforeSend: function(){$("#overlay").show();},
		success: function(data){
		$("#pagination-result").html(data);
		setInterval(function() {$("#overlay").hide(); },500);
		},
		error: function() 
		{} 	        
   });
}
getresult("./request/getresult.php");
function changePagination(option) {
	if(option!= "") {
		getresult("./request/getresult.php");
	}
}
var byName = ()=>{
    var datos={
            rowcount:$("#rowcount").val(),
            pagination_setting:$("#pagination-setting").val(),
            keyword:$("#searchBox").val()
        };
    $.ajax({
		url: 'request/getresult.php',
		type: "GET",
		data:  datos,
		beforeSend: function(){$("#overlay").show();},
		success: function(data){
		$("#pagination-result").html(data);
		setInterval(function() {$("#overlay").hide(); },500);
		},
		error: function() 
		{} 	        
   });
}
var addPerson = (iddoc)=>{
    $.ajax({
        url:'./request/addPerson.php',
        type:'post',
        data:{
            iddoc:iddoc,
            idpac:id
        },
        success:(res)=>{
            console.log(res);
            if(res.exist){
                swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Ya Tienes este doctor en tu lista!',
                        confirmButtonClass:'btn btn-cmj'
                        })
            }else{

                if(res.success){
                    swal({
                        type: 'success',
                        title: 'Doctor Añadido',
                        confirmButtonClass:'btn btn-cmj'
                        })
                }else{
                    swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Error en la insercion, Favor Comuniquese con Nosotros!',
                            confirmButtonClass:'btn btn-cmj'
                            })
                }
            }
        }
    });
};
$('#searchButton').click(()=>{
   byName();
});
$('#searchBox').keypress((e)=>{
    if(e.keyCode==13){
    e.preventDefault();
    byName();
    }
});
</script>
</body>
</html>
<?php include '../../template/footer.php';?>