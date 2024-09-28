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
if (isset($_GET["consultar"])){
        $sqlPatient = mysqli_query($conexionBD,"SELECT * FROM usuarios WHERE DocumentoIdentidad=".$_GET["consultar"]);
        if(mysqli_num_rows($sqlPatient) > 0){
            $patient = mysqli_fetch_all($sqlPatient,MYSQLI_ASSOC);
            echo json_encode($patient); 
            exit();
        } else{  echo json_encode(["success"=>0]); }
}

/* Borra un registro de paciente de la tabla patients, teniendo como criterio de búsqueda 
   la variable 'id' que viene en el $_GET["borrar"] 
   */
if (isset($_GET["borrar"])){
        $sqlActivo = mysqli_query($conexionBD,"DELETE FROM usuarios WHERE id=".$_GET["borrar"]);
        if($sqlActivo){
            echo json_encode(["success"=>1]);
            exit();
        }
        else{  echo json_encode(["success"=>0]); }
}
/* Inserta un registro de paciente de la tabla patients. La información es recibida en método POST */
if(isset($_GET["insertar"])){
        $data = json_decode(file_get_contents("php://input"));
		$id_=$data->id;
        $doc=$data->doc;
		$name=$data->name;
        $lastname=$data->lastname; 
            if(($doc!="")&&($name!="")&&($lastname!="")){        
                $sqlPatient = mysqli_query($conexionBD,"INSERT INTO usuarios(doc,name,lastname) VALUES(null,'$doc','$name','$lastname') ");
                echo json_encode(["success"=>1]);
            }
    exit();
}


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
$sqlPatients_ = mysqli_query($conexionBD,"SELECT * FROM usuarios");
if(mysqli_num_rows($sqlPatients_) > 0){
    $patients_ = mysqli_fetch_all($sqlPatients_,MYSQLI_ASSOC);
    echo json_encode($patients_);
}
else{ echo json_encode([["success"=>0]]); }
?>