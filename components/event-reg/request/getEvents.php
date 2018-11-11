<?php
include '../../../functions/connection.php';
require 'utils.php';
$sql = "SELECT ci.ID_Cita id, ci.Fecha date, ci.horaInicio startf, ci.horaFin endf,ci.Descripcion description, usr.nombre username, usr.apellido userlastname 
FROM citas ci , r_paciente rp ,usuario usr where ci.ID_Pac = rp.ID_Pac and usr.id_usuario =  rp.ID_Cliente and rp.ID_Profesional = 4  and ci.Estado=10";
$resultado = $mysqli->query($sql);
while($row = $resultado->fetch_assoc()) {
    //print_r($row);
    $date=$row['date'];
    $start=$row['startf'];
    $row['start']="$date"."T$start";
    $row['end']=$row['date'].'T'.$row['endf'];
    $row['title']=$row['username'].' '.$row['userlastname'];
    //$row['allday']=false;
    //$row['editable']=false;
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
//$json=substr($json,0,strlen($json)-1);




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
//echo($json);
?>