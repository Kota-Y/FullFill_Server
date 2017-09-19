<?php
	header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("Insert Into kotoba(userid,kotoba,whose,genre) Values(:userid,:kotoba,:whose,:genre)");
        $stmt->bindParam(':userid', $_POST["userid"]);
		$stmt->bindParam(':kotoba', $_POST["kotoba"]);
		$stmt->bindParam(':whose', $_POST["whose"]);
		$stmt->bindParam(':genre', $_POST["genre"]);
        $stmt->execute();
        print(json_encode(0));
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>