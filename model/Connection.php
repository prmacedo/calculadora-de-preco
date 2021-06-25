<?php

class Connection {
  public static function connect() {
    $hostname = "localhost";
    $database = "inn";
    $username = "root";
    $password = "";

    try {
      $my_connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      $my_connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $my_connection;
    } catch (PDOException $e) {
      return null;
    }
  }  
}
