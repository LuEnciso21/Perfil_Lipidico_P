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

/* Inserta un registro de paciente en la tabla usuarios y en lipidico */
if (isset($_GET["insertar"])) {
    $data = json_decode(file_get_contents("php://input"));

    // Verificar que los datos sean válidos
    if ($data && isset($data->Documentoidentidad) && isset($data->Nombres) && isset($data->Apellidos) && 
        isset($data->Edad) && isset($data->Genero) && isset($data->EPS) && 
        isset($data->CHOLT) && isset($data->HDL) && isset($data->LDL) && isset($data->TRIG)) {

        // Obtener datos
        $doc = $conexionBD->real_escape_string($data->Documentoidentidad);
        $name = $conexionBD->real_escape_string($data->Nombres);
        $lastname = $conexionBD->real_escape_string($data->Apellidos);
        $edad = $conexionBD->real_escape_string($data->Edad);
        $genero = $conexionBD->real_escape_string($data->Genero);
        $eps = $conexionBD->real_escape_string($data->EPS);
        
        // Nuevas variables para la tabla lipidico
        $cholt = $conexionBD->real_escape_string($data->CHOLT);
        $hdl = $conexionBD->real_escape_string($data->HDL);
        $ldl = $conexionBD->real_escape_string($data->LDL);
        $trig = $conexionBD->real_escape_string($data->TRIG);

        // Consulta para insertar el nuevo paciente en la tabla usuarios
        $sqlPatient = "INSERT INTO usuarios (`Documento identidad`, Nombres, Apellidos, Edad, Genero, EPS) 
                       VALUES ('$doc', '$name', '$lastname', '$edad', '$genero', '$eps')";
        
        if (mysqli_query($conexionBD, $sqlPatient)) {
            // Si la inserción en usuarios fue exitosa, obtener el ID del nuevo paciente
            $patientId = $conexionBD->insert_id; // Obtiene el último ID insertado
            
            // Consulta para insertar en la tabla lipidico
            $sqlLipidico = "INSERT INTO lipidico (`Documento identidad`, CHOLT, HDL, LDL, TRIG) 
                            VALUES ('$doc', '$cholt', '$hdl', '$ldl', '$trig')";
            
            if (mysqli_query($conexionBD, $sqlLipidico)) {
                echo json_encode(["success" => 1]);
            } else {
                echo json_encode(["success" => 0, "error" => mysqli_error($conexionBD)]);
            }
        } else {
            echo json_encode(["success" => 0, "error" => mysqli_error($conexionBD)]);
        }
    } else {
        echo json_encode(["success" => 0, "error" => "Datos incompletos"]);
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
