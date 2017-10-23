<?php
require_once 'DBConn.php';

new Product();

class Product {

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
          Product::insert($data);
        } else if ($method==="PUT"){
          Product::update($data);
        } else if ($method==="DELETE"){
          Product::delete($data);
        }
      }
    }
  }

  public function get($data) {
    $sql = "SELECT p.id, p.name, description, c.name category, price from products p, categories c where p.categoryid = c.id";
    try{
      $result = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo $json_info = json_encode($result);
  }

  public function insert($data) {
    $query = "INSERT into products (name,description,categoryid,price) VALUES (:name,:description,:categoryid,:price)";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
      $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $stmt->bindValue(':categoryid', $data['categoryid'], PDO::PARAM_INT);
      $stmt->bindValue(':price', $data['price'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

  public function update($data) {
    $query = "UPDATE products SET name=:name, description=:description, categoryid=:categoryid, price=:price WHERE id=:id";
    try{
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
      $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $stmt->bindValue(':categoryid', $data['categoryid'], PDO::PARAM_STR);
      $stmt->bindValue(':price', $data['price'], PDO::PARAM_STR);
      $numrows = $stmt->execute();
      logToFile($numrows);
    } catch(PDOException $e) {
      logToFile($e->getMessage());
      die();
    }
    echo true;
  }

  public function delete($data) {
    $query = "delete from products where id = :id";
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
