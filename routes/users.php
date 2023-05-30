<?php
function getUsers(){
    global $db;
    $query = $db->prepare("SELECT * FROM workers");
    $query->execute();
    $result = $query->fetchAll();
    echo json_encode($result);
}

