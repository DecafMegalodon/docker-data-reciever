<?php
    if ( isset($_POST["SUBMISSION_PSK"]) && $_POST["SUBMISSION_PSK"] == getenv("SUBMISSION_PSK")){
      echo "Authentication accepted (debug)";
    } else {
      http_response_code(401);
      die();
    }
    $server=getenv('SQL_SERVER');
    $user=getenv('SQL_USER');
    $password=getenv('SQL_PASSWORD');
    $database=getenv('SQL_DATABASE');
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
