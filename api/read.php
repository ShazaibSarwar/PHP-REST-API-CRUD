<?php
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../Employee.php';

$database = new Database();

$db = $database->getConnection();
$items = new Employee($db);

$record = $items->getEmployees();

$itemCount = $record->num_rows;

echo json_encode($itemCount);

if($itemCount >0)
{
    $empArray = array();
    $empArray["body"] = array();
    $empArray["itemCount"] = $itemCount;

    while($row = $record->fetch_assoc())
    {
        array_push($empArray["body"], $row);
    }


}
*/


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../Employee.php';

$database = new Database();

$db = $database->getConnection();

$items = new Employee($db);
$records = $items->getEmployees();
$itemCount = $records->num_rows;

echo json_encode($itemCount);

if ($itemCount > 0) 
{
    $employeeArr = array();
    $employeeArr["status"] = 200;
    $employeeArr["body"] = array();
    $employeeArr["itemCount"] = $itemCount;

    while ($row = $records->fetch_assoc())
    {
        array_push($employeeArr["body"], $row);
    }

    echo json_encode($employeeArr);

} else {
    $respose["status"] = 404;
    $respose["Message"] = "Error";
    echo json_encode($respose);
}
?>