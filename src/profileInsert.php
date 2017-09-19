<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("Insert Into user(userid,username,password,image) Values(:userid,:username,:password,:image)");
        $stmt->bindParam(':userid', $_POST["userid"]);
        $stmt->bindParam(':username', $_POST["username"]);
        $stmt->bindParam(':password', $_POST["password"]);
        $stmt->bindParam(':image', $_POST["image"]);
        $stmt->execute();
        print(json_encode(0));
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>