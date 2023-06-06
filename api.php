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

                // search employee
                if(isset($requestData['name']) && !isset($requestData['new']) && !isset($requestData['del'])){

                    $data = [
                    'name' => $requestData['name']
                    ];

                    $users.searchWorkers($data);

                } else if ($requestData===[]){
                    echo "xd";
                }
        
                // new employee
                if (isset($requestData['new']) && $requestData['new'] != false) {

                    $data = [
                    'name' => $requestData['name'],
                    'surName' => $requestData['surName'],
                    'dob' => $requestData['dob']
                    ];

                    $users.postWorker($data);
                    // echo json_encode($requestData);

                } 
                // else if(isset($requestData['new']) && $requestData['new'] != true || !isset($requestData['new'])&&!isset($requestData['del'])){
                //     echo "nie ma tak";
                // }
        
                // delete employee 
                if(isset($requestData['del']) && $requestData['del'] != false){

                    $data = [
                    'name'=> $requestData['name'] 
                    ];
                    
                    $users.deleteWorker($data);
                    
                    // echo json_encode($requestData);
                } 
                // else if (isset($requestData['del']) && $requestData['del'] != true || !isset($requestData['new'])&&!isset($requestData['del'])){
                //     echo "nie";
                // }
            }
    }