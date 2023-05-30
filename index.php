<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$config = require_once 'dbconnect.php';
$users = require_once './routes/users.php';

try{
  $db = new PDO("mysql:host={$config['host']};dbname={$config['db']};charset=utf8", $config['user'], $config['pass'], [PDO::ATTR_EMULATE_PREPARES => false, PDO::ERRMODE_EXCEPTION]);
  if($_SERVER['REQUEST_METHOD']==='GET'){
    $users.getUsers();
  }
} catch(PDOException $error){
  echo json_encode(['error' => 'Błąd połączenia z bazą danych']);
}
