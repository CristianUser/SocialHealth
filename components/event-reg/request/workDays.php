<?php
include 'connection.php';
require 'utils.php';
session_start();
$token = $_SESSION['token'];
if($_GET['token']!=$token){
    exit('Error en la peticion');
}
$doctorId=$_GET['id'];
$sql = "SELECT h.ajustes FROM horario h WHERE h.id_horario=$doctorId";
$persona = $mysqli->query($sql);
$result=$persona->fetch_assoc();
$array= json_decode($result["ajustes"],true)['array'];
$dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
if($array==null){//creando default si no ha configurado su horario
    unset($array);
    for($i=0;$i<7;$i++){
        $array[$i]['dia']=$dias[$i];
        $array[$i]['ajustes'][]=[];
        $array[$i]['ajustes'][0]['horaFin']='20:00';
        $array[$i]['ajustes'][0]['horaInicio']='06:00';
        if($i==6){
            $array[$i]['ajustes']=[];
        }
    }
}
// print_r($array);
// exit('');
//Creando lista de horas
$interval = new DateInterval('PT01H');
$dayStart=date_create_from_format('H:i','00:00');
$dayEnd= date_create_from_format('H:i','24:00');
$daterange2 = new DatePeriod($dayStart, $interval, $dayEnd);
foreach($daterange2 as $date) {
    $dayHours[]= $date->format('H:i');
}

$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

$interval2 = new DateInterval('P1D');
$weekRange = new DatePeriod($range_start, $interval2, $range_end);

$lista=[];
$lista2=[];
$freeHoursW;

foreach($weekRange as $date1) {
    $lista2[]=$date1->format('Y-m-d');
    //echo '<h3>'.$date1->format('D')."</h3><br>";
    $weekday= (int) $date1->format('w');
    $weekday-=1;
    if($weekday==-1){$weekday=6;}
    foreach($array[$weekday]['ajustes'] as $day){
        //echo '<h3>'.$date1->format('D')."</h3><br>";
        $hourStart=date_create_from_format('H:i',$day['horaInicio']);
        $hourEnd= date_create_from_format('H:i',$day['horaFin']);
        $daterange = new DatePeriod($hourStart, $interval, $hourEnd);
        
        
        foreach($daterange as $date2) {
            $freeHours[]= $date2->format('H:i');
            //echo $date2->format('H:i').'<br>';
        }
        unset($date2);
        
        
        
    }
    if(isset($freeHours)){
        $freeHoursW[]=$freeHours;
        unset($freeHours);
    }else{
        $freeHoursW[]=[];
    }
    //echo sizeof($freeHoursW);
}
foreach($freeHoursW as $freeHours){




    foreach($dayHours as $date3){
        if(!in_array($date3,$freeHours)){
           $x[]=$date3; 
        }else{
            if(isset($x)){
                $w[]=$x;
                unset($x);
            }

        }
        
    }
    $w[]=$x;
    unset($x);
    $lista[]=$w;
    unset($w);

    
}
$cont=0;
$json='[';
foreach($lista as $element){
    //print_r($element);
        //echo '<hr>';
    foreach($element as $hora){
        $poss=count($hora);
        //echo $lista2[$cont].'T'.$hora[0].'-'.$lista2[$cont].'T'.$hora[$poss-1].'<br>';
        $eventos['start']=$lista2[$cont].'T'.$hora[0];
        $date= new DateTime($hora[$poss-1]);
        $date->add(new DateInterval('PT1H'));
        if($date->format('H:i')=='00:00'){
            $dateEnd='23:59';
        }else
        {
            $dateEnd=$date->format('H:i');
        }
        $eventos['end']=$lista2[$cont].'T'.$dateEnd;
        $eventos['title']='No Work';
        $eventos['editable']=false;
        $eventos['color']='#d7d7d7';
        $eventos['className']='work-hours';
        $json.=json_encode($eventos).',';
    }
    $cont+=1;
    if($cont==7){$cont=0;}

        
}
// eventos reales
$userId=$_GET['userId'];
$sql = "SELECT ci.ID_Cita id,rp.ID_Cliente idPac, ci.Fecha date, ci.horaInicio startf, ci.horaFin endf,ci.Descripcion description, usr.nombre username, usr.apellido userlastname 
FROM citas ci , r_paciente rp ,usuario usr where ci.ID_Pac = rp.ID_Pac and usr.id_usuario =  rp.ID_Cliente and rp.ID_Profesional = $doctorId and ci.Estado='Pendiente'";
$resultado = $mysqli->query($sql);
while($row = $resultado->fetch_assoc()) {
    //print_r($row);
    $date=$row['date'];
    $start=$row['startf'];
    $row['start']="$date"."T$start";
    $row['end']=$row['date'].'T'.$row['endf'];
    $row['title']='Ocupado';
    $row['editable']=false;
    if($row['idPac']==$userId){
        $row['title']=$row['username'].' '.$row['userlastname'];
        $row['color']='green';
        $row['status']='pendient';
    }
    unset($row['idPac']);
    unset($row['startf']);
    unset($row['endf']);
    unset($row['date']);
    unset($row['username']);
    unset($row['userlastname']);
    unset($row['id']);
    $jsonEcod =json_encode($row);
    $json .= "$jsonEcod";
    $json.= ',';
}
$json=substr($json,0,strlen($json)-1);
$json.=']';
//echo $json;


// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
    die("Please provide a date range.");
  }
  
  // Parse the start/end parameters.
  // These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
  // Since no timezone will be present, they will parsed as UTC.
  $range_start = parseDateTime($_GET['start']);
  $range_end = parseDateTime($_GET['end']);
  
  // Parse the timezone parameter if it is present.
  $timezone = null;
  if (isset($_GET['timezone'])) {
    $timezone = new DateTimeZone($_GET['timezone']);
  }

$input_arrays = json_decode($json, true);

$output_arrays = array();
foreach ($input_arrays as $array) {

  // Convert the input array into a useful Event object
  $event = new Event($array, $timezone);

  // If the event is in-bounds, add it to the output
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}

// Send JSON to the client.
echo json_encode($output_arrays);
?>