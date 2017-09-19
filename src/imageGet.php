<?php
    header("Content-Type: text/html; charset=UTF-8");
		require('mysqlini.php');
		$servername = $db['host'];
		$dbname = $db['dbname'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db['user'], $db['pass']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT COUNT(id) AS imagecount ,COUNT(userid) AS testcount FROM image");
        $stmt->execute();

		print("[{");

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$imagecount = mb_convert_encoding($result['imagecount'],"utf-8","auto");
			print("\"imagecount\":\"" . $imagecount . "\",");
			$testcount = mb_convert_encoding($result['testcount'],"utf-8","auto");
			print("\"testcount\":\"" . $testcount . "\"},{");
        }
        print("\"imagecount\":\"0\",\"testcount\":\"0\"}]");
    }
    catch(PDOException $e) {
        print(json_encode(-1));
    }
?>
