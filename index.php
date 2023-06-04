<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST");

$config = require_once 'dbconnect.php';
$users = require_once './routes/workers.php';

try {
  $db = new PDO("mysql:host={$config['host']};dbname={$config['db']};charset=utf8", $config['user'], $config['pass'], [PDO::ATTR_EMULATE_PREPARES => false, PDO::ERRMODE_EXCEPTION]);

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // getting all employers
    $users.getWorkers();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $requestData = json_decode(file_get_contents('php://input'), true);

    // new employee
    if (isset($requestData['name']) && isset($requestData['surName']) && isset($requestData['dob'])) {
        $data = [
          'name' => $requestData['name'],
          'surName' => $requestData['surName'],
          'dob' => $requestData['dob']
        ];
        $users.postWorker($data);
    }
    
    // search employee
    if(isset($requestData['name'])){
        $data = [
          'name' => $requestData['name']
        ];
        $users.searchWorkers($data);
    }else{
        echo json_encode("xd");
    }

    if(isset($requestData['del']) && $requestData['del']===true){
        $data = [
          'name'=> $requestData['name'] 
        ];
        $users.deleteWorker($data);
    };
    }
} catch (PDOException $error) {
   echo http_response_code(500);
}
?>
