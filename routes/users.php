<?php
function getUsers(){
    global $db;
    $query = $db->prepare("SELECT * FROM test3");
    $query->execute();
    $result = $query->fetchAll();
    echo json_encode($result);
}

