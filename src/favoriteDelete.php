<?php
	header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("DELETE FROM favorite WHERE 1 AND userid=:userid AND kotobaid=:kotobaid");
        $stmt->bindParam(':userid', $_POST["userid"]);
        $stmt->bindParam(':kotobaid', $_POST["kotobaid"]);
        $stmt->execute();
        print(json_encode(0));
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>