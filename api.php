<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$config = require_once 'dbconnect.php';

try{
  $db = new PDO("mysql:host={$config['host']};dbname={$config['db']};charset=utf8", $config['user'], $config['pass'], [PDO::ATTR_EMULATE_PREPARES => false, PDO::ERRMODE_EXCEPTION]);
  if($_SERVER['REQUEST_METHOD']==='GET'){
    $query = $db->prepare("SELECT * FROM test3");
    $query->execute();
    $result = $query->fetchAll();
    echo json_encode($result);
  }
} catch(PDOException $error){
  echo json_encode(['error' => 'Błąd połączenia z bazą danych']);
}
