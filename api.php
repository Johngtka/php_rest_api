<?php
    function API(){
        $users = require_once './routes/workers.php';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // getting all employers
            $users.getWorkers();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // formatting data from post request sended in json to assoc array
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
    
            // delete employee 
            if(isset($requestData['del']) && $requestData['del']===true){
                $data = [
                'name'=> $requestData['name'] 
                ];
                $users.deleteWorker($data);
            };
        }
    }