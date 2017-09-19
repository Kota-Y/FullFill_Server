<?php
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$name=$_POST["username"];
//$id=$_POST["id"];
        $stmt = $conn->prepare("UPDATE user SET username=:username WHERE 1 AND id=:id");
        $stmt->bindParam(':username',$_POST["username"]);
        $stmt->bindParam(':id',$_POST["id"]);
        $stmt->execute();
        print(json_encode(0));
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>