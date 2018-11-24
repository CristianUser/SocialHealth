<?php
$directorio = '../../../private/files/4/documents';
$ficheros1  = scandir($directorio);
$ficheros2  = scandir($directorio, 1);
 //echo realpath($directorio). PHP_EOL;
//print_r($ficheros1);
$array;
$x=0;
foreach($ficheros1 as $value){
    if($value!="." and $value!=".."){
        $array[$x]['name']=$value;
        $array[$x]['size']=filesize($directorio.'/'.$value);
        // $imgDataP = base64_encode(file_get_contents($directorio.'/'.$value));
        // $perfilP = 'data: '.mime_content_type($directorio.'/'.$value).';base64,'.$imgDataP;
        // $array[$x]['fileURL']=$perfilP;
        $x+=1;
    }
    
}
header('Content-Type: application/json');
echo json_encode($array);
?>