<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/employees.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Employee($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    

    $response = array();
    $response["mensaje"] = "No fue posible realizar la operación";
    $response["estatus"] = 0;
    $response["data"] = array();

    try{
        if($item->deleteEmployee()){
            $response["mensaje"] = "Operación realizada con éxito";
            $response["estatus"] = 1;
            $response["data"] = array();
            echo json_encode($response);
        } else{
            $response["mensaje"] = "No fue posible realizar la operación";
            $response["estatus"] = 0;
            $response["data"] = array();
            echo json_encode($response);
        }
    }catch(Exception $ex){
        $response["mensaje"] = "No fue posible realizar la operación ".$ex;
        $response["estatus"] = -1;
        $response["data"] = array();
    }
    
?>