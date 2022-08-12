<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/employees.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new Employee($db);
    $stmt = $items->getEmployees();
    $itemCount = $stmt->rowCount();

    $response = array();
    $response["mensaje"] = "No se encontraron elementos";
    $response["estatus"] = 0;
    $response["data"] = array();

    if($itemCount > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "age" => $age,
                "designation" => $designation,
                "created" => $created
            );
            array_push($response["data"], $e);
        }

        $response["mensaje"] = "Operación realizada con éxito";
        $response["estatus"] = 1;

        echo json_encode($response);
    }
    else{

        $response["mensaje"] = "No se encontraron elementos";
        $response["estatus"] = 0;
        $response["data"] = array();

        echo json_encode($response);
    }
?>