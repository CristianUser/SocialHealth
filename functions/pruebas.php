<?php
include './connection.php';
include './funcs.php';

if(isSetup(5)){
    echo 'it is';
}else{
    echo 'it is not';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="dropzone.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div  >
        <div id="mydrop" class="dropzone">
        </div>
    </div>
    <script src="./dropzone.js"></script>
    <script>
        var myDropzone = new Dropzone("#mydrop", { 
            url: "/file/post",
            autoProcessQueue:false
        });
    </script>
</body>
</html>