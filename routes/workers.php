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
        $result = $query->fetchAll();
        echo json_encode($result);
    }

    function searchWorkers($data){
        global $db;
        $query = $db->prepare("SELECT name, surname FROM workers WHERE name = :imie");
        $query->bindParam(':imie', $data['name']);
        $query->execute();
        $result = $query->fetchAll();
        echo json_encode($result);
    }

    function editWorker($data){
        global $db;
        $query = $db->prepare("UPDATE workers SET name = :imie, surname = :nazwisko WHERE id = :workerId");
        $query->bindParam(':imie', $data['name']);
        $query->bindParam(':nazwisko', $data['surName']);
        $query->bindParam(':workerId', $data['workerId']);
        $query->execute();
        $result = $query->fetchAll();
        echo json_encode($result);
    }   

    function deleteWorker($data){
        global $db;
        $query = $db->prepare("DELETE FROM workers WHERE id = :numer");
        $query->bindParam(':numer', $data['id']);
        $query->execute();
        $dropId = $db->prepare("ALTER TABLE workers DROP id");
        $dropId->execute();
        $addId = $db->prepare("ALTER TABLE workers ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)");
        $addId->execute();
    }