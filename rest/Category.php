<?php
require_once 'DBConn.php';

new Category();

class Category {

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
          Category::insert($data);
        } else if ($method==="PUT"){
          Category::update($data);
        } else if ($method==="DELETE"){
          Category::delete($data);
        }
      }
    }
  }

  public function get($data) {
    $sql = "SELECT id, name from categories";
    try{
      $result = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo $json_info = json_encode($result);
  }

  public function insert($data) {
    $query = "INSERT into categories (name) VALUES (:name)";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

  public function update($data) {
    $query = "UPDATE categories SET name=:name WHERE id=:id";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

  public function delete($data) {
    $query = "delete from categories where id = :id";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

}
