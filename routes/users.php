<?php
function getUsers(){
    global $db;
    $query = $db->prepare("SELECT * FROM workers");
    $query->execute();
    $result = $query->fetchAll();
    echo json_encode($result);
}
function postUser($data){
    global $db;
    $query = $db->prepare("INSERT INTO workers VALUES (NULL, :name, :surName, :dob)");
    $query->bindParam(':name', $data['name']);
    $query->bindParam(':surName', $data['surName']);
    $query->bindParam(':dob', $data['dob']);
    $query->execute();
}

function searchUsers($data){
    global $db;
    $query = $db->prepare("SELECT name, surName FROM workers WHERE name=:imie");
    $query->bindParam(':imie',  $data['name']);
    $query->execute();
    $result = $query->fetchAll();
    echo json_encode($result);
}
