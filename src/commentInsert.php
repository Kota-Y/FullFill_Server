<?php
	header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("Insert Into comment(userid,kotobaid,comment) Values(:userid,:kotobaid,:comment)");
        $stmt->bindParam(':userid', $_POST["userid"]);
		$stmt->bindParam(':kotobaid', $_POST["kotobaid"]);
		$stmt->bindParam(':comment', $_POST["comment"]);
        $stmt->execute();
        print(json_encode(0));
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>