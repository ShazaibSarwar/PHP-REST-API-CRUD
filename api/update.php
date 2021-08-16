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

$item->id = isset($_POST['id']) ? $_POST['id'] : die();
$item->name = $_POST['name'];
$item->email = $_POST['email'];
$item->designation = $_POST['designation'];
$item->created = date('Y-m-d H:i:s');

$respose["status"] = 404;
if($item->updateEmployee())
{
    $respose["status"] = 200;
    $respose["Message"] = "Emplyee Updated Successfully";
    echo json_encode($respose);
} 
else
{
    $respose["status"] = 404;
    $respose["Message"] = "Error";
    echo json_encode($respose);
}
?>