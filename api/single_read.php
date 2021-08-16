<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../Employee.php';

$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getSingleEmployee();

if($item->name != null)
{
    
    $emp_arr = array(
    "status" => 200,
    "data" => array(
    "id" => $item->id,
    "name" => $item->name,
    "email" => $item->email,
    "designation" => $item->designation,
    "created" => $item->created
    )
    );

    http_response_code(200);
    echo json_encode($emp_arr);
}
else
{
    $respose["status"] = 404;
    $respose["Message"] = "Error";
    echo json_encode($respose);
}

?>