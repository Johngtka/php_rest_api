<?php

    function getWorkers(){
        global $db;
        $query = $db->prepare("SELECT * FROM workers");
        $query->execute();
        $result = $query->fetchAll();
        echo json_encode($result);
    }

    function postWorker($data){
        global $db;
        $query = $db->prepare("INSERT INTO workers VALUES (NULL, :name, :surName, :dob)");
        $query->bindParam(':name', $data['name']);
        $query->bindParam(':surName', $data['surName']);
        $query->bindParam(':dob', $data['dob']);
        $query->execute();
    }

    function searchWorkers($data){
        global $db;
        $query = $db->prepare("SELECT name, surName FROM workers WHERE name=:imie");
        $query->bindParam(':imie',  $data['name']);
        $query->execute();
        $result = $query->fetchAll();
        echo json_encode($result);
    }

    function deleteWorker($data){
        global $db;
        $query = $db->prepare("DELETE FROM workers WHERE name=:imie");
        $query->bindParam(':imie', $data['name']);
        $query->execute();
        $dropId = $db->prepare("ALTER TABLE workers DROP id");
        $dropId->execute();
        $addId = $db->prepare("ALTER TABLE workers ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)");
        $addId->execute();
    }