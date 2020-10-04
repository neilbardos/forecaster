<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//get posted data
// $data = json_decode(file_get_contents("php://input"));
$data = $_POST;

include_once("infraCostCalculator.php");

// $cost = new infraCostCalculator(100,4,48); //FOR DEBUGGING
$cost = new infraCostCalculator($data['studyPerDay'],$data['growthPercentag'],$data['numberOfMonthsToForecast']);
echo json_encode($cost->calculateCost());
?>