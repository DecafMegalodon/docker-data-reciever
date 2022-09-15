<?php
    // Check if the request has a valid credential
    if ( !isset($_POST["SUBMISSION_PSK"]) || $_POST["SUBMISSION_PSK"] != getenv("SUBMISSION_PSK")){
      http_response_code(401);
      die();
    }
    $server=getenv('SQL_SERVER');
    $user=getenv('SQL_USER');
    $password=getenv('SQL_PASSWORD');
    $database=getenv('SQL_DATABASE');
    $table=getenv('SQL_TABLE');
    $keys=explode(",", getenv('POST_KEYS'));

    $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $querytext = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, getenv('POST_KEYS'), 
                         ":".join(", :", $keys));
    $stmt = $conn->prepare($querytext);
    //Help prevent the remainder of possible attacks by using true prepared stmts
    //$stmt->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    foreach($keys as $key){
        if(!isset($_POST[$key])){
            http_response_code(400);
            die();
        }
        $stmt->bindParam(":" . $key, $_POST[$key]);
    }
    try{
      $stmt->execute();
    } catch (PDOException $e) {
        http_response_code(500);
        echo  "SQL error:" . $e->getMessage();
        die();
    }
?>
