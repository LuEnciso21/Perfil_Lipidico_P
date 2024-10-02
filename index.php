<?php
/* 
TAKEN FORM: https://github.com/oscaruhp/empleados
AUTHOR: Oscar Uh

MODIFIED AND ADAPTED BY: Angelower Santana-Velásquez

*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/*  Conecta con la base de datos en el servidor local 
	usando las credenciales de usuario y contraseña */
$servidor = "localhost"; 
$usuario = "root"; 
$passwd = ""; 
$nombreBaseDatos = "perfillipidico";
$conexionBD = new mysqli($servidor, $usuario, $passwd, $nombreBaseDatos);
/* Consulta UN registro de paciente de la tabla patients teniendo como criterio de búsqueda 
   la variable 'id' que viene en el $_GET["consultar"] 
   */
if (isset($_GET["consultar"])) {
    $id = $_GET["consultar"];

    // Consulta a la tabla usuarios
    $sqlPatient = mysqli_query($conexionBD, "SELECT * FROM usuarios WHERE Documento_identidad='$id'");
    
    // Si se encuentra el paciente
    if (mysqli_num_rows($sqlPatient) > 0) {
        $patient = mysqli_fetch_assoc($sqlPatient);

        // Consulta a la tabla lipidico
        $sqlLipidico = mysqli_query($conexionBD, "SELECT * FROM lipidico WHERE Documento_identidad='$id'");
        
        // Si se encuentra el perfil lipídico
        if (mysqli_num_rows($sqlLipidico) > 0) {
            $lipidico = mysqli_fetch_assoc($sqlLipidico);
            // Combina la información del paciente con el perfil lipídico
            $result = [
                'patient' => $patient,
                'lipidico' => $lipidico
            ];
            echo json_encode($result);
        } else {
            // Si no hay perfil lipídico
            echo json_encode([
                'patient' => $patient,
                'lipidico' => null
            ]);
        }
    } else {
        echo json_encode(["success" => 0]);
    }
    exit();
}

/* Borra un registro de paciente de la tabla patients, teniendo como criterio de búsqueda 
   la variable 'id' que viene en el $_GET["borrar"] 
   */
if (isset($_GET["borrar"])){
        $sqlActivo = mysqli_query($conexionBD,"DELETE FROM usuarios WHERE Documento_identidad=".$_GET["borrar"]);
        if($sqlActivo){
            echo json_encode(["success"=>1]);
            exit();
        }
        else{  echo json_encode(["success"=>0]); }
}
if (isset($_GET["detalles"])) {
    // Consultar la tabla lipidico por Documento_identidad
    $documento = mysqli_real_escape_string($conexionBD, $_GET["detalles"]);
    $sqllipidos = mysqli_query($conexionBD, "SELECT * FROM lipidico WHERE Documento_identidad='" . $documento . "'");

    // Verificar si hay resultados en lipidico
    if (mysqli_num_rows($sqllipidos) > 0) {
        $lipidos = mysqli_fetch_all($sqllipidos, MYSQLI_ASSOC);
        echo json_encode($lipidos); // Solo devolver los resultados de lipidico
    } else {
        echo json_encode([["success" => 0, "message" => "No se encontraron datos en lipidico"]]);
    }
} elseif (isset($_GET["usuarios"])) {
    // Consultar la tabla usuarios
    $sqlPatients_ = mysqli_query($conexionBD, "SELECT * FROM usuarios");

    // Verificar si hay resultados en usuarios
    if (mysqli_num_rows($sqlPatients_) > 0) {
        $patients_ = mysqli_fetch_all($sqlPatients_, MYSQLI_ASSOC);
        echo json_encode($patients_); // Solo devolver los resultados de usuarios
    } else {
        echo json_encode([["success" => 0, "message" => "No se encontraron usuarios"]]);
    }
} else {
    echo json_encode([["success" => 0, "message" => "No se proporcionaron parámetros"]]);
}



/* Inserta un registro de paciente de la tabla patients. La información es recibida en método POST */




/* Actualiza todos los campos de la tabla patients, teniendo como criterio de búsqueda 
   la variable 'id' que viene en el $_GET["actualizar"]
   */
if(isset($_GET["actualizar"])){ 
    $data = json_decode(file_get_contents("php://input"));
    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $doc=$data->doc;
	$name=$data->name;
	$lastname=$data->lastname;  
	$sqlPatient = mysqli_query($conexionBD,"UPDATE documento identidad SET doc='$doc', name='$name',lastname='$lastname' WHERE id='$id'");
	echo json_encode(["success"=>1 ]);
	exit();
    
}

/*
	Muestra todos los registros almacenados en la tabla patients, usando la URL raíz.
*/
