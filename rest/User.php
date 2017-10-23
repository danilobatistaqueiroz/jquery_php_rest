<?php
require_once 'DBConn.php';

new User();

class User {

  public $conn;

  function __construct( ) {

    $this->conn = DBConn::getConn();

    header('Content-Type: application/json');
    define('CHARSET', 'UTF-8');

    $uri = $_SERVER['REQUEST_URI'];
    $method = getenv('REQUEST_METHOD');

    logToFile( "the uri is: $uri \r\n");
    logToFile( "method: '$method' \r\n");

    if($method==="GET"){
      if(isset($_SERVER['QUERY_STRING'])) {
        $data = $_SERVER['QUERY_STRING'];
        $this->get($data);
      }
    } else {
      parse_str(file_get_contents("php://input"), $data );
      if(isset($data) && sizeof($data)>0){
        if ($method==="POST"){
          User::insert($data);
        } else if ($method==="PUT"){
          User::update($data);
        } else if ($method==="DELETE"){
          User::delete($data);
        }
      }
    }
  }

  public function get($data) {
    $sql = "SELECT login, name, email, type, address from users";
    try{
      $result = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo $json_info = json_encode($result);
  }

  public function insert($data) {
    $query = "INSERT into users (login,name,passwd,email,type,address) VALUES (:login,:name,:passwd,:email,:type,:address)";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':login', $data['login'], PDO::PARAM_STR);
      $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
      $stmt->bindValue(':passwd', $data['passwd'], PDO::PARAM_STR);
      $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
      $stmt->bindValue(':type', $data['type'], PDO::PARAM_STR);
      $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

  public function update($data) {
    $query = "UPDATE users SET name=:name, email=:email, type=:type, address=:address WHERE login=:login";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':login', $data['login'], PDO::PARAM_STR);
      $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
      $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
      $stmt->bindValue(':type', $data['type'], PDO::PARAM_STR);
      $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

  public function delete($data) {
    $query = "delete from users where login = :login";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':login', $data['login'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

}
