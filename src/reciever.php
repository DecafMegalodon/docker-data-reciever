<?php
    $server=getenv('SQL_SERVER');
    $user=getenv('SQL_USER');
    $password=getenv('SQL_PASSWORD');
    $database=getenv('SQL_DATABASE');
    echo $server . $user . $password . $database;
    try{
      $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("INSERT INTO test (testval)
          VALUES (:data)");
      $stmt->bindParam(':data', $variablehere);
      $variablehere = $_POST["storagevalue"];
      $stmt->execute();
    } catch (PDOException $e) {
      echo  "SQL error:" . $e->getMessage();
    }
    //phpinfo();
?>
