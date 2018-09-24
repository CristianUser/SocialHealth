<?php

$table =<<<EOT
 (
    SELECT nombre, apellido FROM usuario WHERE id_usuario in (SELECT ID_Cliente FROM r_paciente WHERE ID_Profesional = 4)
 ) temp
EOT;
$primaryKey = 'id_usuario';

$columns = array(
   array( 'db' => 'nombre', 'dt' => 0 ),
   array( 'db' => 'apellido','dt' => 1 ),
   array( 'db' => 'correo','dt' => 2 ),
   array( 'db' => 'usuario','dt' => 3 )
);

$sql_details = array(
   'user' => 'root',
   'pass' => '',
   'db'   => 'socialhealth',
   'host' => 'localhost'
);

require( 'ssp.class.php' );
echo json_encode(
   SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);